@extends('client.shell')

@section('client-content')
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h2 class="fw-bold">Job Application Details</h2>

        <!-- Application Info -->
        <div class="card shadow border-0 mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Applicant Details</h5>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $expert->name }}</p>
                <p><strong>Email:</strong> {{ $expert->email }}</p>
                <p><strong>Cover Letter:</strong> {!! nl2br(e($jobApplication->cover_letter)) !!}</p>
                <p>
                    <strong>Status:</strong>
                    <span
                        class="badge bg-{{ $jobApplication->status == 'pending' ? 'warning' : ($jobApplication->status == 'accepted' ? 'success' : 'danger') }}">
                        {{ ucfirst($jobApplication->status) }}
                    </span>
                </p>
                <p><small class="text-muted">Applied on
                        {{ \Carbon\Carbon::parse($jobApplication->created_at)->format('M d, Y h:i A') }}</small></p>
            </div>
            @if ($expert->workExperiences->isNotEmpty())
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Work Experience</h5>
                </div>
                <div class="card-body">
                    @foreach ($expert->workExperiences as $experience)
                        <div class="mb-3">
                            <h6 class="fw-bold">{{ $experience->job_title }} at {{ $experience->company_name }}</h6>
                            <p class="mb-1 text-muted">
                                {{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }} –
                                {{ $experience->end_date ? \Carbon\Carbon::parse($experience->end_date)->format('M Y') : 'Present' }}
                            </p>
                            <p>{!! nl2br(e($experience->description)) !!}</p>
                            <hr>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-secondary">
                    <i class="fas fa-briefcase"></i> No work experience listed.
                </div>
            @endif

            <!-- Application Status -->

            @if ($jobApplication->status === 'pending')
                <div class="card-footer text-end mb-5">
                    <form action="{{ route('client.job-applications.accept', $jobApplication->id) }}" method="POST"
                        class="d-inline">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="accepted">
                        <button type="submit" class="btn btn-success me-2">Accept</button>
                    </form>

                    <form action="{{ route('client.job-applications.reject', $jobApplication->id) }}" method="POST"
                        class="d-inline">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="rejected">
                        <button type="submit" class="btn btn-danger">Reject</button>
                    </form>
                </div>
            @endif

            <!-- accepted application -->

            @if ($jobApplication->status === 'accepted' && !$jobApplication->jobContract)
                <!-- create contract -->

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createContractModal">
                    <i class="fas fa-file-contract"></i> Create Contract
                </button>

                @include('client.job-applications.partials.job-contract-create')
            @endif
        </div>

        <!-- rejected application -->

        @if ($jobApplication->status === 'rejected')
            <div class="alert alert-danger mt-4">
                <strong>This application has been rejected.</strong>
            </div>
        @endif

    </div>
@endsection
