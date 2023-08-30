@extends('layout')
@section('title','Forgot password Page')
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
    #submit{
       background-color: #3f96c9;
    }

</style>

@endsection
@section('content')
<div class="agileits">
    <div class="w3-agileits-info">
        <p class="w3agileits">Forgot password</p>
        @if (session()->has('success'))
        <div class="alert alert-success">
            <span>{{ session()->get('success') }}</span>
        </div>
    @endif
        <div class="formDiv">
     
            <form class='form animate-form' id='form1' action="{{ route('submitForgotPasswordForm') }}" method="post">
                @csrf
                <div class='form-group has-feedback w3ls'>
                    <label class='control-label' for='name'>Email</label>
                    <input class='form-control' id='email' name='email' placeholder='Email' type='email' value="{{ old('email') }}">
                    <span class='glyphicon glyphicon-ok form-control-feedback'></span>
                    @error('email')
                    <span class="error">{{ $message }}</span>
                     @enderror
                </div>
                <div class='submit w3-agile'>
                    <input id="submit" class='btn btn-lg' type='submit' value='Send reset password link'>
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
            }, 5000);
    });
</script>
@endsection
