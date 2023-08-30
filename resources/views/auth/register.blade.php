@extends('layout')
@section('title','Register Page')
@section('style')
<style>
    .error{
        color: red ;
    }
    .form{
        background-color: rgb(23, 183, 170);

    }
    #submit{
       background-color: #3f96c9;
    }

</style>

@endsection
@section('content')
<div class="agileits">
    <div class="w3-agileits-info"  id="rform">
        <p class="w3agileits">Register Here</p>
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

        <form class='form animate-form' id='form1' action="{{ route('register') }}" method="post">
            @csrf
            <div class='form-group has-feedback w3ls'>
                <label class='control-label' for='name'>Username</label>
                <input class='form-control' id='name' name='name' placeholder='Username' type='text' value="{{ old('name') }}">
                <span class='glyphicon glyphicon-ok form-control-feedback'></span>
                @error('name')
                <span class="error">{{ $message }}</span>
                 @enderror
            </div>
            <div class='form-group has-feedback w3ls'>
                <label class='control-label' for='name'>Email</label>
                <input class='form-control' id='email' name='email' placeholder='Email' type='email' value="{{ old('email') }}">
                <span class='glyphicon glyphicon-ok form-control-feedback'></span>
                @error('email')
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
            <div class='form-group has-feedback w3ls'>
                <label class='control-label' for='cpassword'>Confirm Password</label>
                <input class='form-control' id='cpassword' name='cpassword' placeholder='Confirm password' type='password' value="{{ old('cpassword') }}">
                <span class='glyphicon glyphicon-ok form-control-feedback'></span>
                @error('cpassword')
                <span class="error">{{ $message }}</span>
                 @enderror
            </div>
            <div class='submit w3-agile'>
                <input id="submit" class='btn btn-lg' type='submit' value='SUBMIT'>
            </div>
        </form>
    </div>
        <a href="{{ route('index') }}" style="color:black;  text-decoration: underline; "> I hava an account</a>

    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ URL('js/jQuery.min.js') }}"></script>
 <script  defer type="text/javascript">
    $(document).ready(function () {
        setTimeout(() => {
               $('div.alert').slideUp();
            }, 4000);
    });
</script>

@endsection
