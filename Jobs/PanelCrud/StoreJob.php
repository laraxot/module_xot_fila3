<?php

declare(strict_types=1);

namespace Modules\Xot\Jobs\PanelCrud;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
<<<<<<< HEAD
// ----------- Requests ----------
// ------------ services ----------
=======
//----------- Requests ----------
//------------ services ----------
>>>>>>> 9472ad4 (first)
use Illuminate\Support\Str;
use Modules\Xot\Contracts\PanelContract;
use Modules\Xot\Services\ModelService;
use Modules\Xot\Services\PanelService;

/**
 * Class StoreJob.
 */
<<<<<<< HEAD
class StoreJob extends XotBaseJob {
    /**
     * Execute the job.
     */
    public function handle(): PanelContract {
=======
class StoreJob extends XotBaseJob
{
    /**
     * Execute the job.
     */
    public function handle(): PanelContract
    {
>>>>>>> 9472ad4 (first)
        $row = $this->panel->getRow();
        $this->data = $this->prepareAndValidate($this->data, $this->panel);
        $data = $this->data;

<<<<<<< HEAD
        // ---------------------------
        if (! isset($data['lang']) && \in_array('lang', $row->getFillable(), true)) {
            $data['lang'] = app()->getLocale();
        }
        if (! isset($data['user_id'])
            && \in_array('user_id', $row->getFillable(), true)
            && 'user_id' !== $row->getKeyName()
=======
        //---------------------------
        if (! isset($data['lang']) && in_array('lang', $row->getFillable())) {
            $data['lang'] = app()->getLocale();
        }
        if (! isset($data['user_id'])
            && in_array('user_id', $row->getFillable())
            && 'user_id' != $row->getKeyName()
>>>>>>> 9472ad4 (first)
        ) {
            $data['user_id'] = \Auth::id();
        }

        $row = $row->fill($data);

        $row->save();
        $parent = $this->panel->getParent();
<<<<<<< HEAD
        if (\is_object($parent)) {
=======
        if (is_object($parent)) {
>>>>>>> 9472ad4 (first)
            $parent_row = $parent->getRow();
            $pivot_data = [];
            if (isset($data['pivot'])) {
                $pivot_data = $data['pivot'];
            }
            if (! isset($pivot_data['user_id'])) {
                $pivot_data['user_id'] = \Auth::id();
            }
            try {
<<<<<<< HEAD
                // *
                $types = $this->panel->getName();
                $tmp_rows = $parent_row->$types();
                $tmp = $tmp_rows->save($row, $pivot_data);
                // */
=======
                //*
                $types = $this->panel->getName();
                $tmp_rows = $parent_row->$types();
                $tmp = $tmp_rows->save($row, $pivot_data);
                //*/
>>>>>>> 9472ad4 (first)

                /*
                dddx([
                    '$tmp_rows'=>$tmp_rows,   // Illuminate\Database\Eloquent\Relations\BelongsToMany
                    '$this->panel->getRows()'=>$this->panel->getRows(), //Illuminate\Database\Eloquent\Builder
                ]);
                */

<<<<<<< HEAD
                // 55  Call to an undefined method Illuminate\Database\Eloquent\Builder::save().
                // $tmp = $this->panel->getRows()->save($row, $pivot_data); //??

                // $tmp = $this->panel->getRows()->create($pivot_data); //??
=======
                //55  Call to an undefined method Illuminate\Database\Eloquent\Builder::save().
                //$tmp = $this->panel->getRows()->save($row, $pivot_data); //??

                //$tmp = $this->panel->getRows()->create($pivot_data); //??
>>>>>>> 9472ad4 (first)
                /*
                Model
                BelongsToMany
                HasOneOrMany
                */
            } catch (\Exception $e) {
<<<<<<< HEAD
                // message: "Call to undefined method Illuminate\Database\Eloquent\Builder::save()"
                dddx(
                    ['e' => $e,
                        'panel' => $this->panel,
                        'methods' => get_class_methods($this->panel->getRows()),
=======
                //message: "Call to undefined method Illuminate\Database\Eloquent\Builder::save()"
                dddx(
                    ['e' => $e,
                    'panel' => $this->panel,
                    'methods' => get_class_methods($this->panel->getRows()),
>>>>>>> 9472ad4 (first)
                    ]
                );
                /*
                $this->row = $row;
                $func = 'saveParent'.Str::studly(class_basename($parent_row->$types()));
                $tmp = $this->$func();
                */
            }

<<<<<<< HEAD
            // $tmp=$item->$types()->attach($row->getKey(),$pivot_data);
            // $tmp = $item->$types()->save($row, $pivot_data);
=======
            //$tmp=$item->$types()->attach($row->getKey(),$pivot_data);
            //$tmp = $item->$types()->save($row, $pivot_data);
>>>>>>> 9472ad4 (first)
        }

        $this->manageRelationships($row, $data, 'store');
        if (method_exists($this->panel, 'storeCallback')) {
            $row = $this->panel->storeCallback(['row' => $row, 'data' => $data]);
        }
        \Session::flash('status', 'creato ! ['.$row->getKey().']!');

        return $this->panel;
    }

<<<<<<< HEAD
    public function saveParentHasManyDeep(): void {
=======
    public function saveParentHasManyDeep(): void
    {
>>>>>>> 9472ad4 (first)
    }

    /*
    public function saveParentHasManyDeep_OLD() {
        $row = $this->panel->getRow();
        $data = $this->data;
        $types = $this->types;
        $item = $this->item;

        $rows = $item->$types();
        //debug_getter_obj(['obj'=>$rows]);
        //dddx(get_class_methods($rows));
        $fields = [
            'getQualifiedFarKeyName',
            'getFirstKeyName',
            'getQualifiedFirstKeyName',
            'getForeignKeyName',
            'getQualifiedForeignKeyName',
            'getLocalKeyName',
            'getQualifiedLocalKeyName',
            'getSecondLocalKeyName',
            'getBaseQuery',
            'getParent',
            'getRelated',
            //"getRelationExistenceQuery",
            //"getRelationExistenceQueryForSelfRelation",
            //"getRelationExistenceQueryForThroughSelfRelation",
            'getThroughParents',
            'getForeignKeys',
            'getLocalKeys',
            'getQualifiedParentKeyName',
            //"getMorphedModel",
        ];
        $ris = [];
        $ris['row'] = $row;
        $ris['item'] = $item;
        $ris['types'] = $types;
        $ris['data'] = $data;
        foreach ($fields as $field) {
            $ris[$field] = $rows->$field();
        }
        $ris['item_profiles'] = $item->profiles;
        $ris['row_profile'] = $row->profile;
        $profile_c = collect($item->profiles)->where('post_id', $row->profile->post_id)->count();

        if (0 == $profile_c) {
            //dddx($row->profile);
            //$item->profiles()->associate($row->profile); //Illuminate\Database\Eloquent\Relations\MorphToMany::associate()
            //$item->profiles()->syncWithoutDetaching($row->profile);
            $item->profiles()->save($row->profile);
        }

        //"getQualifiedFarKeyName" => "bell_boys.post_id"
        //"getFirstKeyName" => "post_id"
        //"getQualifiedFirstKeyName" => "restaurant_morph.post_id"
        //"getForeignKeyName" => "post_id"
        //"getQualifiedForeignKeyName" => "bell_boys.post_id"
        //"getLocalKeyName" => "post_id"
        //"getQualifiedLocalKeyName" => "restaurants.post_id"
        //"getSecondLocalKeyName" => "post_id"


        //dddx($rows->getParent()); //restaurantMorph
        //dddx($rows->getRelated());//bellboy
        //dddx($rows->getThroughParents());//restaurantMorph , Profile
        //$arr=['bell_boys.user_id'=>$row->user_id];
        //$rows->updateOrCreate($arr);
        //$rows->associate($row); //Call to undefined method Staudenmeir\EloquentHasManyDeep\HasManyDeep::associate()
        //$rows->save($row); //Call to undefined method Staudenmeir\EloquentHasManyDeep\HasManyDeep::save()
        //$rows->sync($row);//Call to undefined method Staudenmeir\EloquentHasManyDeep\HasManyDeep::sync()
        //$rows->attach($row);//Call to undefined method Staudenmeir\EloquentHasManyDeep\HasManyDeep::attach()
        //match??
        //$rows->saveMany([$row]);//Call to undefined method Staudenmeir\EloquentHasManyDeep\HasManyDeep::saveMany()
    }

    //end handle
    */

<<<<<<< HEAD
    public function storeRelationshipsPivot(Model $model, string $name, array $data): void {
=======
    public function storeRelationshipsPivot(Model $model, string $name, array $data): void
    {
>>>>>>> 9472ad4 (first)
        /*
        extract($params);
        $types=Str::plural($container);
        //dddx($params);
        //$model->$name()->create($data);
        $k=$model->getKey();
        $res=$item->$types()->update($model,$data);
        //dddx($res);
        */
    }

<<<<<<< HEAD
    public function storeRelationshipsHasOne(Model $model, string $name, array $data): void {
        $rows = $model->$name();
        $related = $rows->getRelated();

        // la chiave da aggiornare
=======
    public function storeRelationshipsHasOne(Model $model, string $name, array $data): void
    {
        $rows = $model->$name();
        $related = $rows->getRelated();

        //la chiave da aggiornare
>>>>>>> 9472ad4 (first)
        $pk = $rows->getRelated()->getKeyName();
        /* if ('user_id' == $pk) {
             dddx([$model]);
         }*/

<<<<<<< HEAD
        // debug_getter_obj(['obj'=>$rows]);
        try {
            // backtrace(true);
            // dddx([$model, $name, $data]);
            $related = $rows->create($data);
        } catch (\Exception $e) {
            // "SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry '1' for key 'PRIMARY' (SQL: insert into `liveuser_users` (`first_name`, `last_name`, `email`, `user_id`, `created_by`, `updated_by`, `updated_at`, `created_at`) values (gfdsfs, fdsfds, fds
            // dddx(['e' => $e->getMessage(), 'data' => $data]);
            $data = collect($data)->only($related->getFillable())->all();
            // dddx($data);

            $related = $rows->update($data);
            // $rows->fill($data);
            // $related = $rows->save();
        }
        if (! $model->$name()->exists()) {// collegamento non riuscito
=======
        //debug_getter_obj(['obj'=>$rows]);
        try {
            //backtrace(true);
            //dddx([$model, $name, $data]);
            $related = $rows->create($data);
        } catch (\Exception $e) {
            //"SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry '1' for key 'PRIMARY' (SQL: insert into `liveuser_users` (`first_name`, `last_name`, `email`, `user_id`, `created_by`, `updated_by`, `updated_at`, `created_at`) values (gfdsfs, fdsfds, fds
            //dddx(['e' => $e->getMessage(), 'data' => $data]);
            $data = collect($data)->only($related->getFillable())->all();
            //dddx($data);

            $related = $rows->update($data);
            //$rows->fill($data);
            //$related = $rows->save();
        }
        if (! $model->$name()->exists()) {//collegamento non riuscito
>>>>>>> 9472ad4 (first)
            $pk_local = $rows->getLocalKeyName();
            $pk_fore = $rows->getForeignKeyName();
            $data1 = [(string) $pk_local => $related->$pk_fore];
            $model->update($data1);
        }
    }

    /**
     * Undocumented function.
     */
<<<<<<< HEAD
    public function storeRelationshipsHasMany(Model $model, string $name, array $data): void {
        // $rows = $model->$name();
=======
    public function storeRelationshipsHasMany(Model $model, string $name, array $data): void
    {
        //$rows = $model->$name();
>>>>>>> 9472ad4 (first)
    }

    /**
     * Undocumented function.
     *
     * @param array|string|int $data
     */
<<<<<<< HEAD
    public function storeRelationshipsBelongsTo(Model $model, string $name, $data): void {
        if (\is_string($data) || \is_int($data)) {
            $model->$name()->associate($data);
            // $model->save(); //non dovrebbe essere necessario

            return;
        }
        // $model può essere il modello Profile di ClubReport
        // $name ad esempio può essere la stringa con il nome della relazione region
        // che contiene la lista delle regioni, e parte dal modello Profile
        // quindi $rows->$name() andrà ad aprire la relazione Region del modello Profile
        // la suddetta relazione verrà chiamata $rows

        $rows = $model->$name();
        // debug_getter_obj(['obj'=>$rows]);

        // dddx([$rows]);

        // sicchè $rows sarà nel caso di esempio, la relazione BelongsTo region appartenente a Profile
        // in questa relazione salverò dei dati

        // var_dump([$rows->getForeignKeyName() => $data]);

        // dddx([$model, $data, $rows, $rows->getRelated()->find($data)]);
        // !!! SE E? UN ARRAY DARA? ERROR
        $associated = $rows->getRelated()->find($data);

        // serve ad associare un modello padre ad un modello figlio, tramite chiave esterna del figlio
        // esempio region_id
        $model->$name()->associate($associated);

        // dopo aver associato bisogna salvà er modello
=======
    public function storeRelationshipsBelongsTo(Model $model, string $name, $data): void
    {
        if (is_string($data) || is_integer($data)) {
            $model->$name()->associate($data);
            //$model->save(); //non dovrebbe essere necessario

            return;
        }
        //$model può essere il modello Profile di ClubReport
        //$name ad esempio può essere la stringa con il nome della relazione region
        //che contiene la lista delle regioni, e parte dal modello Profile
        //quindi $rows->$name() andrà ad aprire la relazione Region del modello Profile
        //la suddetta relazione verrà chiamata $rows

        $rows = $model->$name();
        //debug_getter_obj(['obj'=>$rows]);

        //dddx([$rows]);

        //sicchè $rows sarà nel caso di esempio, la relazione BelongsTo region appartenente a Profile
        //in questa relazione salverò dei dati

        //var_dump([$rows->getForeignKeyName() => $data]);

        //dddx([$model, $data, $rows, $rows->getRelated()->find($data)]);
        // !!! SE E? UN ARRAY DARA? ERROR
        $associated = $rows->getRelated()->find($data);

        //serve ad associare un modello padre ad un modello figlio, tramite chiave esterna del figlio
        //esempio region_id
        $model->$name()->associate($associated);

        //dopo aver associato bisogna salvà er modello
>>>>>>> 9472ad4 (first)
        $model->save();

        /*$related = $rows->create($data);
        //$model->$name()->save($related); //Call to undefined method Illuminate\Database\Eloquent\Relations\BelongsTo::save()

        if (! $model->$name()->exists()) {//collegamento non riuscito
            $pk_own = $rows->getOwnerKeyName();
            $pk_fore = $rows->getForeignKeyName();
            $data1 = [(string) $pk_fore => $related->$pk_own];
            $model->update($data1);
        }*/
    }

    /**
     * Undocumented function.
     */
<<<<<<< HEAD
    public function storeRelationshipsMorphOne(Model $model, string $name, array $data): void {
=======
    public function storeRelationshipsMorphOne(Model $model, string $name, array $data): void
    {
>>>>>>> 9472ad4 (first)
        if (! isset($data['lang']) /* && in_array('lang', $row->getFillable()) */) {
            $data['lang'] = app()->getLocale();
        }
        if ($model->$name()->exists()) {
            $model->$name()->update($data);
        } else {
            $model->$name()->create($data);
        }
    }

<<<<<<< HEAD
    public function storeRelationshipsMorphToMany(Model $model, string $name, array $data): void {
        // dddx(\Request::all());
        // return ;
=======
    public function storeRelationshipsMorphToMany(Model $model, string $name, array $data): void
    {
        //dddx(\Request::all());
        //return ;
>>>>>>> 9472ad4 (first)

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
<<<<<<< HEAD
            // dddx($data);
=======
            //dddx($data);
>>>>>>> 9472ad4 (first)
            $model->$name()->sync($data);
        }

        foreach ($data as $k => $v) {
<<<<<<< HEAD
            if (\is_array($v)) {
=======
            if (is_array($v)) {
>>>>>>> 9472ad4 (first)
                if (! isset($v['pivot'])) {
                    $v['pivot'] = [];
                }
                if (! isset($v['pivot']['user_id']) && isset($model->user_id)) {
                    $v['pivot']['user_id'] = $model->user_id;
                }
                if (! isset($v['pivot']['user_id']) && \Auth::check()) {
                    $v['pivot']['user_id'] = \Auth::id();
                }
                /*
                * syncWithoutDetaching fa una select a vuoto ma funziona
                *
                **/
                $model->$name()->syncWithoutDetaching([$k => $v['pivot']]);
            } else {
                $res = $model->$name()->syncWithoutDetaching([$v]);
                /*
                $rows1=$model->$name();
                $related=$rows1->getRelated();
                dddx($related);
                //dddx($params);
                */
<<<<<<< HEAD
                // $model->$name()->attach()
                // dddx('semplice assegnazione');
=======
                //$model->$name()->attach()
                //dddx('semplice assegnazione');
>>>>>>> 9472ad4 (first)
            }
        }
    }

<<<<<<< HEAD
    public function storeRelationshipsHasManyThrough(Model $model, string $name, array $data): void {
        $rows = $model->$name();
        $throughKey = $model->$name()->getRelated()->getKeyName();

        // in realtà sarebbe sufficiente create però proviamo
=======
    public function storeRelationshipsHasManyThrough(Model $model, string $name, array $data): void
    {
        $rows = $model->$name();
        $throughKey = $model->$name()->getRelated()->getKeyName();

        //in realtà sarebbe sufficiente create però proviamo
>>>>>>> 9472ad4 (first)
        if (! empty($data['to'])) {
            $rows->getParent()->updateOrCreate([$rows->getForeignKeyName() => $this->panel->row->{$rows->getFirstKeyName()}, $rows->getFirstKeyName() => $this->panel->row->{$rows->getFirstKeyName()}]);

            $rows->getRelated()->updateOrCreate([$rows->getForeignKeyName() => $this->panel->row->{$rows->getFirstKeyName()}, $throughKey => $data['to'][0]]);
        } else {
            $rows->getParent()->updateOrCreate([$rows->getForeignKeyName() => $this->panel->row->{$rows->getFirstKeyName()}, $rows->getFirstKeyName() => $this->panel->row->{$rows->getFirstKeyName()}]);

            $rows->getRelated()->updateOrCreate([$rows->getForeignKeyName() => '', $throughKey => '']);
        }
    }

    /**
     * Undocumented function.
     */
<<<<<<< HEAD
    public function storeRelationshipsBelongsToMany(Model $model, string $name, array $data): void {
=======
    public function storeRelationshipsBelongsToMany(Model $model, string $name, array $data): void
    {
>>>>>>> 9472ad4 (first)
        if (isset($data['from']) || isset($data['to'])) {
            $this->saveMultiselectTwoSides($model, $name, $data);

            return;
        }
        $model->$name()->syncWithoutDetaching($data);
    }

    /**
     * Undocumented function.
     */
<<<<<<< HEAD
    public function saveMultiselectTwoSides(Model $model, string $name, array $data): void {
        // passo request o direttamente data ?

        $items = $model->$name();
        $related = $items->getRelated();
        // dddx($related);
        $container_obj = $model;
        $container = ModelService::make()->setModel($container_obj)->getPostType();
        // $items_key = $container_obj->getKeyName();
        $items_key = $related->getKeyName();
        // dddx($items_key);//user_id
=======
    public function saveMultiselectTwoSides(Model $model, string $name, array $data): void
    {
        //passo request o direttamente data ?

        $items = $model->$name();
        $related = $items->getRelated();
        //dddx($related);
        $container_obj = $model;
        $container = ModelService::make()->setModel($container_obj)->getPostType();
        //$items_key = $container_obj->getKeyName();
        $items_key = $related->getKeyName();
        //dddx($items_key);//user_id
>>>>>>> 9472ad4 (first)
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
        $items->detach($items_sub->all());
        /* da risolvere Column not found: 1054 Unknown column 'related_type' liveuser_area_admin_areas */
        try {
            $items->attach($items_add->all(), ['related_type' => $container]);
        } catch (\Exception $e) {
            $items->attach($items_add->all());
        }
<<<<<<< HEAD
        $status = 'collegati ['.implode(', ', $items_add->all()).'] scollegati ['.implode(', ', $items_sub->all()).']';
        \Session::flash('status', $status);
    }
}// end storeJob
=======
        $status = 'collegati ['.\implode(', ', $items_add->all()).'] scollegati ['.\implode(', ', $items_sub->all()).']';
        \Session::flash('status', $status);
    }
}//end storeJob
>>>>>>> 9472ad4 (first)
