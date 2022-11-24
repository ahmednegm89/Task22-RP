<!DOCTYPE html>
<html lang="en" dir =  {{ Session('lang') == 'ar' ? "RTL" : '' ;  }}>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@lang('site.welcome') </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{route('user.index')}}">MultiAuth</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
            <li class="nav-item dropdown" style="
            list-style: none; margin-right:45px;">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                 @if (Auth::user())
                 {{Auth::user()->name}} 
                 @endif
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{route('user.show')}}">@lang('site.myprofile')</a></li>
                  <li>
                    <form action="{{route('auth.logout')}}" method="post">
                        @csrf
                        <input class="dropdown-item" type="submit" value="@lang('site.logout') ">
                    </form>
                  </li>
                </ul>
              </li>
        </div>
        <li class="nav-item dropdown" style="list-style: none; py-5" >
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              @lang('site.lang')
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{route('lang.en')}}">en</a></li>
              <li><a class="dropdown-item" href="{{route('lang.ar')}}">ar</a></li>
            </ul>
          </li>
      </nav>
    <div class="mt-5 container">
    <div>
        <img src="{{asset("uploads/users/".Auth::user()->img)}}" alt="profile img"  
        style="width: 215px;height:245px; border-radius:50%" >
    </div>
    <h2>@lang('site.name') : {{Auth::user()->name}}</h2>
    <p>@lang('site.phone') : {{Auth::user()->phone}}</p>
    <p>@lang('site.email') : {{Auth::user()->email}}</p>
    <a type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
        @lang('site.Editmyprofile') 
    </a>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content px-5 py-5">
                 <form method="POST" class="mt-5" action="{{route('user.update',Auth::user()->id)}}" enctype="multipart/form-data" >
                    @csrf
                    <div class="mb-3">
                        <label  class="form-label">@lang('site.name')</label>
                        <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}">
                    </div>
                    @if ($errors->any())
                        @foreach ($errors->get('name') as $error)
                            <p style="color: red">
                                <strong>{{$error}}</strong> 
                            </p>
                            @endforeach
                    @endif
                    <div class="mb-3">
                    <label  class="form-label">@lang('site.email')</label>
                    <input type="email" name="email" class="form-control" value="{{Auth::user()->email}}">
                    </div>
                    @if ($errors->any())
                    @foreach ($errors->get('email') as $error)
                            <p style="color: red">
                                <strong>{{$error}}</strong> 
                            </p>
                        @endforeach
                    @endif
                    <div class="mb-3">
                    <label  class="form-label">@lang('site.phone')</label>
                    <input type="text" name="phone" value="{{Auth::user()->phone}}" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/[^.]/, '0');">
                    </div>
                        @if ($errors->any())
                        @foreach ($errors->get('phone') as $error)
                            <p style="color: red">
                                <strong>{{$error}}</strong> 
                            </p>
                        @endforeach
                        @endif
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">@lang('site.password')</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="leave it blank if you don't want to change">
                            </div>
                        @if ($errors->any())
                        @foreach ($errors->get('password') as $error)
                            <p style="color: red">
                                <strong>{{$error}}</strong> 
                            </p>
                        @endforeach
                        @endif
                        <div class="mb-3">
                            <label for="formFile" class="form-label">@lang('site.photowarning')</label>
                            <input class="form-control" name="img" type="file" id="formFile">
                        </div>
                        @if ($errors->any())
                        @foreach ($errors->get('img') as $error)
                        <p style="color: red">
                            <strong>{{$error}}</strong> 
                        </p>
                        @endforeach
                        @endif
                        <button type="submit" class="btn btn-primary">@lang('site.update')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
        
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  </body>
</html>