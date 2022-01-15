@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header h2 font-weight-bold">Elections
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">

                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>NAME</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($elections as $election)
                                <tr>
                                    <td>{{$election->id}}</td>
                                    <td class="font-weight-bold">{{$election->name}}</td>
                                    <td><span class="badge {{($election->active==1)?"badge-success":"badge-danger"}}">{{($election->active==1)?"ACTIVE":"NOT ACTIVE"}}</span></td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header h2 font-weight-bold">Add New Election
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li><strong>{{ $error }}</strong></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                <b>{{ session()->get('success') }}</b>
                            </div>
                        @endif
                        <form method="post" action="{{url('/election')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="font-weight-bold">NAME</label>
                                        <input type="text" required class="form-control" value="{{old("name")}}"
                                               name="name"
                                               placeholder="Election Name">
                                    </div>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary btn-block font-weight-bold text-uppercase">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
