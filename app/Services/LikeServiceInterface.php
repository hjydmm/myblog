<?php


namespace App\Services;


interface LikeServiceInterface
{
    public function changeLikeAndUpdateNumber($aid, array $isLikeData, array $likeData);

    public function userLikeList($id);

    public function countUserLike($id);

    public function isLiked($isLikeData);

    public function deleteLikeById($aid);

    public function deleteLikesById($aid);
}