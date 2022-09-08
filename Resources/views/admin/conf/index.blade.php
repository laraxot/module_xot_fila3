@extends('adm_theme::layouts.app')
@section('page_heading','package Settings')
@section('content')
@include('theme::includes.flash')


@php
	//$rows = \Config::all();

<<<<<<< HEAD
@endphp
=======
@endphp 
>>>>>>> 9472ad4 (first)
<ul class="nav nav-pills mb-3 nav-justified" id="pills-tab" role="tablist">
	@foreach($rows as $k=>$v)
	<li class="nav-item">
			<a class="nav-link btn " href="{{ url($v->url) }}">{{ $v->title }}</a>
	</li>
<<<<<<< HEAD
	@endforeach
=======
	@endforeach 
>>>>>>> 9472ad4 (first)
</ul>

@endsection
