<?php


namespace App\Services;

use App\Repositories\LinksRepositoryInterface;

class LinksService implements LinksServiceInterface
{
    protected $linksRepository;

    public function __construct
    (
        LinksRepositoryInterface $linksRepository
    )
    {
        $this->linksRepository = $linksRepository;
    }

    /**
     * author: カ シュンヨウ
     * description: 主页获取链接
     * @return mixed
     */
    public function getMostLikeLinks(){
        $where = NULL;
        $order_by = "links.weight";
        $limit = 4;
        return $this->linksRepository->getLinks($where, $order_by, $limit);
    }

    public function getAllLinks()
    {
        return $this->linksRepository->getLinkList($where = null);
    }


    public function getLinkById($id){
        return $this->linksRepository->getLinkById($id);
    }

    public function createLink(array $data)
    {
        return $this->linksRepository->createLinkGetId($data);
    }

    public function deleteLinkById($id)
    {
        return $this->linksRepository->deleteLinkById($id);
    }

    public function updateLink($link_id, array $data){

        return $this->linksRepository->updateLink($link_id, $data);
    }

    public function batchDeleteLink(array $ids)
    {
        return $this->linksRepository->batchDeleteLink($ids);
    }
}