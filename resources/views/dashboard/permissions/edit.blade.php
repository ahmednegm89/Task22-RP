@extends('layouts.layout')
@section('title')
edit permission {{ $permission->name}}
@endsection
@section('content')
<form method="POST" class="mt-5" action="{{route('permissions.update',$permission)}}">
    @csrf
    @method('PUT')
    <div class="mb-3">
    <label  class="form-label">permission name</label>
    <input type="text" name="name" class="form-control" value="{{$permission->name}}">
    </div>
    @if ($errors->any())
        @foreach ($errors->get('name') as $error)
            <p style="color: red">
                <strong>{{$error}}</strong> 
            </p>
        @endforeach
    @endif
    <button type="submit" class="btn btn-primary">update</button>
</form>
@endsection