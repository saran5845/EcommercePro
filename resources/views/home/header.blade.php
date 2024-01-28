<header class="header_section">
            <div class="container">
               <nav class="navbar navbar-expand-lg custom_nav-container ">
                  <a class="navbar-brand" href="/"><img width="250" src="home/images/logo.png" alt="#" /></a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class=""> </span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav">
                        <li class="nav-item active">
                           <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="/">About</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="/#menu-about">Products</a>
                        </li>
                        
                        <li class="nav-item">
                           <a class="nav-link" href="/#testimonial-menu">Testimonial</a>
                        </li>
                         @if (Route::has('login'))
                         @auth
                         <li class="nav-item">
                           <a class="nav-link" href="/cart-page">Cart</a>
                        </li>
                         @endauth
                        @endif
                         @if (Route::has('login'))
                         @auth
                         <x-app-layout>
                         </x-app-layout>
                         @else
                        <li class="nav-item">
                           <a class="nav-link btn btn-info" href="{{ route('login') }}">Log in</a>
                        </li>
                        <li class="nav-item ml-3">
                           <a class="nav-link btn btn-info" href="{{ route('register') }}">Register</a>
                        </li>
                        @endauth
                        @endif
                       
                     </ul>
                  </div>
               </nav>
            </div>
         </header>