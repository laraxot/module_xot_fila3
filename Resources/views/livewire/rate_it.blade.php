<<<<<<< HEAD
<div>
    @component('theme::components.modal.simple',['guid'=>$modal_guid,'title'=>$modal_title])
    @slot('content')
        @livewire('blog::rate_single')



    @endslot
    @slot('btns')

    @endslot
    @endcomponent

    <button data-toggle="modal" data-target="#{{ $modal_guid }}"  class="btn btn-primary mb-2">
        Vota <i class="fas fa-star"></i>
    </button>

</div>

=======
<div>
    @component('theme::components.modal.simple',['guid'=>$modal_guid,'title'=>$modal_title])
    @slot('content')
        @livewire('blog::rate_single')



    @endslot
    @slot('btns')

    @endslot
    @endcomponent

    <button data-toggle="modal" data-target="#{{ $modal_guid }}"  class="btn btn-primary mb-2">
        Vota <i class="fas fa-star"></i>
    </button>

</div>

>>>>>>> 3c97c308c85924a62f31c89c71edfe23450749f0
