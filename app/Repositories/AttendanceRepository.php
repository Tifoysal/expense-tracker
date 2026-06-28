<?php

namespace App\Repositories;

use App\Models\Attendance;

class AttendanceRepository
{

    protected $attendance;
    public function __construct(Attendance $attendance)
    {

    $this->attendance=$attendance;

    }
    public function index(){

        return $this->attendance->paginate(8);
    }
}