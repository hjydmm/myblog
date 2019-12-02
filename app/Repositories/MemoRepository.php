<?php


namespace App\Repositories;

use App\Model\Memo;


class MemoRepository implements MemoRepositoryInterface
{
    protected static $memo;

    public function __construct(Memo $memo)
    {
        self::$memo = $memo;
    }

    public function getMemosByAid($admin_id)
    {
        return self::$memo::where('admin_id', $admin_id)
            ->first();
    }

    public function createMemo(array $data)
    {
        return self::$memo->insert($data);
    }

    public function updateMemo($admin_id, array $data){

        return self::$memo::where('admin_id', '=', $admin_id) -> update($data);
    }
}