@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center bravo-login-form-page bravo-login-page">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                        <style>
                            .reset-form-sms .form-group{
                                display : flex;
                            }
                            .reset-form-sms label{
                                text-align: left !important;
                                margin-top: 15px;
                                margin-left: 16px;
                            }
                            .reset-form-sms label[for='phone-confirmation']{
                                display : none;
                                margin-top : 25px;
                            }
                            .reset-form-sms #confirmCode{
                                display : none;
                            }
                            .reset-form-sms input#phone-confirmation{
                                display : none;
                                width : 329px;
                                height : 45px;
                                margin-top : 20px;
                            }
                            .reset-form-sms input{
                                width : 329px;
                                height : 45px;
                                margin-top : 20px;
                            }
                            .reset-form-sms{
                                width : 100%;
                            }
                        </style>
                        <h4>Or</h4>
                        <form method="POST" class="reset-form-sms">
                            @csrf
                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
                                <label for="phone-confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Code From SMS') }}</label>
                                <input id="phone" type="phone" name="phone">
                                <input id="phone-confirmation" name="phone-confirmation">
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button id="sendCode" class="btn btn-primary">
                                        {{ __('Send SMS Reset Number') }}
                                    </button>
                                    <button id="confirmCode" class="btn btn-primary">
                                        {{ __('Confirm Code') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
