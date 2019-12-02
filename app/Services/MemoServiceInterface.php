<?php


namespace App\Services;


interface MemoServiceInterface
{
    public function getMemosByAid($admin_id);

    public function createMemo(array $data);

    public function updateMemo($admin_id, array $data);
}