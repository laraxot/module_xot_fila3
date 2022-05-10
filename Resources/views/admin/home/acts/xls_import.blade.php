@extends('adm_theme::layouts.app')
@section('content')
<<<<<<< HEAD
    {{--  
     <div class="card bg-light mt-3">
        <div class="card-header">
            Import Excel to Database 
=======
    {{-- <div class="card bg-light mt-3">
        <div class="card-header">
            Import Excel to Database
>>>>>>> 04f6c8ba (first)
        </div>
        <div class="card-body">
            <form action="{{ Request::fullUrl() }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success">Next !</button>
            </form>
        </div>
<<<<<<< HEAD
    </div>
    --}}
    <livewire:theme::import.xls.model modelClass="\Modules\LU\Models\User" />
@endsection
=======
    </div> --}}
    <livewire:import.xls.model modelClass="\Modules\LU\Models\User" />
@endsection
>>>>>>> 04f6c8ba (first)
