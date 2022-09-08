<?php
/**
 * https://laravelproject.com/laravel-filtering-query-using-pipelines/.
 * https://jeffochoa.me/understanding-laravel-pipelines.
 * https://dev.to/abrardev99/pipeline-pattern-in-laravel-278p.
 * https://www.codecheef.org/article/laravel-pipeline-interpretation-with-example.
 */
declare(strict_types=1);

namespace Modules\Xot\QueryFilters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

<<<<<<< HEAD
class Status {
=======
class Status
{
>>>>>>> 9472ad4 (first)
    /**
     * Undocumented function.
     *
     * @param Builder $query
     *
     * @return Closure
     */
<<<<<<< HEAD
    public function handle($query, Closure $next) {
=======
    public function handle($query, Closure $next)
    {
>>>>>>> 9472ad4 (first)
        if (request()->has('status')) {
            $query->where('status', request('status'));
        }

<<<<<<< HEAD
        // $next($builder);
=======
        //$next($builder);
>>>>>>> 9472ad4 (first)
        // Here you perform the task and return the updated $content
        // to the next pipe
        return $next($query);
    }
}

/*
use Illuminate\Pipeline\Pipeline;



class PostController
{
    public function index(Request $request)
    {
        $query = Post::query();

        $posts = app(Pipeline::class)
                ->send($query)
                ->through([
                    \App\QueryFilters\Status::class,
                    \App\QueryFilters\OrderBy::class,
                ])
                ->thenReturn()
                ->get();

        return view('post.index', compact('posts'));
    }
}

 */
/*
app(Pipeline::class)
    ->send($content)
    ->through($pipes)
    ->via(‘customMethodName’) // <---- This one :)
    ->then(function ($content) {
        return Post::create(['content' => $content]);
    });
    */
