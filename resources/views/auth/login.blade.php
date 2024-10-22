<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
     <!-- CSS Files -->
     <link rel="stylesheet" href="{{URL::asset('template/assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('template/assets/css/plugins.min.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('template/assets/css/kaiadmin.min.css')}}" />

</head>
<body>
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="card p-5">
        <div class="card-title text-center"><img src="{{URL::asset('template/3.png')}}" class="rounded-3" alt="" style="width: 100px; height:100px;"></div>
        <div class="card-title text-center">{{ config('app.name', 'Laravel') }}</div>
        <div class="card-body">
            <form method="POST" action="{{route('postLogin')}}" class="row g-3 needs-validation" novalidate>
                @csrf
                <div class="col-md-12">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="login" value="{{ old('login') }}" required>
                </div>
                <div class="col-md-12">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="col-12">
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                    <label class="form-check-label" for="invalidCheck">
                        Agree to terms and conditions
                    </label>
                    <div class="invalid-feedback">
                        You must agree before submitting.
                    </div>
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Login</button>
                </div>
            </form>
        </div>
        </div>
    </div>
<script>
    (function () {
    'use strict'

    var forms = document.querySelectorAll('.needs-validation')

    Array.prototype.slice.call(forms)
        .forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
        })
    })()
</script>

</body>
</html>
