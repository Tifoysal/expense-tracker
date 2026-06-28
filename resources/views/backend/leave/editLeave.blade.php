@extends('backend.layouts.app')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card spur-card border-0 shadow rounded-lg">
                        <div class="card-header d-flex justify-content-between">
                            <div class="d-flex">
                                <div class="spur-card-icon">
                                    <i class="fas fa-table"></i>
                                </div>
                                <div class="spur-card-title">Edit Leave Request</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{route('employee.leave.update',$editLeaves->id)}}" method="post" role="form">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="form-group">
                                        <input class="form-control" id="duration" type="hidden" name="user_id"
                                               value="{{ auth()->user()->id}}"/>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="category">Leave type:</label>
                                            <select class="form-control  @error('leave_type_id') is-invalid @enderror"
                                                    id="category" name="leave_type_id" required>
                                                @foreach($leaveTypes as $leaveType)

                                                    <option @if($leave->leave_type_id == $leaveType->id)selected @endif
                                                    value="{{ $leaveType->id }}">{{ $leaveType->name}} - Total
                                                        leave {{ $leaveType->number_of_days }} days
                                                        - {{ $leaveType->number_of_days - $totalLeave }} days left.
                                                    </option>
                                                @endforeach
                                                @error('leave_type_id') <span
                                                    class="text-danger">{{$message}}</span> @enderror
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Title:</label>
                                            <input class="form-control @error('title') is-invalid @enderror" id="name"
                                                   type="text" name="title"
                                                   value="{{$leave->title}}"/>
                                            @error('title') <span
                                                class="text-danger">{{$message}}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Duration:</label>
                                            <input class="form-control @error('duration') is-invalid @enderror" id="name"
                                                   type="text" name="duration"
                                                   value="{{$leave->duration}}"/>
                                            @error('duration') <span
                                                class="text-danger">{{$message}}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Reason:</label>
                                            <input class="form-control @error('reason') is-invalid @enderror" id="name"
                                                   type="text" name="reason"
                                                   value="{{$leave->reason}}"/>
                                            @error('reason') <span
                                                class="text-danger">{{$message}}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Location:</label>
                                            <input class="form-control @error('location') is-invalid @enderror"
                                                   id="name" type="text" name="location"
                                                   value="{{$leave->location}}"/>
                                            @error('location') <span
                                                class="text-danger">{{$message}}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="name">From:</label>
                                            <input class="form-control  @error('from') is-invalid @enderror" id="name"
                                                   type="date" name="from"
                                                   value="{{$leave->from}}"/>
                                            @error('from') <span
                                                class="text-danger">{{$message}}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">To:</label>
                                            <input class="form-control @error('to') is-invalid @enderror" id="name"
                                                   type="date" name="to"
                                                   value="{{$leave->to}}"/>
                                            @error('to') <span
                                                class="text-danger">{{$message}}</span> @enderror
                                        </div>

                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Emergency Contact:</label>
                                            <input class="form-control @error('emergency_contact') is-invalid @enderror"
                                                   id="name" type="text" name="emergency_contact"
                                                   value="{{$leave->emergency_contact}}"/>
                                            @error('emergency_contact') <span
                                                class="text-danger">{{$message}}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Remarks:</label>
                                            <input class="form-control @error('remarks') is-invalid @enderror" id="name"
                                                   type="text" name="remarks"
                                                   value="{{$leave->remarks}}"/>
                                            @error('remarks') <span
                                                class="text-danger">{{$message}}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <a href="{{route('leaves.list')}}" class="btn btn-danger">Back</a>
                                    <button type="submit" class="btn btn-info">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
