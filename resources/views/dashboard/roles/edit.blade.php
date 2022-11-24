@extends('layouts.layout')
@section('title')
edit role {{ $role->name}}
@endsection
@section('content')
<form method="POST" class="mt-5" action="{{route('roles.update',$role)}}">
    @csrf
    @method('PUT')
    <div class="mb-3">
    <label  class="form-label">role name</label>
    <input type="text" name="name" class="form-control" value="{{$role->name}}">
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
                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{$permission->name}}" {{in_array($permission->name,$role->permissions) ? 'checked' : ''}} id="Action">
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
    <button type="submit" class="btn btn-primary">update</button>
</form>
@endsection