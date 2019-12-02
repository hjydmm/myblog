<?php


namespace App\Repositories;


interface AttendRepositoryInterface
{
    public function isAttend(array $isAttendData);

    public function createAttend(array $attendData);

    public function cancelAttend(array $isAttendData);

    public function countAttended($id);
}