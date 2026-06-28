<?php

namespace App\Services;

use App\Models\LeaveType;
use App\Repositories\LeaveTypeRepository;
use App\Http\Requests\LeaveTypeRequest;
use Illuminate\Http\Request;

class LeaveTypeService
{	
	protected $leaveTypeRepository;
	
	public function __construct(LeaveTypeRepository $leaveTypeRepository)
	{
		$this->leaveTypeRepository = $leaveTypeRepository;
	}

	public function index()
	{
		return $this->leaveTypeRepository->index();
	}

    public function store(Request $request)
	{
	    $attributes = $request->all();
	    return $this->leaveTypeRepository->store($attributes);
	}

	public function read($id)
	{

    	return $this->leaveTypeRepository->find($id);
	}

	public function update(Request $request, $id)
	{
		$attributes = $request->all();
    	return $this->leaveTypeRepository->update($id, $attributes);
	}

	public function delete($id)
	{
      return $this->leaveTypeRepository->delete($id);
	}
}