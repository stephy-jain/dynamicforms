<!DOCTYPE html>
<html>
<head>
    <title>Create Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <style type="text/css">
        .box {
            width: 600px;
            margin: 0 auto;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Menu</div>
                <div class="card-body">
                    <ul class="list-group" style="display: inline-flex; list-style-type: none; padding: 0;">
                        <li style="margin-right: 10px;">
                            <a href="{{ route('forms.index') }}" style="text-decoration: none; color: #333;">Forms</a>
                        </li>
                        <li style="margin-right: 10px;">
                            <a href="{{ route('admin.logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                               style="text-decoration: none; color: #333;">
                                <span>Log Out</span>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </a>
                        </li>
                    </ul>


                </div>
            </div>
        </div>
        <div class="col-md-9">
            @yield('content')
        </div>
    </div>
</div>

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

