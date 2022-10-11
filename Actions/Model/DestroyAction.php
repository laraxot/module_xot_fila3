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
        $id = $row->getKey();



        $msg = 'cancellato! ['.$id.']!'; // .'['.implode(',',$row->getChanges()).']';

        $res = $row->delete();
        if ($res) {
            \Session::flash('status', 'eliminato');
        } else {
            \Session::flash('status', 'NON eliminato');
        }

        return $row;
    }
}
