@extends('expert.shell')

@section('expert-content')
    <div class="row my-4">
        <div class="col-10 mx-auto">
            @include('expert.profile._ui.user-card.user-card', ['user' => $user])
            @include('expert.profile._ui.card-profile-setting')
            @yield('profile-content')
        </div>
    </div>
@endsection