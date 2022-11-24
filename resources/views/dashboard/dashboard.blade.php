@extends('layouts.layout')
@section('title')
    dashbord
@endsection
@section('content')
<h1 class="text-center mt-5" >@lang('site.welcome'), {{Auth::user()->name}}</h1>
@endsection
