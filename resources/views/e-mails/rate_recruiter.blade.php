<!DOCTYPE html>
<html>

<head>
    <title>Rate Recruiter</title>
</head>

<body>
    <p>Message: You are now able to rate the user: <a href="http://localhost:8000/profile/{{$recruiter->slug}}">
            {{$recruiter->username}}</a>
        because the job <a href="http://localhost:8000/jobs/{{$job->slug}}"> {{$job->title}} </a> is now in
        'DONE'
        state.</p>
    <br>
    <p>
        Link to rate: <a href="http://localhost:8000/recruiter-rating/{{$job->id}}/{{$recruiter->id}}"> LINK </a>
    </p>
</body>

</html>
