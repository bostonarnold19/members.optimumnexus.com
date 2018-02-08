<?php

namespace Modules\Scraper\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Scraper\Interfaces\ScraperRepositoryInterface;
use Modules\User\Interfaces\UserRepositoryInterface;
use Modules\Scraper\Interfaces\WorkshopEventAttendeeRepositoryInterface;

class ScraperController extends Controller
{

    protected $scraper_repository;
    protected $user_repository;
    protected $workshop_event_attendee_repository;

    public function __construct(ScraperRepositoryInterface $scraper_repository, UserRepositoryInterface $user_repository, WorkshopEventAttendeeRepositoryInterface $workshop_event_attendee_repository)
    {
        $this->scraper_repository = $scraper_repository;
        $this->user_repository = $user_repository;
        $this->workshop_event_attendee_repository = $workshop_event_attendee_repository;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        //check if user has affiliate number
        if (Auth::user()->scraper_affiliate_number) {
            $workshop_config = $this->scraper_repository->RouteConfig();
            $user_events = $this->scraper_repository->where('user_id',Auth::id())->get();
            return view('scraper::index', compact('user_events', 'workshop_config'));
        } else {
            return view('scraper::enter_affiliate_number');
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('scraper::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('scraper::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('scraper::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
    
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        try {
            \DB::beginTransaction();
            $event = $this->scraper_repository->where('user_id', Auth::id())->where('id', $id)->first();
            if ($event) {
                $this->scraper_repository->delete($id);
            } else {
                throw new \Exception("You cannot delete this event.");
            }
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            $error_message = $e->getMessage();
        }
        return compact('error_message', 'msg');
    }

    /**
     * Check if custom-url exists
     *
     * @param array $request
     * @return Response
     */
    private function checkIfExists($request)
    {
        return $this->scraper_repository->where('custom_url', $request->custom_url)->first();

    }

    public function saveAffiliateNumber(Request $request)
    {
        $affiliate_number = $this->user_repository->where('scraper_affiliate_number', $request->affiliate_number);
        //check if affiliate # is already exist
        if ($affiliate_number->count() > 0) {
            return redirect('om')->with('error', 'Affiliate number is already taken.');
        } else {
            //save affiliate #
            $this->user_repository->update(Auth::id(), ['scraper_affiliate_number' => $request->affiliate_number]);
            return redirect('om')->with('success', 'Affiliate number saved.');
        }
    }

    public function createEvent()
    {

        try {
            
            $lists = $this->scrape_imf_home();

            if ($lists[0]['link'] === false)
                throw new \Exception("We can't connect to the server at imfreedomworkshop.com. Please try again later");
            
            $user_workshop = $this->scraper_repository->where('user_id', Auth::id())->first();
            $workshop_config = $this->scraper_repository->RouteConfig();
            return view('scraper::create', compact('lists', 'workshop_config', 'user_workshop'));

        } catch (\Exception $e) {
            // $error = "We can't connect to the server at imfreedomworkshop.com. Please try again.";
            $error = $e->getMessage();
            return redirect('om')->with('warning', $error);
        }
        
    }

    private function scrape_imf_home()
    {
        try {
            $scrape = file_get_contents('http://imfreedomworkshop.com/');
            
            $list = [];
            for ($i=3; $i < 15; $i++) { 

                //for value
                //get the starting position
                $search = strpos($scrape,'<div class="element-container cf" data-style="" id="le_body_row_4_col_1_el_'.$i.'"><div class="element"> <div class="op-text-block" style="width:100%;text-align: left;"><h4 style="text-align: center;"><strong>');

                if ($search !== false ) {
                    $start =  $search + strlen('<div class="element-container cf" data-style="" id="le_body_row_4_col_1_el_'.$i.'"><div class="element"> <div class="op-text-block" style="width:100%;text-align: left;"><h4 style="text-align: center;"><strong>');


                    //remove the string before the starting
                    $substr_result = substr($scrape, $start);
                    //get the end position
                    $end = strpos($substr_result, '</a>');
                    //get the result

                    $result = substr($scrape, $start, $end);
                    
                    // seperate the link value and display name
                    $start = strpos($result, '>') + 1;    // add 1 to remove '>'
                    $display_date = substr($result, $start);

                    $start = strpos($result, '"') + 1;
                    $link = substr($result, $start);
                    $link = strstr($link, '"',true);

                    //end for value

                    //for name
                    $start = strpos($scrape,'<div class="element-container cf" data-style="" id="le_body_row_4_col_2_el_'.$i.'"><div class="element"> <div class="op-text-block" style="width:100%;text-align: left;">') + strlen('<div class="element-container cf" data-style="" id="le_body_row_4_col_2_el_'.$i.'"><div class="element"> <div class="op-text-block" style="width:100%;text-align: left;">');

                    //remove the string before the starting
                    $substr_result = substr($scrape, $start);

                    $new_start = strpos($substr_result, '<a ') + strlen('<a ');
                    $substr_result = substr($substr_result, $new_start);

                    //get the end position
                    $end = strpos($substr_result, '</a>');

                    //get the result
                    $result = substr($scrape, $start+$new_start, $end);
                    
                    // seperate the link value and display name
                    $start = strpos($result, '>') + 1;    // add 1 to remove '>'
                    $display_name = strip_tags(substr($result, $start));

                    //end for name

                    //save to array
                    $list[] = compact('link', 'display_name', 'display_date');
                }
                
            }
            
            return $list;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function scrapeSelected(Request $request)
    {
        $event_location_date = explode('|', $request->event_location_date);

        try {

            $scrape = file_get_contents($event_location_date[0]);

            //for getting data
            //get the starting position
            $start = strpos($scrape,'<form id="contactform"');

            //remove the string before the starting
            $substr_result = substr($scrape, $start);
            //get the end position
            $end = strpos($substr_result, '</form>');
            //get the result

            $data_result = substr($scrape, $start, $end);

            //for display
            //get the starting position
            $start = strpos($scrape,'<form id="contactform"');

            //remove the string before the starting
            $substr_result = substr($scrape, $start);
            //get the end position
            $end = strpos($substr_result, '<label for="first name');
            //get the result

            $display_result = substr($scrape, $start, $end);
            $display_result .= '</div>';
            $display_result .= '</div>';
            $display_result = str_replace('group-column','form-group row',$display_result);
            $display_result = str_replace('formcolumn','col-sm-6',$display_result);
            $display_result = str_replace('form id','div id',$display_result);
            
        
        }catch (\Exception $e) {
            $error = "We can't connect to the server at ".@$event_location_date[0].". Please try again.";
            // $error = $e->getMessage();
        }

        return compact('error', 'data_result', 'display_result');
        
    }

    public function storeEvent(Request $request)
    {

        try {

            \DB::beginTransaction();

            $data = $request->all();
            $other_data = [
                'form'  => $data['event_form'],
                'tags'  => $data['event_tag']
            ];
            $user_event = [];
            $user_event['user_id'] =  Auth::id();
            $user_event['event_name'] =  $data['event_name'];
            $user_event['other_data'] =  json_encode($other_data);
            $user_event['event_location_date'] =  $data['event_location_date'];
            $this->scraper_repository->save($user_event);
            \DB::commit();
            $msg = 'Save success.';
        } catch (\Exception $e) {
            \DB::rollBack();
            // $error_message = 'Unable to save data.';
            $error_message = $e->getMessage();
        }
        return compact('error_message', 'msg');
    }

    public function eventAttendees($id)
    {
        $event = $this->scraper_repository->where('user_id', Auth::id())->where('id', $id)->first();
        if ($event) {
            $attendees = $this->workshop_event_attendee_repository->where('event_id', $id)->get();
            return view('scraper::view', compact('attendees'));
        } else {
            return redirect('om')->with('error', 'You cannot view this event.');
        }
    }

    public function getEvent($id)
    {
        $data = [];
        $event_data = $this->scraper_repository->find($id);
        $other_data = json_decode($event_data->other_data);
        $html = $other_data->form;
        $counter = 0;
        return compact('html');
    }
}
