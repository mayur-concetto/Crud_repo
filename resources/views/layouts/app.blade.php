<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">


    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @yield('title')
    
    <style>
    label.error {
         color: #dc3545;
         font-size: 14px;
    }
</style>
   
    @yield('css')
    
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    
    <link href="{{ asset('css/iziToast.css') }}" rel="stylesheet">

    @yield('style')
</head>

<body>
    @yield('content')
    @yield('models')
    
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    
    <script src="{{ asset('js/iziToast.js') }}"></script>

    <script>
        var baseUrl = "{{ url('/') }}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @yield('page-script')
</body>

</html>
