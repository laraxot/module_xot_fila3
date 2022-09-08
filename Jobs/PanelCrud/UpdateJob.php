<?php

declare(strict_types=1);

namespace Modules\Xot\Jobs\PanelCrud;

<<<<<<< HEAD
// ----------- Requests ----------
// ------------ services ----------
=======
//----------- Requests ----------
//------------ services ----------
>>>>>>> 9472ad4 (first)
use ArgumentCountError;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Modules\Xot\Contracts\PanelContract;
use Modules\Xot\Services\ArrayService;
use Modules\Xot\Services\PanelService;

/**
 * Class UpdateJob.
 */
<<<<<<< HEAD
class UpdateJob extends XotBaseJob {
    /**
     * Execute the job.
     */
    public function handle(): PanelContract {
        $row = $this->panel->getRow();
        $old = $this->data;
        $this->data = $this->prepareAndValidate($this->data, $this->panel);
        // dddx(['old' => $old, 'prepared' => $this->data]);
        $data = $this->data;

        // https://medium.com/@taylorotwell/tap-tap-tap-1fc6fc1f93a6
=======
class UpdateJob extends XotBaseJob
{
    /**
     * Execute the job.
     */
    public function handle(): PanelContract
    {
        $row = $this->panel->getRow();
        $old = $this->data;
        $this->data = $this->prepareAndValidate($this->data, $this->panel);
        //dddx(['old' => $old, 'prepared' => $this->data]);
        $data = $this->data;

        //https://medium.com/@taylorotwell/tap-tap-tap-1fc6fc1f93a6
>>>>>>> 9472ad4 (first)
        //  30     Call to an undefined method Illuminate\Support\HigherOrderTapProxy<mixed>::update().
        $row = tap($row)->update($data);

        $this->manageRelationships($row, $data, 'update');
<<<<<<< HEAD
        $msg = 'aggiornato! ['.$row->getKey().']!'; // .'['.implode(',',$row->getChanges()).']';

        \Session::flash('status', $msg); // .
=======
        $msg = 'aggiornato! ['.$row->getKey().']!'; //.'['.implode(',',$row->getChanges()).']';

        \Session::flash('status', $msg); //.
>>>>>>> 9472ad4 (first)

        return $this->panel;
    }

    /**
     * @param array $data
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setData($data) {
=======
    public function setData($data)
    {
>>>>>>> 9472ad4 (first)
        $this->data = $data;

        return $this;
    }

    /**
     * --- hasOne ----.
     */
<<<<<<< HEAD
    public function updateRelationshipsHasOne(Model $model, string $name, array $data): void {
        $rows = $model->$name();

        if ($rows->exists()) {
            if (! \is_array($data)) {
                // variabile uguale alla relazione
            } else {
                // backtrace(true);
                // dddx([$model, $name, $data]);
=======
    public function updateRelationshipsHasOne(Model $model, string $name, array $data): void
    {
        $rows = $model->$name();

        if ($rows->exists()) {
            if (! is_array($data)) {
                //variabile uguale alla relazione
            } else {
                //backtrace(true);
                //dddx([$model, $name, $data]);
>>>>>>> 9472ad4 (first)
                $model->$name->update($data);
            }
        } else {
            dddx(['err' => 'wip']);
<<<<<<< HEAD
            // $this->storeRelationshipsHasOne($params);
=======
            //$this->storeRelationshipsHasOne($params);
>>>>>>> 9472ad4 (first)
        }
    }

    /**
     *  belongsTo.
     *
     * @param string|int|array $data
     */
<<<<<<< HEAD
    public function updateRelationshipsBelongsTo(Model $model, string $name, $data): void {
        $rows = $model->$name();
        if (! \is_array($data)) {
=======
    public function updateRelationshipsBelongsTo(Model $model, string $name, $data): void
    {
        $rows = $model->$name();
        if (! is_array($data)) {
>>>>>>> 9472ad4 (first)
            $related = $rows->getRelated();
            $related = $related->find($data);
            $res = $rows->associate($related);
            $res->save();

            return;
        }

        if ($rows->exists()) {
            $model->$name()->update($data);
        } else {
            dddx(['err' => 'wip']);
        }
    }

    /**
     * --- hasMany ---.
     */
<<<<<<< HEAD
    public function updateRelationshipsHasMany(Model $model, string $name, array $data): void {
        $rows = $model->$name();
        debug_getter_obj(['obj' => $rows]);
        // ---------- TO DO ------------//
    }

    // end updateRelationshipsHasMany
=======
    public function updateRelationshipsHasMany(Model $model, string $name, array $data): void
    {
        $rows = $model->$name();
        debug_getter_obj(['obj' => $rows]);
        //---------- TO DO ------------//
    }

    //end updateRelationshipsHasMany
>>>>>>> 9472ad4 (first)

    /**
     * --- belongsToMany.
     */
<<<<<<< HEAD
    public function updateRelationshipsBelongsToMany(Model $model, string $name, array $data): void {
        // $model->$name()->syncWithoutDetaching($data);

        if (\in_array('to', array_keys($data), true) || \in_array('from', array_keys($data), true)) {
=======
    public function updateRelationshipsBelongsToMany(Model $model, string $name, array $data): void
    {
        //$model->$name()->syncWithoutDetaching($data);

        if (in_array('to', array_keys($data)) || in_array('from', array_keys($data))) {
>>>>>>> 9472ad4 (first)
            /*
                $parent=$this->panel->getParent();
                if($parent!=null){
                    $parent_id=$parent->getRow()->getKey();
                    $parent_key=$parent->postType().'_'.$parent->getRow()->getKeyName();
                    $data1=[];
                    foreach($data['to'] as $v){
                        $data1[$v]=[$parent_key=>$parent_id];
                    }
                    $model->$name()->attach($data1);
                    return ;
                }
                $model->$name()->sync($data['to']);
                return ;
            */
            $this->saveMultiselectTwoSides($model, $name, $data);

            return;
        }
        $model->$name()->sync($data);
    }

<<<<<<< HEAD
    // end updateRelationshipsBelongsToMany

    /*    hasOneThrough */

    /*    morphTo */
=======
    //end updateRelationshipsBelongsToMany

    /*    hasOneThrough     */

    /*    morphTo           */
>>>>>>> 9472ad4 (first)

    /**
     * ManyThrough.
     */
<<<<<<< HEAD
    public function updateRelationshipsHasManyThrough(Model $model, string $name, array $data): void {
        $rows = $model->$name();
        $throughKey = $rows->getRelated()->getKeyName();

        // from è la tendina di sinistra, to quella di destra
        if (! empty($data['to'])) {

=======
    public function updateRelationshipsHasManyThrough(Model $model, string $name, array $data): void
    {
        $rows = $model->$name();
        $throughKey = $rows->getRelated()->getKeyName();

        //from è la tendina di sinistra, to quella di destra
        if (! empty($data['to'])) {
            //dddx(get_class_methods($rows));
            //exit(debug_methods($rows));
            /*
            dddx([
                'getQuery' => $rows->getQuery(),
                'getBaseQuery' => $rows->getBaseQuery(),
            ]);
            */
            /*
            getQualifiedParentKeyName               perm_users.id
            getQualifiedFarKeyName                  area_perm_user.perm_user_id
            getFirstKeyName                         user_id
            getQualifiedFirstKeyName                perm_users.user_id
            getForeignKeyName                       perm_user_id
            getQualifiedForeignKeyName              area_perm_user.perm_user_id
            getLocalKeyName                         id
            getQualifiedLocalKeyName                users.id
            getSecondLocalKeyName                   id
            getParent                               > Modules\LU\Models\PermUser {#2167
            getRelated                              > Modules\LU\Models\AreaPermUser {#2193
            $this->panel->row                       > Modules\LU\Models\User {#2080
            $rows->getRelated()->getKeyName         id
            */
>>>>>>> 9472ad4 (first)
            $row = $this->panel->row;
            $parent_relation_name = Str::camel(class_basename($rows->getParent()));
            $related_relation_name = Str::camel(class_basename($rows->getRelated()));
            $related_relation_name = Str::plural($related_relation_name);
<<<<<<< HEAD
            // dddx([$parent_relation_name, $related_relation_name]);
            $bridge = $row->{$parent_relation_name};
            $bridge_rows = $bridge->{$related_relation_name}();
            // dddx(get_class_methods($bridge_rows));
            // $bridge_rows->syncWithoutDetaching(666); //ate\Database\Eloquent\Relations\HasMany::syncWithoutDetaching
            throw new \Exception('WIP ['.__LINE__.']['.__FILE__.']');
        // $bridge_rows->save();
            // $rows->get();
=======
            //dddx([$parent_relation_name, $related_relation_name]);
            $bridge = $row->{$parent_relation_name};
            $bridge_rows = $bridge->{$related_relation_name}();
            //dddx(get_class_methods($bridge_rows));
            //$bridge_rows->syncWithoutDetaching(666); //ate\Database\Eloquent\Relations\HasMany::syncWithoutDetaching
            throw new \Exception('WIP ['.__LINE__.']['.__FILE__.']');
            //$bridge_rows->save();
            //$rows->get();
>>>>>>> 9472ad4 (first)
            /*
            $rows->update(
            [
                'sssperm_user.user_idaa' => $row->id,
                'areas.area_id' => '666',
            ]
            );
            */

            /*
            $parent_data = [
            $rows->getForeignKeyName() => $this->panel->row->{$rows->getFirstKeyName()},
            $rows->getFirstKeyName() => $this->panel->row->{$rows->getFirstKeyName()},
            ];
            $rows->getParent()->updateOrCreate($parent_data);
            $related_data = [
            $rows->getForeignKeyName() => $this->panel->row->{$rows->getFirstKeyName()},
            $throughKey => $data['to'][0],
            ];
            $rows->getRelated()->updateOrCreate($related_data);
            */
        } else {
<<<<<<< HEAD
            // dddx([$rows->getForeignKeyName() => $this->panel->row->{$rows->getFirstKeyName()}, $throughKey => '']);
            // se non c'è niente su to vuol dire che va cancellato il campo dal modello relativo

            // attenzione. in sto caso va bene così ma in realtà solo i from andrebbero cancellati
            // $rows->getRelated()->where([$rows->getForeignKeyName() => $this->panel->row->{$rows->getFirstKeyName()}])->delete();
        }

        // $rows->save();
=======
            //dddx([$rows->getForeignKeyName() => $this->panel->row->{$rows->getFirstKeyName()}, $throughKey => '']);
            //se non c'è niente su to vuol dire che va cancellato il campo dal modello relativo

            //attenzione. in sto caso va bene così ma in realtà solo i from andrebbero cancellati
            //$rows->getRelated()->where([$rows->getForeignKeyName() => $this->panel->row->{$rows->getFirstKeyName()}])->delete();
        }

        //$rows->save();
>>>>>>> 9472ad4 (first)
    }

    /**
     * morphOne.
     */
<<<<<<< HEAD
    public function updateRelationshipsMorphOne(Model $model, string $name, array $data): void {
=======
    public function updateRelationshipsMorphOne(Model $model, string $name, array $data): void
    {
>>>>>>> 9472ad4 (first)
        /* con update or create crea sempre uno nuovo, con update e basta se non esiste non va a crearlo */
        $rows = $model->$name();
        if ($rows->exists()) {
            $rows->update($data);
        } else {
            if (! isset($data['lang'])) {
                $data['lang'] = \App::getLocale();
            }
            $rows->create($data);
        }
    }

    /**
     * morphMany.
     */
<<<<<<< HEAD
    public function updateRelationshipsMorphMany(Model $model, string $name, array $data): void {
        // $res=$model->$name()->syncWithoutDetaching($data);
        foreach ($data as $k => $v) {
            if (! \is_array($v)) {
=======
    public function updateRelationshipsMorphMany(Model $model, string $name, array $data): void
    {
        //$res=$model->$name()->syncWithoutDetaching($data);
        foreach ($data as $k => $v) {
            if (! is_array($v)) {
>>>>>>> 9472ad4 (first)
                $v = [];
            }
            if (! isset($v['pivot'])) {
                $v['pivot'] = [];
            }
<<<<<<< HEAD
            // Call to undefined method Illuminate\Database\Eloquent\Relations\MorphMany::syncWithoutDetaching()
            // $res = $model->$name()->syncWithoutDetaching([$k => $v['pivot']]);
=======
            //Call to undefined method Illuminate\Database\Eloquent\Relations\MorphMany::syncWithoutDetaching()
            //$res = $model->$name()->syncWithoutDetaching([$k => $v['pivot']]);
>>>>>>> 9472ad4 (first)
            $model->$name()->touch();
        }
    }

    /**
     * morphToMany.
     */
<<<<<<< HEAD
    public function updateRelationshipsMorphToMany(Model $model, string $name, array $data): void {

        if (\in_array('to', array_keys($data), true) || \in_array('from', array_keys($data), true)) {
            if(!isset($data['to'])){
                $data['to']=[];
            }
            $data=$data['to'];
        }

        if (! Arr::isAssoc($data)) {
            $model->$name()->sync($data);
        }
        // dddx($data);
        //
        // $model->$name()->attach($data);
        // }

        foreach ($data as $k => $v) {
            if (\is_array($v)) {
                if (! isset($v['pivot'])) {
                    $v['pivot'] = [];
                }
                // dddx('a');
=======
    public function updateRelationshipsMorphToMany(Model $model, string $name, array $data): void
    {
        //dddx([\Request::all(), $params]);
        //$res=$model->$name()->syncWithoutDetaching($data);
        //dddx([$name, Arr::isAssoc($data)]);
        if (! Arr::isAssoc($data)) {
            $data = collect($data)->map(
                function ($item) use ($model, $name) {
                    if (is_numeric($item)) {
                        return $item;
                    }
                    $related = $model->$name()->getRelated();
                    $related_panel = PanelService::make()->get($related);
                    $res = $related_panel->setLabel($item);

                    return $res->getKey().'';
                }
            )->all();
            //dddx($data);
            $model->$name()->sync($data);
        }
        //dddx($data);
        //
        //$model->$name()->attach($data);
        //}

        foreach ($data as $k => $v) {
            if (is_array($v)) {
                if (! isset($v['pivot'])) {
                    $v['pivot'] = [];
                }
                //dddx('a');
>>>>>>> 9472ad4 (first)
                /*
                echo '<hr/><pre>'.print_r($v['pivot'],1).'</pre><hr/>';
                $res = $model->$name()
                        ->where('related_id',$k)
                        ->where('user_id',$v['pivot']['user_id'])
                        ->update($v['pivot']);
                */
                $res = $model->$name()
                    ->syncWithoutDetaching([$k => $v['pivot']]);
            } else {
                // $res = $model->$name()
                 //   ->syncWithoutDetaching([$v]);
            }
<<<<<<< HEAD
            // ->where('user_id',1)
            // ->syncWithoutDetaching([$k => $v['pivot']])

                // ->updateOrCreate(['related_id'=>$k,'user_id'=>1],$v['pivot']);
            // $model->$name()->touch();
=======
            //->where('user_id',1)
            //->syncWithoutDetaching([$k => $v['pivot']])

                //->updateOrCreate(['related_id'=>$k,'user_id'=>1],$v['pivot']);
            //$model->$name()->touch();
>>>>>>> 9472ad4 (first)
        }
    }

    /**
     * morphedByMany.
     **/

    /**
     * pivot.
     */
<<<<<<< HEAD
    public function updateRelationshipsPivot(Model $model, string $name, array $data): void {
=======
    public function updateRelationshipsPivot(Model $model, string $name, array $data): void
    {
>>>>>>> 9472ad4 (first)
        /*
        $rows = $model->$name;
        if (null == $rows) {
            dddx([
                'model' => $model, //cuisine_cat
                'panel_name' => $this->panel->getName(),
                'parent_row' => $this->panel->getParent()->getRow(), //restaurant
                'parent_name' => $this->panel->getParent()->getName(), //restaurant
                'name' => $name, //pivot
                'data' => $data,
            ]);
        }
        //*/
        $parent_panel = $this->panel->getParent();
<<<<<<< HEAD
        if (null !== $parent_panel) {
=======
        if (null != $parent_panel) {
>>>>>>> 9472ad4 (first)
            $parent_row = $parent_panel->getRow();
            $panel_name = $this->panel->getName();
            $parent_row->{$panel_name}()->updateExistingPivot($model->getKey(), $data);
        }
<<<<<<< HEAD
        // $res = $this->panel->rows->updateOrCreate($data);
        // dddx($res);

        // $rows->update($data);
    }

    public function saveMultiselectTwoSides(Model $model, string $name, array $data): void {
        $items = $model->$name();
        $related = $items->getRelated();
        // $container_obj = $model;
        // $container = $container_obj->post_type;
        // $items_key = $container_obj->getKeyName();
=======
        //$res = $this->panel->rows->updateOrCreate($data);
        //dddx($res);

        //$rows->update($data);
    }

    public function saveMultiselectTwoSides(Model $model, string $name, array $data): void
    {
        $items = $model->$name();
        $related = $items->getRelated();
        //$container_obj = $model;
        //$container = $container_obj->post_type;
        //$items_key = $container_obj->getKeyName();
>>>>>>> 9472ad4 (first)
        $items_key = $related->getKeyName();
        $items_0 = $items->get()->pluck($items_key);

        if (! isset($data['to'])) {
            $data['to'] = [];
        }
<<<<<<< HEAD
        /**
         * @var array
         */
        $data_to=$data['to'];
        $items_1 = collect($data_to);
=======
        $items_1 = collect($data['to']);
>>>>>>> 9472ad4 (first)
        $items_add = $items_1->diff($items_0);
        $items_sub = $items_0->diff($items_1);
        /*
        dddx([
            'items_0'=>$items_0,
            'items_1'=>$items_1,
            'items_add'=>$items_add,
            'items_sub'=>$items_sub,

        ]);
            */

        $ids = $items_sub->all();
        $parent = $this->panel->getParent();
<<<<<<< HEAD
        if (null !== $parent) {
=======
        if (null != $parent) {
>>>>>>> 9472ad4 (first)
            $parent_id = $parent->getRow()->getKey();
            $parent_key = $parent->postType().'_'.$parent->getRow()->getKeyName();
            /*
            $data1=[];
            foreach($ids as $v){
                $data1[$v]=[
                    //'job_role_id'=>$v,
                    $parent_key=>$parent_id
                ];
            }
            */
<<<<<<< HEAD
            // dddx($data1);
            // echo '<pre>'.print_r($data1,true).'</pre>';
            // $model->$name()->where($parent_key,$parent_id)->detach($ids);
            // dddx(get_class_methods($model->$name())) ;//->detach($data1);
            $model->$name()->wherePivot($parent_key, $parent_id)->detach($ids);
        // return ;
=======
            //dddx($data1);
            //echo '<pre>'.print_r($data1,true).'</pre>';
            //$model->$name()->where($parent_key,$parent_id)->detach($ids);
            //dddx(get_class_methods($model->$name())) ;//->detach($data1);
            $model->$name()->wherePivot($parent_key, $parent_id)->detach($ids);
            //return ;
>>>>>>> 9472ad4 (first)
        } else {
            $items->detach($ids);
        }
        /* da risolvere Column not found: 1054 Unknown column 'related_type' liveuser_area_admin_areas */
<<<<<<< HEAD
        // try {
        //    $items->attach($items_add->all(), ['related_type' => $container]);
        // } catch (\Exception $e) {
        $ids = $items_add->all();

        $parent = $this->panel->getParent();
        if (null !== $parent) {
=======
        //try {
        //    $items->attach($items_add->all(), ['related_type' => $container]);
        //} catch (\Exception $e) {
        $ids = $items_add->all();

        $parent = $this->panel->getParent();
        if (null != $parent) {
>>>>>>> 9472ad4 (first)
            $parent_id = $parent->getRow()->getKey();
            $parent_key = $parent->postType().'_'.$parent->getRow()->getKeyName();
            $data1 = [];
            foreach ($ids as $v) {
                $data1[$v] = [$parent_key => $parent_id];
            }
            $model->$name()->attach($data1);
        } else {
            $items->attach($ids);
        }
<<<<<<< HEAD
        // }
        $status = 'collegati ['.implode(', ', $items_add->all()).'] scollegati ['.implode(', ', $items_sub->all()).']';
        \Session::flash('status', $status);
    }

    public function updateRelationshipsHasManyDeep(Model $model, string $name, array $data): void {
=======
        //}
        $status = 'collegati ['.\implode(', ', $items_add->all()).'] scollegati ['.\implode(', ', $items_sub->all()).']';
        \Session::flash('status', $status);
    }

    public function updateRelationshipsHasManyDeep(Model $model, string $name, array $data): void
    {
>>>>>>> 9472ad4 (first)
        /*
        dddx([
            'model' => $model,
            'name' => $name,
            'data' => $data,
        ]);
        */
        $rows = $model->$name();
        $methods = get_class_methods($rows);
<<<<<<< HEAD
        // *
=======
        //*
>>>>>>> 9472ad4 (first)
        $methods_get = collect($methods)->filter(
            function ($item) {
                return Str::startsWith($item, 'get');
            }
        )->map(
            function ($item) use ($rows) {
                $value = 'Undefined';
                try {
                    $value = $rows->{$item}();
                } catch (\Exception $e) {
                    $value = $e->getMessage();
                } catch (ArgumentCountError $e) {
                    $value = $e->getMessage();
                }

                return [
                    'name' => $item,
                    'value' => $value,
                ];
            }
        )->all();
<<<<<<< HEAD

    }
}
=======
        //exit(ArrayService::toHtml(['data' => $methods_get]));
        /*/
        dddx(
            [
                'parent' => $rows->getParent(), //PermUser
                'related' => $rows->getRelated(), //Area
                'methods' => $methods,
            ]
        );
        //$rows->updateOrCreate(['areas.id' => 666]);
        /*
        getThroughParents =>[
            array=>[
                 [0] => Modules\LU\Models\PermUser Object
                 [1] => Modules\LU\Models\AreaPermUser Object
            ]
        ]
        getForeignKeys => [
            [0] => user_id
            [1] => perm_user_id
            [2] => id
        ]
        getLocalKeys => [
            [0] => id
            [1] => id
            [2] => area_id
        ]
        getQualifiedParentKeyName   =>  perm_users.id
        getQualifiedFarKeyName      =>  areas.perm_user_id
        getFirstKeyName             =>  user_id
        getQualifiedFirstKeyName    =>  perm_users.user_id
        getForeignKeyName           =>  perm_user_id
        getQualifiedForeignKeyName  =>  areas.perm_user_id
        getLocalKeyName             =>  id
        getQualifiedLocalKeyName    =>  users.id
        getSecondLocalKeyName       =>  id
        */
    }
}
>>>>>>> 9472ad4 (first)
