@extends('layouts.auth')
@php
    $logo=asset(Storage::url('uploads/logo/'));
    $company_logo=Utility::getValByName('company_logo');
    $settings = Utility::settings();

@endphp
@push('custom-scripts')
@if ($settings['recaptcha_module'] == 'on')
        {!! NoCaptcha::renderJs() !!}
    @endif
@endpush
@section('page-title')
    {{__('Login')}}
@endsection

@if ($settings['cust_darklayout'] == 'on')
    <style>
        .g-recaptcha {
            filter: invert(1) hue-rotate(180deg) !important;
        }
    </style>
@endif

@php
    $languages = App\Models\Utility::languages();
@endphp



@section('content')
    <div class="card-body">
        <div>
            <h2 class="mb-3 f-w-600">{{ __('Login') }}</h2>
        </div>
        @if(session('status'))
        <div class="mb-4 font-medium text-lg text-green-600 text-danger">
            {{ session('status') }}
        </div>
    @endif
        {{ Form::open(['route' => 'login', 'method' => 'post', 'id' => 'loginForm', 'class' => 'login-form']) }}
        <div class="custom-login-form">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('Email') }}</label>
                {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('Enter Your Email')]) }}
                @error('email')
                    <span class="error invalid-email text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label class="form-label">{{ __('Password') }}</label>
                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => __('Enter Your Password'), 'id' => 'input-password']) }}
                @error('password')
                    <span class="error invalid-password text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-4">
                <div class="d-flex flex-wrap align-items-center justify-content-between">

                    @if (Route::has('password.request'))
                        <span><a href="{{ route('password.request' , $lang) }}"
                                tabindex="0">{{ __('Forgot your password?') }}</a></span>
                    @endif
                </div>
            </div>

            @if ($settings['recaptcha_module'] == 'on')
                <div class="form-group col-lg-12 col-md-12 mt-3">
                    {!! NoCaptcha::display() !!}
                    @error('g-recaptcha-response')
                        <span class="small text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            @endif

            <div class="d-grid">
                {{ Form::submit(__('Login'), ['class' => 'btn btn-primary mt-2', 'id' => 'saveBtn']) }}
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection

