<!DOCTYPE html>
<html lang="en" dir =  {{ Session('lang') == 'ar' ? "RTL" : '' ;  }}>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    @yield('style')
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="/admin/dashboard">MultiAuth</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" href="{{route('users.index')}}">@lang('site.users')</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="{{route('roles.index')}}">@lang('site.roles')</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="{{route('permissions.index')}}">@lang('site.permissions')</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                @lang('site.lang')
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('lang.en')}}">en</a></li>
                <li><a class="dropdown-item" href="{{route('lang.ar')}}">ar</a></li>
              </ul>
            </li>
          </ul>
        </div>
          <li class="nav-item dropdown" style="
          list-style: none; margin-right:45px;">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
               @if (Auth::user())
               {{Auth::user()->name}} 
               @endif
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('users.show',Auth::user()->id)}}">@lang('site.myprofile')</a></li>
                <li>
                  <form action="{{route('auth.logout')}}" method="post">
                      @csrf
                      <input class="dropdown-item" type="submit" value="@lang('site.logout')">
                  </form>
                </li>
              </ul>
            </li>
      </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    @yield('script')
  </body>
</html>