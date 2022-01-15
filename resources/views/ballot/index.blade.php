@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @foreach($ballots as $ballot)
                    <div class="card">
                        <div class="card-header h2 font-weight-bold">{{$ballot->name }}</div>

                        <div class="card-body">
                            <table class="table table-striped table-bordered">

                                <thead>
                                <tr>
                                    <th>IMAGE</th>
                                    <th>NAME</th>
                                    <th>PARTY</th>
                                    <th>NATIONAL ID</th>
                                    <th>STATUS</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ballot->candidates as $candidate)
                                    <tr>
                                        <td><img src="{{asset("/images/$candidate->image")}}" height="70" width="auto"/>
                                        </td>
                                        <td class="font-weight-bold text-uppercase">{{$candidate->name}}</td>
                                        <td>{{$candidate->party->name}}</td>
                                        <td>{{$candidate->national_id}}</td>
                                        <td>
                                            <span class="badge {{($candidate->active==1)?"badge-success":"badge-danger"}}">{{($candidate->active==1)?"ACTIVE":"NOT ACTIVE"}}</span>
                                        </td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
