@extends('layouts.layout')
@section('title')
edit {{ $user->name}}
@endsection
@section('content')
<form method="POST" class="mt-5" action="{{route('users.update',$user)}}" enctype="multipart/form-data" >
    @csrf
    @method('PUT')
    <input type="hidden" name="id" value="{{$user->id}}">
    <div class="mb-3">
    <label  class="form-label">@lang('site.name')</label>
    <input type="text" name="name" class="form-control" value="{{$user->name}}">
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
    <input type="email" name="email" class="form-control" value="{{$user->email}}">
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
    <input type="text" name="phone" value="{{$user->phone}}" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/[^.]/, '0');">
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
      <select class="form-select mb-3" name="role" aria-label="Default select example">
        @foreach ($roles as $role)
        <option value="{{$role->id}}">{{$role->name}}</option>
        @endforeach
      </select>
      @if ($errors->any())
      @foreach ($errors->get('role') as $error)
          <p style="color: red">
              <strong>{{$error}}</strong> 
          </p>
      @endforeach
      @endif
    <button type="submit" class="btn btn-primary">@lang('site.update')</button>
</form>
@endsection