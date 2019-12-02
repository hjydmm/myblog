<?php

namespace App\Repositories;

use App\Model\Attend;

class AttendRepository implements AttendRepositoryInterface
{
    protected static $attend;
    
    public function __construct(Attend $attend)
	{
        self::$attend = $attend;
    }


    public function isAttend(array $isAttendData)
    {
        return self::$attend::where($isAttendData)->first() ? true : false;
    }

    public function createAttend(array $attendData)
    {
        return self::$attend->insert($attendData);
    }

    public function cancelAttend(array $isAttendData)
    {
        return self::$attend::where($isAttendData)->delete();
    }

    public function getUserAttendById($id, $with)
    {
        return self::$attend::with($with)
            ->select('attend.*')
            ->where('attend.user_id', '=', $id)
            ->orderBy('attend.created_at', 'DESC')
            ->get();
    }

    public function countUserAttend($where)
    {
        return self::$attend->where($where)->count();
    }

    public function countAttended($id)
    {
        return self::$attend->where('attend_user_id', '=', $id)->count();
    }


    /**
     * 
     * @description:是否关注
     * @author wuyanwen(2017年9月16日)
     * @param
     */
    public function isAttended($user_id, $attend_user_id)
    {
        $where = [
            ['user_id', '=', $user_id],
            ['attend_user_id', '=', $attend_user_id],
        ];

        return self::$attend::where($where)->first() ? true : false;
    }
    
    /**
     * 
     * @description:关注
     * @author wuyanwen(2017年9月16日)
     * @param@param unknown $user_id
     * @param@param unknown $attend_user_id
     */
    public function attend($user_id, $attend_user_id)
    {
        return self::$attend::create([
            'user_id' => $user_id,
            'attend_user_id' => $attend_user_id
        ]);
    }
    
    /**
     * 
     * @description:取消关注
     * @author wuyanwen(2017年9月16日)
     * @param@param unknown $user_id
     * @param@param unknown $attend_user_id
     */
    public function cancel($user_id, $attend_user_id)
    {
        $where = [
            ['user_id', '=', $user_id],
            ['attend_user_id', '=', $attend_user_id],
        ];
        
        return self::$attend::where($where)->delete();
    }
    
    /**
     * @description:
     * @author wuyanwen(2017年9月20日)
     */
    public function getTotalAttendUser($user_id)
    {
        return self::$attend::where('user_id', '=', $user_id)->count();
    }
    
    /**
     * @description:
     * @author wuyanwen(2017年9月20日)
     */
    public function getAttendUser($user_id, $limit = 10, $offset = 0)
    {
        return self::$attend::where('attend.user_id', '=', $user_id)
                            ->leftjoin('users', 'attend.attend_user_id', '=', 'users.id')
                            ->select('users.id', 'users.user_name', 'users.introduction','users.avatar')
                            ->offset($offset * $limit)
                            ->limit($limit)
                            ->orderBy('attend.created_at')
                            ->get();
    }
}
