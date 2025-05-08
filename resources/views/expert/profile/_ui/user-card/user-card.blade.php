@php
    $imageSrc = asset('images/default-profile.png');

    if ($user->profile && $user->profile->url) {
        $url = $user->profile->url;
        // Handle localhost URL
        if (Str::startsWith($url, 'http://localhost')) {
            $imageSrc = str_replace('http://localhost', 'http://localhost:' . env('APP_PORT', '8000'), $url);
        }
        // Handle other URLs or relative paths
        elseif (Str::startsWith($url, ['http://', 'https://'])) {
            $imageSrc = $url;
        } else {
            $imageSrc = asset($url);
        }
    }

@endphp

<div class="card border-0 shadow-sm rounded-3 mb-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="bg-primary text-white p-4 mb-3">
            <div class="text-center">
                <div class="position-relative d-inline-block mb-3">
                    <div class="rounded-circle bg-white p-1" style="width: 130px; height: 130px; overflow: hidden;">
                        <img src="{{ $imageSrc }}" alt="Profile Image" class="img-fluid rounded-circle"
                            style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <button class="btn btn-light btn-sm rounded-circle position-absolute bottom-0 end-0 shadow"
                        data-bs-toggle="modal" data-bs-target="#uploadPhotoModal" title="Change Photo">
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

<!-- Upload Modal -->
<div class="modal fade" id="uploadPhotoModal" tabindex="-1" aria-labelledby="uploadPhotoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="uploadForm" enctype="multipart/form-data" method="POST"
            action="{{ route('expert.profile.upload-photo') }}">
            @csrf
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white border-0">
                    <h5 class="modal-title" id="uploadPhotoModalLabel"><i class="fas fa-camera me-2"></i>Upload Photo
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="file" name="photo" class="form-control" accept="image/*" required>
                    <div id="uploadStatus" class="text-center mt-2"></div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-upload me-1"></i> Upload
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
