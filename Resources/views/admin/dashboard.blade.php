@extends('adm_theme::layouts.app')
@section('page_heading', ' ')
@section('content')
    @include('formx::includes.flash')

    @php
    //se in areas ho ancora vecchie aree oppure aree che utilizzo in altre basi, c'è qualche problema
    //dddx([Auth::user()->areas->pluck('area_define_name'), Module::all(), Module::getByStatus(1)]);
    @endphp

    @foreach (Auth::user()->areas as $area)
        <x-dashboard.widget :area=$area />
    @endforeach


@endsection
