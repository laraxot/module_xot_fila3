<div>
    @component('theme::components.modal.simple', ['guid' => $modal_guid, 'title' => $modal_title])
        @slot('content')
            @if (session()->has('message'))
                <div class="alert alert-success" style="margin-top:30px;">x
                    {{ session('message') }}
                </div>
            @endif
            @foreach ($goals as $goal)
<<<<<<< HEAD
                @livewire('rate.single',['model'=>$model,'goal'=>$goal ])
=======
                @livewire('rating::rate.single',['model'=>$model,'goal'=>$goal ])
>>>>>>> 9472ad4 (first)
            @endforeach



        @endslot
        @slot('btns')
            <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Close</button>
        @endslot
    @endcomponent

    <button data-toggle="modal" data-target="#{{ $modal_guid }}" class="btn btn-primary mb-2">
        Vota <i class="fas fa-star"></i>
    </button>

</div>
