@extends('layouts.app')
@section('content')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info" align="middle">

                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {

                window.location.href = "{{URL::to('login')}}";


        });

    </script>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
@endsection
