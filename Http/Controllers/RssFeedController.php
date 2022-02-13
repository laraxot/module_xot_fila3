<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Controllers;

use Illuminate\Support\Facades\Response;

/**
 * Class RssFeedController.
 * https://devdojo.com/bobbyiliev/how-to-add-a-simple-rss-feed-to-laravel-without-using-package.
 */
class RssFeedController
{
    public function feed(string $lang, string $item): \Illuminate\Http\Response
    {
        $items = xotModel($item)::with('post')
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get();

        return response()
            ->view('xot::rss.feed', ['items' => $items, 'lang' => $lang])
            ->header('Content-Type', 'application/xml');
    }
}
