@extends('layouts.login_temp')

@section('content')
<div class="login-pag-inner">
    <div class="  z-index-50">
        <div class="login-container   ">
            <div class="login-branding login-content">
                <a href="index.html"><img src="images/gmf.png" alt="Mouldifi" title="Mouldifi"></a>
            </div>
            <br>
            <div class="login-content">
                <h2><strong> Register </strong> page </h2>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <input id="email" type="text" placeholder="ID NUMBER" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="id_number" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block">Register</button>
                        </div>
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger">
                                {{$errors->first()}}
                            </div>
                        @endif


                        <p class="text-center"><a href="{{ route('login') }}">Login </a></p>
                    </form>
                </div>
        </div>
    </div>
</div>
@endsection
