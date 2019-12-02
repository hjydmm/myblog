<?php


namespace App\Services;

use App\Repositories\AttendRepositoryInterface;

class AttendService implements AttendServiceInterface
{
    protected $attendRepository;

    public function __construct
    (
        AttendRepositoryInterface $attendRepository
    )
    {
        $this->attendRepository = $attendRepository;
    }


    public function changeAttend(array $isAttendData, array $attendData)
    {
        $flag = $this->attendRepository->isAttend($isAttendData);
        if( $flag === true ){
            $this->attendRepository->cancelAttend($isAttendData);
            return [ 'status'=>true, 'judge'=>'down' ];
        }elseif( $flag === false ){
            $this->attendRepository->createAttend($attendData);
            return [ 'status'=>true, 'judge'=>'up' ];
        }else{
            return [ 'status'=>false ];
        }
    }

    public function isAttendUser($user_id, $attend_user_id)
    {
        $isAttendData = ['user_id'=>$user_id, 'attend_user_id'=>$attend_user_id];
        return $this->attendRepository->isAttend($isAttendData);
    }

    public function userAttendList($id)
    {
        $with = ['users'];
        return $this->attendRepository->getUserAttendById($id, $with);
    }

    public function countUserAttend($id)
    {
        $where[] = ['user_id', '=', $id];
        return $this->attendRepository->countUserAttend($where);
    }

    public function countAttended($id)
    {
        return $this->attendRepository->countAttended($id);
    }
}