<?php

namespace Modules\Xot\Models\Panels;

use Illuminate\Http\Request;
use Modules\Xot\Contracts\RowsContract;
//--- Services --

use Modules\Xot\Models\Panels\XotBasePanel;

class FailedJobPanel extends XotBasePanel {
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = 'Modules\Xot\Models\FailedJob';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static string $title = 'title';


    /**
     * Get the fields displayed by the resource.
     *
     * @return array
        'col_size' => 6,
        'sortable' => 1,
        'rules' => 'required',
        'rules_messages' => ['it'=>['required'=>'Nome Obbligatorio']],
        'value'=>'..',
     */
    public function fields(): array {
        return array (
  
  (object) array(
     'type' => 'Id',
     'name' => 'id',
     'comment' => NULL,
  ),
  
  (object) array(
     'type' => 'String',
     'name' => 'uuid',
     'rules' => 'required',
     'comment' => NULL,
  ),
  
  (object) array(
     'type' => 'Text',
     'name' => 'connection',
     'rules' => 'required',
     'comment' => NULL,
  ),
  
  (object) array(
     'type' => 'Text',
     'name' => 'queue',
     'rules' => 'required',
     'comment' => NULL,
  ),
  
  (object) array(
     'type' => 'Text',
     'name' => 'payload',
     'rules' => 'required',
     'comment' => NULL,
  ),
  
  (object) array(
     'type' => 'Text',
     'name' => 'exception',
     'rules' => 'required',
     'comment' => NULL,
  ),
  
  (object) array(
     'type' => 'Datetime',
     'name' => 'failed_at',
     'rules' => 'required',
     'comment' => NULL,
  ),
);
    }

    /**
     * Get the tabs available.
     *
     * @return array
     */
    public function tabs():array {
        $tabs_name = [];

        return $tabs_name;
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(Request $request):array {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function filters(Request $request = null):array {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @return array
     */
    public function lenses(Request $request):array {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array
     */
    public function actions():array {
        return [];
    }
}