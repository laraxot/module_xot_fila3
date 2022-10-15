<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Spatie\QueueableAction\QueueableAction;

class DestroyAction {
    use QueueableAction;

    public function __construct() {
    }

    public function execute(Model $row, array $data, array $rules): Model {

        //prende la chiave del modello

        $id = $row->getKey();

        //nel mio caso nella pivot è la chiave 14 ma non nella tabella finale,
        //ma probabilmente è giusto perchè va disassociata se è many to many
        //ma forse il problema è che il modello è Keyword e non KeywordReport

        //$msg = 'cancellato! ['.$id.']!'; // .'['.implode(',',$row->getChanges()).']';

        //cancella il modello $row (ma allora l'id a che gli serve?)
       
        //nella belongs to many con delete lo dà cancellato ma non è vero

        $res = $row->delete();
        if ($res) {
            \Session::flash('status', 'eliminato');
        } else {
            \Session::flash('status', 'NON eliminato');
        }


        return $row;
    }
}
