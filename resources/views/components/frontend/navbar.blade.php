 <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
     <div class="container px-4 px-lg-5">
         <a class="navbar-brand" href="index.html">JustBlogged</a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
             aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
             Menu
             <i class="fas fa-bars"></i>
         </button>
         <div class="collapse navbar-collapse" id="navbarResponsive">
             <ul class="navbar-nav ms-auto py-4 py-lg-0">
                 <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="index.html">Home</a></li>
                 <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="about.html">About</a></li>
                 <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="contact.html">Contact</a></li>
                 <div class="dropdown">
                     <button class="btn dropdown-toggle mt-1" type="button" style="color: white;" data-bs-toggle="dropdown" aria-expanded="false">
                       Categories
                     </button>
                     <ul class="dropdown-menu">
                         @foreach ($categories as $category)
                         {{-- <li><a class="dropdown-item" href="{{ route('frontend.category', ['slug' => $category->slug])}}">{{$category->name}}</a></li> --}}
                         <li><a class="dropdown-item" href="category/{{$category->slug}}">{{$category->name}}</a></li>
                         @endforeach
                     </ul>
                 </div>

                 @auth
                 <div class="dropdown">
                     <button class="btn dropdown-toggle" type="button" style="color: white;" data-bs-toggle="dropdown" aria-expanded="false">
                         <img src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/fox.jpg" width="35" height="35" class="rounded-circle">
                     </button>
                     <ul class="dropdown-menu">
                         <li class="mx-2"><img src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/fox.jpg" width="40" height="40" class="rounded-circle"> {{ ucfirst($user->name) }}<br/>
                          <li><hr class="dropdown-divider"></li>
                         <li><a class="dropdown-item" href="{{route('dashboard')}}">Dashboard</a></li>
                         <li><a class="dropdown-item" href="#">Profile</a></li>
                         <li>
                            <form action="{{route('logout')}}" method="POST">
                                @csrf
                                <button class="dropdown-item" type="submit">Logout</button>
                            </form>
                     </ul>
                 </div>
                 @else
                 <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4"
                         href="{{ route('login.index') }}">Login</a></li>
                 @endauth
             </ul>
         </div>
     </div>
 </nav>
