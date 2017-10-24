<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Interfaces\UserClientRepositoryInterface;

class ClientRegistrationController extends Controller
{
    protected $user_client_repository;

    public function __construct(UserClientRepositoryInterface $user_client_repository)
    {
        $this->user_client_repository = $user_client_repository;
    }

    public function registerClient(Request $request)
    {
        $client = $this->user_client_repository->save($request->all());
        return response()->json([
            'client' => $client,
        ], 200);
    }
}
