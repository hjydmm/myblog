<?php


namespace App\Repositories;


interface LikeRepositoryInterface
{
    public function createLike(array $likeData);

    public function cancelLike(array $isLikeData);

    public function isLike(array $isLikeData);

    public function getUserLikeById($id, $with);

    public function countUserLike($where);

    public function deleteLikeById($aid);

    public function deleteLikesById($aid);
}