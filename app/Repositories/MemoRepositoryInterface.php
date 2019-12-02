<?php


namespace App\Repositories;


interface MemoRepositoryInterface
{
    public function getMemosByAid($admin_id);

    public function createMemo(array $data);

    public function updateMemo($admin_id, array $data);
}