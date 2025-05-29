@extends('expert.shell')

@section('title')
    Expert Profile
@endsection

@section('expert-content')
    <div class="row justify-content-center">
        @if(session('profile_incomplete') || !$user->isProfileComplete())
            <div class="alert alert-info shadow-sm border-0 rounded-3 mb-4">
                <div class="d-flex">
                    <div class="me-3">
                        <i class="fas fa-exclamation-circle fs-3 text-primary"></i>
                    </div>
                    <div>
                        <h5 class="alert-heading fw-bold mb-2">Complete Your Profile</h5>
                        <p class="mb-2">Please complete your profile to access all platform features and increase your
                            chances of being hired.</p>

                        @php
    $incompleteFields = session('incomplete_fields') ?? $user->getIncompleteProfileFields();
                        @endphp

                        @if(!empty($incompleteFields))
                            <div>
                                <span class="fw-bold">Sections to complete:</span>
                                <div class="d-flex flex-wrap gap-2 mt-2">
                                    @foreach($incompleteFields as $field)
                                        <a href="#{{ $field }}Info"
                                            class="badge bg-primary bg-opacity-10 text-light px-3 py-2 text-decoration-none">
                                            @if($field == 'personal')
                                                <i class="fas fa-user me-1"></i> Personal Information
                                            @elseif($field == 'address')
                                                <i class="fas fa-map-marker-alt me-1"></i> Address Information
                                            @elseif($field == 'contact')
                                                <i class="fas fa-envelope me-1"></i> Contact Information
                                            @else
                                                <i class="fas fa-info-circle me-1"></i> {{ ucfirst($field) }} Information
                                            @endif
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif



        @include('expert.profile._ui.user-card.user-card', ['user' => $user])
        <div class="card no-hover shadow-sm border-0 mb-4">
            <div class="card-body p-0">
            </div>
        </div>
        @include('expert.profile._ui.card-profile-setting')


        <div class="profile-content">
            @yield('profile-content')
        </div>
    </div>
@endsection
