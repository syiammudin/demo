@extends('layouts.login_temp')

@section('content')
<div class="login-pag-inner ">
    <div class="  z-index-50">
        <div class="login-container   ">
            <div class="login-branding login-content transparent bg2" style="background: #2E3746 ;">
                <a href="index.html"><img src="images/logo.jpg" alt="Mouldifi" title="Mouldifi"></a>
            </div>
            <br>
            <div class="login-content transparent">
                <h2><strong>Welcome</strong>, please login</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <input id="email" type="text" placeholder="User Name" class="form-control{{ $errors->has('id_number') ? ' is-invalid' : '' }} transparent" name="id_number" value="{{ old('id_number') }}"  autofocus>
                        @if ($errors->has('id_number'))
                            <span class="text-danger" role="alert">
                                <strong>{{ $errors->first('id_number') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} transparent" name="password" >
                        @if ($errors->has('password'))
                            <span class="text-danger" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                      <input type="radio" name="type_login" value="aplication" class="form-control transparent" checked style="display: none ;" >
                        <button class="btn btn-primary btn-block">Login</button>
                    </div>
                    <div class="form-group">
                        <!-- <label class="col-sm-2 control-label">Maintenance Area </label> -->
                        Akses Login
                        <table class="table " style="color:black; font-size: 10pt;">
                          <tr>
                            <td>Step 1 - User</td>
                            <td> Username : user <br> Password : 123321</td>
                          </tr>
                          <tr>
                            <td>Step 2 - Manager</td>
                            <td> Username : manager <br> Password : 123321</td>
                          </tr>
                          <tr>
                            <td>Step 3 - HRD</td>
                            <td> Username : hrd <br> Password : 123321</td>
                          </tr>
                        </table>
                        <!-- <div class="row">
                            <div class="col-md-12 radio radio-replace radio-success"> -->
                                <!-- <div class="col-lg-6">
                                    <input type="radio" name="type_login" value="ldap" checked class="form-control  transparent">
                                    <label for="radio6">L-Dap Account</label>
                                </div> -->
                                <!-- <div class="col-lg-6">
                                    <label for="radio6">Aplication Account</label>
                                </div> -->

                                <!-- @if ($errors->has('type_login'))
                                <span class="text-danger" role="alert">
                                    <strong>{{ $errors->first('type_login') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div> -->
                    </div>

                    <div class="form-group">
                         <div class="checkbox checkbox-replace">
                             <input class="form-check-input transparent"  type="hidden" name="remember" value="1" id="remember" {{ old('remember') ? 'checked' : '' }}>
                             <!-- <label class="form-check-label" for="remember">
                                 {{ __('Remember Me') }}
                             </label> -->
                          </div>
                     </div>

                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        @if($errors->has('error'))
                            <!-- @if (!$errors->has('type_login')  or !$errors->has('id_number') or !$errors->has('password')) -->
                                <div class="alert alert-danger">
                                    {{$errors->first('error')}}
                                </div>
                            <!-- @endif -->
                        @endif
                        <!-- <p class="text-center"><a href="{{ route('register') }}">Register </a></p> -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
