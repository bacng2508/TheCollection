<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>THE COLLECTION</title>

    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Porto - Bootstrap eCommerce Template">
    <meta name="author" content="SW-THEMES">


    {{-- Start scrip head: Demo 4 --}}
    <!-- Favicon -->
    {{-- <link rel="icon" type="image/x-icon" href="{{asset("frontend")}}/assets/images/icons/favicon.png"> --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('company') }}/logo/company_white_icon.jpg">
    {{-- <link rel="icon" type="image/x-icon" href="{{ asset('company') }}/logo/company_black_icon.png"> --}}


    <script>
        WebFontConfig = {
            google: {
                families: ['Open+Sans:300,400,600,700,800', 'Poppins:300,400,500,600,700,800', 'Oswald:300,400,500,600,700,800']
            }
        };
        (function(d) {
            var wf = d.createElement('script'),
                s = d.scripts[0];
            wf.src = '{{asset("frontend")}}/assets/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{asset("frontend")}}/assets/css/bootstrap.min.css">

    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{asset("frontend")}}/assets/css/demo4.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset("frontend")}}/assets/vendor/fontawesome-free/css/all.min.css">
    {{-- End scrip head: Demo 4 --}}

    {{-- Cart --}}
	<link rel="stylesheet" href="{{asset("frontend")}}/assets/css/style.min.css">

    {{-- Custom Style --}}
	<link rel="stylesheet" href="{{asset("frontend")}}/css/style.css">
    
    {{-- Font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> --}}
    <script src="{{asset("frontend")}}/assets/js/sweetalert2.all.min.js"></script>


    {{-- Toastr --}}
	<link rel="stylesheet" href="{{asset("frontend")}}/assets/css/toastr.min.css">

    @vite(['resources/js/app.js'])

</head>