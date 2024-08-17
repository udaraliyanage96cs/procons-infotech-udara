<!DOCTYPE html>
<html>
    <head>
        <title>Mail From Procons Infotech</title>
    </head>
    <body>
        <h1>Email Reset Password</h1>
        <p>Hello  {{ $details['email'] }}!</p>
        <p>This email for your password reset. Attacted a token below</p>
        <p>Token :  {{ $details['token'] }}</p>
        <p>Password Rest URL : {{URL::to('/')}}/reset_password/{{ $details['uid'] }}</p>
    </body>
</html>