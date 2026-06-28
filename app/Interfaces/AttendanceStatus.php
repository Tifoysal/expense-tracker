<?php

namespace App\Interfaces;

interface  AttendanceStatus
{
    const  ABSENT = 'absent';
    const  LEAVE = 'leave';
    const  HOLIDAY = 'holiday';
    const  MOVEMENT = 'movement';
    const  PRESENT = 'present';
}
