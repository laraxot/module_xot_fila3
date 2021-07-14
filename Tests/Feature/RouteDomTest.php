<?php

declare(strict_types=1);

/**
 * https://devdojo.com/devdojo/simple-laravel-route-testing.
 */

namespace Modules\Xot\Tests\Feature;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Tests\TestCase;

class RouteDomTest extends TestCase {
    /**
     * A basic test example.
     */
    public function testRoutes(): void {
        $urls = [
            '/',
            //'/'.App::getlocale().'/home', //questo url mi da errore
        ];
        //dd(get_class_methods($this));
        $this->checkLinks($urls);
    }

    public function checkLinks($urls, $depth = 0): void {
        $base_url = env('APP_URL');

        if ($depth > 5) {
            return;
        }
        $i = 0;

        foreach ($urls as $url) {
            /*
            if ($i++ > 3) {
                return;
            }
            */
            $url = str_replace('index.php', '', $url);
            $response = $this->get($url);
            $html = $response->getContent();
            //dd(get_class_methods($response));
            //dd($response->streamedContent());The response is not a streamed response
            $status = (int) $response->status();
            if (! in_array($status, [200, 302])) {
                echo $base_url.$url.' (FAILED) did not return a 200 or 302 ['.$response->status().'].'.chr(13);
                //dd($base_url.$url);
                $this->assertTrue(false);
            } else {
                echo $base_url.$url.' (success ?)'.chr(13);
                $this->assertTrue(true);
            }
            echo PHP_EOL;
            $dom = $this->dom($html);
            //$links = $dom->filter('a')->links();
            $links = $dom->filter('a')->each(
                function ($node) {
                    return $node->attr('href');
                }
            );
            $links = collect($links)->filter(
                function ($item) {
                    return ! Str::startsWith($item, 'mailto:') &&
                        ! Str::startsWith($item, 'https://mail.') &&
                        Str::startsWith($item, '/')
                        ;
                }
            )->all();

            $this->checkLinks($links, $depth + 1);
        }
    }

    /*
    The URL of the element is relative,
    so you must define its base URI passing an absolute URL to the constructor of the
    "Symfony\Component\DomCrawler\AbstractUriElement" class ("" was passed)
    */
    private function dom($html) {
        $dom = new \Symfony\Component\DomCrawler\Crawler();
        $dom->addHTMLContent($html, 'UTF-8');

        return $dom;
    }
}