@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

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
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <img id="blah" src="#" alt=""/>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-header font-weight-bold h1">Add New Candidate</div>
                            <div class="card-body">
                                <form method="post" action="{{url('/candidate')}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="font-weight-bold">NAME</label>
                                                <input type="text" required class="form-control" value="{{old("name")}}"
                                                       name="name"
                                                       placeholder="Fullname">
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label class="font-weight-bold">NATIONAL ID NUMBER</label>
                                                <input type="text" required class="form-control"
                                                       value="{{old("national_id")}}"
                                                       name="national_id"
                                                       placeholder="XX-XXXXXX-X-X">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="font-weight-bold">PARTY</label>
                                                <select required class="form-control" name="party_id">
                                                    <option value="">Select Party</option>
                                                    @foreach($parties as $party)
                                                        <option value="{{$party->id}}">{{$party->name}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label class="font-weight-bold">PORTFOLIO</label>
                                                <select required class="form-control" name="portfolio_id">
                                                    <option value="">Select Portfolio</option>
                                                    @foreach($portfolios as $portfolio)
                                                        <option value="{{$portfolio->id}}">{{$portfolio->name}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="font-weight-bold">ELECTION</label>
                                                <select required class="form-control" name="election_id">
                                                    <option value="">Select Eelection</option>
                                                    @foreach($elections as $election)
                                                        <option value="{{$election->id}}">{{$election->name}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="font-weight-bold">IMAGE</label>
                                                <input type="file" onchange="readURL(this);" required
                                                       class="form-control" value="{{old("image")}}"
                                                       name="image">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary font-weight-bold text-uppercase">
                                        Submit
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>

@endsection
