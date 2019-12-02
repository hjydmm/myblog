<?php


namespace App\Services;

use App\Repositories\CommentRepositoryInterface;
use App\Repositories\ArticleRelateRepositoryInterface;

class CommentService implements CommentServiceInterface
{
    protected $commentRepository;
    protected $articleRelateRepository;

    public function __construct
    (
        CommentRepositoryInterface $commentRepository,
        ArticleRelateRepositoryInterface $articleRelateRepository
    )
    {
        $this->commentRepository = $commentRepository;
        $this->articleRelateRepository = $articleRelateRepository;
    }

    public function createComment(array $data)
    {
        return $this->commentRepository->createComment($data);
    }

    public function updateCommentNumber($aid)
    {
        return $this->articleRelateRepository->incrementCommentNumber($aid);
    }

    public function deleteCommentById($aid)
    {
        return $this->commentRepository->deleteCommentById($aid);
    }
    public function deleteCommentsById($aid)
    {
        return $this->commentRepository->deleteCommentsById($aid);
    }

    public function userLatestCommentList($id)
    {
        $with = ['articles'];
        return $this->commentRepository->getUserCommentById($id, $with, $limit=5);
    }

    public function userCommentList($id)
    {
        $with = ['articles'];
        return $this->commentRepository->getUserCommentById($id, $with, null);
    }

    public function countUserComment($id)
    {
        $where[] = ['user_id', '=', $id];
        return $this->commentRepository->countUserComment($where);
    }
}