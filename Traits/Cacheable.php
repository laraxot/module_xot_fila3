<?php

declare(strict_types=1);

namespace Modules\Xot\Traits;

use Carbon\Carbon;
use Closure;
use Illuminate\Cache\CacheManager;
use Illuminate\Database\Eloquent\Model;

/**
 * Trait Cacheable.
 */
<<<<<<< HEAD
trait Cacheable {
=======
trait Cacheable
{
>>>>>>> 9472ad4 (first)
    /**
     * Cache instance.
     *
     * @var CacheManager
     */
    protected static ?CacheManager $cache = null;

    /**
     * Flush the cache after create/update/delete events.
     */
    protected bool $eventFlushCache = false;

    /**
     * Global lifetime of the cache.
     */
    protected int $cacheMinutes = 60;

    /**
     * Set cache manager.
     */
<<<<<<< HEAD
    public static function setCacheInstance(CacheManager $cache) {
=======
    public static function setCacheInstance(CacheManager $cache)
    {
>>>>>>> 9472ad4 (first)
        self::$cache = $cache;
    }

    /**
     * Get cache manager.
     *
     * @return CacheManager
     */
<<<<<<< HEAD
    public static function getCacheInstance() {
=======
    public static function getCacheInstance()
    {
>>>>>>> 9472ad4 (first)
        if (null === self::$cache) {
            self::$cache = app('cache');
        }

        return self::$cache;
    }

    /**
     * Determine if the cache will be skipped.
     *
     * @return bool
     */
<<<<<<< HEAD
    public function skippedCache() {
=======
    public function skippedCache()
    {
>>>>>>> 9472ad4 (first)
        return false === config('repositories.cache_enabled', false)
            || true === app('request')->has(config('repositories.cache_skip_param', 'skipCache'));
    }

    /**
     * Get Cache key for the method.
     *
     * @param mixed $args
     *
     * @return string
     */
<<<<<<< HEAD
    public function getCacheKey(string $method, $args, string $tag) {
=======
    public function getCacheKey(string $method, $args = null, string $tag)
    {
>>>>>>> 9472ad4 (first)
        // Sort through arguments
        foreach ($args as &$a) {
            if ($a instanceof Model) {
                $a = \get_class($a).'|'.$a->getKey();
            }
        }

        // Create hash from arguments and query
<<<<<<< HEAD
        $args = serialize($args).serialize($this->getScopeQuery());

        return sprintf(
=======
        $args = \serialize($args).\serialize($this->getScopeQuery());

        return \sprintf(
>>>>>>> 9472ad4 (first)
            '%s-%s@%s-%s',
            config('app.locale'),
            $tag,
            $method,
<<<<<<< HEAD
            md5($args)
=======
            \md5($args)
>>>>>>> 9472ad4 (first)
        );
    }

    /**
     * Get an item from the cache, or store the default value.
     *
<<<<<<< HEAD
     * @param mixed|null $time
     *
     * @return mixed
     */
    public function cacheCallback(string $method, array $args, Closure $callback, $time = null) {
=======
     * @return mixed
     */
    public function cacheCallback(string $method, array $args, Closure $callback, $time = null)
    {
>>>>>>> 9472ad4 (first)
        // Cache disabled, just execute query & return result
        if (true === $this->skippedCache()) {
            return \call_user_func($callback);
        }

        // Use the called class name as the tag
<<<<<<< HEAD
        $tag = static::class;
=======
        $tag = \get_called_class();
>>>>>>> 9472ad4 (first)

        return self::getCacheInstance()->tags(['repositories', $tag])->remember(
            $this->getCacheKey($method, $args, $tag),
            $this->getCacheExpiresTime($time),
            $callback
        );
    }

    /**
     * Flush the cache for the given repository.
     *
     * @return bool
     */
<<<<<<< HEAD
    public function flushCache() {
=======
    public function flushCache()
    {
>>>>>>> 9472ad4 (first)
        // Cache disabled, just ignore this
        if (false === $this->eventFlushCache || false === config('repositories.cache_enabled', false)) {
            return false;
        }

        // Use the called class name as the tag
<<<<<<< HEAD
        $tag = static::class;
=======
        $tag = \get_called_class();
>>>>>>> 9472ad4 (first)

        return self::getCacheInstance()->tags(['repositories', $tag])->flush();
    }

    /**
     * Return the time until expires in minutes.
     *
     * @param int $time
     *
     * @return int
     */
<<<<<<< HEAD
    protected function getCacheExpiresTime($time = null) {
        if (self::EXPIRES_END_OF_DAY === $time) {
            return class_exists(Carbon::class)
                ? round(Carbon::now()->secondsUntilEndOfDay() / 60)
=======
    protected function getCacheExpiresTime($time = null)
    {
        if (self::EXPIRES_END_OF_DAY === $time) {
            return \class_exists(Carbon::class)
                ? \round(Carbon::now()->secondsUntilEndOfDay() / 60)
>>>>>>> 9472ad4 (first)
                : $this->cacheMinutes;
        }

        return $time ?: $this->cacheMinutes;
    }
}
