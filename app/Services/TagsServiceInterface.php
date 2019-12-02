<?php


namespace App\Services;


interface TagsServiceInterface
{
    public function createTags(array $data);

    public function arrayToString($glue, array $array);

    public function deleteTagsById($aid);

    public function stringToArray($delimiter, $str);

    public function getContainTagList($tag_name);
}