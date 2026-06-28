<?php

namespace App\Repositories;

use App\Models\LeaveType;

class LeaveTypeRepository
{
  
  protected $leaveType;

  public function __construct(LeaveType $leaveType)
  {
    
    $this->leaveType = $leaveType;
  }

  public function index()
  {
  	
    return $this->leaveType->orderBy('id','desc')->paginate(5);
  }

  public function store($attributes)
  {

    return $this->leaveType->create($attributes);
  }

  public function find($id)
  {
    return $this->leaveType->find($id);
  }


  public function update($id, array $attributes)
  {
    
    return $this->leaveType->find($id)->update($attributes);
  }


//   public function delete($id)
//   {
    
//     return $this->leaveType->find($id)->delete();
//   }
public function delete($id)
{
    $leaveType = $this->leaveType->find($id);
    // dd($leaveType); // Check if this returns a model or null
    return $leaveType->delete();
}
} 