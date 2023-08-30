@extends('layout')
@section('title','Change password page')
@section('style')
<style>
    .error{
        color: red ;
    }
    .form{
        background-color: rgb(23, 183, 170);
    }
    .footer_margin{
        margin-top: 120px !important;
    }
    .agileits
    {
        margin-top: 5%;
    }
    #registerForm{
        text-decoration: underline;
    }
    #submit{
       background-color: #3f96c9;
    }

</style>

@endsection
@section('content')
<div class="agileits">
    <div class="w3-agileits-info">
        <p class="w3agileits">Change password</p>
        @if (session()->has('error'))
        <div class="alert alert-danger">
            <span>{{ session()->get('error') }}</span>
        </div>
    @endif
    @if (session()->has('success'))
        <div class="alert alert-success">
            <span>{{ session()->get('success') }}</span>
        </div>
    @endif
        <div class="formDiv">

            <form class='form animate-form' id='form1' action="{{ route('submitResetPasswordForm') }}" method="post">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class='form-group has-feedback w3ls'>
                    <label class='control-label' for='email'>Email</label>
                    <input class='form-control' id='email' name='email' placeholder='Email' type='text' value="{{ old('email') }}">
                    <span class='glyphicon glyphicon-ok form-control-feedback'></span>
                    @error('email')
                    <span class="error">{{ $message }}</span>
                     @enderror
                </div>
                <div class='form-group has-feedback agile'>
                    <label class='control-label' for='newpassword'>New Password</label>
                    <input class='form-control w3l' id='newpassword' name='newpassword' placeholder='New Password' type='password'><span class='glyphicon glyphicon-ok form-control-feedback'></span>
                    @error('newpassword')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class='form-group has-feedback w3ls'>
                    <label class='control-label' for='cpassword'>Confirm Password</label>
                    <input class='form-control' id='cpassword' name='cpassword' placeholder='Confirm password' type='password' value="{{ old('cpassword') }}">
                    <span class='glyphicon glyphicon-ok form-control-feedback'></span>
                    @error('cpassword')
                    <span class="error">{{ $message }}</span>
                     @enderror
                </div>

                <div class='submit w3-agile'>
                    <input id="submit" class='btn btn-lg' type='submit' value='Change password'>
                </div>
            </form>
        </div>
      
    </div>
</div>


@endsection

@section('scripts')
<script type="text/javascript" src="{{ URL('js/jQuery.min.js') }}"></script>
<script src="{{ URL('js/bootstrap.min.js') }}"></script>

<script  defer type="text/javascript">
    $(document).ready(function () {
        setTimeout(() => {
               $('div.alert').slideUp();
            }, 4000);
    });
</script>
@endsection
