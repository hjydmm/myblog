<?php


namespace App\Services;

use App\Repositories\TagsRepositoryInterface;
use App\Repositories\ArticleRepositoryInterface;

class TagsService implements TagsServiceInterface
{
    protected $tagsRepository;
    protected $articleRepository;

    public function __construct
    (
        TagsRepositoryInterface $tagsRepository,
        ArticleRepositoryInterface $articleRepository
    )
    {
        $this->tagsRepository = $tagsRepository;
        $this->articleRepository = $articleRepository;
    }

    public function createTags(array $data)
    {
        return $this->tagsRepository->createTags($data);
    }

    public function updateTags($aid, array $data)
    {
        return $this->tagsRepository->updateTags($aid, $data);
    }

    public function deleteTagsById($aid)
    {
        return $this->tagsRepository->deleteTagsById($aid);
    }

    /**
     * author: カ シュンヨウ
     * description: 数组转换成字符串
     * @param array $array
     * @return string
     */
    public function arrayToString($glue, array $array)
    {
        $str = implode($glue, $array);
        return $str;
    }

    /**
     * author: カ シュンヨウ
     * description: 字符串转换成数组
     * @param $str
     * @return array
     */
    public function stringToArray($delimiter, $str)
    {
        $array = explode($delimiter, $str);
        return $array;
    }

    public function getContainTagList($tag_name)
    {
        $tagsList = $this->tagsRepository->getAllTags();
        $containAids = array();
        foreach ($tagsList as $tags) {
            if(preg_match('/(?<![a-zA-Z0-9])'.$tag_name.'(?![a-zA-Z0-9])/', $tags->str_tags)){
                $containAids[] = $tags->aid;
            }
        }
        return $this->articleRepository->getArticlesPageByIds(ArticleService::PASS_STATUS, $containAids);
    }





}