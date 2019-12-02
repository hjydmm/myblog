<?php


namespace App\Repositories;

use App\Model\Tag;


class TagRepository implements TagRepositoryInterface
{
    protected static $tag;

    public function __construct(Tag $tag)
    {
        self::$tag = $tag;
    }

    public function getTagList($where = null)
    {
        return self::$tag::where($where ? : [])
            ->select('id', 'name', 'weight', 'index')
            ->orderBy('weight','DESC')
            ->get();
    }

    public function getTagById($id){

        return self::$tag::where('id', $id)->get();
    }


    public function createTag(array $data)
    {
        return self::$tag->insert($data);
    }

    public function createTagGetId(array $data)
    {
        $id = self::$tag->insertGetId($data);
        return $id;
    }

    public function deleteTagById($id)
    {
        //知道主键的话可以直接用destroy($id)方法，而不需要先find($id)，然后delete()
        return self::$tag::destroy($id);
    }

    public function batchDeleteTag(array $ids)
    {
        return self::$tag::destroy($ids);
    }

    public function updateTag($tag_id, array $data){

        return self::$tag::where('id', '=', $tag_id) -> update($data);
    }


}