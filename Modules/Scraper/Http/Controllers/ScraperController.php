<?php

namespace Modules\Scraper\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Scraper\Interfaces\ScraperRepositoryInterface;

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
        // dd($this->scraper_repository->all());
        return view('scraper::index');
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
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
