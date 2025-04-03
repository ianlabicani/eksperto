@extends('expert.shell')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-10 mx-auto">
                @include('expert.profile._ui.card-user')
                @include('expert.profile._ui.card-profile-setting')
                @include('expert.expertise._ui.card-expertise')
            </div>
        </div>
@endsection