@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('messages.Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('messages.A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('messages.Before proceeding, please check your email for a verification link.') }}
                    {{ __('messages.If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <input type="submit" class="px-2 py-1 mx-2 mr-md-4" id="verify-submit" value="{{ __('messages.click here to request another.') }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
