<?php

namespace App\Services;

use App\Repositories\LeaveRepository;
use Illuminate\Http\Request;

class LeaveService

{
	protected $leaveRepository;

    public function __construct(LeaveRepository $leaveRepository)
    {
    	$this->leaveRepository = $leaveRepository;
    }

    public function index()
    {
    	return $this->leaveRepository->index();
    }

    public function store(Request $request)
    {
    	$attributes = $request->all();

    	return $this->leaveRepository->store($attributes);
    }

    public function details($id)
    {
        return $this->leaveRepository->details($id);
    }

    public function edit($id)

    {
    	return $this->leaveRepository->edit($id);
    }

    public function update(Request $request, $id)
    {
    	$attributes = $request->all();
    	return $this->leaveRepository->update($id, $attributes);
    }

    public function delete($id)
    {
    	return $this->leaveRepository->delete($id);
    }
}
