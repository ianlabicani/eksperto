@php
    use Illuminate\Support\Facades\Auth;

    $user = Auth::user();

    // If URL is already absolute (e.g. starts with http or https), use it directly
    $imageSrc = Str::startsWith($profileUrl, ['http://', 'https://'])
        ? $profileUrl
        : asset($profileUrl ?? 'images/default-profile.png');
@endphp

<div class="card shadow-lg mb-3">
    <div class="card-body">
        <div class="rounded-circle mb-3" style="width: 120px; height: 120px; overflow: hidden; margin: auto;">
            <img src="{{ $imageSrc }}" alt="Profile Photo" class="img-fluid mx-auto d-block"
                style="width: 100%; height: 100%; object-fit: cover;">
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

        <!-- Upload Photo Button -->
        <button class="btn btn-primary btn-sm mt-3 d-block mx-auto" data-bs-toggle="modal"
            data-bs-target="#uploadPhotoModal">
            <span class="mx-2">UPLOAD PHOTO</span>
        </button>

        <!-- Upload Modal -->
        <div class="modal fade" id="uploadPhotoModal" tabindex="-1" aria-labelledby="uploadPhotoModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form id="uploadForm" enctype="multipart/form-data" method="POST"
                    action="{{ route('expert.profile.upload-photo') }}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="uploadPhotoModalLabel">Upload Photo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="file" name="photo" class="form-control" accept="image/*" required>
                            <div id="uploadStatus" class="text-center mt-2"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Upload</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>