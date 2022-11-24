@extends('layouts.layout')
@section('title')
    roles
@endsection
@section('content')
<table class="table mt-5">
    <thead>
      <tr>
        <th scope="col">@lang('site.name')</th>
        <th scope="col">@lang('site.permissions')</th>
        <th scope="col">@lang('site.actions')</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($roles as $role)
    <tr>
          <td>{{$role->name}}</td>
          <td>
            @foreach ($role->permissions as $permission)
                {{$permission}},
            @endforeach
          </td>
            <td>
                <a type="button" class="btn btn-warning" href="{{route('roles.edit',$role)}}">
                  @lang('site.edit')
                </a>
                <form style="display: inline" action="{{route('roles.destroy',$role)}}" method="post">
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
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addrolemodal">
    @lang('site.addrole')
  </button>
    {{-- add user modal --}}
    <div class="modal fade" id="addrolemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">@lang('site.addrole')</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('roles.store')}}" >
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
                    @foreach ($permissions as $permission)
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{$permission->name}}" id="Action">
                        <label class="form-check-label" for="{{$permission->name}}">
                            {{$permission->name}}
                        </label>
                      </div>
                    @endforeach
                    @if ($errors->any())
                    @foreach ($errors->get('permissions') as $error)
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