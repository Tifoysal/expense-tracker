<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class OrganogramNode extends Component
{
    public $employee;

    public $children = [];

    public $expanded = false;

    public function mount(User $employee)
    {
        $this->employee = $employee;
    }

    public function loadChildren()
    {
        if (!$this->expanded) {

            $this->children = User::withCount('subordinates')
                ->with('designation')
                ->where('executive_id', $this->employee->id)
                ->get();

            $this->expanded = true;

        } else {

            $this->expanded = false;
        }
    }

    public function render()
    {
        return view('backend.livewire.organogram-node');
    }
}