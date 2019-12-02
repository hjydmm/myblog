<?php


namespace App\Services;


interface CommentServiceInterface
{
    public function createComment(array $data);

    public function updateCommentNumber($aid);

    public function deleteCommentById($aid);

    public function deleteCommentsById($aid);

    public function userCommentList($id);

    public function countUserComment($id);

}