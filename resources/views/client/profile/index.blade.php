@extends('client.profile.shell')

@section('profile-content')
    <div class="container">
        <div class="row">
            <div class="col-10 mx-auto">
                @if (!$user->profile || !$user->contacts || !$user->address)
                    <div class="alert alert-warning mt-3">
                        <i class="fas fa-exclamation-triangle"></i> Please complete your profile to access all features.
                    </div>
                @else
                    <div class="alert alert-success mt-3">
                        <i class="fas fa-check-circle"></i> Your profile is complete. You can now access all features.
                    </div>
                @endif
                @include('client.profile._ui.card-user')
                @include('client.profile._ui.card-personal')
            </div>
        </div>
    </div>
@endsection