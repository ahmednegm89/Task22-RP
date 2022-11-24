<!DOCTYPE html>
<html lang="en" dir =  {{ Session('lang') == 'ar' ? "RTL" : '' ;  }}>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
  <body>
    <div class="w-50 mx-auto mt-5">
      <!-- Register -->
      <div class="card">
        <li class="nav-item dropdown mx-auto" style="list-style: none">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            @lang('site.lang')
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route('lang.en')}}">en</a></li>
            <li><a class="dropdown-item" href="{{route('lang.ar')}}">ar</a></li>
          </ul>
        </li>
          <div class="card-body">
            <h4 class="mb-2">@lang('site.welcome') 👋</h4>
            <p class="mb-4">@lang('site.pleasesignin')</p>
            <form class="mb-3" action="{{route('auth.hlogin')}}" method="post">
              @csrf
              <div class="mb-3">
                <label for="credential" class="form-label">@lang('site.cred')</label>
                <input id="credential" type="text"  placeholder="Email or Phone" class="form-control " name="credential" value="{{ old('credential') }}" required autofocus>
              </div>
              @if ($errors->any())
                @foreach ($errors->get('credential') as $error)
                    <p style="color: red">
                        <strong>{{$error}}</strong> 
                    </p>
                @endforeach
              @endif
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">@lang('site.password')</label>
                </div>
                <div class="input-group input-group-merge">
                    <input id="password" placeholder="Password" type="password" class="form-control" name="password" required autocomplete="current-password">
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
            </div>
            @if ($errors->any())
                @foreach ($errors->get('password') as $error)
                    <p style="color: red">
                        <strong>{{$error}}</strong> 
                    </p>
                @endforeach
            @endif
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">@lang('site.login')</button>
              </div>
            </form>
          </div>
        </div>
  </div>  
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>