@extends('layouts.app')
@extends('patient.vital_signs_header')
@section('Maincontent')
<br>
<style type="text/css">
        .ScrollStyle {
            /*float: left;
            width: 445px;*/
            height: 100vh;
            overflow-y: auto;
        }
        .navigation, .guidance, .documentation{
            border-radius: 2%;
        }
        .documentation:hover,.guidance:hover{
            background: #ECE9E6;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to bottom, #FFFFFF, #ECE9E6);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to bottom, #FFFFFF, #ECE9E6); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            box-shadow: 2px 2px 50px 2px darkgray;
        }
        .navigation:hover .list-group-item{
            background: #ECE9E6;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to bottom, #FFFFFF, #ECE9E6);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to bottom, #FFFFFF, #ECE9E6); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        }
        .navigation:hover{
            box-shadow: 2px 2px 50px 2px darkgray;
        }
</style>

    {{--@parent--}}
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>


    {{--Three Panels--}}
    <div class="container-fluid" style="margin-top: 0;padding-top: 0;padding-left: 1%;">
        <div class="row" style="padding-top: 0;border-top:0;">
            {{--Navigation Panel--}}

            <div class="col-md-2 navigation" style="padding-left: 0;padding-right: 0">
                <div class="ScrollStyle" style="overflow:auto;height:100vh">

                <ul class="list-group test" style="cursor: pointer;">
                    <li class="list-group-item">
                        {{--Adding Demographics to existing nav modules--}}
                        <a
                                id="Demographics_tab"
                                href="{{ URL::route('Demographics', $patient->patient_id)}}"
                        >
                            <b>Demographics</b>
                        </a>
                    </li>

                    @foreach ($navs as $key=>$nav)
                        @if($nav[0]->parent_id === NULL)
                            <li class="list-group-item">
                                <a id="{{$nav[0]->navigation_name}}_tab" href="{{ URL::route($nav[0]->navigation_name, $patient->patient_id)}}">
                                    <b>{{ $nav[0]->navigation_name }}</b>
                                </a>
                            </li>
                        @else
                            <li class="list-group-item" style="padding-left: 20%">
                                <a id="{{$nav[0]->navigation_name}}_tab" href="{{ URL::route($nav[0]->navigation_name.$nav[0]->parent_id, $patient->patient_id)}}">
                                    <b>{{ $nav[0]->navigation_name }}</b>
                                </a>
                            </li>
                        @endif
                    @endforeach

                    <li class="list-group-item">
                        @if(!((count($disposition)> 0) && $status_id === 1))
                            <a class="btn btn-default" id="submit-button" style="margin:auto; text-align:center; display:block; width:100%;" title = "Disposition should be saved inorder to submit a patient." disabled>
                                <i class="fa fa-floppy-o" aria-hidden="true"></i> Submit</a>
                        @else
                            <a href="{{ URL::route('AssignInstructor', $patient->patient_id) }}" class="btn btn-primary" id="submit-button" style="margin:auto; text-align:center; display:block; width:100%;" title = "You need to assign instructor for final submission of patient.">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i> Submit</a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>


            {{--Documentation Panel--}}
            <div class="col-md-6 documentation" style="padding-left: 0;margin-left: 0;padding-right: 15px;margin-right: 0">
                <div class="ScrollStyle">
                    <br>
                @yield('documentation_panel')
            </div>
        </div>

            {{--Guidance Panel--}}
            <div class="col-md-4 guidance" style="float: right;border: thin solid grey; height: auto; padding: 0; border-radius: 5px;" id="guidance_panel">
                <div class="ScrollStyle" style="overflow:auto;height:100vh">

                <!-- Guidance Panel -->
                <div style="background-color: lightpink; display: flex; border-radius: 5px;">
                    <h4>&nbsp;Guidance Panel</h4>
                </div>
                <br>
                <div class="container-fluid" id="tabdiv">
                    <ul class="nav nav-pills" id="myTab">
                        <li id="changetets"  class="active"><a data-toggle="pill" href="#main">Main</a></li>
                        <li id="test"><a data-toggle="pill" href="#ddx">DDx</a></li>
                        <li><a data-toggle="pill" href="#av">A/V</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="main" class="tab-pane fade in active">
                            @include('patient.guidancepanel_main')
                        </div>
                        <div id="ddx" class="tab-pane fade">
                            @include('patient.guidancepanel_ddx')
                        </div>
                        <div id="av" class="tab-pane fade">
                            @include('patient.guidancepanel_av')
                        </div>

                    </div>
                </div>
            </div>

                <!-- Guidance Panel -->

            </div>
        </div>
    </div>
</div>
@endsection

