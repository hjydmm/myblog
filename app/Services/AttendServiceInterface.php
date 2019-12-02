<?php


namespace App\Services;


interface AttendServiceInterface
{
    public function changeAttend(array $isAttendData, array $attendData);

    public function isAttendUser($user_id, $attend_user_id);

    public function countAttended($id);
}