<?php

namespace App\Repositories;

use App\Model\Attend;
use App\Model\Comment;
use App\Model\Like;
use App\Model\Store;
use App\Model\Users;
use App\Model\Article;

class UsersRepository implements UsersRepositoryInterface
{
    protected static $user;
    protected static $article;
    protected static $like;
    protected static $store;
    protected static $attend;
    protected static $comment;

    public function __construct
    (
        Users $user,
        Article $article,
        Like $like,
        Store $store,
        Attend $attend,
        Comment $comment
    )
    {
        self::$user = $user;
        self::$article = $article;
        self::$like = $like;
        self::$store = $store;
        self::$attend = $attend;
        self::$comment = $comment;
    }

    /**
     * author: カ シュンヨウ
     * description: 获取所有用户
     * @return mixed
     */
    public function getUsersList()
    {
        return self::$user->get();
    }

    /**
     * author: カ シュンヨウ
     * description: 获取给定条件(where)所有用户(分页形式)
     * @param int $offset
     * @param int $limit
     * @param array $where
     * @return array
     */
    public function getUsersPageList($offset=0, $limit = 15, $where = [])
    {
        $data = self::$users::where($where)
            ->select('id','user_name', 'email', 'avatar', 'city', 'type','gender', 'activation', 'status','created_at')
            ->offset($offset)
            ->limit($limit)
            ->get();
        $total = self::$users::where($where)->count();
        return ['data' => $data, 'total' => $total];
    }

    /**
     * author: カ シュンヨウ
     * description: 通过id获取用户
     * @param $id
     * @return mixed
     */
    public function getUserById($id){
        //如果只是返回一条记录的话建议用first(),用get()的话返回的是一个collection数组对象
        return self::$user::where('id', $id)->first();
    }

    /**
     * author: カ シュンヨウ
     * description:  通过给定字段获取用户
     * @param $field
     * @param $value
     * @return mixed
     */
    public function getUserByField($field, $value)
    {
        return self::$users::where($field, '=', $value)->first();
    }

    /**
     * author: カ シュンヨウ
     * description: 创建新的用户
     * @param array $data
     * @return mixed
     */
    public function createUser(array $data)
    {
        return self::$user->insert($data);
    }
    public function createUserGetId(array $data)
    {
        $id = self::$user->insertGetId($data);
        return $id;
    }

    /**
     * author: カ シュンヨウ
     * description: 根据id删除一个用户
     * @param $id
     * @return int
     */
    public function deleteUserById($id)
    {
        //知道主键的话可以直接用destroy($id)方法，而不需要先find($id)，然后delete()
        return self::$user::destroy($id);
    }

    /**
     * author: カ シュンヨウ
     * description: 根据ids数组批量删除用户
     * @param array $ids
     * @return int
     */
    public function batchDeleteUsers(array $ids)
    {
        return self::$user::destroy($ids);
    }

    /**
     * author: カ シュンヨウ
     * description: 更新一个用户的信息
     * @param $user_id
     * @param array $data
     * @return mixed
     */
    public function updateUser($user_id, array $data){

        return self::$user::where('id', '=', $user_id) -> update($data);
    }

    /**
     * author: カ シュンヨウ
     * description: 展示某个用户发表的(最新的**limit篇**的**status状态**的)文章简介(默认5篇审核通过)
     * @return mixed
     */
    public function getLimitPassArticle($status = Article::PASS_STATUS, $limit = 5)
    {
        return self::$user->article_relate()
            ->select('article_relate.*', 'articles.title', 'articles.id', 'articles.created_at')
            ->where('articles.status', '=', $status)
            ->orderBy('articles.created_at', 'DESC')
            ->limit($limit);
    }










	
	/**
	 * 
	 * @description:注册用户
	 * @author wuyanwen(2017年9月16日)
	 * @param@param unknown $data
	 */
	public function store($data)
	{
	    return self::$user::create([
	        'user_name' => $data['name'],
	        'email'     => $data['email'],
	        'password'  => bcrypt($data['password']),
	        'api_token' => substr(encrypt(str_random(rand(30,40))),1,40),
	    ]);
	}
	
	/**
	 * @description:注册oauth用户
	 * @author wuyanwen(2017年9月28日)
	 */
	public function storeOauthUser($data)
	{
	    return self::$user::create($data);
	}
	
	/**
	 * 
	 * @description:禁止/解禁用户
	 * @author wuyanwen(2017年9月10日)
	 * @param@param unknown $id
	 */
	public function forbidden($id)
	{
	    $user = $this->find('id', $id);
	    
	    $user->status = $user->status == 1 ? 2 : 1;
	    
	    return $user->save();
	}
	/**
	 * 
	 * @description:删除一条记录
	 * @author wuyanwen(2017年9月10日)
	 * @param@param unknown $id
	 * @param@return boolean|NULL
	 */
	public function delete($id)
	{
	    return self::$user->delete([$id]);
	}
	
	/**
	 * 
	 * @description:查询用户文章
	 * @author wuyanwen(2017年9月14日)
	 * @param
	 */
	public function getArticles($id)
	{
	    $user = self::$user::where('id', '=', $id)->find($id);
	    
	    return $user ? $user->hasManyUserArticles : [];
	}


    /**
     *
     * @description:查找记录
     * @author wuyanwen(2017年9月10日)
     * @param@param unknown $field
     * @param@param unknown $value
     */
    public function find($field, $value)
    {
        return self::$user::where($field, '=', $value)->first();
    }

	/**
	 * 
	 * @description:更新用户信息
	 * @author wuyanwen(2017年9月19日)
	 * @param@param unknown $data
	 */
	public function update($data)
	{
	    $user = $this->find('id', $data['id']);
	    
	    unset($data['id']);
	    
	    foreach ($data as $key => $value)
	    {
	    	if(!$value == ''){
	           $user->$key = $value;
	    	}
	    }
	    
	    return $user->save();
	}
	

}
