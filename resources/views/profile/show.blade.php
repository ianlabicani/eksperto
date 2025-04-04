@php
    $shell = Auth::check() && Auth::user()->isClient() ? 'client.shell' :
        (Auth::check() && Auth::user()->isExpert() ? 'expert.shell' : 'default.shell');

    // Extract contact details
    $email = collect($contacts)->firstWhere('type', 'email')['value'] ?? 'No email available';
    $phone = collect($contacts)->firstWhere('type', 'phone')['value'] ?? 'No phone number';
    $social = collect($contacts)->firstWhere('type', 'social')['value'] ?? 'No social links';
@endphp

@extends($shell)

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                @if (url()->previous() !== url()->current())
                    <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                @endif
                <h2 class="fw-semibold text-dark">
                    <i class="fas fa-user-circle"></i> Public Profile
                </h2>
            </div>
        </div>

        <!-- Profile Information -->
        <div class="row mt-4">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <i class="fas fa-id-card"></i> Profile Information
                    </div>
                    <div class="card-body">
                        <p><i class="fas fa-user"></i> <strong>Name:</strong> {{ $user->name }}</p>
                        <p><i class="fas fa-envelope"></i> <strong>Email:</strong> {{ $user->email }}</p>
                        <p><i class="fas fa-info-circle"></i> <strong>Bio:</strong>
                            {{ $profile->bio ?? 'No bio available' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Address Information -->
        <div class="row mt-4">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <i class="fas fa-map-marker-alt"></i> Address Information
                    </div>
                    <div class="card-body">
                        @if ($address->house_number && $address->street && $address->municipality)
                            <p><i class="fas fa-home"></i> <strong>House Number:</strong> {{ $address->house_number }}</p>
                            <p><i class="fas fa-road"></i> <strong>Street:</strong> {{ $address->street }}</p>
                            <p><i class="fas fa-map-pin"></i> <strong>Barangay:</strong> {{ $address->barangay }}</p>
                            <p><i class="fas fa-city"></i> <strong>Municipality:</strong> {{ $address->municipality }}</p>
                            <p><i class="fas fa-map"></i> <strong>Province:</strong> {{ $address->province }}</p>
                            <p><i class="fas fa-mail-bulk"></i> <strong>Zip Code:</strong> {{ $address->zip_code }}</p>
                        @else
                            <p class="text-muted"><i class="fas fa-exclamation-circle"></i> No address available.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="row mt-4">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <i class="fas fa-address-book"></i> Contact Information
                    </div>
                    <div class="card-body">
                        <p><i class="fas fa-envelope"></i> <strong>Email:</strong> {{ $email }}</p>
                        <p><i class="fas fa-phone"></i> <strong>Phone:</strong> {{ $phone }}</p>
                        <p><i class="fab fa-facebook"></i> <strong>Social Media:</strong> {{ $social }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection