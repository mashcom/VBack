@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header h2 font-weight-bold">ELECTION RESULTS
                    </div>
                    <div class="card-body">
                        @foreach($elections as $election)
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th><h4 class="font-weight-bold text-uppercase"> {{$election->name}}</h4></th>
                                </tr>
                                </thead>
                                @foreach($election->portfolios as $portfolio)
                                    @if($portfolio->candidates->count()>0)
                                        <thead class="table-dark">
                                        <tr>
                                            <th><h4 class="font-weight-bold text-uppercase"> {{$portfolio->name}}</h4>
                                            </th>
                                        </tr>

                                        </thead>
                                        <thead class="table-dark">
                                        <tr>
                                            <th>NAME</th>
                                            <th>PARTY</th>
                                            <th>NATIONAL ID</th>
                                            <th>VOTES</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($portfolio->candidates as $candidate)
                                            <tr>
                                                <th>{{$candidate->name}}</th>
                                                <th>{{$candidate->party->name}}</th>
                                                <th>{{$candidate->national_id}}</th>
                                                <th>{{$candidate->votes}}</th>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    @endif
                                @endforeach
                            </table>
                        @endforeach

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
