<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Traits;

<<<<<<< HEAD
// use Laravel\Scout\Searchable;

// ----- models------
use Illuminate\Database\Eloquent\Builder;
use Modules\Xot\Models\Widget;

// ---- services -----
// use Modules\Xot\Services\PanelService;

// ------ traits ---
=======
//use Laravel\Scout\Searchable;

//----- models------
use Illuminate\Database\Eloquent\Builder;
use Modules\Xot\Models\Widget;

//---- services -----
//use Modules\Xot\Services\PanelService;

//------ traits ---
>>>>>>> 9472ad4 (first)

/**
 * Trait WidgetTrait.
 */
<<<<<<< HEAD
trait WidgetTrait {
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function widgets() {
        // questo sarebbe itemWidgets, ma teniamo questo nome
        return $this->morphMany(Widget::class, 'post')
            // ->whereNull('layout_position')
=======
trait WidgetTrait
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function widgets()
    {
        //questo sarebbe itemWidgets, ma teniamo questo nome
        return $this->morphMany(Widget::class, 'post')
            //->whereNull('layout_position')
>>>>>>> 9472ad4 (first)
            ->where(
                function ($query) {
                    $query->where('layout_position', '')
                        ->orWhereNull('layout_position');
                }
            )
            ->orderBy('pos');
    }

<<<<<<< HEAD
    public function containerWidgets(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(Widget::class, 'post_type', 'post_type')
            ->orderBy('pos');
        // ->whereNull('post_id');
    }

    // non sembra funzionare, perchè?
=======
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function containerWidgets():\Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Widget::class, 'post_type', 'post_type')
            ->orderBy('pos');
        //->whereNull('post_id');
    }

    //non sembra funzionare, perchè?
>>>>>>> 9472ad4 (first)

    /**
     * @param Builder $query
     * @param string  $layout_position
     *
     * @return mixed
     */
<<<<<<< HEAD
    public function scopeOfLayoutPosition($query, $layout_position) {
=======
    public function scopeOfLayoutPosition($query, $layout_position)
    {
>>>>>>> 9472ad4 (first)
        return $query->where('layout_position', $layout_position);
    }
}
