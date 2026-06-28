<?php

namespace App\Repositories;

use App\Models\Leave;

class LeaveRepository
{

  protected $leave;

  public function __construct(Leave $leave)
   {
      $this->leave = $leave;
   }


  public function index()
    {
      return $this->leave->orderBy('id','desc')->paginate(10);
    }


	public function store($attributes)
	{
		return $this->leave->create($attributes);
	}

    public function details($id)
    {
      return $this->leave->find($id);
    }

	public function edit($id)
	{
		return $this->leave->find($id);
	}

	public function update($id, array $attributes)
	{
		return $this->leave->find($id)->update($attributes);
	}

	public function delete($id)
	{
		return $this->leave->find($id)->delete();
	}
}
