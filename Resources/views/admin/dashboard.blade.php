<<<<<<< HEAD
@include('adm_theme::admin.dashboard.' . config('xra.adm_home', '01'))
=======
@extends('adm_theme::layouts.app')
@section('page_heading', ' ')
@section('content')
    @include('theme::includes.flash')

    @if (!empty(Auth::user()->areasUsed))
        @foreach (Auth::user()->areasUsed as $area)
            <x-dashboard.widget :area=$area />
        @endforeach
    @endif

@endsection
>>>>>>> 9472ad4 (first)
