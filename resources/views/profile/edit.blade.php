@php
    $shell = Auth::user()->isClient() ? 'client.shell' : (Auth::user()->isExpert() ? 'expert.shell' : 'default.shell');
    $user = Auth::user();
@endphp

@extends($shell)

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h2 class="fw-semibold text-dark">Profile</h2>

                @if (!$user->profile || !$user->contacts || !$user->address)
                    <div class="alert alert-warning mt-3">
                        <i class="fas fa-exclamation-triangle"></i> Please complete your profile to access all features.
                    </div>
                @endif
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        @include('profile.ui.update-profile-information-form')
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        @include('profile.ui.update-address-form')
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        @include('profile.ui.update-contacts-form')
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        @include('profile.ui.update-password-form')
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        @include('profile.ui.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection