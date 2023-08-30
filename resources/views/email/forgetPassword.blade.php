<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset password link</title>
</head>
<style>
    .agileits {
        margin-top: 5%;
    }
</style>
<link href="{{ URL('css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all" />
<!-- Common Css -->
<link href="{{ URL('css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
<!--// Common Css -->
<!-- Nav Css -->
<link rel="stylesheet" href="{{ URL('css/style4.css') }}">
<!--// Nav Css -->
<!-- Fontawesome Css -->
<link href="{{ URL('css/fontawesome-all.css') }}" rel="stylesheet">
<!--// Fontawesome Css -->
<!--// Style-sheets -->

<!--web-fonts-->
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<!--//web-fonts-->
<body>
    
    <div class="agileits">
        <div class="w3-agileits-info">
            <p class="w3agileits"> Reset password link</p>
            <div class="formDiv">
                <p>You can reset password from the below link:</p>

                <a class="btn btn-primary" href="{{ route('showResetPasswordForm', $token) }}">Reset password</a>
            </div>

        </div>
</body>
</html>