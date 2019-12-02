<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Request;
use App\Http\Controllers\Controller;
use App\Services\UsersService;
use App\Http\Requests\AdminRequest;
use App\Services\BuildMenuService;
use App\Traits\Response;
use Hash;

class RoleController extends BaseController
{
    use Response;
    //
    protected $request ;
    protected $user;

    public function __construct(Request $request, UsersRepository $user)
    {
        $this->request = $request;
        $this->user    = $user;
    }
}
