<!doctype html>
<html lang="en-US" itemscope itemtype="http://schema.org/LocalBusiness">

<head>

    <script type="text/javascript">
        window.Userback = window.Userback || {};
        Userback.access_token = '31120|46565|05nPNSF9dWbUzJAX30JDIq26e';
        (function(d) {
            var s = d.createElement('script');s.async = true;
            s.src = 'https://static.userback.io/widget/v1.js';
            (d.head || d.body).appendChild(s);
        })(document);
    </script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta itemprop="name" content="">
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <link rel="icon" type="image/png" href="{{url('assets/favicon.png')}}" />
    <title>TYHO</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <!-- Fontawesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <!-- Int Tel CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.min.css" integrity="sha512-yye/u0ehQsrVrfSd6biT17t39Rg9kNc+vENcCXZuMz2a+LWFGvXUnYuWUW6pbfYj1jcBb/C39UZw2ciQvwDDvg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Select2 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- jquery validation -->
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/jquery.passwordRequirements.css')}}" />
    <!-- Toaster -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!-- Owl-carousel, datepicker -->
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/owl.carousel.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/datepicker.css')}}" />
    <!-- slick, spinner, calender, theme -->
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/slick-theme.css')}}" />
    <link rel="stylesheet" href="{{url('assets/plugin/cal/css/calendar.css')}}">
    <link rel="stylesheet" href="{{url('assets/plugin/cal/css/theme.css')}}">
    <link rel="stylesheet" href="{{url('assets/plugin/cal/css/spinner.css')}}">
    <!-- Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/main.css')}}" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.css" /> -->
<!--         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.css" /> -->

</head>

<body>
<!-- Header Code Start -->

<header class="siteHeader siteHeaderFull">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="#" title="PriceLabs">
                <img src="{{url('assets/img/logo.svg')}}" alt="Tyho" title="Tyho" />
            </a>
            <div class="collapse navbar-collapse menu" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('allCoaches')}}">Therapists</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Coaches</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">EAP</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">FAQs</a>
                    </li>
                </ul>
            </div>
            <div class="btns_header">
                @if(session('loggedTherapist'))
                    <a class="btn btn-primary" id="logoutTherapistButton">LOGOUT</a>
                @endif
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </nav>
        <div class="row headerBanner align-items-center">
            <div class="col-6">
                <h1>Our Therapists</h1>
            </div>
            <div class="col-6 text-end">
                <img src="{{url('assets/img/processing_img.svg')}}" alt="image" title=""/>
            </div>
        </div>
        <nav class="text-center breadcrumb-align" style="--bs-breadcrumb-divider: '-';" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#"><i class="fas fa-house-user"></i>Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Library</li>
            </ol>
        </nav>
    </div>
</header>
<!-- Header Code End -->