<?php

namespace App\Services;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Repositories\AttendanceRepository;


class AttendanceService
{
    protected $attendanceRepository;

    public function __construct(AttendanceRepository $attendanceRepository){

        $this->attendanceRepository= $attendanceRepository;

    }
    public function index()
    {
        $this->attendanceRepository->index();
    }

}
