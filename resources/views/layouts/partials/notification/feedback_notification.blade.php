
	@if(Auth::user()->role =='Student')
        @if($notification->read_at == null)
            <a class="btn btn-default" style="background-color:#00B2B9;color:white" href="{{ route( 'student_notification_preview', ['notification_id' => $notification->id ] ) }}" id="previewsnot">
         @else
                    <a class="btn btn-default" href="{{ route( 'student_notification_preview', ['notification_id' => $notification->id ] ) }}" id="previewsnot">
         @endif
                {{$notification['data']['insfname']."\t".$notification['data']['inslname']
    ."\t\t has submitted the feedback for \t\t".$notification['data']['patientfname']."\t"
    .$notification['data']['patientlname'] }}
        </a>

	@else
                        @if($notification->read_at == null)
            <a class="btn btn-default" style="background-color:#00B2B9;color:white" href="{{ route( 'patient_notification_preview', ['notification_id' => $notification->id ] ) }}" id="previewnot">
                @else
                    <a class="btn btn-default" href="{{ route( 'patient_notification_preview', ['notification_id' => $notification->id ] ) }}" id="previewnot">
                  @endif
                    {{ $notification['data']['insfname']."\t".$notification['data']['inslname'].
	"\t\t has submitted \t\t".$notification['data']['patientfname']."\t"
    .$notification['data']['patientlname']."\t\t for review" }}
        </a>
	@endif


