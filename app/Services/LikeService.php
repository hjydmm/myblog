<?php


namespace App\Services;

use App\Repositories\LikeRepositoryInterface;
use App\Repositories\ArticleRepositoryInterface;
use App\Repositories\ArticleRelateRepositoryInterface;

class LikeService implements LikeServiceInterface
{
    protected $likeRepository;
    protected $articleRepository;
    protected $articleRelateRepository;

    public function __construct
    (
        LikeRepositoryInterface $likeRepository,
        ArticleRepositoryInterface $articleRepository,
        ArticleRelateRepositoryInterface $articleRelateRepository
    )
    {
        $this->likeRepository = $likeRepository;
        $this->articleRepository = $articleRepository;
        $this->articleRelateRepository = $articleRelateRepository;
    }

    public function changeLikeAndUpdateNumber($aid, array $isLikeData, array $likeData)
    {
        $flag = $this->likeRepository->isLike($isLikeData);
        if( $flag === true ){
            $this->articleRelateRepository->decrementLikeNumber($aid);
            $this->likeRepository->cancelLike($isLikeData);
            return [ 'like_status'=>true, 'judge'=>'down' ];
        }elseif( $flag === false ){
            $this->articleRelateRepository->incrementLikeNumber($aid);
            $this->likeRepository->createLike($likeData);
            return [ 'like_status'=>true, 'judge'=>'up' ];
        }else{
            return [ 'like_status'=>false, 'judge'=>'error' ];
        }
    }

    public function userLikeList($id)
    {
        $with = ['articles'];
        return $this->likeRepository->getUserLikeById($id, $with);
    }

    public function countUserLike($id)
    {
        $where[] = ['user_id', '=', $id];
        return $this->likeRepository->countUserLike($where);
    }

    /**
     * author: カ シュンヨウ
     * description: 统计某用户的文章被点赞个数
     * @param $id
     * @return mixed
     */
    public function countArticleLiked($whereIn)
    {
        return $this->likeRepository->countArticleLiked($whereIn);
    }

    public function isLiked($isLikeData)
    {
        return $this->likeRepository->isLike($isLikeData);
    }

    public function deleteLikeById($aid)
    {
        return $this->likeRepository->deleteLikeById($aid);
    }
    public function deleteLikesById($aid)
    {
        return $this->likeRepository->deleteLikesById($aid);
    }

}