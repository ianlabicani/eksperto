@extends('client.profile.shell')

@section('profile-content')
    <div class="container">
        <div class="row">
            <div class="col-10 mx-auto">
                @if (!$user->isProfileComplete())
                    <div class="alert alert-warning mt-3">
                        <i class="fas fa-exclamation-triangle"></i> Please complete your profile to access all features.
                    </div>
                @else
                    <div class="alert alert-success mt-3">
                        <i class="fas fa-check-circle"></i> Your profile is complete. You can now access all features.
                    </div>
                @endif
                <div class="card shadow-lg mb-3">
                    <div class="card-body">
                        <div class="rounded-circle mb-3"
                            style="width: 120px; height: 120px; overflow: hidden; margin: auto;">
                            <img src="{{ asset('images/profile-placeholder.jpg') }}" alt="Eksperto Logo"
                                class="img-fluid mx-auto d-block">
                        </div>
                        <h5 class="card-title text-center">{{ $user->name }}</h5>
                        <p class="card-text text-center text-muted">{{ $user->email }}</p>

                        <div class="d-flex justify-content-center mt-3 gap-3 text-center">
                            <div class="">
                                <span class="h5 d-block text-center">0</span>
                                <span class="text-color d-block">Visits</span>
                            </div>
                            <div class="">
                                <span class="h5 d-block text-center">1</span>
                                <span class="text-color d-block">Job's Done</span>
                            </div>
                            <div class="">
                                <span class="h5 d-block text-center">Available</span>
                                <span class="text-color d-block">Status</span>
                            </div>
                        </div>

                        <button class="btn btn-primary btn-sm mt-3 d-block mx-auto" data-bs-toggle="modal"
                            data-bs-target="#comingSoonModal">
                            <span class="mx-2">UPLOAD PHOTO</span>
                        </button>

                        <div class="modal fade" id="comingSoonModal" tabindex="-1" aria-labelledby="comingSoonModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="comingSoonModalLabel">Coming Soon</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        This feature is coming soon. Stay tuned for updates!
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('client.profile.partials.card-personal', ['user' => $user])
            </div>
        </div>
    </div>
@endsection