<!DOCTYPE html>
<html>
<head>
    <title>Appraisal Status</title>
</head>
<body>
    <h4>Hello {{ $details['name'] }},</h4>
    <p>Your latest appraisal is now {{ $details['status'] }}.</p>  
    @if($details['status'] == 'complete')
        @if($details['uuid'])
            <p><a href="http://127.0.0.1:8000/pdf/{{$details['uuid']}}/download">Click here</a> to download your appraisal.
        @endif
    @endif
    <p>Thank you</p>
</body>
</html>