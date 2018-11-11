<!DOCTYPE html>
<html>
<head>
	<title>Job Application Response</title>
</head>
<body>
<p><b>Username: </b>{{Auth::user()->username}}</p>
<br>
<p><b>Email: </b>{{Auth::user()->email}}</p>
<br>
<p><b>Subject: </b>Job Application Response</p>
<br>
<p><b>Message: </b>Your application for job: <a href="http://localhost:8000/jobs/{{$job_slug->slug}}">{{$job_slug->slug}}</a> has been {{$job_application_state->state}}.</a></p>
<br>
</body>
</html>
