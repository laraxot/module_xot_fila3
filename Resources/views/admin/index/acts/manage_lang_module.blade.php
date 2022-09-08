@extends('adm_theme::layouts.app')
@section('content')

<<<<<<< HEAD
{{--
=======
{{--  
>>>>>>> 9472ad4 (first)
<table class="table">
    @foreach($files as $file)
    <tr>
        <td>{{ $file->getFilenameWithoutExtension() }}</td>
        <td>{{ $file->getSize() }}</td>
        <td>     </td>
    </tr>
    @endforeach
</table>
--}}
<<<<<<< HEAD
@livewire('manage_lang_module',['module_name'=>'progressioni'])
=======
@livewire('xot::manage_lang_module',['module_name'=>'progressioni'])
>>>>>>> 9472ad4 (first)

@endsection