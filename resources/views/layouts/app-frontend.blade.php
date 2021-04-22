@php
    if(session()->has('language')){
        $language = session()->get('language');
    }else{
        $language = 'id';
    }
@endphp
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required Meta Tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title> {{$preference[0]->web_name}}</title>
        <link rel="icon" type="image/png" href="{{asset('assets/frontend/images/favicon.png')}}" />

        <!--Core CSS -->
        <link rel="stylesheet" href="{{asset('assets/frontend/css/bulma.css')}}">
        <link rel="stylesheet" href="{{asset('assets/frontend/css/app.css')}}">
        <link rel="stylesheet" href="{{asset('assets/frontend/css/core.css')}}">
        <link rel="stylesheet" href="{{asset('assets/frontend/css/core_deep-blue.css')}}">
        @stack('css')

    </head>
    <body>
        <div class="pageloader"></div>
        <div class="infraloader is-active"></div>        
        <!-- Hero and nav -->
        @yield('div-nav')
            <nav class="navbar navbar-wrapper navbar-fade navbar-light is-transparent">
                <div class="container">
                    <!-- Brand -->
                    <div class="navbar-brand">
                        <a class="navbar-item" href="/">
                            <img class="light-logo" src="{{asset('assets/frontend/images/logos/white.png')}}" alt="">
                            <img class="dark-logo" src="{{asset('assets/frontend/images/logos/color.png')}}" alt="">
                        </a>
            
                        {{-- <!-- Sidebar Trigger -->
                        <a id="navigation-trigger" class="navbar-item hamburger-btn" href="javascript:void(0);">
                            <span class="menu-toggle">	
                                <span class="icon-box-toggle"> 	
                                    <span class="rotate">
                                        <i class="icon-line-top"></i>
                                        <i class="icon-line-center"></i>
                                        <i class="icon-line-bottom"></i> 
                                    </span>
                                </span>
                            </span>
                        </a> --}}
            
                        <!-- Responsive toggle -->
                        <div class="custom-burger" data-target="">
                            <a id="" class="responsive-btn" href="javascript:void(0);">
                                <span class="menu-toggle">	
                                    <span class="icon-box-toggle"> 	
                                        <span class="rotate">
                                            <i class="icon-line-top"></i>
                                            <i class="icon-line-center"></i>
                                            <i class="icon-line-bottom"></i> 
                                        </span>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <!-- /Responsive toggle -->
                    </div>
            
                    <!-- Navbar menu -->
                    <div class="navbar-menu">
                        <!-- Navbar Start -->
                        <div class="navbar-start">
                            <!-- Navbar item -->
                            @foreach ($menu as $item)
                                @php
                                    $menuname = \App\GlobalFunction::spaceChange(1,$item->name);
                                    if($item->id_page){
                                        $href = route('menu-fe',$menuname);
                                    }else{
                                        $href = $item->url;
                                    }
                                @endphp
                                @if ($item->submenu->count() != 0)
                                    <div class="navbar-item has-dropdown is-hoverable is-hidden-mobile">
                                        <a class="navbar-link" href="{{$href}}">
                                            {{$item->name}}
                                        </a>
                                        <div class="navbar-dropdown is-boxed is-medium">
                                            @foreach ($item->submenu as $submenu)
                                                @php
                                                    $submenuname = \App\GlobalFunction::spaceChange(1,$submenu->name);
                                                    if($submenu->id_page){
                                                        $hrefsubmenu = route('submenu-fe',[$menuname, $submenuname]);
                                                    }else{
                                                        $hrefsubmenu = $submenu->url;
                                                    }
                                                    
                                                @endphp
                                                <a class="navbar-item is-menu" href="{{$hrefsubmenu}}">
                                                    <span>{{$submenu->name}}</span>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <a class="navbar-item is-slide" href="{{$href}}">
                                        {{$item->name}}
                                    </a>
                                @endif
                            @endforeach
                        </div>
            
                        <!-- Navbar end -->
                        <div class="navbar-end">
                            <!-- Signup button -->
                            <div class="navbar-item">
                                <a id="#signup-btn" href="{{route('changeLanguage')}}" class="button button-signup btn-outlined is-bold btn-align light-btn rounded raised">
                                    {{$language}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Hero Wallop Slider -->
            @yield('jumbotron')
            <!-- /Hero Wallop Slider -->
        </div>
        <!-- /Hero and nav -->
        
        <!-- Clients -->
        {{-- <div class="hero-foot is-pulled">
            <div class="container">
                <div class="tabs partner-tabs is-centered">
                    <ul>
                        <li><a><img class="partner-logo" src="{{asset('assets/frontend/images/logos/custom/covenant.svg')}}" alt=""></a></li>
                        <li><a><img class="partner-logo" src="{{asset('assets/frontend/images/logos/custom//infinite.svg')}}" alt=""></a></li>
                        <li><a><img class="partner-logo" src="{{asset('assets/frontend/images/logos/custom/phasekit.svg')}}" alt=""></a></li>
                        <li><a><img class="partner-logo" src="{{asset('assets/frontend/images/logos/custom/grubspot.svg')}}" alt=""></a></li>
                        <li><a><img class="partner-logo" src="{{asset('assets/frontend/images/logos/custom/gutwork.svg')}}" alt=""></a></li>
                    </ul>
                </div>
            </div>
        </div> --}}
        <!-- /Clients -->
        
        <!-- Content -->
        @yield('content')
        <!-- Content -->

        
        <!-- Dark footer -->
        <footer id="dark-footer" class="footer footer-dark">
            <div class="container">
                <div class="columns">
                    {{-- <div class="column">
                        <div class="footer-column">
                            <div class="footer-header">
                                <h3>Product</h3>
                            </div>
                            <ul class="link-list">
                                <li><a href="#">Discover features</a></li>
                                <li><a href="#">CMS integration</a></li>
                                <li><a href="#">Customers</a></li>
                                <li><a href="#">Weekly sessions</a></li>
                                <li><a href="#">Free trials and demo</a></li>
                                <li><a href="#">What's next ?</a></li>
                            </ul>
                        </div>
                    </div> --}}
                    <div class="column">
                        <div class="footer-column">
                            <div class="footer-header">
                                <h3>Company</h3>
                            </div>
                            <ul class="link-list">
                                <li><a href="{{route('product-fe')}}">Product</a></li>
                                <li><a href="{{route('project-fe')}}">Project</a></li>
                                <li><a href="{{route('demo')}}">Demo Project</a></li>
                                <li><a href="{{route('news')}}">News</a></li>
                            </ul>
                        </div>
                    </div>
                    {{-- <div class="column">
                        <div class="footer-column">
                            <div class="footer-header">
                                <h3>Learning</h3>
                            </div>
                            <ul class="link-list">
                                <li><a href="#">Resources</a></li>
                                <li><a href="#">Blog</a></li>
                                <li><a href="#">FAQ</a></li>
                                <li><a href="#">API documentation</a></li>
                                <li><a href="#">Admin guide</a></li>
                            </ul>
                        </div>
                    </div> --}}
                    <div class="column">
                        <div class="footer-column">
                            <div class="footer-logo">
                                <img src="{{asset('assets/frontend/images/logos/white.png')}}" alt="">
                            </div>
                            <div class="footer-header">
                                <nav class="level is-mobile">
                                    <div class="level-left level-social">
                                       @foreach ($socialmedias as $socialmedia)
                                            <a href="{{$socialmedia->url}}" class="level-item">
                                                <span class="icon"><i class="fa fa-{{$socialmedia->name}}"></i></span>
                                            </a>
                                       @endforeach                                        
                                    </div>
                                </nav>
                            </div>
                            <div class="copyright">
                                @if (session()->get('language') == 'id')
                                    <span class="moto light-text">{!! $preference[0]->address_ina !!}</span>
                                @else
                                    <span class="moto light-text">{!! $preference[0]->address_eng !!}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- /Dark footer -->
        <!-- Side navigation -->
        <script src="{{asset('assets/frontend/js/app.js')}}"></script>
        
        <!-- Bulkit js -->
        @yield('js-atas')
        <script src="{{asset('assets/frontend/js/auth.js')}}"></script>
        <script src="{{asset('assets/frontend/js/contact.js')}}"></script>
        <script src="{{asset('assets/frontend/js/main.js')}}"></script>
        @yield('js-bawah') 
    </body>  
</html>
