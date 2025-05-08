@extends('expert.shell')

@section('expert-content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                @if(session('profile_incomplete') || !$user->isProfileComplete())
                    <div class="alert alert-info shadow-sm border-0 rounded-3 mb-4">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-circle fs-3 me-3 text-primary"></i>
                            <div>
                                <h5 class="alert-heading mb-1">Profile Completion Required</h5>
                                <p class="mb-0">Please complete your profile to access all platform features.</p>

                                @php
                                    $incompleteFields = session('incomplete_fields') ?? $user->getIncompleteProfileFields();
                                @endphp

                                @if(!empty($incompleteFields))
                                    <div class="mt-2">
                                        <strong>Sections to complete:</strong>
                                        <ul class="mb-0 ps-3">
                                            @foreach($incompleteFields as $field)
                                                <li>
                                                    @if($field == 'personal')
                                                        <a href="#personalInfo" class="text-decoration-none">Personal Information</a>
                                                    @elseif($field == 'address')
                                                        <a href="#addressInfo" class="text-decoration-none">Address Information</a>
                                                    @elseif($field == 'contact')
                                                        <a href="#contactInfo" class="text-decoration-none">Contact Information</a>
                                                    @else
                                                        {{ ucfirst($field) }} Information
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
                @include('expert.profile._ui.user-card.user-card', ['user' => $user])
                @include('expert.profile._ui.card-profile-setting')
                @yield('profile-content')
            </div>
        </div>
    </div>
@endsection