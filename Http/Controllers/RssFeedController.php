<?php

namespace Modules\Xot\Http\Controllers;

/**
 * Class RssFeedController.
 * https://devdojo.com/bobbyiliev/how-to-add-a-simple-rss-feed-to-laravel-without-using-package.
 */
class RssFeedController {
    public function feed($lang, $item) {
        return 'wip';

        $items = xotModel($item)::with('post')
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get();

        return response()
            ->view('xot::rss.feed', ['items' => $items, 'lang' => $lang])
            ->header('Content-Type', 'application/xml');
    }
}
