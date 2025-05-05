@extends('client.shell')

@section('client-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between align-items-center">
                <h1>Dashboard</h1>
            </div>

            <div class="col-md-12 mt-3">
                <p>Welcome to client dashboard, {{ Auth::user()->name }}!</p>
            </div>
        </div>
    </div>
@endsection