
	@if(Auth::user()->role =='Student')
        <a href="{{route('markRead', ['id' => $notification->id ])}}" id="preview">
	{{$notification['data']['insfname']."\t".$notification['data']['inslname']
    ."\t\t has submitted the feedback for \t\t".$notification['data']['patientfname']."\t"
    .$notification['data']['patientlname'] }}
        </a>

	@else

        <a href="{{route('markRead', ['id' => $notification->id ])}}" id="preview">
	{{ $notification['data']['insfname']."\t".$notification['data']['inslname'].
	"\t\t has submitted \t\t".$notification['data']['patientfname']."\t"
    .$notification['data']['patientlname']."\t\t for review" }}
        </a>
	@endif


