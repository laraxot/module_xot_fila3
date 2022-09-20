<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Modules\Blog\Models\Post;

/**
 * Class SiteMapController.
 * https://kaloraat.com/articles/create-a-dynamic-xml-sitemap-in-laravel
 * https://laraget.com/blog/generate-a-simple-xml-sitemap-using-laravel.
 */
<<<<<<< HEAD
class SiteMapController {
=======
class SiteMapController
{
>>>>>>> ae3a261 (up)
    /*
    public function sitemap()
    {
        //return 'wip';

        //indicizzare solo i modelli traducibili?
        $posts = Post::groupBy('post_type')
            ->selectRaw('post_type')
            ->get();

        $posts = $posts->map(function ($item) {
            return $item->post_type;
        })->all();

        $posts = Arr::where($posts, function ($value) {
            if (null !== $value) {
                return $value;
            }
            if (! Str::contains($value, 'Modules')) {
                return $value;
            }
        });

        $items = collect();

        foreach ($posts as $post) {
            //$new_collection = xotModel($post)::with('post')->get();
            try {
                if (is_object(xotModel($post))) {
                    $new_collection = xotModel($post)::all()->map(function ($item) {
                        if ($item->post) {
                            return $item;
                        }
                    })->filter(function ($value) {
                        return ! is_null($value);
                    });
                    //qui non so se prenderli tutti oppure una parte, ho letto che il sitemap non può essere più grande di tot mega
                }
            } catch (\Throwable $th) {
                dddx(['elemento non valido '.$post, $posts]);
            }

            $items = $items->merge($new_collection);
        }

        //dddx($items);

        return response()->view('xot::sitemap', [
            'items' => $items,
        ])->header('Content-Type', 'text/xml');
    }
    */

<<<<<<< HEAD
    public function index(): ?Response {
=======
    public function index(): ?Response
    {
>>>>>>> ae3a261 (up)
        /*
        $limit = 50;
        $lang = app()->getLocale();
        $rows = Post::where('lang', $lang)
            //->whereHas('linkable') /
            ->limit($limit)
            ->get()
            ->filter(function ($item) {
                try {
                    $linkable = $item->linkable;
                } catch (\Exception $e) {
                    $linkable = null;
                } catch (\Error $e) {
                    $linkable = null;
                }

                return is_object($linkable);
            });
        $view = 'xot::sitemap.index';
        $view_params = [
            'view' => $view,
            'rows' => $rows,
        ];

        return response()->view($view, $view_params)
            ->header('Content-Type', 'text/xml');
        */
        return null;
    }
}
