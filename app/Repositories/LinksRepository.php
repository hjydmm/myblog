<?php

namespace App\Repositories;

use App\Model\Links;

class LinksRepository implements LinksRepositoryInterface
{
    //
    protected static $links;
    
    public function __construct(Links $links)
    {
        self::$links = $links;
    }

    public function getLinks($where, $order_by, $limit = 5){
        if($where == NULL){
            return self::$links->orderBy($order_by, 'DESC')
                ->limit($limit)
                ->get();
        }
        return self::$links->where($where)
            ->orderBy($order_by, 'DESC')
            ->limit($limit)
            ->get();
    }

    public function getLinkList($where = null)
    {
        return self::$links::where($where ? : [])
            ->select('id', 'title', 'url', 'weight', 'show')
            ->orderBy('weight','DESC')
            ->get();
    }

    public function getLinkById($id){

        return self::$links::where('id', $id)->get();
    }


    public function createLink(array $data)
    {
        return self::$links->insert($data);
    }

    public function createLinkGetId(array $data)
    {
        $id = self::$links->insertGetId($data);
        return $id;
    }

    public function deleteLinkById($id)
    {
        //知道主键的话可以直接用destroy($id)方法，而不需要先find($id)，然后delete()
        return self::$links::destroy($id);
    }

    public function batchDeleteLink(array $ids)
    {
        return self::$links::destroy($ids);
    }

    public function updateLink($link_id, array $data){

        return self::$links::where('id', '=', $link_id) -> update($data);
    }


    
}
