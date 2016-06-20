<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	Name  : {{ Sentry::getUser()->username }}<br>
	Email : {{ Sentry::getUser()->email }}<br>
	Join Date : {{ Sentry::getUser()->created_at }}<br>
<<<<<<< HEAD

	@foreach($fork as $forks)
		<span>{!! $forks !!}</span>
=======
	@foreach($fork as $forks)
		<span>{{ ++$i }}. {{ $forks }}<br></span>
>>>>>>> 7c418c3449949bd902fa4a63587579f395846ec9
	@endforeach
</body>
</html>