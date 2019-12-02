<?php

namespace App\Http\Controllers\Api;

use App\Repositories\AdminRepository;
use Illuminate\Http\Request;

class Admin
{
    protected $admin;
    
    public function __construct(AdminRepository $admin)
    {
        $this->admin = $admin;
    }

    public function pageList(Request $request){
        return $this->admin->pageList();
    }
    
    /**
     * 
     * @description:用户分页列表
     * @author wuyanwen(2017年9月24日)
     * @param@param Request $request
     * @param@return number[]|string[]|NULL[]|unknown[]
     */
    public function page(Request $request)
    {
        
        $params = $request->all();
        $offset = $params['page'] - 1;
        $limit  = $params['limit'];
        
        $where = [];
        
        if (isset($params['username']) && $params['username']) {
            $where[] = ['name', '=', $params['name']];
        }
        if (isset($params['email']) && $params['email']) {
            $where[] = ['email', '=', $params['email']];
        }
       
        $data = $this->admin->page($offset * $limit, $limit, $where);

        return [
            'code' => 0,
            'msg'  => '',
            'count' => $data['total'],
            'data'  => $data['data'],
        ];
    }
}