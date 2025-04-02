<div class="card mb-3 shadow-lg">
    <div class="card-header">
        <h2>Profile Settings</h2>
    </div>

    <div class="card-body pt-0">

        <ul class="list-unstyled d-flex flex-column gap-2">
            <li>
                <a class="text-decoration-none text-muted {{ request()->routeIs('expert.profile.index') ? 'custom-active' : ''  }}"
                    href="">
                    <i class="fa fa-user" aria-hidden="true" style="width: 20px"></i> Personal
                </a>
            </li>
            <li>
                <a class="text-decoration-none text-muted {{ request()->routeIs('expert.educational-background.index') ? 'custom-active' : ''  }}"
                    href="{{ route('expert.educational-background.index') }}">
                    <i class="fa fa-graduation-cap" style="width: 20px"></i> Educational Background
                </a>
            </li>
            <li>
                <a class="text-decoration-none text-muted {{ request()->routeIs('') ? 'custom-active' : ''  }}" href="">
                    <i class="fa fa-briefcase" aria-hidden="true" style="width: 20px"></i> Work Experience
                </a>
            </li>
            <li>
                <a class="text-decoration-none text-muted {{ request()->routeIs('') ? 'custom-active' : ''  }}" href="">
                    <i class="fa fa-wrench" aria-hidden="true" style="width: 20px"></i> Expertise
                </a>
            </li>
            <li>
                <a class="text-decoration-none text-muted {{ request()->routeIs('') ? 'custom-active' : ''  }}" href="">
                    <i class="fa fa-upload" aria-hidden="true" style="width: 20px"></i> Upload Certificate(s)
                </a>
            </li>
        </ul>
    </div>
</div>

@push('styles')
    <style>
        .custom-active {
            color: #0d6efd;
            font-weight: 600;
        }

        .custom-active:hover {
            color: #0d6efd;
            font-weight: 600;
        }
    </style>
@endpush