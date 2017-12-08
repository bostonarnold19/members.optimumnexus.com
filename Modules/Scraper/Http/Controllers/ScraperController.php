<?php

namespace Modules\Scraper\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Scraper\Interfaces\ScraperRepositoryInterface;
use Modules\User\Interfaces\UserRepositoryInterface;

class ScraperController extends Controller
{

    protected $scraper_repository;
    protected $user_repository;

    public function __construct(ScraperRepositoryInterface $scraper_repository, UserRepositoryInterface $user_repository)
    {
        $this->scraper_repository = $scraper_repository;
        $this->user_repository = $user_repository;
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

        try {

            $exist = $this->checkIfExists($request);

            if ($exist) {
                throw new \Exception("Custom URL is already taken");
            }

            \DB::beginTransaction();

            $workshop_data = $request->all();
            $workshop_data['user_id'] = Auth::id();

            $this->scraper_repository->save($workshop_data);
            \DB::commit();
            $msg = 'Save success.';
        } catch (\Exception $e) {
            \DB::rollBack();
            $error_message = $e->getMessage();
        }
        return compact('error_message', 'msg');
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
        try {
            $exist = $this->checkIfExists($request);

            if ($exist && $exist->id != $id) {
                throw new \Exception("Custom URL is already taken");
            }

            \DB::beginTransaction();
            $data = $request->all();
            $this->scraper_repository->update($id, $data);
            $msg = 'Update success.';
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            $error_message = $e->getMessage();

        }
        return compact('error_message', 'msg');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
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

    public function userWorkshop($user_workshop_id, $custom_url)
    {
        $id = $user_workshop_id;
        $page_scrape = $this->scraper_repository->find($id);

        //Scrape
        $phonevalue = 'value="' . $page_scrape->phone . '" ';

        $addy1value = 'value="' . $page_scrape->address_1 . '" ';

        $cityvalue = 'value="' . $page_scrape->city . '" ';

        $zipvalue = 'value="' . $page_scrape->zip_code . '" ';

        $html = file_get_contents($page_scrape->imfurl);

        // set value of phone input
        $offsetofphone = strpos($html, 'placeholder="Enter your phone number"');

        $html2 = substr_replace($html, $phonevalue, $offsetofphone, 0);

        // set value of addy 1
        $offsetofaddy1 = strpos($html2, 'placeholder="Enter your address 1"');

        $html3 = substr_replace($html2, $addy1value, $offsetofaddy1, 0);

        // set value of city
        $offsetofcity = strpos($html3, 'placeholder="Enter your city "');

        $html4 = substr_replace($html3, $cityvalue, $offsetofcity, 0);

        // set value of zip code
        $offsetofzip = strpos($html4, 'placeholder="Enter your zip "');

        $html5 = substr_replace($html4, $zipvalue, $offsetofzip, 0);

        echo $html5;
    }

    public function saveAffiliateNumber(Request $request)
    {
        $affiliate_number = $this->user_repository->where('scraper_affiliate_number', $request->affiliate_number);
        //check if affiliate # is already exist
        if ($affiliate_number->count() > 0) {
            return redirect('scraper')->with('error', 'Affiliate number is already taken.');
        } else {
            //save affiliate #
            $this->user_repository->update(Auth::id(), ['scraper_affiliate_number' => $request->affiliate_number]);
            return redirect('scraper')->with('success', 'Affiliate number saved.');
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
            return redirect('scraper')->with('warning', $error);
        }
        
    }

    private function scrape_imf_home()
    {
        try {
            $scrape = file_get_contents('http://imfreedomworkshop.com/');
            
            $list = [];
            for ($i=3; $i < 13; $i++) { 

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
                    $start = strpos($scrape,'<div class="element-container cf" data-style="" id="le_body_row_4_col_2_el_'.$i.'"><div class="element"> <div class="op-text-block" style="width:100%;text-align: left;"><h4 style="text-align: center;">') + strlen('<div class="element-container cf" data-style="" id="le_body_row_4_col_2_el_'.$i.'"><div class="element"> <div class="op-text-block" style="width:100%;text-align: left;"><h4 style="text-align: center;">');

                    //remove the string before the starting
                    $substr_result = substr($scrape, $start);
                    //get the end position
                    $end = strpos($substr_result, '</a>');
                    //get the result

                    $result = substr($scrape, $start, $end);
                    
                    // seperate the link value and display name
                    $start = strpos($result, '>') + 1;    // add 1 to remove '>'
                    $display_name = substr($result, $start);
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

            //get the starting position
            $start = strpos($scrape,'<form id="contactform"');

            //remove the string before the starting
            $substr_result = substr($scrape, $start);
            //get the end position
            $end = strpos($substr_result, '</form>');
            //get the result

            $result = substr($scrape, $start, $end);
            
        
        }catch (\Exception $e) {
            $error = "We can't connect to the server at ".@$event_location_date[0].". Please try again.";
            // $error = $e->getMessage();
        }

        return compact('error', 'result');
        
    }

    public function storeEvent(Request $request)
    {

        try {

            \DB::beginTransaction();

            $data = $request->all();
            $user_event = [];
            $user_event['user_id'] =  Auth::id();
            $user_event['event_name'] =  $data['event_name'];
            $user_event['other_data'] =  $data['event_data'];
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

    public function eventAttendees()
    {

        return view('scraper::view');
    }

    public function getEvent($id)
    {
        $data = [];
        $event_data = $this->scraper_repository->find($id);
        $other_data = json_decode($event_data->other_data);
        $html = '';
        $counter = 0;
        $html_data = $other_data[0];
        $radio_values = $other_data[1];
        $tag_value = $other_data[2];
        // dd($other_data);
        foreach ($html_data as $key => $value) {
            $html .= '<div class="form-group row">';
              $html .= '<div class="col-12">';
                $html .= '<p><em>' . preg_replace('/\s\s+/', ' ', $value[2]) . '</em></p>';
                $html .= '<div class="form-check">';
                  $html .= '<label class="form-check-label">';
                    $html .= '<input class="form-check-input" type="radio" value="'.$radio_values[$counter].'" name="time">';
                    $html .= $value[0];
                  $html .= '</label>';
                $html .= '</div>';
                $html .= '<div class="form-check">';
                  $html .= '<label class="form-check-label">';
                    $html .= '<input class="form-check-input" type="radio" value="'.$radio_values[$counter+1].'" name="time">';
                    $html .=  $value[1];
                  $html .= '</label>';
                $html .= '</div>';
              $html .= '</div>';
            $html .= '</div>';
            $counter+=2;
        }
        return compact('html');
    }
}
