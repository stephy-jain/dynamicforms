<!DOCTYPE html>
<html>
<head>
    <title> Login</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <style type="text/css">
        .box {
            width: 600px;
            margin: 0 auto;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
<br/>
<div class="container box">
    <h3 align="center"> Login </h3><br/>


    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

{{--    @if (count($errors) > 0)--}}
{{--        <div class="alert alert-danger">--}}
{{--            <ul>--}}
{{--                @foreach($errors->all() as $error)--}}
{{--                    <li>{{ $error }}</li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    @endif--}}

    <form method="post" action="{{ route('admin.login.action') }}">
        @csrf
        <div class="col-12">
            <label for="yourUsername" class="form-label">Username</label>
            <div class="input-group has-validation">

                <input type="text" class="form-control @error('email') is-invalid @enderror"
                       placeholder="Email" name="email" value="{{ old('email') }}"
                       autocomplete="email" autofocus>

                @error('email')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
        </div>

        <div class="col-12">
            <label for="yourPassword" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="Password" name="password" autocomplete="current-password"
                   value="">
            @error('password')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="col-12">
            <input type="submit" value="Login" class="btn btn-primary w-100">
        </div>
    </form>
</div>
</body>
</html>
