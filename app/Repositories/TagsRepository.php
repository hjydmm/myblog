<?php

namespace App\Repositories;

use App\Model\Tags;

class TagsRepository implements TagsRepositoryInterface
{
    //
    protected static $tags;
    
	public function __construct(Tags $tags)
	{
	    self::$tags = $tags;
	}

    /**
     * author: カ シュンヨウ
     * description: 新建文章的同时插入标签数据
     * @param array $data
     * @return mixed
     */
	public function createTags(array $data)
    {
        return self::$tags->insert($data);
    }

    public function updateTags($aid, array $data)
    {
        $result = self::$tags::where('aid', '=', $aid)->update($data);
        return $result;
    }

    public function deleteTagsById($aid)
    {
        //知道主键的话可以直接用destroy($id)方法，而不需要先find($id)，然后delete()
        return self::$tags::where('aid', '=', $aid)
            ->delete();
    }

    public function getAllTags()
    {
        return self::$tags->get();
    }


    /**
	 * 
	 * @description:获取所有标签
	 * @author wuyanwen(2017年9月24日)
	 * @param
	 */
	public function getTags()
	{
	    return self::$tags->get();
	}
	
	/**
	 * @description:获取标签文章
	 * @author wuyanwen(2017年9月19日)
	 * @param unknown $tag_name
	 * @return unknown
	 */
	public function getTagsRelateArticle($tagname)
	{
	    $tags = self::$tags::where('name', '=', $tagname)->first();
	    
	    return $tags ? $tags->hasManyArticles : [];
	}
	
	/**
	 * 
	 * @description:获取某个标签下文章总数
	 * @author wuyanwen(2017年9月20日)
	 * @param@param unknown $tagname
	 * @param@return array
	 */
	public function getTagTotalArticles($tagname)
	{
	    $tags = self::$tags::where('name', '=', $tagname)
	                       ->leftjoin('tags_relate', 'tags.id', '=','tags_relate.tag_id')
	                       ->count();
	}
	
	/**
	 * 
	 * @description:获取标签文章
	 * @author wuyanwen(2017年9月20日)
	 * @param@param unknown $tagname
	 * @param@param unknown $offset
	 * @param@param unknown $limt
	 */
	public function getTagArticle($tagname, $offset = 0, $limit = 10)
	{
	    $where = [
	        ['name', '=', $tagname],
	        ['articles.status', '=', 3],
	    ];
	    
	    return self::$tags::where($where)
                    	    ->leftjoin('tags_relate', 'tags.id', '=','tags_relate.tag_id')
                    	    ->leftjoin('articles', 'articles.id', '=', 'tags_relate.aid')
                    	    ->leftjoin('article_relate', 'articles.id', '=', 'article_relate.aid')
                    	    ->select('articles.title','articles.intro','articles.id','articles.author','articles.thumb_img','articles.category','article_relate.*')
                    	    ->offset($offset * $limit)
                    	    ->limit($limit)
                    	    ->orderBy('articles.created_at', 'DESC')
                    	    ->get();
	}
	
	/**
	 * 
	 * @description:根据tag name获取
	 * @author wuyanwen(2017年9月24日)
	 * @param@param unknown $name
	 */
	public function getTagByName($name)
	{
	    return self::$tags::where('name', '=', $name)->first();
	}
	
	/**
	 * 
	 * @description:存储
	 * @author wuyanwen(2017年9月24日)
	 * @param@param unknown $name
	 */
	public function store($name)
	{
	    return self::$tags::create([
	        'name' => $name,
	    ]);
	}
}
