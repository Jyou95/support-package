<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Contact Us</title>
	<body style="text-align:center">
		<h1>
			Contact Us any time ABC
		</h1>
		<form action="{{route('contact')}}" method="post">
			@csrf
			<input type="text" name="name" placeholder="Your Name please">
			<input type="text" name="email" placeholder="Your Email please">
			<button type="submit" value="submit">Submit</button>
		</form>
	</body>
</html>