@extends('adm_theme::layouts.app')
@section('page_heading', ' ')
@section('content')
    @include('formx::includes.flash')

    @foreach (Auth::user()->areas as $area)
        <x-dashboard.widget :area=$area />
    @endforeach


@endsection
