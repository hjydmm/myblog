<?php


namespace App\Repositories;


interface CommentRepositoryInterface
{
    public function createComment(array $data);

    public function deleteCommentById($aid);

    public function deleteCommentsById($aid);

    public function getUserCommentById($id, $with, $limit=5);

    public function countUserComment(array $where);

}