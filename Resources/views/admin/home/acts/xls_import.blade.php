@extends('adm_theme::layouts.app')
@section('content')
     <div class="card bg-light mt-3">
        <div class="card-header">
            Import Excel to Database 
        </div>
        <div class="card-body">
            <form action="{{ Request::fullUrl() }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success">Next !</button>
            </form>
            {{--  
            <table class="table table-bordered mt-3">
                <tr>
                    <th colspan="3">
                        List Of Users
                        <a class="btn btn-warning float-end" href="{{ route('users.export') }}">Export User Data</a>
                    </th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
                @endforeach
            </table>
            --}}
        </div>
    </div>
@endsection