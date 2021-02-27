<!doctype html>
<!--
	Software House by GetTemplates.co
	URL: https://gettemplates.co
-->
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- awesone fonts css-->
    <link href="{{asset('assets/frontend/css/font-awesome.css')}}" rel="stylesheet" type="text/css">
    <!-- owl carousel css-->
    <link rel="stylesheet" href="{{asset('assets/frontend/owl-carousel/assets/owl.carousel.min.css')}}" type="text/css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/frontend/css/bootstrap.min.css')}}">
    <!-- custom CSS -->
    <link rel="stylesheet" href="{{asset('assets/frontend/css/style.css')}}">
    <title>Software House - Free Responsive Agency Template using Bootstrap 4</title>
    <style>

    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light bg-transparent" id="gtco-main-nav">
    <div class="container"><a class="navbar-brand">Software House</a>
        <button class="navbar-toggler" data-target="#my-nav" onclick="myFunction(this)" data-toggle="collapse"><span
                class="bar1"></span> <span class="bar2"></span> <span class="bar3"></span></button>
        <div id="my-nav" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="{{route('home-fe')}}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('product-fe')}}">Product</a></li>
                <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#news">News</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<footer class="container-fluid" id="gtco-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-6" id="contact">
                <h4> Contact Us </h4>
                <input type="text" class="form-control" placeholder="Full Name">
                <input type="email" class="form-control" placeholder="Email Address">
                <textarea class="form-control" placeholder="Message"></textarea>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-6">
                        <h4>Company</h4>
                        <ul class="nav flex-column company-nav">
                            <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">News</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">FAQ's</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                        </ul>
                        <h4 class="mt-5">Fllow Us</h4>
                        <ul class="nav follow-us-nav">
                            <li class="nav-item"><a class="nav-link pl-0" href="#"><i class="fa fa-facebook"
                                                                                      aria-hidden="true"></i></a></li>
                            <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-twitter"
                                                                                 aria-hidden="true"></i></a></li>
                            <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-google"
                                                                                 aria-hidden="true"></i></a></li>
                            <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-linkedin"
                                                                                 aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <h4>Services</h4>
                        <ul class="nav flex-column services-nav">
                            <li class="nav-item"><a class="nav-link" href="#">Web Design</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Graphics Design</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">App Design</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">SEO</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Marketing</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Analytic</a></li>
                        </ul>
                    </div>
                    <div class="col-12">
                        <p style="color: white">&copy; 2019. All Rights Reserved. Design by <a href="https://gettemplates.co" target="_blank">GetTemplates</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{asset('assets/frontend/js/jquery-3.3.1.slim.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/popper.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/bootstrap.min.js')}}"></script>
<!-- owl carousel js-->
<script src="{{asset('assets/frontend/owl-carousel/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/main.js')}}"></script>
</body>
</html>
