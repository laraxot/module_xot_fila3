<?php

declare(strict_types=1);

namespace Modules\Xot\Jobs\PanelCrud\Traits;

use Carbon\Carbon;
<<<<<<< HEAD
// ----------- Requests ----------
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; // per dizionario morph
// ------------ services ----------
=======
//----------- Requests ----------
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; // per dizionario morph
//------------ services ----------
>>>>>>> 9472ad4 (first)
use Modules\Xot\Http\Requests\XotRequest;
use Modules\Xot\Services\PanelService;

/**
 * Trait CommonTrait.
 */
<<<<<<< HEAD
trait CommonTrait {
    /**
     * @return array
     */
    public function getData() {
        $panel = PanelService::make()->get($this->row);
        if (! \is_object($panel)) {
            // dddx($this->row);
        }
        $request = XotRequest::capture();
        if (\count($request->all()) > 0) {
            // dd(['['.__LINE__.']['.__FILE__.']', $request->all(), request()->all(), $_SESSION]);
=======
trait CommonTrait
{
    /**
     * @return array
     */
    public function getData()
    {
        $panel = PanelService::make()->get($this->row);
        if (! is_object($panel)) {
            //dddx($this->row);
        }
        $request = XotRequest::capture();
        if (count($request->all()) > 0) {
            //dd(['['.__LINE__.']['.__FILE__.']', $request->all(), request()->all(), $_SESSION]);
>>>>>>> 9472ad4 (first)
            $request->validatePanel($panel);
            $data = $request->all();
        } else {
            $data = request()->all();
        }

        return $data;
    }

    /**
     * https://hackernoon.com/eloquent-relationships-cheat-sheet-5155498c209
     * https://laracasts.com/discuss/channels/eloquent/cleanest-way-to-save-model-and-relationships.
<<<<<<< HEAD
     */
    public function manageRelationships(array $params): void {
=======
     *
     * @param array $params
     */
    public function manageRelationships(array $params): void
    {
>>>>>>> 9472ad4 (first)
        $act = 'show';
        extract($params);
        if (! isset($model)) {
            dddx(['err' => 'model is missing']);

            return;
        }
        if (! isset($data)) {
            dddx(['err' => 'data is missing']);

            return;
        }
<<<<<<< HEAD
        if (! \is_object($model)) {
            return;
            // dddx(['model' => $model]);
        }
        $methods = get_class_methods($model);
        // dddx($model->post_type);
        Relation::morphMap([$model->post_type => \get_class($model)]);
=======
        if (! is_object($model)) {
            return;
            //dddx(['model' => $model]);
        }
        $methods = get_class_methods($model);
        //dddx($model->post_type);
        Relation::morphMap([$model->post_type => get_class($model)]);
>>>>>>> 9472ad4 (first)
        /*
        if(!is_array($methods)){
            $methods=[];
        }
        */
<<<<<<< HEAD
        // dddx($params);
        $data1 = collect($data)->filter(
            function ($item, $key) use ($methods) {
                return \in_array($key, $methods, true);
            }
        )->map(
            function ($v, $k) use ($model, $data) {
                if (! \is_string($k)) {
=======
        //dddx($params);
        $data1 = collect($data)->filter(
            function ($item, $key) use ($methods) {
                return in_array($key, $methods);
            }
        )->map(
            function ($v, $k) use ($model, $data) {
                if (! is_string($k)) {
>>>>>>> 9472ad4 (first)
                    dddx([$k, $v, $data]);
                }
                $rows = $model->$k();
                $related = null;
                if (method_exists($rows, 'getRelated')) {
                    $related = $rows->getRelated();
                }

                return (object) [
<<<<<<< HEAD
                    'relationship_type' => class_basename($rows),
                    'is_relation' => $rows instanceof \Illuminate\Database\Eloquent\Relations\Relation,
                    'related' => $related,
                    'data' => $v,
                    'name' => $k,
                    'rows' => $rows,
=======
                'relationship_type' => class_basename($rows),
                'is_relation' => $rows instanceof \Illuminate\Database\Eloquent\Relations\Relation,
                'related' => $related,
                'data' => $v,
                'name' => $k,
                'rows' => $rows,
>>>>>>> 9472ad4 (first)
                ];
            }
        )->all();

        foreach ($data1 as $k => $v) {
<<<<<<< HEAD
            // Relation::morphMap();
            // if($v->related->post_type!=null){
                // dddx($v);
            // }
            $func = $act.'Relationships'.$v->relationship_type; // updateRelationshipsMorphOne
            // echo '<h3>'.$func.'</h3>';
            // $this->$func(['model'=>$model,'name'=>$v->name,'data'=>$v->data]);
=======
            //Relation::morphMap();
            //if($v->related->post_type!=null){
                //dddx($v);
            //}
            $func = $act.'Relationships'.$v->relationship_type; //updateRelationshipsMorphOne
            //echo '<h3>'.$func.'</h3>';
            //$this->$func(['model'=>$model,'name'=>$v->name,'data'=>$v->data]);
>>>>>>> 9472ad4 (first)
            $parz = array_merge($params, ['model' => $model, 'name' => $v->name, 'data' => $v->data]);
            /*
            if(!method_exists($this,$func)){
                dddx(
                    [
                        'func'=>$func,
                        'model'=>$model,
                        'model_class'=>get_class($model),
                        'name'=>$v->name,
                        'data'=>$v->data,
                        'v'=>$v,
                    ]
                );
            }
            */
<<<<<<< HEAD
            // if($v->is_relation){
=======
            //if($v->is_relation){
>>>>>>> 9472ad4 (first)
            if (method_exists($this, $func)) {
                self::$func($parz);
            }
        }

        if (isset($data['pivot'])) {
<<<<<<< HEAD
            $func = $act.'Relationships'.'Pivot'; // updateRelationshipsMorphOne
            // $this->$func(['model'=>$model,'name'=>'pivot','data'=>$data['pivot']]);
            // self::$func(['model'=>$model,'name'=>'pivot','data'=>$data['pivot']]);
=======
            $func = $act.'Relationships'.'Pivot'; //updateRelationshipsMorphOne
            //$this->$func(['model'=>$model,'name'=>'pivot','data'=>$data['pivot']]);
            //self::$func(['model'=>$model,'name'=>'pivot','data'=>$data['pivot']]);
>>>>>>> 9472ad4 (first)
            $params['name'] = 'pivot';
            $params['data'] = $data['pivot'];
            self::$func($params);
        }
    }

    /**
     * @param array         $data
     * @param PanelContract $panel
     *
     * @return mixed
     */
<<<<<<< HEAD
    public function prepareForValidation($data, $panel) {
=======
    public function prepareForValidation($data, $panel)
    {
>>>>>>> 9472ad4 (first)
        $date_fields = collect($panel->fields())->filter(
            function ($item) use ($data) {
                return Str::startsWith($item->type, 'Date') && isset($data[$item->name]);
            }
        )->all();
        foreach ($date_fields as $field) {
            $value = $data[$field->name]; // metterlo nel filtro sopra ?
            /*
            *  Se e' un oggetto e' già convertito
            **/
<<<<<<< HEAD
            if (! \is_object($value)) {
                $func = 'Conv'.$field->type;
                $value_new = $this->$func($field, $value);
                // $this->request->add([$field->name => $value_new]);
=======
            if (! is_object($value)) {
                $func = 'Conv'.$field->type;
                $value_new = $this->$func($field, $value);
                //$this->request->add([$field->name => $value_new]);
>>>>>>> 9472ad4 (first)
                $data[$field->name] = $value_new;
            }
        }

        return $data;
    }

    /**
     * @param array         $data
     * @param PanelContract $panel
     *
     * @throws \Illuminate\Validation\ValidationException
     *
     * @return array
     */
<<<<<<< HEAD
    public function prepareAndValidate($data, $panel) {
        // $data0 = $data;
        $data = $this->prepareForValidation($data, $panel);
        // dddx($data0, $data);
=======
    public function prepareAndValidate($data, $panel)
    {
        //$data0 = $data;
        $data = $this->prepareForValidation($data, $panel);
        //dddx($data0, $data);
>>>>>>> 9472ad4 (first)
        $act = '';
        $rules = $panel->rules(['act' => $act]);

        $validator = Validator::make($data, $rules);

<<<<<<< HEAD
        return $validator->validate(); // fa tutto da solo
=======
        return $validator->validate(); //fa tutto da solo
>>>>>>> 9472ad4 (first)
    }

    /**
     * @param $field
     * @param mixed $value
     *
     * @return Carbon|false|null
     */
<<<<<<< HEAD
    public function ConvDate($field, $value) {
        if (null === $value) {
=======
    public function ConvDate($field, $value)
    {
        if (null == $value) {
>>>>>>> 9472ad4 (first)
            return $value;
        }
        $value_new = Carbon::createFromFormat('d/m/Y', $value);

        return $value_new;
    }

    /**
     * @param $field
     * @param mixed $value
     *
     * @return Carbon|false|null
     */
<<<<<<< HEAD
    public function ConvDateTime($field, $value) {
        if (null === $value) {
=======
    public function ConvDateTime($field, $value)
    {
        if (null == $value) {
>>>>>>> 9472ad4 (first)
            return $value;
        }
        $value_new = Carbon::createFromFormat('d/m/Y H:i', $value);

        return $value_new;
    }

    /**
     * @param $field
     * @param mixed $value
     *
     * @return Carbon|false|null
     */
<<<<<<< HEAD
    public function ConvDateTime2Fields($field, $value) {
        if (null === $value) {
=======
    public function ConvDateTime2Fields($field, $value)
    {
        if (null == $value) {
>>>>>>> 9472ad4 (first)
            return $value;
        }
        $value_new = Carbon::createFromFormat('d/m/Y H:i', $value);

        return $value_new;
    }
}
