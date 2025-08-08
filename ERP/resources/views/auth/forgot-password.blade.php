@extends('layouts.auth')

@section('page-title')
    {{ __('Forgot Password') }}
@endsection

@php
    $settings = Utility::settings();
@endphp

@push('custom-scripts')
@if ($settings['recaptcha_module'] == 'on')
        {!! NoCaptcha::renderJs() !!}
    @endif
@endpush

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
    <div class="">
        <h2 class="mb-3 f-w-600">{{__('Forgot Password')}}</h2>
        @if (session('status'))
        <div class="alert alert-primary">
            {{ session('status') }}
        </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    </div>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="">
            <div class="form-group mb-3">
                <label for="email" class="form-label">{{ __('E-Mail') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{__('Enter Email')}}">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <small>{{ $message }}</small>
                </span>
                @enderror
            </div>

            @if ($settings['recaptcha_module'] == 'on')
                <div class="form-group mb-3">
                    {!! NoCaptcha::display() !!}
                    @error('g-recaptcha-response')
                    <span class="small text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            @endif

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-block mt-2">{{ __('Send Password Reset Link') }}</button>
            </div>
            <p class="my-4 text-center">{{__("Back to")}} <a href="{{ route('login' , $lang) }}" class="text-primary">{{__('Login')}}</a></p>

        </div>
    </form>
</div>
@endsection




