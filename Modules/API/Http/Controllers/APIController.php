<?php

namespace Modules\API\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Funnel\Interfaces\PageRepositoryInterface;

class APIController extends Controller
{

    public function __construct(PageRepositoryInterface $page_repository)
    {
        $this->page_repository = $page_repository;
    }

    public function login(Request $request)
    {
        $data = [];
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $data['token'] = $user->createToken('api')->accessToken;
            $data['user_id'] = Auth::user()->id;
            $status = 200;
        } else {
            $data['error'] = "Unauthorised";
            $status = 401;
        }
        return response()->json($data, $status);
    }

    public function syncPages(Request $request)
    {

        if (!isset($request->email) || !isset($request->password) || !isset($request->pages)) {
            return response()->json(['invalid request'], 403);
        } 

        try {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

                DB::beginTransaction();
                //delete old first
                $this->page_repository->where('user_id', Auth::user()->id)->delete();
                //save new
                foreach ($request->pages as $key => $page) {
                    $this->page_repository->create($page);
                }
                
                DB::commit();
                $status = 200;
                $data['message'] = 'save success';

            } else {
                $data['error'] = "Unauthorised";
                $status = 401;
            }
            
        } catch (\Exception $e) {
            $status = 500;
            $data['error'] = $e->getMessage();
            DB::rollBack();
        }
        

        return response()->json($data, $status);
    }
}
