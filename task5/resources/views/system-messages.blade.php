@if(session()->has('status'))
    <div class="alert {{ session()->get('alert-class', 'alert-success') }} for-global-window d-flex align-items-center" id="status-area">
        <i class="fas fa-check-circle mr-2"></i>{{ session()->get('status') }}
        <a href="#" class="ml-auto">
            <i class="far fa-times-circle"></i>
        </a>
    </div>
@endif
