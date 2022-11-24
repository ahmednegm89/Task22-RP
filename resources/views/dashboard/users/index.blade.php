@extends('layouts.layout')
@section('title')
    Users
@endsection
@section('content')
<table class="table mt-5">
    <thead>
      <tr>
        <th scope="col">@lang('site.img')</th>
        <th scope="col">@lang('site.name')</th>
        <th scope="col">@lang('site.phone')</th>
        <th scope="col">@lang('site.email')</th>
        <th scope="col">@lang('site.role')</th>
        <th scope="col">@lang('site.actions')</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
    <tr>
          <td><img src="{{asset("uploads/users/".$user->img)}}" alt="profile img"  
            style="width: 21px;height:24px; border-radius:50%" ></td>
          <td>{{$user->name}}</td>
            <td>{{$user->phone}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->role->name}}</td>
            <td>
                <a type="button" class="btn btn-warning" href="{{route('users.edit',$user)}}">
                  @lang('site.edit')
                </a>
                <form style="display: inline" action="{{route('users.destroy',$user)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">@lang('site.delete')</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
  </table>
  {{-- add user button --}}
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addusermodal">
    @lang('site.adduser')
  </button>
    {{-- add user modal --}}
    <div class="modal fade" id="addusermodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">@lang('site.adduser')</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('users.store')}}" enctype="multipart/form-data" >
                    @csrf
                    <div class="mb-3">
                      <label  class="form-label">@lang('site.name')</label>
                      <input type="text" name="name" class="form-control">
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
                      <input type="email" name="email" class="form-control">
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
                      <input type="text" name="phone" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/[^.]/, '0');">
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
                      <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    @if ($errors->any())
                        @foreach ($errors->get('password') as $error)
                            <p style="color: red">
                                <strong>{{$error}}</strong> 
                            </p>
                        @endforeach
                    @endif
                    <div class="mb-3">
                      <label for="formFile" class="form-label">@lang('site.photo')</label>
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
                    <button type="submit" class="btn btn-primary">@lang('site.add')</button>
                  </form>
            </div>
          </div>
        </div>
      </div>
  </div>
@endsection