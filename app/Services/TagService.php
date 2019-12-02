<?php


namespace App\Services;

use App\Repositories\TagRepositoryInterface;

class TagService implements TagServiceInterface
{

    protected $tagRepository;


    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function getAllTag()
    {
        return $this->tagRepository->getTagList($where = null);
    }


    public function getTagById($id){
        return $this->tagRepository->getTagById($id);
    }

    public function createTag(array $data)
    {
        return $this->tagRepository->createTagGetId($data);
    }

    public function deleteTagById($id)
    {
        return $this->tagRepository->deleteTagById($id);
    }

    public function updateTag($tag_id, array $data){

        return $this->tagRepository->updateTag($tag_id, $data);
    }

    public function batchDeleteTag(array $ids)
    {
        return $this->tagRepository->batchDeleteTag($ids);
    }
}