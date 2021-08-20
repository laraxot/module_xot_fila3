<?php

namespace Modules\Xot\Http\Controllers;

use Modules\Blog\Models\Post;

/**
 * Class SiteMapController.
 * https://kaloraat.com/articles/create-a-dynamic-xml-sitemap-in-laravel
 * https://laraget.com/blog/generate-a-simple-xml-sitemap-using-laravel.
 */
class SiteMapController {
    public function sitemap() {
        return 'wip';
        $posts = Post::all();
        dddx($posts);
    }
}
