<?php

declare(strict_types=1);

namespace Modules\Xot\Models;

//--- TRAITS ---
use Modules\Xot\Models\Traits\WidgetTrait;
use Sushi\Sushi;

//------ ext models---

/**
 * Modules\Xot\Models\Home.
 *
 * @property int                                                                   $id
 * @property string|null                                                           $created_by
 * @property string|null                                                           $updated_by
 * @property string|null                                                           $deleted_by
 * @property \Illuminate\Support\Carbon|null                                       $created_at
 * @property \Illuminate\Support\Carbon|null                                       $updated_at
 * @property string|null                                                           $icon_src
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\Xot\Models\Widget[] $containerWidgets
 * @property int|null                                                              $container_widgets_count
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\Xot\Models\Image[]  $images
 * @property int|null                                                              $images_count
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\Xot\Models\Widget[] $widgets
 * @property int|null                                                              $widgets_count
 * @method static \Illuminate\Database\Eloquent\Builder|Home newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Home newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Home ofLayoutPosition($layout_position)
 * @method static \Illuminate\Database\Eloquent\Builder|Home query()
 * @method static \Illuminate\Database\Eloquent\Builder|Home whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Home whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Home whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Home whereIconSrc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Home whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Home whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Home whereUpdatedBy($value)
 * @mixin \Eloquent
 * @property string|null $name
 * @method static \Modules\Xot\Database\Factories\HomeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Home whereName($value)
 */
class Home extends BaseModel {
    use WidgetTrait;
    use Sushi;

    /**
     * @var string[]
     */
    protected $fillable = ['id', 'icon_src'];

    /**
     * Undocumented variable.
     *
     * @var array
     */
    protected $rows = [
        [
            'id' => 'home',
            'name' => 'New York',
            'icon_src' => '',
            'created_by' => 'xot',
            'updated_by' => 'xot',
        ],
    ];
}