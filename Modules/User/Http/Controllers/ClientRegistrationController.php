<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Interfaces\UserRepositoryInterface;

class ClientRegistrationController extends Controller
{
    protected $user_repository;

    public function __construct(UserRepositoryInterface $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    public function registerClient(Request $request)
    {
        $user = $this->user_repository->save($request->all());
    }
}
