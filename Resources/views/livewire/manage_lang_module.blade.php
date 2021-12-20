<div>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Size</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach($files as $file)
        <tr>
            <td>{{ $file->getFilenameWithoutExtension() }}</td>
            <td>{{ $file->getSize() }}</td>
            <td><button wire:click="edit('{{ $file->getFilenameWithoutExtension() }}')" class="btn btn-primary">Modifica</button></td>
        </tr>
        @endforeach
        <tbody>
    </table>

    <livewire:theme::modal.form_array data="ciao" bodyView="xot::livewire.manage_lang_module.edit" />
</div>