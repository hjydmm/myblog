<?php


namespace App\Services;

use App\Repositories\MemoRepositoryInterface;

class MemoService implements MemoServiceInterface
{

    protected $memoRepository;


    public function __construct(MemoRepositoryInterface $memoRepository)
    {
        $this->memoRepository = $memoRepository;
    }


    public function getMemosByAid($admin_id)
    {
        return $this->memoRepository->getMemosByAid($admin_id);
    }

    public function createMemo(array $data)
    {
        return $this->memoRepository->createMemo($data);
    }

    public function updateMemo($admin_id, array $data)
    {
        return $this->memoRepository->updateMemo($admin_id, $data);
    }

}
