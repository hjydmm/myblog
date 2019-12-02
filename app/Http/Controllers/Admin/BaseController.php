<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

abstract class BaseController extends Controller
{
    //草稿状态
    const DRAFT_STATUS = 1;
    //审核状态
    const AUDIT_STATUS = 2;
    //通过状态
    const PASS_STATUS  = 3;

}