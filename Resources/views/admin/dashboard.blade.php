@extends('adm_theme::layouts.app')
@section('page_heading', ' ')
@section('content')
    @include('formx::includes.flash')

    @if (!empty(Auth::user()->areasUsed))
        @foreach (Auth::user()->areasUsed as $area)
            <x-dashboard.widget :area=$area />
        @endforeach
    @endif

@endsection
