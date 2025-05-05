@extends('expert.shell')

@section('expert-content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-10 mx-auto">
                @include('expert.profile._ui.card-user')
                @include('expert.profile._ui.card-profile-setting')
                @include('expert.work-experiences._ui.card-work-experience')
            </div>
        </div>
@endsection