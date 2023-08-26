@extends('layouts.auth_app')
@section('title')
    تسجيل الدخول
@endsection
@section('content')

    <style>

    </style>
    <div class="card login-part">
        <div class="card-header"><h4 class='text-center'>تسجيل الدخول</h4></div>

        <div class="card-body ">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger p-0">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group" style="
                                direction: unset !important;
                                 text-align:right; font-size: large;">
                    <label for="email">البريد الألكتروني</label>
                    <input aria-describedby="emailHelpBlock" id="email" type="email"
                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                           placeholder="أدخل البريد الألكتروني" tabindex="1" dir="rtl"
                           value="{{ (Cookie::get('email') !== null) ? Cookie::get('email') : old('email') }}" autofocus
                           required>
                    <!--<div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>-->
                </div>

                <div class="form-group">
                    <div dir="rtl" style="
                                direction: unset !important;
                                 text-align:right;">
                        <label for="password"
                        >كلمة المرور</label>
                    </div>
                    <input aria-describedby="passwordHelpBlock" id="password" type="password"
                           value="{{ (Cookie::get('password') !== null) ? Cookie::get('password') : null }}"
                           placeholder="أدخل كلمة المرور" dir="rtl"
                           class="form-control{{ $errors->has('email') ? ' is-invalid': '' }}" name="password"
                           tabindex="2" required>
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                    <!-- <div class="float-left" dir="rtl">
                        <a href="{{ route('forget.password.get') }}" class="text-small">
                              Forgot Password ?
                        </a>
                    </div> -->
                </div>

{{--                <div class="form-group">--}}
{{--                    <div class="custom-control custom-checkbox">--}}
{{--                        <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"--}}
{{--                               id="remember"{{ (Cookie::get('remember') !== null) ? 'checked' : '' }}>--}}
{{--                        <label class="custom-control-label" for="remember">Remember Me</label>--}}
{{--                    </div>--}}
{{--                </div>--}}

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block save-btn" tabindex="4">
                        تسجيل الدخول
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
