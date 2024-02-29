@extends('web.layout.app')
@section('content')
<!-- Start login section  -->
<div class="login__section section--padding">
    <div class="container">
        {!! Form::open(['route' => 'web.check-login', 'id' => 'submit-form', 'redirect'=>url('/')]) !!}
        <div class="login__section--inner">
            <div class="row row-cols-md-2 justify-content-center">
                <div class="col">
                    <div class="account__login">
                        <div class="account__login--header mb-25">
                            <h2 class="account__login--header__title mb-10">Login</h2>
                        </div>
                        <div class="account__login--inner">
                            <label>
                                <input class="account__login--input" placeholder="Email Addres" name="email" type="email">
                            </label>
                            <label>
                                <input class="account__login--input" placeholder="Password" name="password" type="password">
                            </label>
                            <div class="account__login--remember__forgot mb-15 d-flex justify-content-between align-items-center">
                                <button class="account__login--forgot" type="button">Forgot Your Password?</button>
                            </div>
                            <button class="account__login--btn primary__btn" id="submit-form-button" type="submit">Login</button>
                            <div class="account__login--divide">
                                <span class="account__login--divide__text">OR</span>
                            </div>
                            <p class="account__login--signup__text">Don,t Have an Account? <a href="{{ route('web.register') }}">Sign up now</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
<!-- End login section  -->
@endsection