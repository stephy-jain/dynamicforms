<!DOCTYPE html>
<html>
<head>
    <title>Forms</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Menu</div>
                <div class="card-body">
                    @if($forms->isNotEmpty())
                        <ul class="list-group">
                            @forelse($forms as $form)
                                <li class="list-group-item">
                                    <a href="{{ route('forms.show', $form->slug) }}">{{ $form->name }}</a>
                                </li>
                            @empty
                                <li class="list-group-item">No forms available.</li>
                            @endforelse
                        </ul>
                    @else
                        <p>No Menu</p>
                    @endif

                </div>
            </div>
        </div>
        <div class="col-md-9">
            @yield('content')
        </div>
    </div>
</div>
<div id="success-toast" style="display: none;"></div>
<div id="error-toast" style="display: none;"></div>
<script>
    function showSuccessToast(message) {
        toastr.success(message);
    }

    function showErrorToast(message) {
        toastr.error(message);
    }

    @if(session('success'))
    showSuccessToast('{{ session('success') }}');
    @endif

    @if(session('error'))
    showErrorToast('{{ session('error') }}');
    @endif
</script>
</body>
</html>
