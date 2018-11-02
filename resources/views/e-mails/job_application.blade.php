<!DOCTYPE html>
<html>
<head>
	<title>Job Application Form</title>
</head>
<body>
<p><b>Username: </b>{{Auth::user()->username}}</p>
<br>
<p><b>Email: </b>{{Auth::user()->email}}</p>
<br>
<p><b>Subject: </b>Job Application</p>
<br>
<p><b>Message: </b>This <a href="http://localhost:8000/profile/{{$user_slug}}">user</a> has just applied to your <a href="http://localhost:8000/jobs/{{$slug['slug']}}">job.</a></p>
<br>
</body>
</html>
