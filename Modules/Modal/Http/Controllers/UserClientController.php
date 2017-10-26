<?php

namespace Modules\Modal\Http\Controllers;

use Auth;
use Illuminate\Routing\Controller;
use Modules\Modal\Interfaces\UserClientRepositoryInterface;

class UserClientController extends Controller
{
    protected $user_client_repository;

    public function __construct(UserClientRepositoryInterface $user_client_repository)
    {
        $this->user_client_repository = $user_client_repository;
    }

    public function index()
    {
        $auth_id = Auth::id();
        $clients = $this->user_client_repository->where('user_id', $auth_id)->get();
        return view('modal::index', compact('clients'));
    }
}
