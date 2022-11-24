@extends('layouts.layout')
@section('title')
    {{Auth::user()->name}}
@endsection
@section('content')
<div class="mt-5">
    <div>
        <img src="{{asset("uploads/users/".Auth::user()->img)}}" alt="profile img"  
        style="width: 215px;height:245px; border-radius:50%" >
    </div>
    <h2>@lang('site.name') : {{Auth::user()->name}}</h2>
    <p>@lang('site.phone'): {{Auth::user()->phone}}</p>
    <p>@lang('site.email'): {{Auth::user()->email}}</p>
    <a type="button" class="btn btn-warning" href="{{route('users.edit',$user)}}">
        @lang('site.Editmyprofile')
    </a>
</div>
@endsection
