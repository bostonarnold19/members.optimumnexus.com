<?php

namespace Modules\Scraper\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Scraper\Interfaces\ScraperRepositoryInterface;
use Auth;

class ScraperController extends Controller
{

    protected $scraper_repository;

    public function __construct(ScraperRepositoryInterface $scraper_repository)
    {
        $this->scraper_repository = $scraper_repository;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $user_workshop      = $this->scraper_repository->where('user_id', Auth::id())->first(); 
        $workshop_config    = $this->scraper_repository->RouteConfig();
        return view('scraper::index', compact('user_workshop','workshop_config'));
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

            if ($exist) 
                throw new \Exception("Custom URL is already taken");

            \DB::beginTransaction();

            $workshop_data = $request->all();
            $workshop_data['user_id'] = \Auth::id();

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

            if ($exist && $exist->id != $id) 
                throw new \Exception("Custom URL is already taken");

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
        $id             = $user_workshop_id;
        $page_scrape    = $this->scraper_repository->find($id);

        //Scrape
        $phonevalue     = 'value="'.$page_scrape->phone.'" ';

        $addy1value     = 'value="'.$page_scrape->address_1.'" ';

        $cityvalue      = 'value="'.$page_scrape->city.'" ';

        $zipvalue       = 'value="'.$page_scrape->zip_code.'" ';

        $html           = file_get_contents($page_scrape->imfurl);
        
        // set value of phone input
        $offsetofphone  = strpos($html, 'placeholder="Enter your phone number"');

        $html2          = substr_replace($html, $phonevalue, $offsetofphone,0);

        // set value of addy 1
        $offsetofaddy1  = strpos($html2, 'placeholder="Enter your address 1"');

        $html3          = substr_replace($html2,  $addy1value, $offsetofaddy1,0);

        // set value of city
        $offsetofcity   = strpos($html3, 'placeholder="Enter your city "');

        $html4          = substr_replace($html3, $cityvalue, $offsetofcity,0);


        // set value of zip code
        $offsetofzip    = strpos($html4, 'placeholder="Enter your zip "');

        $html5          = substr_replace($html4, $zipvalue, $offsetofzip,0);


        echo $html5;
    }
}
