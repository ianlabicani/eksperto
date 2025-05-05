@php
    $user = Auth::user();
@endphp

@extends('expert.shell')

@section('expert-content')
    <div class="container">

        @if (!$user->profile || !$user->contacts || !$user->address)
            <div class="alert alert-warning mt-3">
                <i class="fas fa-exclamation-triangle"></i> Please complete your profile to access all features.
            </div>
        @else
            <div class="alert alert-success mt-3">
                <i class="fas fa-check-circle"></i> Your profile is complete. You can now access all features.
            </div>
        @endif

        <div class="row">
            <div class="col-10 mx-auto">
                @include('expert.profile._ui.card-user')
                @include('expert.profile._ui.card-profile-setting')
                @include('expert.profile._ui.card-personal')
                @yield('profile.content')
            </div>
        </div>
@endsection