<!DOCTYPE html>
<html>
<head>
	<title>Register Email</title>
</head>
<body>
	<table>
		<tr><td>Dear {{ $name }}</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Please Click on below link to activate your account:</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td><a href="{{ url('confirm/'.$code)}}">Confirm Account</a></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Thanks & Regards,</td></tr>
		<tr><td>Online Shopping</td></tr>
	</table>
</body>
</html>