@extends('layout')
@section('title','Login Page')
@section('style')
<style>
    .error{
        color: red ;
    }
    .form{
        background-color: rgb(23, 183, 170);
    }
  
    .agileits
    {
        margin-top: 5%;
    }
    .hrefUnderline{
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
        <p class="w3agileits">Login Here</p>
        <div class="formDiv">

            <form class='form animate-form' id='form1' action="{{ route('login') }}" method="post">
                @csrf
                <div class='form-group has-feedback w3ls'>
                    <label class='control-label' for='name'>Username</label>
                    <input class='form-control' id='name' name='name' placeholder='Username' type='text' value="{{ old('name') }}">
                    <span class='glyphicon glyphicon-ok form-control-feedback'></span>
                    @error('name')
                    <span class="error">{{ $message }}</span>
                     @enderror
                </div>

                <div class='form-group has-feedback agile'>
                    <label class='control-label' for='password'>Password</label>
                    <input class='form-control w3l' id='password' name='password' placeholder='Password' type='password'><span class='glyphicon glyphicon-ok form-control-feedback'></span>
                    @error('password')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div  class='submit w3-agile'>
                    <input id="submit" class='btn btn-lg' type='submit' value='SUBMIT'>
                </div>
            </form>
        </div>
        <a id="registerForm" class="hrefUnderline" href="{{ route('showRegistrationForm') }}" style="color:black;">Dont have an account? Register here</a><br>
        <a id="forgotPasswordPage" class="hrefUnderline" href="{{ route('forgotPasswordPage') }}">Forgot password?Click here</a>
    </div>
</div>


@endsection

@section('scripts')
<script type="text/javascript" src="{{ URL('js/jQuery.min.js') }}"></script>
<script src="{{ URL('js/bootstrap.min.js') }}"></script>


@endsection
