@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header h2 font-weight-bold">Candidates
                        <a href="{{url('candidate/create')}}" class="btn btn-primary font-weight-bold float-right">ADD
                            CANDIDATE</a>
                    </div>
                    <div class="card-body">
{{--                        <table class="table table-striped table-bordered">--}}

{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th>IMAGE</th>--}}
{{--                                <th>NAME</th>--}}
{{--                                <th>PARTY</th>--}}
{{--                                <th>PORTFOLIO</th>--}}
{{--                                <th>NATIONAL ID</th>--}}
{{--                                <th>STATUS</th>--}}
{{--                                <th></th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
                        <div class="row">
                            @foreach($candidates as $candidate)
                                <div class="col-lg-3 mx-5">
                                    <div class="card" style="width: 18rem;">
                                        <img class="card-img-top" src="{{asset("/images/$candidate->image")}}" alt="Card image cap">
                                        <div class="card-body">
                                            <table class="table table-striped"> <tr>
                                                <tr>
                                                    <td class="font-weight-bold text-uppercase">{{$candidate->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{$candidate->party->name}}</td></tr>
                                                <tr>
                                                    <td>{{$candidate->portfolio->name}}</td></tr>
                                                <tr>
                                                    <td>{{$candidate->national_id}}</td></tr>
                                                <tr>
                                                    <td><span class="badge {{($candidate->active==1)?"badge-success":"badge-danger"}}">{{($candidate->active==1)?"ACTIVE":"NOT ACTIVE"}}</span></td></tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
{{--                                <tr>--}}
{{--                                    <td><img src="{{asset("/images/$candidate->image")}}" height="70" width="auto"/></td>--}}
{{--                                    <td class="font-weight-bold text-uppercase">{{$candidate->name}}</td>--}}
{{--                                    <td>{{$candidate->party_id}}</td>--}}
{{--                                    <td>{{$candidate->portfolio_id}}</td>--}}
{{--                                    <td>{{$candidate->national_id}}</td>--}}
{{--                                    <td><span class="badge {{($candidate->active==1)?"badge-success":"badge-danger"}}">{{($candidate->active==1)?"ACTIVE":"NOT ACTIVE"}}</span></td>--}}
{{--                                    <td></td>--}}
{{--                                </tr>--}}
                            @endforeach
{{--                            </tbody>--}}
{{--                        </table>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
