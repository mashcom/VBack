@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header h2 font-weight-bold">Voters
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">

                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>NAME</th>
                                <th>REG NUMBER</th>
                                <th>NATIONAL ID</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($voters as $voter)
                                <tr>
                                    <td>{{$voter->id}}</td>
                                    <td class="font-weight-bold">{{$voter->name}}</td>
                                    <td class="font-weight-bold">{{$voter->regnum}}</td>
                                    <td class="font-weight-bold">{{$voter->national_id}}</td>
                                    <td><span class="badge {{($voter->active==1)?"badge-success":"badge-danger"}}">{{($voter->active==1)?"ACTIVE":"NOT ACTIVE"}}</span></td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header h2 font-weight-bold">Add New Voter
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
                        <form method="post" action="{{url('/voter')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="font-weight-bold">NAME</label>
                                        <input type="text" required class="form-control" value="{{old("name")}}"
                                               name="name"
                                               placeholder="Fullname">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="font-weight-bold">REG NUMBER</label>
                                        <input type="text" required class="form-control" value="{{old("regnum")}}"
                                               name="regnum"
                                               placeholder="">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="font-weight-bold">NATIONAL ID NUMBER</label>
                                        <input type="text" required class="form-control" value="{{old("national_id")}}"
                                               name="national_id"
                                               placeholder="XX-XXXXXXX-X-XX">
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
