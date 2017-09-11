<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\User\Interfaces\UserClientRepositoryInterface;

class UserController extends Controller
{
    protected $user_repository;

    public function __construct(UserClientRepositoryInterface $user_client_repository)
    {
        $this->user_client_repository = $user_client_repository;
        $this->middleware('auth');
    }

    public function index()
    {
        $users = $this->user_client_repository->all();
        return view('user::index', compact('users'));
    }

    public function sendEmail()
    {

    }
}
