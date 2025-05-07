@extends('client.profile.shell')

@section('profile-content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                @if (!$user->isProfileComplete())
                    <div class="alert alert-warning border-0 shadow-sm rounded-3 d-flex align-items-center mb-4">
                        <i class="fas fa-exclamation-triangle fs-4 me-3 text-warning"></i>
                        <div>Please complete your profile to access all features.</div>
                    </div>
                @else
                    <div class="alert alert-success border-0 shadow-sm rounded-3 d-flex align-items-center mb-4">
                        <i class="fas fa-check-circle fs-4 me-3 text-success"></i>
                        <div>Your profile is complete. You can now access all features.</div>
                    </div>
                @endif

                <div class="card border-0 shadow-sm rounded-3 mb-4 overflow-hidden">
                    <div class="card-body p-0">
                        <div class="bg-primary text-white p-4 mb-3">
                            <div class="text-center">
                                <div class="position-relative d-inline-block mb-3">
                                    <div class="rounded-circle bg-white p-1"
                                        style="width: 130px; height: 130px; overflow: hidden;">
                                        <img src="{{ asset('images/profile-placeholder.jpg') }}" alt="Profile Image"
                                            class="img-fluid rounded-circle">
                                    </div>
                                    <button
                                        class="btn btn-light btn-sm rounded-circle position-absolute bottom-0 end-0 shadow"
                                        data-bs-toggle="modal" data-bs-target="#comingSoonModal" title="Change Photo">
                                        <i class="fas fa-camera"></i>
                                    </button>
                                </div>
                                <h4 class="card-title mb-0">{{ $user->name }}</h4>
                                <p class="card-text text-white-50">{{ $user->email }}</p>
                            </div>
                        </div>

                        <div class="px-4 pb-4">
                            <div class="row g-0">
                                <div class="col-md-4 border-end">
                                    <div class="p-3 text-center">
                                        <div class="display-6 fw-bold text-primary">0</div>
                                        <div class="small text-muted">Visits</div>
                                    </div>
                                </div>
                                <div class="col-md-4 border-end">
                                    <div class="p-3 text-center">
                                        <div class="display-6 fw-bold text-primary">1</div>
                                        <div class="small text-muted">Jobs Completed</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 text-center">
                                        <div class="badge bg-success px-3 py-2 fs-6">Available</div>
                                        <div class="small text-muted mt-1">Status</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('client.profile.partials.card-personal', ['user' => $user, 'profile' => $profile, 'address' => $address])
            </div>
        </div>
    </div>

    <!-- Coming Soon Modal -->
    <div class="modal fade" id="comingSoonModal" tabindex="-1" aria-labelledby="comingSoonModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white border-0">
                    <h5 class="modal-title" id="comingSoonModalLabel"><i class="fas fa-rocket me-2"></i>Coming Soon</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <i class="fas fa-code fs-1 text-primary my-3"></i>
                    <p class="lead">This feature is coming soon!</p>
                    <p class="text-muted">We're working hard to bring you the ability to upload your profile photo. Stay
                        tuned for updates!</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection