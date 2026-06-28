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

                            <form action="{{route('leaves.update',$editLeaves->id)}}" method="post" role="form">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Status:</label>
                                    <input class="form-control" id="name" type="text" name="status"/>
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
