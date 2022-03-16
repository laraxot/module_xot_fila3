@extends('adm_theme::layouts.app')
@section('content')

<form action="{{ Request::fullUrl() }}" method="POST" enctype="multipart/form-data">
                @csrf
    <input type="text" name="search" class="form-control">
    <button class="btn btn-primary">search</button>
</form>

<table class="table table-bordered">
    @foreach($rows as $row)
        <tr>
            <td>{{ $row['name'] }}</td>
            <td>
                <table  class="table table-bordered">
                    @foreach($row['fields'] as $field)
                        <tr><td>{{ $field['name'] }}</td><td>{{ $field['type'] }}</td></tr>
                    @endforeach
                </table>
            </td>
        </tr>
    @endforeach
</table>

@endsection
