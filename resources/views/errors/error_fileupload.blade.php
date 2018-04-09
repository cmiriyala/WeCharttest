@extends('layouts.app')
@section('content')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    <div class="container">
        <div class="row">
            <div class="col-md-1">
                <a href="{{url('/AddAudios')}}" class="btn btn-success">
                    <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                    Audios</a>
            </div>
            <div class="col-md-1">
                <a href="{{url('/AddVideos')}}" class="btn btn-success">
                    <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                    Videos</a>
            </div>
            <div class="col-md-1">
                <a href="{{url('/AddImages')}}" class="btn btn-success">
                    <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                    Images</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info" align="middle">
                    <p align="middle">
                            <strong>The excel file is not loaded</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
