<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	Name  : {{ Sentry::getUser()->username }}<br>
	Email : {{ Sentry::getUser()->email }}<br>
	Join Date : {{ Sentry::getUser()->created_at }}<br>
	@foreach($fork as $forks)
		<span>{{ ++$i }}. {{ $forks }}<br></span>
	@endforeach
</body>
</html>