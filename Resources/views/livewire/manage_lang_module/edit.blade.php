<div>
    <table class="table table-bordered">
    @foreach($form_data as $k=>$v)
    <tr>
        <td>{{ $k }}</td>
        <td> {{-- <input type="text" wire:model="form_data.{{ $k }}" /> 
            --}}
            @if(is_array($v))
                @include('xot::livewire.manage_lang_module.edit',['form_data'=>$v])
            @else
                <input type="text" wire:model="form_data.{{ $k }}" class="form-control" /> 
            @endif
        </td>
    </tr>
    @endforeach
    </table>


</div>