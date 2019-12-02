<?php


namespace App\Repositories;


interface TagsRepositoryInterface
{
    public function createTags(array $data);

    public function updateTags($aid, array $data);

    public function deleteTagsById($aid);

    public function getAllTags();
}