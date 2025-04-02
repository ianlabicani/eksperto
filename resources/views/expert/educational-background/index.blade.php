@extends('expert.shell')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-10 mx-auto">
                @include('expert.profile.ui.card-user')
                @include('expert.profile.ui.card-profile-setting')
                @include('expert.educational-background.ui.card-educational-background')
            </div>
        </div>
@endsection