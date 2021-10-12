<?php

declare(strict_types=1);

namespace Modules\Xot\Jobs\PanelCrud;

use Illuminate\Database\Eloquent\Model;
//----------- Requests ----------
//------------ services ----------
use Illuminate\Support\Arr;
use Modules\Xot\Contracts\PanelContract;
use Modules\Xot\Services\PanelService as Panel;

/**
 * Class UpdateJob.
 */
class UpdateJob extends XotBaseJob {
    /**
     * Execute the job.
     */
    public function handle(): PanelContract {
        $row = $this->panel->getRow();
        $old = $this->data;
        $this->data = $this->prepareAndValidate($this->data, $this->panel);
        //dddx(['old' => $old, 'prepared' => $this->data]);
        $data = $this->data;

        //https://medium.com/@taylorotwell/tap-tap-tap-1fc6fc1f93a6
        //  30     Call to an undefined method Illuminate\Support\HigherOrderTapProxy<mixed>::update().
        $row = tap($row)->update($data);
        //dd([/*'row' => $row, */'data' => $data, 'ris' => $ris, __LINE__, __FILE__]);

        $this->manageRelationships($row, $data, 'update');
        \Session::flash('status', 'aggiornato! ['.$row->getKey().']!'); //.implode(',',$row->getChanges())

        return $this->panel;
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function setData($data) {
        $this->data = $data;

        return $this;
    }

    /**
     *--- hasOne ----.
     */
    public function updateRelationshipsHasOne(Model $model, string $name, array $data): void {
        $rows = $model->$name();

        if ($rows->exists()) {
            if (! is_array($data)) {
                //variabile uguale alla relazione
            } else {
<<<<<<< HEAD
                //$model->$name()->update($data);
=======
                //backtrace(true);
                //dddx([$model, $name, $data]);
>>>>>>> a4c5634 (up)
                $model->$name->update($data);
            }
        } else {
            dddx(['err' => 'wip']);
            //$this->storeRelationshipsHasOne($params);
        }
    }

    /**
     *  belongsTo.
     *
     * @param string|int|array $data
     */
    public function updateRelationshipsBelongsTo(Model $model, string $name, $data): void {
        if (! is_array($data)) {
            $rows = $model->$name();
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
    public function updateRelationshipsHasMany(Model $model, string $name, array $data): void {
        $rows = $model->$name();
        debug_getter_obj(['obj' => $rows]);
        //---------- TO DO ------------//
    }

    //end updateRelationshipsHasMany

    /**
     * --- belongsToMany.
     */
    public function updateRelationshipsBelongsToMany(Model $model, string $name, array $data): void {
        //$model->$name()->syncWithoutDetaching($data);

        if (in_array('to', array_keys($data)) || in_array('from', array_keys($data))) {
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

    //end updateRelationshipsBelongsToMany

    /*    hasOneThrough     */

    /*    morphTo           */

    /**
     * ManyThrough.
     */
    public function updateRelationshipsHasManyThrough(Model $model, string $name, array $data): void {
        //$rows = $model->$name();
        //dddx(get_class_methods($rows));

        /*if (isset($data['to'])) {
            $rows = $model->$name();
<<<<<<< HEAD
            //touch
            dddx(
                [
                    //Call to undefined method Illuminate\Database\Eloquent\Relations\HasManyThrough::attach()
                    //'attach' => $rows->attach(1),
                    //Call to undefined method Illuminate\Database\Eloquent\Relations\HasManyThrough::sync()
                    //'attach' => $rows->sync(1),
                    'model' => $model, //Profile
                    'name' => $name, //rights
                    'data' => $data, //['to']=>[0=>'1',1=>'2'];
                    'value' => $rows->get(),
                    'getQualifiedParentKeyName' => $rows->getQualifiedParentKeyName(), //liveuser_perm_users.perm_user_id
                    'getQualifiedFarKeyName' => $rows->getQualifiedFarKeyName(), //liveuser_userrights.perm_user_id
                    'getParent' => $rows->getParent(), //PermUser
                    'getRelated' => $rows->getRelated(), //UserRight
                    'getFirstKeyName' => $rows->getFirstKeyName(), //auth_user_id
                    'getQualifiedFirstKeyName' => $rows->getQualifiedFirstKeyName(), //liveuser_perm_users.auth_user_id
                    'getForeignKeyName' => $rows->getForeignKeyName(), //perm_user_id
                    'getQualifiedForeignKeyName' => $rows->getQualifiedForeignKeyName(), //liveuser_userrights.perm_user_id
                    'getLocalKeyName' => $rows->getLocalKeyName(), //auth_user_id
                    'getQualifiedLocalKeyName' => $rows->getQualifiedLocalKeyName(), //profiles.auth_user_id
                    'getSecondLocalKeyName' => $rows->getSecondLocalKeyName(), //perm_user_id
                    'model->getLocalKeyName' => $model->{$rows->getLocalKeyName()}, //2
                    'rows_methods' => get_class_methods($rows),
                    'model_methods' => get_class_methods($model),
                    'model getRelations' => $model->factory()->guessRelationship('a'),
                ]
            );

            //$this->saveMultiselectTwoSides($model,$name,$data);
=======
            dddx(get_class_methods($rows));
            dddx($rows->getParent());
            $this->saveMultiselectTwoSides($rows->getParent(), $name, $data);
        }*/

        /* modificato da davide. tolto wip altrimenti non modifica lo user da profile */
        /*dddx(['wip']);*/

        //dddx([$model, $name, $data]);

        //es. relazione rights hasmanythrough a modello profile
        //dddx($model->$name());
        $rows = $model->$name();

        //dddx(get_class_methods($rows));

        $throughKey = $model->$name()->getRelated()->getKeyName();

        //dddx([$rows->getFirstKeyName(), $rows->getForeignKeyName(), $throughKey]);

        //potrebbe essere necessario un foreach

        //dddx($data);

        //from è la tendina di sinistra, to quella di destra
        if (! empty($data['to'])) {
            //dddx([$rows, $rows->getForeignKeyName() => $this->panel->row->{$rows->getFirstKeyName()}, $throughKey => $data['to'][0]]);

            /*dddx([$rows->getForeignKeyName() => $this->panel->row->{$rows->getFirstKeyName()},
                $rows->getFirstKeyName() => $this->panel->row->{$rows->getFirstKeyName()}, ]);*/

            $rows->getParent()->updateOrCreate([$rows->getForeignKeyName() => $this->panel->row->{$rows->getFirstKeyName()}, $rows->getFirstKeyName() => $this->panel->row->{$rows->getFirstKeyName()}]);

            $rows->getRelated()->updateOrCreate([$rows->getForeignKeyName() => $this->panel->row->{$rows->getFirstKeyName()}, $throughKey => $data['to'][0]]);
        } else {
            //dddx([$rows->getForeignKeyName() => $this->panel->row->{$rows->getFirstKeyName()}, $throughKey => '']);
            //se non c'è niente su to vuol dire che va cancellato il campo dal modello relativo

            //attenzione. in sto caso va bene così ma in realtà solo i from andrebbero cancellati
            $rows->getRelated()->where([$rows->getForeignKeyName() => $this->panel->row->{$rows->getFirstKeyName()}])->delete();
>>>>>>> a4c5634 (up)
        }

        //$rows->save();
    }

    /**
     * morphOne.
     */
    public function updateRelationshipsMorphOne(Model $model, string $name, array $data): void {
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
    public function updateRelationshipsMorphMany(Model $model, string $name, array $data): void {
        //$res=$model->$name()->syncWithoutDetaching($data);
        foreach ($data as $k => $v) {
            if (! is_array($v)) {
                $v = [];
            }
            if (! isset($v['pivot'])) {
                $v['pivot'] = [];
            }
            //Call to undefined method Illuminate\Database\Eloquent\Relations\MorphMany::syncWithoutDetaching()
            //$res = $model->$name()->syncWithoutDetaching([$k => $v['pivot']]);
            $model->$name()->touch();
        }
    }

    /**
     * morphToMany.
     */
    public function updateRelationshipsMorphToMany(Model $model, string $name, array $data): void {
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
                    $related_panel = Panel::get($related);
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
                /*
                echo '<hr/><pre>'.print_r($v['pivot'],1).'</pre><hr/>';
                $res = $model->$name()
                        ->where('related_id',$k)
                        ->where('auth_user_id',$v['pivot']['auth_user_id'])
                        ->update($v['pivot']);
                */
                $res = $model->$name()
                    ->syncWithoutDetaching([$k => $v['pivot']]);
            } else {
                // $res = $model->$name()
                 //   ->syncWithoutDetaching([$v]);
            }
            //->where('auth_user_id',1)
            //->syncWithoutDetaching([$k => $v['pivot']])

                //->updateOrCreate(['related_id'=>$k,'auth_user_id'=>1],$v['pivot']);
            //$model->$name()->touch();
        }
    }

    /**
     * morphedByMany.
     **/

    /**
     * pivot.
     */
    public function updateRelationshipsPivot(Model $model, string $name, array $data): void {
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
        if (null != $parent_panel) {
            $parent_row = $parent_panel->getRow();
            $panel_name = $this->panel->getName();
            $parent_row->{$panel_name}()->updateExistingPivot($model->getKey(), $data);
        }
        //$res = $this->panel->rows->updateOrCreate($data);
        //dddx($res);

        //$rows->update($data);
    }

    public function saveMultiselectTwoSides(Model $model, string $name, array $data): void {
        $items = $model->$name();
        $related = $items->getRelated();
        //$container_obj = $model;
        //$container = $container_obj->post_type;
        //$items_key = $container_obj->getKeyName();
        $items_key = $related->getKeyName();
        $items_0 = $items->get()->pluck($items_key);

        if (! isset($data['to'])) {
            $data['to'] = [];
        }
        $items_1 = collect($data['to']);
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
        if (null != $parent) {
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
            //dddx($data1);
            //echo '<pre>'.print_r($data1,true).'</pre>';
            //$model->$name()->where($parent_key,$parent_id)->detach($ids);
            //dddx(get_class_methods($model->$name())) ;//->detach($data1);
            $model->$name()->wherePivot($parent_key, $parent_id)->detach($ids);
        //return ;
        } else {
            $items->detach($ids);
        }
        /* da risolvere Column not found: 1054 Unknown column 'related_type' liveuser_area_admin_areas */
        //try {
        //    $items->attach($items_add->all(), ['related_type' => $container]);
        //} catch (\Exception $e) {
        $ids = $items_add->all();

        $parent = $this->panel->getParent();
        if (null != $parent) {
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
        //}
        $status = 'collegati ['.\implode(', ', $items_add->all()).'] scollegati ['.\implode(', ', $items_sub->all()).']';
        \Session::flash('status', $status);
    }
}