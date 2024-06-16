<!-- Header Section -->
<header>
    <div class="container">
         <div class="top_ber">
            <div class="row">
                <div class="col-md-6">
                    <div class="top_ber_left">
                        @php echo Date('jS F, Y h:i A') @endphp
                    </div><!--top_ber_left-->
                </div><!--col-md-6-->
                <div class="col-md-6">
                    <div class="top_ber_right">
                        <div class="top-menu">
                            <ul class="nav navbar-nav">    
                                @guest
                                    @if (Route::has('login'))<li><a href="{{ route('login') }}">Login</a></li>@endif
                                    @if (Route::has('register'))<li><a href="{{ route('register') }}">Register</a></li>@endif
                                @else
                                    <li><a href="{{ route('my-posts') }}">My Posts</a></li>
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }}
                                        </a>
        
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                &nbsp; {{ __('Logout') }}
                                            </a>
        
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                @endguest
                            </ul>

                        </div><!--top-menu-->
                    </div><!--top_ber_left-->
                </div><!--col-md-6-->
            </div><!--row-->
         </div><!--top_ber-->
         
         <div class="header-section">
            <div class="row">
                 <div class="col-md-3">
                    <div class="logo">
                    <a  href="/"><img class="img-responsive" src="/assets/img/logo.png" alt=""></a>
                    </div><!--logo-->
                 </div><!--col-md-3-->
                 
                 <div class="col-md-6">
                    
                 </div><!--col-md-6-->
                 
                 <div class="col-md-3">
                    <div class="social_icon1">
                            <a class="icons-sm fb-ic"><i class="fa fa-facebook"></i></a>
                            <!--Twitter-->
                            <a class="icons-sm tw-ic"><i class="fa fa-twitter"></i></a>
                            <!--Google +-->
                            <a class="icons-sm gplus-ic"><i class="fa fa-google-plus"> </i></a>
                            <!--Linkedin-->
                            <a class="icons-sm li-ic"><i class="fa fa-linkedin"> </i></a> 
                            <!--Pinterest-->
                            <a class="icons-sm pin-ic"><i class="fa fa-pinterest"> </i></a>
                    </div> <!--social_icon1-->
                 </div><!--col-md-3-->
            </div> <!--row-->	
         </div><!--header-section-->    	      
    </div><!-- /.container -->   

    <nav class="navbar main-menu navbar-inverse navbar-static-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed pull-left" data-toggle="offcanvas">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            </div>
            <div id="navbar" class="collapse navbar-collapse sidebar-offcanvas">
            <ul class="nav navbar-nav">
                <li class="hidden"><a href="#page-top"></a></li>
                @php
                    $categories = \App\Models\Category::take(9)->get();
                    foreach ($categories as $category)
                        echo '<li><a class="page-scroll" href="/category/'.$category->id.'">' . $category->name . '</a></li>';
                @endphp
            </ul>
            <div class="pull-right">
                <form class="navbar-form" action="{{route('search')}}" method="GET" role="search">
                    <div class="input-group">
                        <input class="form-control" value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}" name="search" placeholder="Search" name="q" type="text">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </nav> 
    <!-- .navbar -->
</header>