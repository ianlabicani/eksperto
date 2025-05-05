@extends('expert.shell')

@section('expert-content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-10 mx-auto">
                @include('expert.profile._ui.card-user')
                @include('expert.profile._ui.card-profile-setting')
                @include('expert.educational-background._ui.card-educational-background')
            </div>
        </div>
@endsection