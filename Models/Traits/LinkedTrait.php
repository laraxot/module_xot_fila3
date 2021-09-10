<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\URL;
//use Laravel\Scout\Searchable;
use Illuminate\Support\Facades\Route;
//----- models------
use Illuminate\Support\Str;
//use Modules\Blog\Models\Favorite;
use Modules\Blog\Models\Post;
//----- services -----
use Modules\LU\Models\User;

use Modules\Xot\Models\Image;
use Modules\Xot\Services\PanelService as Panel;
use Modules\Xot\Services\RouteService;
use Modules\Xot\Services\StubService;
use Modules\Xot\Services\TenantService as Tenant; // per dizionario morph

//------ traits ---

/**
 * Modules\Xot\Models\Traits\LinkedTrait.
 *
 * @property \Modules\LU\Models\User|null $user
 * @property \Modules\Blog\Models\Post    $post
 */
trait LinkedTrait {
    /**
     * @return string
     */
    public function getRouteKeyName() {
        return RouteService::inAdmin() ? 'id' : 'guid';
    }

    //------- relationships ------------

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \ReflectionException
     */
    public function post(): MorphOne {
        $models = Tenant::config('xra.model');
        $class = get_class($this);
        $alias = collect($models)->search($class);

        if (false === $alias) {
            $data = [];
            $panel = Panel::get($this);
            $alias = $panel->postType();
            $data['model'][$alias] = $class;
            Tenant::saveConfig(['name' => 'xra', 'data' => $data]);
        }

        if (null == Relation::getMorphedModel($alias)) {
            Relation::morphMap([
                $alias => $class,
            ]);
        }

        return $this->morphOne(Post::class, 'post')//, null, 'id')
            ->where('lang', App::getLocale());
    }

    public function posts(): MorphMany {
        return $this->morphMany(Post::class, 'post')//, null, 'id')
            ->where('lang', App::getLocale());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function postLang(string $lang) {
        return $this->morphOne(Post::class, 'post')//, null, 'id')
            ->where('lang', $lang);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images() {
        return $this->morphMany(Image::class, 'post');
    }

    /* spostato in Favorite.php
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
    public function favorites() {
        return $this->morphMany(Favorite::class, 'post');
    }
    */

    /* -- messo in hasprofileTrait
    public function user():\Illuminate\Database\Eloquent\Relations\HasOne {
        return $this->hasOne(User::class, 'auth_user_id', 'auth_user_id');
    }

    public function profile() {
        dddx('i');
        $class = Tenant::model('profile');

        return $this->hasOne($class, 'auth_user_id', 'auth_user_id');
    }
    */

    /* spostato in Favorite.php
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany

    public function myFavorites() {
        return $this->morphMany(Favorite::class, 'post')
            ->where('auth_user_id', Auth::id());
    }
     */

    /* spostato in Favorite.php
     * @return bool
    public function isMyFavorited() {
        return $this->favorites()
            ->where('auth_user_id', Auth::id())->count() > 0;
    }
    */

    /**
     * @param object|string $related
     */
    public function getTableMorph($related, bool $inverse): string {
        if ($inverse) {
            $pivot = get_class($this).'Morph';
        } else {
            if (is_string($related)) {
                $pivot = $related.'Morph';
            } else {
                $pivot = get_class($related).'Morph';
            }
        }

        return $pivot;
    }

    /**
     * @param object|string $related
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function morphRelatedWithKey($related, bool $inverse, string $table_key) {
        $name = 'post';
        $pivot = $this->getTableMorph($related, $inverse);
        //$pivot_fields = app($pivot)->getFillable();
        $model_name = Str::snake(class_basename($this));
        $related_name = Str::snake(class_basename($related));
        if ($inverse) {
            $foreignPivotKey = $model_name.'_id';
            $relatedPivotKey = $table_key;
            $parentKey = 'id';
            $relatedKey = $table_key;
        } else {
            $foreignPivotKey = $table_key;
            $relatedPivotKey = $related_name.'_id';
            $parentKey = $table_key;
            $relatedKey = 'id';
        }

        return $this->morphToMany(
            $related,
            $name,
            $pivot,
            $foreignPivotKey,
            $relatedPivotKey,
            $parentKey,
            $relatedKey,
            $inverse
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function morphRelated(string $related, bool $inverse = false, ?string $table_key = null) {
        $name = 'post';
        $pivot = $this->getTableMorph($related, $inverse);
        $pivot_fields = app($pivot)->getFillable();

        if (null != $table_key) {
            $relation = $this->morphRelatedWithKey($related, $inverse, $table_key);
        } else {
            if ($inverse) {
                $relation = $this->morphedByMany($related, $name, $pivot);
            } else {
                $relation = $this->morphToMany($related, $name, $pivot);
            }
        }

        return $relation->using($pivot)
            ->withPivot($pivot_fields)
            ->withTimestamps()
            ->with(['post']) //Eager
        ;
    }

    /* deprecated
    public function morphRelated_FUNZIONAMA($related, $inverse = false) {
        if ($inverse) {
            $model = $this;
            $pivot = get_class($this).'Morph';
        } else {
            if (is_string($related)) {
                $pivot = $related.'Morph';
                $model = new $related();
            } else {
                $pivot = get_class($related).'Morph';
                $model = $related;
            }
        }
        $name = 'post';
        if (! class_exists($pivot)) {
            StubService::fromModel([
                'class' => $pivot,
                'stub' => 'morph_pivot', //con questo crea anche la migration
                'model' => $model,
            ]);
            dddx('Refresh Page ');
        }

        $pivot_table = with(new $pivot())->getTable();
        $pivot_fields = with(new $pivot())->getFillable();
        if ($inverse) {
            $foreignPivotKey = 'related_id';
            $relatedPivotKey = 'post_id';
        } else {
            $foreignPivotKey = 'post_id';
            $relatedPivotKey = 'related_id';
        }
        //$parentKey = 'post_id';
        $parentKey = 'id';

        $relatedKey = 'id';
        //dddx(app($related));
        Relation::morphMap([app($related)->post_type => $related]);

        return $this->morphToMany(
            $related,
            $name,
            $pivot_table,
            $foreignPivotKey,
            $relatedPivotKey,
            $parentKey,
            $relatedKey,
            $inverse
        )
            ->using($pivot)
            ->withPivot($pivot_fields)
            ->withTimestamps()
            ->with('post')
        ;
    }
    */
    //------- mutators -------------

    /**
     * @return bool|mixed|string
     */
    public function postType() {
        $post_type = collect(config('xra.model'))->search(get_class($this));
        if (false === $post_type) {
            $post_type = Str::snake(class_basename($this));
        }

        return $post_type;
    }

    public function getUserHandleAttribute(?string $value): ?string {
        return $value ?? optional($this->user)->handle;
        /*
        $user = $this->user;
        if (is_object($user)) {
            return $user->handle;
        }

        return 'john doe';
        */
    }

    public function getPostTypeAttribute(?string $value): ?string {
        if (null != $value) {
            return $value;
        }
        $post_type = collect(config('xra.model'))->search(get_class($this));
        if (false === $post_type) {
            $post_type = Str::snake(class_basename($this));
        }

        return $post_type;
    }

    public function getLangAttribute(?string $value): ?string {
        if (null != $value) {
            return $value;
        }

        $lang = App::getLocale();

        return $lang;
    }

    /**
     * @return mixed
     */
    public function getPostAttr(string $func, ?string $value) {
        $str0 = 'get';
        $str1 = 'Attribute';
        $name = substr($func, strlen($str0), -strlen($str1));
        $name = Str::snake($name);
        if (null != $value) {
            return $value;
        }
        if ('Post' == class_basename($this)) {
            return $this->$name;
        }

        if (isset($this->pivot) && Str::endsWith($name, '_url')) { // solo le url dipendono dal pivot
            return $this->pivot->$name; //.'#PIVOT';
        }

        //questo if mi crea la doppia riga in profile quando mi registro!!!!
        //\Debugbar::warning(! isset($this->post) && '' != $this->getKey());
        //\Debugbar::warning('$this->post: '.$this->post);
        //\Debugbar::warning('$this->getKey(): '.$this->getKey());
        /*
        if (! isset($this->post) && '' != $this->getKey()) {
            $this->post = $this->post()->create(['lang' => App::getLocale()]);
        }
        */
        //se commento questo if sembra che non produca più la doppia riga in posts
        //provato con creazione profilo, articolo, ristorante
        //...la domanda sorge spontanea: perchè è stato messo questo if???

        if (isset($this->post) && is_object($this->post)) {
            try {
                return $this->post->$name; //.'#NO-PIVOT';
            } catch (\ErrorException $e) {
                dddx([$this->post, $name]);
            }
        }
        /* //deprecated ??
        if (Str::endsWith($name, '_url')) {
            $act = Str::before($name, '_url');

            return RouteService::urlModel(['model' => $this, 'act' => $act]);
        }
        */

        return $value;
    }

    //---- da mettere i mancanti ---

    public function getTitleAttribute(?string $value): ?string {
        return $this->getPostAttr(__FUNCTION__, $value);
    }

    public function getSubtitleAttribute(?string $value): ?string {
        return $this->getPostAttr(__FUNCTION__, $value);
    }

    public function getGuidAttribute(?string $value): ?string {
        return $this->getPostAttr(__FUNCTION__, $value);
    }

    public function getImageSrcAttribute(?string $value): ?string {
        return $this->getPostAttr(__FUNCTION__, $value);
    }

    public function getTxtAttribute(?string $value): ?string {
        return $this->getPostAttr(__FUNCTION__, $value);
    }

    //*

    //
    // @param mixed $value
    //
    // @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
    // @throws \ReflectionException
    //
    // @return mixed
    //
    /* deprecated
    public function getUrlAttribute($value) {

        //return $this->getPostAttr(__FUNCTION__, $value);
        return Panel::get($this)->url();
    }

    //*/

    /* deprecated
    public function getRoutenameAttribute($value) {
        return $this->getPostAttr(__FUNCTION__, $value);
    }
    */
    /*
    public function setTitleAttribute(?string $value): void {
        $this->setPostAttr(__FUNCTION__, $value);
    }

    public function setSubtitleAttribute(?string $value): void {
        $this->setPostAttr(__FUNCTION__, $value);
    }
    */
    public function setGuidAttribute(?string $value): void {
        if ('' == $value && null != $this->post) {
            $this->post->guid = Str::slug($this->attributes['title'].' '.$this->attributes['subtitle']);
            $res = $this->post->save();
        }
    }

    /*
    public function setGuidAttribute(?string $value): void {
        $this->setPostAttr(__FUNCTION__, $value);
    }
    */

    public function setImageSrcAttribute(?string $value): void {
        $this->setPostAttr(__FUNCTION__, $value);
    }

    public function setTxtAttribute(?string $value): void {
        $this->setPostAttr(__FUNCTION__, $value);
    }

    public function setUrlAttribute(?string $value): void {
        $this->setPostAttr(__FUNCTION__, $value);
    }

    /*
     * @param mixed $value

    /* deprecated
    public function setRoutenameAttribute(?string $value) {
        return $this->setPostAttr(__FUNCTION__, $value);
    }
    */
    //--- attribute e' risertvato

    /**
     * @param mixed $value
     */
    public function setPostAttr(string $func, $value): void {
        $str0 = 'set';
        $str1 = 'Attribute';
        $name = substr($func, strlen($str0), -strlen($str1));
        $name = Str::snake($name);
        $data = [$name => $value];
        $data['lang'] = App::getLocale();
        //$this->post->$name=$value;
        //$res=$this->post->save();
        $this->post()->updateOrCreate($data);
        //print_r($data);
        unset($this->attributes[$name]);
    }

    /*//deprecated ??
    public function urlActFunc($func, $value) {
        $str0 = 'get';
        $str1 = 'Attribute';
        $name = substr($func, strlen($str0), -strlen($str1));
        $act = Str::snake($name);
        $act = substr($act, 0, -4);
        $url = RouteService::urlModel(['model' => $this, 'act' => $act]);

        return $url;
    }


    public function getEditUrlAttribute($value) {
        return $this->urlActFunc(__FUNCTION__, $value);
    }

    public function getMoveupUrlAttribute($value) {
        return $this->urlActFunc(__FUNCTION__, $value);
    }

    public function getMovedownUrlAttribute($value) {
        return $this->urlActFunc(__FUNCTION__, $value);
    }

    public function getShowUrlAttribute($value) {
        return $this->urlActFunc(__FUNCTION__, $value);
    }

    public function getIndexEditUrlAttribute($value) {
        return $this->urlActFunc(__FUNCTION__, $value);
    }

    public function getCreateUrlAttribute($value) {
        return $this->urlActFunc(__FUNCTION__, $value);
    }

    public function getUpdateUrlAttribute($value) {
        return $this->urlActFunc(__FUNCTION__, $value);
    }

    public function getDestroyUrlAttribute($value) {
        return $this->urlActFunc(__FUNCTION__, $value);
    }

    public function getDetachUrlAttribute($value) {
        return $this->urlActFunc(__FUNCTION__, $value);
    }
    //*/

    //----------------------------------------------
    /* deprecated
    public function imageResizeSrc(array $params){
        return '['.__FILE__.']['.__LINE__.']';
        $value = null;
        if (isset($this->post)) {
            $value = $this->post->imageResizeSrc($params);
        }

        return $value;
    }

    public function image_html(array $params){
        $value = null;
        if (isset($this->post)) {
            $value = $this->post->image_html($params);
        }

        return $value;
    }

    public function urlLang(array $params){
        return '['.__FILE__.']['.__LINE__.']';
        if (! isset($this->post)) {
            return '#';
        }

        return $this->post->urlLang($params);
    }
    */
    /* deprecated ??
    public function linkedFormFields():array {
        $roots = Post::getRoots();
        $view = 'blog::admin.partials.'.Str::snake(class_basename($this));

        return view()->make($view)->with('row', $this->post)->with($roots);
    }
    //*/
    //------------------------------------

    /**
     * Undocumented function.
     *
     * @return Model|\Modules\Blog\Models\XotBaseModel|\Modules\Blog\Models\BaseModelLang|null
     */
    public function item(string $guid) {
        $post_table = with(new Post())->getTable();
        if (RouteService::inAdmin()) {
            $rows = $this->join($post_table, $post_table.'.post_id', '=', $this->getTable().'.id')
                ->where('lang', $this->lang)
                ->where($post_table.'.post_id', $guid)
                ->where($post_table.'.post_type', $this->post_type)
            ;
        } else {
            $rows = $this->join($post_table, $post_table.'.post_id', '=', $this->getTable().'.id')
                ->where('lang', $this->lang)
                ->where($post_table.'.guid', $guid)
                ->where($post_table.'.post_type', $this->post_type)
            ;
        }

        /*
        return $query->join($post_table.' as post', function ($join) {
            $join->on('post.post_id', '=', $this->getTable().'.id')
                ->select('title', 'guid', 'subtitle')
                ->where('lang', $this->lang)
                ->where('post.post_type', $this->post_type)
                //->limit(1)
            ;
        });
        */

        /* -- testare i tempi
        $rows=$this->whereHas('post',function($query) use($guid){
        $query->where('guid',$guid);
        });
         */
        return $rows->first();
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \ReflectionException
     */
    public function fixItemLang(string $item_guid): void {
        $item_guid = str_replace('%20', '%', $item_guid);
        $item_guid = str_replace(' ', '%', $item_guid);
        $panel = Panel::get($this);
        $other_lang = Post::query()
            ->where('post_type', $panel->postType())
            ->where('guid', 'like', $item_guid)
            ->first();
        if (is_object($other_lang)) {
            $up = $other_lang->replicate();
            $up->lang = App::getLocale();
            $up->save();
            //$row = self::firstOrCreate(['post_id' => $up->post_id]);
            //$row = $this->firstOrCreate(['post_id' => $up->post_id]);

            //return $row;
        }
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfItem($query, string $guid) {
        //getRouteKeyName
        if (RouteService::inAdmin()) {
            return $query->where('post_id', $guid);
        //return $query->where('post.post_id',$guid);
        } else {
            return $query->whereHas('post', function ($query) use ($guid): void {
                $query->where('guid', $guid);
            });
        }
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithPost($query, string $guid) {
        return $query; //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        /* depreated ??
        $post_table = with(new Post())->getTable();

        return $query->join($post_table.' as post', function ($join) {
            $join->on('post.post_id', '=', $this->getTable().'.id')
                ->select('title', 'guid', 'subtitle')
                ->where('lang', $this->lang)
                ->where('post.post_type', $this->post_type)
                //->limit(1)
            ;
        });
        */
    }

    //---------------------------------
    /*
    public function listItemSchemaOrg(array $params){
        $tmp = explode('\\', get_class($this));
        $ns = Str::snake($tmp[1]);
        $pack = Str::snake($tmp[3]);
        $view = $ns.'::schema_org.list_item.'.$pack;
        if (! view()->exists($view)) {
            ddd('not exists ['.$view.']');
        }
        $row = $this;
        foreach ($params as $k => $v) {
            $row->$k = $v;
        }

        return view()->make($view)->with('row', $row);
    }
    */

    /*
     * @param $container
     *
     * @return string
     */
    /* deprecated ?
    public function urlNextContainer($container) {
        //ddd($this->post->pivot);
        //ddd($this->post);
        //$params = optional(\Route::current())->parameters();
        $params = Route::current()->parameters();
        list($containers, $items) = params2ContainerItem($params);
        $container_n = collect($containers)->search($this->post_type);
        $act = 'index';
        $tmp = [];
        for ($i = 0; $i <= $container_n + 1; ++$i) {
            $tmp[] = 'container'.$i;
        }
        $path = implode('.', $tmp);
        //$ns='pub_theme';
        $routename = $path.'.'.$act;
        $parz = $params;
        $parz['item'.($container_n + 0)] = $this;
        $parz['container'.($container_n + 1)] = $container;
        //it/{container0}/{item0}/{container1}/{item1}/{container2}
        $route = route($routename, $parz);

        return $route;
    }
    */
}
