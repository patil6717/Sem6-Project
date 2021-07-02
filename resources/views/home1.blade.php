@extends('layouts.userlayout')
@section('content')
<nav class="navbar navbar-light navbar-expand-md sticky-top navigation-clean-button" style="height: 80px;background-color: #0d7994;color: #fffff0;">
    <div class="container-fluid"><a class="navbar-brand" href="/"><img src="https://img.icons8.com/plasticine/32/ffffff/bus--v2.png"/></i>&nbsp;Om Sai Travels</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="navbar-nav ml-auto" style="background-color: #0d7994;">
                <li class="nav-item"><a class="nav-link active" style="color:#18e0e0;" href="#">Trip</a></li>
                <li class="nav-item"><a class="nav-link" style="color:#fffff0;" href="{{route('tour')}}">Tour</a></li>
                <li class="nav-item"><a class="nav-link" style="color:#fffff0;" href="{{route('getbushire')}}">Bus HIre</a></li>
            </ul>
        </div>
    </div>
  </nav>

<body id="page-top">
  
    <header class="masthead" style="background-image:url('{{asset('/img/bus2.jpg')}}');">
        <div class="container">
                <div class="collapse navbar-collapse"></div>
                <section class="contact-clean">
                    <header class="header-dark">
                        <div class="container hero">
                            <div class="row">
                                <div class="col-md-8 offset-md-2">
                                    <h1 class="text-center" style="color: #8B4513">Welcome To Om Sai Travels</h1>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <a href="/viewtripbooking">
                                    <i class="tim-icons icon-zoom-split"></i>
                                    <p><h6>Your Bookings</h6></p>
                                </a>
                        </div>

                        </div>
                    </header>
              
                    <form method="get" action="{{route('searchbus')}}">
                    @csrf
                    @if(Session::has('errmsg'))
                    <div class="alert alert-danger">
                    {{Session::get('fail')}}
                        </div>
                        @endif
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                        <h2 class="text-center">Search Bus</h2>
                        <div class="form-group"><input list="stations"class="form-control text-center" name="start" type="text" placeholder="From"></div>
 			<datalist id="stations">
                        @foreach($stations as $station1)
                       <option value="{{$station1->sname}}">
                        @endforeach
                       </datalist>                        
			<div class="form-group"><input list="stations" class="form-control text-center" name="end" type="text" placeholder="To"></div>
                        <datalist id="stations">
                        @foreach($stations as $station1)
                       <option value="{{$station1}}">
                        @endforeach
                       </datalist>
			<div class="form-group"><input class="form-control text-center" name="date" placeholder="DD-MM-YYYY" type="date"></div>
                        <div class="form-group"><button class="btn btn-primary" type="submit">Search</button></div>
                    </form>
                </section><button class="navbar-toggler" data-toggle="collapse"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="intro-lead-in"></div>
                <div class="intro-heading text-uppercase"></div>
           
        </div>
    </header>
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="text-uppercase section-heading">Services</h2>
                    <h3 class="text-muted section-subheading">Best Tour And Travel Operator Since 2002</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4"><span class="fa-stack fa-4x"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-shopping-cart fa fa-bus fa-stack-1x fa-inverse"></i></span>
                    <h4 class="section-heading">Bus Service</h4>
                    <p class="text-muted">The Bus are Well Designed And Comfortable, You Will Get Very Smooth Experience With our Bus</p>
                </div>
                <div class="col-md-4"><span class="fa-stack fa-4x"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-laptop fa-stack-1x fa-inverse"></i></span>
                    <h4 class="section-heading">Ticket Booking Support</h4>
                    <p class="text-muted">We aim to be there for 24/7 for helping to booking process of our travels you can check whether tickets are booked for your prefered seat whether booked seat is of male or female</p>
                </div>
                <div class="col-md-4"><span class="fa-stack fa-4x"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-lock fa-stack-1x fa-inverse"></i></span>
                    <h4 class="section-heading">Safety Precautions</h4>
                    <p class="text-muted">Due to Covid-19 All bus Are sanitized, Washed&nbsp; and well Cleaned for every trip they have, We are Concern For Your Health As well as Our Staff, We can Assure that our travel is best in safety precaution&nbsp;</p>
                </div>
                <div class="col-md-4"><span class="fa-stack fa-4x"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-handshake-o fa-stack-1x fa-inverse"></i></span>
                    <h4 class="section-heading">Customer Support</h4>
                    <p class="text-muted">Our customer support will ensure to service all your queries.</p>
                </div>
            </div>
        </div>
    </section>
    {{-- <section class="bg-light" id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="text-uppercase section-heading">Portfolio</h2>
                    <h3 class="text-muted section-subheading">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-4 portfolio-item"><a class="portfolio-link" data-toggle="modal" href="#portfolioModal1">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fa fa-plus fa-3x"></i></div>
                        </div><img class="img-fluid" src="{{asset('img/portfolio/1-thumbnail.jpg')}}">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Threads</h4>
                        <p class="text-muted">Illustration</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 portfolio-item"><a class="portfolio-link" data-toggle="modal" href="#portfolioModal2">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fa fa-plus fa-3x"></i></div>
                        </div><img class="img-fluid" src="{{asset('img/portfolio/2-thumbnail.jpg')}}">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Explore</h4>
                        <p class="text-muted">Graphic Design</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 portfolio-item"><a class="portfolio-link" data-toggle="modal" href="#portfolioModal3">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fa fa-plus fa-3x"></i></div>
                        </div><img class="img-fluid" src="{{asset('img/portfolio/3-thumbnail.jpg')}}">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Finish</h4>
                        <p class="text-muted">Identity</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 portfolio-item"><a class="portfolio-link" data-toggle="modal" href="#portfolioModal4">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fa fa-plus fa-3x"></i></div>
                        </div><img class="img-fluid" src="{{asset('img/portfolio/4-thumbnail.jpg')}}">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Lines</h4>
                        <p class="text-muted">Branding</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 portfolio-item"><a class="portfolio-link" data-toggle="modal" href="#portfolioModal5">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fa fa-plus fa-3x"></i></div>
                        </div><img class="img-fluid" src="{{asset('img/portfolio/5-thumbnail.jpg')}}">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Southwest</h4>
                        <p class="text-muted">Website Design</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 portfolio-item"><a class="portfolio-link" data-toggle="modal" href="#portfolioModal6">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fa fa-plus fa-3x"></i></div>
                        </div><img class="img-fluid" src="{{asset('img/portfolio/6-thumbnail.jpg')}}">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Window</h4>
                        <p class="text-muted">Photography</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade text-center portfolio-modal" role="dialog" tabindex="-1" id="portfolioModal1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="modal-body">
                                <h2 class="text-uppercase">Project Name</h2>
                                <p class="text-muted item-intro">Lorem ipsum dolor sit amet consectetur.</p><img class="img-fluid d-block mx-auto" src="{{asset('img/portfolio/1-full.jpg')}}">
                                <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                <ul class="list-unstyled">
                                    <li>Date: January 2017</li>
                                    <li>Client: Threads</li>
                                    <li>Category: Illustration</li>
                                </ul><button class="btn btn-primary" data-dismiss="modal" type="button"><i class="fa fa-times"></i><span>&nbsp;Close Project</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-center portfolio-modal" role="dialog" tabindex="-1" id="portfolioModal2">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="modal-body">
                                <h2 class="text-uppercase">Project Name</h2>
                                <p class="text-muted item-intro">Lorem ipsum dolor sit amet consectetur.</p><img class="img-fluid d-block mx-auto" src="{{asset('img/portfolio/2-full.jpg')}}">
                                <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                <ul class="list-unstyled">
                                    <li>Date: January 2017</li>
                                    <li>Client: Threads</li>
                                    <li>Category: Illustration</li>
                                </ul><button class="btn btn-primary" data-dismiss="modal" type="button"><i class="fa fa-times"></i><span>&nbsp;Close Project</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-center portfolio-modal" role="dialog" tabindex="-1" id="portfolioModal3">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="modal-body">
                                <h2 class="text-uppercase">Project Name</h2>
                                <p class="text-muted item-intro">Lorem ipsum dolor sit amet consectetur.</p><img class="img-fluid d-block mx-auto" src="{{asset('img/portfolio/3-full.jpg')}}">
                                <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                <ul class="list-unstyled">
                                    <li>Date: January 2017</li>
                                    <li>Client: Threads</li>
                                    <li>Category: Illustration</li>
                                </ul><button class="btn btn-primary" data-dismiss="modal" type="button"><i class="fa fa-times"></i><span>&nbsp;Close Project</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-center portfolio-modal" role="dialog" tabindex="-1" id="portfolioModal4">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="modal-body">
                                <h2 class="text-uppercase">Project Name</h2>
                                <p class="text-muted item-intro">Lorem ipsum dolor sit amet consectetur.</p><img class="img-fluid d-block mx-auto" src="{{asset('img/portfolio/4-full.jpg')}}">
                                <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                <ul class="list-unstyled">
                                    <li>Date: January 2017</li>
                                    <li>Client: Threads</li>
                                    <li>Category: Illustration</li>
                                </ul><button class="btn btn-primary" data-dismiss="modal" type="button"><i class="fa fa-times"></i><span>&nbsp;Close Project</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-center portfolio-modal" role="dialog" tabindex="-1" id="portfolioModal5">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="modal-body">
                                <h2 class="text-uppercase">Project Name</h2>
                                <p class="text-muted item-intro">Lorem ipsum dolor sit amet consectetur.</p><img class="img-fluid d-block mx-auto" src="{{asset('img/portfolio/5-full.jpg')}}">
                                <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                <ul class="list-unstyled">
                                    <li>Date: January 2017</li>
                                    <li>Client: Threads</li>
                                    <li>Category: Illustration</li>
                                </ul><button class="btn btn-primary" data-dismiss="modal" type="button"><i class="fa fa-times"></i><span>&nbsp;Close Project</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-center portfolio-modal" role="dialog" tabindex="-1" id="portfolioModal6">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="modal-body">
                                <h2 class="text-uppercase">Project Name</h2>
                                <p class="text-muted item-intro">Lorem ipsum dolor sit amet consectetur.</p><img class="img-fluid d-block mx-auto" src="{{asset('img/portfolio/6-full.jpg')}}">
                                <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                <ul class="list-unstyled">
                                    <li>Date: January 2017</li>
                                    <li>Client: Threads</li>
                                    <li>Category: Illustration</li>
                                </ul><button class="btn btn-primary" data-dismiss="modal" type="button"><i class="fa fa-times"></i><span>&nbsp;Close Project</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
  
  @stop
  @section('script')
      <script>
           var today = new Date().toISOString().split('T')[0];
document.getElementsByName("date")[0].setAttribute('min', today);
      </script>
  @endsection