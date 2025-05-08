@extends('expert.shell')

@section('expert-content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                @include('expert.profile._ui.user-card.user-card', ['user' => $user])
                @include('expert.profile._ui.card-profile-setting')
                @yield('profile-content')
            </div>
        </div>
    </div>
@endsection