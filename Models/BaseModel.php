<?php

declare(strict_types=1);

namespace Modules\Xot\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
<<<<<<< HEAD
// use Laravel\Scout\Searchable;
// ---------- traits
=======
//use Laravel\Scout\Searchable;
//---------- traits
>>>>>>> 9472ad4 (first)

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Xot\Services\FactoryService;
use Modules\Xot\Traits\Updater;

/**
 * Class BaseModel.
 */
<<<<<<< HEAD
abstract class BaseModel extends Model {
    use HasFactory;
    // use Searchable;
    // use Cachable;
    use Updater;
    /**
     * Indicates whether attributes are snake cased on arrays.
     *
     * @see  https://laravel-news.com/6-eloquent-secrets
     *
     * @var bool
     */
     public static $snakeAttributes = true;

    protected $perPage = 30;
=======
abstract class BaseModel extends Model
{
    use Updater;
    //use Searchable;
    //use Cachable;
    use HasFactory;
>>>>>>> 9472ad4 (first)

    /**
     * @var string
     */
    protected $connection = 'mysql'; // this will use the specified database conneciton

    /**
     * @var string[]
     */
    protected $fillable = ['id'];
    /**
<<<<<<< HEAD
     * @var array<string, string>
     */
    protected $casts = [
        // 'published_at' => 'datetime:Y-m-d', // da verificare
=======
     * @var array
     */
    protected $casts = [
        //'published_at' => 'datetime:Y-m-d', // da verificare
>>>>>>> 9472ad4 (first)
    ];

    /**
     * @var string[]
     */
    protected $dates = ['published_at', 'created_at', 'updated_at'];
    /**
     * @var string
     */
    protected $primaryKey = 'id';
    /**
     * @var bool
     */
    public $incrementing = true;
    /**
<<<<<<< HEAD
     * @var array<int, string>
     */
    protected $hidden = [
        // 'password'
=======
     * @var array
     */
    protected $hidden = [
        //'password'
>>>>>>> 9472ad4 (first)
    ];
    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
<<<<<<< HEAD
    public function images() {
=======
    public function images()
    {
>>>>>>> 9472ad4 (first)
        return $this->morphMany(Image::class, 'post');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
<<<<<<< HEAD
    protected static function newFactory() {
        return FactoryService::newFactory(static::class);
=======
    protected static function newFactory()
    {
        return FactoryService::newFactory(get_called_class());
>>>>>>> 9472ad4 (first)
    }
}
