<?php

namespace App\Repositories;

use App\Model\Comment;

class CommentRepository implements CommentRepositoryInterface
{
    protected static $comment;
    
    public function __construct(Comment $comment)
	{
        self::$comment = $comment;
    }

    public function createComment(array $data)
    {
        $result = self::$comment->insert($data);
        return $result;
    }

    public function deleteCommentById($aid)
    {
        //知道主键的话可以直接用destroy($id)方法，而不需要先find($id)，然后delete()
        return self::$comment::where('aid', '=', $aid)
            ->delete();
    }

    public function deleteCommentsById($aid)
    {
        $flag = true;
        $data = self::$comment::where('aid', '=', $aid)
            ->get();
        foreach ($data as $d) {
            $flag = self::$comment::where('id', '=', $d->id)
                ->delete();
            if(!$flag) {
                break;
            }
        }
        return $flag;
    }

    /**
     * author: カ シュンヨウ
     * description: 通过user_id获取用户所有评论
     * @param $id
     * @param $with
     * @return Comment[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getUserCommentById($id, $with, $limit=5)
    {
        return self::$comment::with($with)
            ->select('comments.*')
            ->where('comments.user_id', '=', $id)
            ->orderBy('comments.created_at', 'DESC')
            ->limit($limit)
            ->get();
    }

    public function countUserComment(array $where)
    {
        return self::$comment->where($where)->count();
    }







    /**
     * 
     * @description:添加评论
     * @author wuyanwen(2017年9月17日)
     * @param
     */
    public function store($data)
    {
        return self::$comment::create([
            'user_id'   => $data['user_id'],
            'user_name' => $data['user_name'],
            'avatar'    => $data['avatar'],
            'aid'       => $data['aid'],
            'content'   => $data['content'],
        ]);
    }
    
    /**
     * @description:获取评论
     * @author wuyanwen(2017年9月20日)
     */
    public function getComments($user_id, $limit = 5, $offset = 0)
    {
        return self::$comment::where('comments.user_id', '=', $user_id)
                                ->leftjoin('articles', 'comments.aid', '=', 'articles.id')
                                ->select('articles.id as aid','articles.title','comments.id','comments.content','comments.created_at')
                                ->orderBy('comments.created_at', 'DESC')
                                ->offset($offset * $limit)
                                ->limit($limit)
                                ->get();
    }
    
    /**
     * @description:获取用户总数
     * @author wuyanwen(2017年9月20日)
     * @param unknown $id
     */
    public function getTotalUserComments($user_id, $limit = 0)
    {
        $total = self::$comment::where('user_id', '=', $user_id)->count();
        
        return ['pages' => ceil($total / ($limit ? : self::$comment::LIMIT)), 'total' => $total];
    }
}
