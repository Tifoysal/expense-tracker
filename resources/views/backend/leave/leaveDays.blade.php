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
                                <div class="spur-card-title">Leave Request</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table">
                                    <thead>
                                    <tr style="text-align: center;">
                                        <th>Serial</th>
                                        <th>Leave</th>
                                        <th>Days left</th>
                                    </tr>
                                    </thead>
                                    @foreach($details as $key=>$leave)
                                        <tbody>
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$leave->leaveType->name}}</td>
                                            <td>{{$leave->number_of_days}}</td>
                                        </tr>
                                        </tbody>
                                        
                                    @endforeach
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
