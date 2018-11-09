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
<p><b>Message: </b>Your application for job: <a href=""><!-- {{JOB}} --></a> has been <!-- {{ APPLICATIO STATUS}} -->.</a></p>
<br>
</body>
</html>
