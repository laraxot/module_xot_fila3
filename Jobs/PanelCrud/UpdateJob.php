<?php

declare(strict_types=1);

namespace Modules\Xot\Jobs\PanelCrud;

//----------- Requests ----------
//------------ services ----------
use ArgumentCountError;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Modules\Xot\Contracts\PanelContract;
use Modules\Xot\Services\ArrayService;
use Modules\Xot\Services\PanelService as Panel;

/**
 * Class UpdateJob.
 */
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
        //  30     Call to an undefined method Illuminate\Support\HigherOrderTapProxy<mixed>::update().
        $row = tap($row)->update($data);

        $this->manageRelationships($row, $data, 'update');
        $msg = 'aggiornato! ['.$row->getKey().']!'; //.'['.implode(',',$row->getChanges()).']';

        \Session::flash('status', $msg); //.

        return $this->panel;
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * --- hasOne ----.
     */
    public function updateRelationshipsHasOne(Model $model, string $name, array $data): void
    {
        $rows = $model->$name();

        if ($rows->exists()) {
            if (! is_array($data)) {
                //variabile uguale alla relazione
            } else {
                //backtrace(true);
                //dddx([$model, $name, $data]);
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
    public function updateRelationshipsBelongsTo(Model $model, string $name, $data): void
    {
        $rows = $model->$name();
        if (! is_array($data)) {
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
    public function updateRelationshipsHasMany(Model $model, string $name, array $data): void
    {
        $rows = $model->$name();
        debug_getter_obj(['obj' => $rows]);
        //---------- TO DO ------------//
    }

    //end updateRelationshipsHasMany

    /**
     * --- belongsToMany.
     */
    public function updateRelationshipsBelongsToMany(Model $model, string $name, array $data): void
    {
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
            $row = $this->panel->row;
            $parent_relation_name = Str::camel(class_basename($rows->getParent()));
            $related_relation_name = Str::camel(class_basename($rows->getRelated()));
            $related_relation_name = Str::plural($related_relation_name);
            //dddx([$parent_relation_name, $related_relation_name]);
            $bridge = $row->{$parent_relation_name};
            $bridge_rows = $bridge->{$related_relation_name}();
            //dddx(get_class_methods($bridge_rows));
            //$bridge_rows->syncWithoutDetaching(666); //ate\Database\Eloquent\Relations\HasMany::syncWithoutDetaching
            throw new \Exception('WIP ['.__LINE__.']['.__FILE__.']');
            //$bridge_rows->save();
            //$rows->get();
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
            //dddx([$rows->getForeignKeyName() => $this->panel->row->{$rows->getFirstKeyName()}, $throughKey => '']);
            //se non c'è niente su to vuol dire che va cancellato il campo dal modello relativo

            //attenzione. in sto caso va bene così ma in realtà solo i from andrebbero cancellati
            //$rows->getRelated()->where([$rows->getForeignKeyName() => $this->panel->row->{$rows->getFirstKeyName()}])->delete();
        }

        //$rows->save();
    }

    /**
     * morphOne.
     */
    public function updateRelationshipsMorphOne(Model $model, string $name, array $data): void
    {
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
    public function updateRelationshipsMorphMany(Model $model, string $name, array $data): void
    {
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
                        ->where('user_id',$v['pivot']['user_id'])
                        ->update($v['pivot']);
                */
                $res = $model->$name()
                    ->syncWithoutDetaching([$k => $v['pivot']]);
            } else {
                // $res = $model->$name()
                 //   ->syncWithoutDetaching([$v]);
            }
            //->where('user_id',1)
            //->syncWithoutDetaching([$k => $v['pivot']])

                //->updateOrCreate(['related_id'=>$k,'user_id'=>1],$v['pivot']);
            //$model->$name()->touch();
        }
    }

    /**
     * morphedByMany.
     **/

    /**
     * pivot.
     */
    public function updateRelationshipsPivot(Model $model, string $name, array $data): void
    {
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

    public function saveMultiselectTwoSides(Model $model, string $name, array $data): void
    {
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

    public function updateRelationshipsHasManyDeep(Model $model, string $name, array $data): void
    {
        /*
        dddx([
            'model' => $model,
            'name' => $name,
            'data' => $data,
        ]);
        */
        $rows = $model->$name();
        $methods = get_class_methods($rows);
        //*
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
