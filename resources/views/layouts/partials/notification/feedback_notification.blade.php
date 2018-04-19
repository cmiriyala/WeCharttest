
	@if(Auth::user()->role =='Student')
        <a href="{{ route( 'student_notification_preview', ['notification_id' => $notification->id ] ) }}" id="previewsnot">
	{{$notification['data']['insfname']."\t".$notification['data']['inslname']
    ."\t\t has submitted the feedback for \t\t".$notification['data']['patientfname']."\t"
    .$notification['data']['patientlname'] }}
        </a>

	@else
            <a href="{{ route( 'patient_notification_preview', ['notification_id' => $notification->id ] ) }}" id="previewnot">
	{{ $notification['data']['insfname']."\t".$notification['data']['inslname'].
	"\t\t has submitted \t\t".$notification['data']['patientfname']."\t"
    .$notification['data']['patientlname']."\t\t for review" }}
        </a>
	@endif


