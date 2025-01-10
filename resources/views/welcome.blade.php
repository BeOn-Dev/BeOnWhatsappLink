<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Number Input Form</title>
    <style>
        .container {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;

        }

        .form-container {
            width: 50%;
            text-align: center;
        }
    </style>
    <!-- Add jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="{{asset('beon_logo.svg.svg')}}">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link active fs-3 text-primary mx-2" aria-current="page" href="#">BEON</a>--}}
{{--                </li>--}}
            </ul>
        </div>
    </div>
</nav>



<div class="container">
    <div class="form-container w-50 m-auto h-100vh">
        <!-- Blade Syntax for Link -->
        <a href="{{ $responseBody['data']['link'] }}" class="btn btn-success w-100" target="_blank">Login With WhatsApp</a>
    </div>
</div>


<script>
    $(document).ready(function () {
        // URLs
        const authStatusUrl = @json(route('check-auth-status',$reference));
        const dashboardUrl = @json(route('dashboard'));

        // Function to check authentication status
        function checkAuthentication() {
            console.log('Checking authentication status...');
            $.ajax({
                url: authStatusUrl,
                type: 'GET',
                success: function (response) {
                    if (response.authenticated) {
                        // Redirect to the dashboard if authenticated
                        window.location.href = dashboardUrl;
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error checking authentication status:', error);
                }
            });
        }

        setInterval(checkAuthentication, 4000);
    });
</script>
</body>
</html>
