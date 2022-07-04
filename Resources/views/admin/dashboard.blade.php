@include('adm_theme::admin.dashboard.' . config('xra.adm_home', '02'))
{{-- @extends('adm_theme::layouts.app')
@section('page_heading', ' ')
@section('content')
    @include('theme::includes.flash')
    ///{{ Route::currentRouteName() }} //admin.containers.index
    @if (!empty(Auth::user()->areasUsed))
        @foreach (Auth::user()->areasUsed as $area)
            <x-dashboard.widget :area=$area />
        @endforeach
    @endif

@endsection --}}
