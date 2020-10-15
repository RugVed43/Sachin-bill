<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>ACCESS DENIED</title>
	
</head>
<body>
	<h1>ACCESS DENIED</h1>
<p>redirecting back in 3 seconds.....</p>
<script type="text/javascript">
    setTimeout(function () {
    	window.location = "{{ URL::to('/') }}";
    }, 3000)
</script>

</body>
</html>