<?php

declare(strict_types=1);

/**
 * https://devdojo.com/devdojo/simple-laravel-route-testing.
 */

namespace Modules\Xot\Tests\Feature;

use Illuminate\Support\Facades\App;
use Tests\TestCase;

<<<<<<< HEAD
class RouteTest extends TestCase {
=======
class RouteTest extends TestCase
{
>>>>>>> 9472ad4 (first)
    /**
     * A basic test example.
     *
     * @return void
     */
<<<<<<< HEAD
    public function testRoutes() {
        // dddx('/'.App::getlocale().'/home');
=======
    public function testRoutes()
    {
        //dddx('/'.App::getlocale().'/home');
>>>>>>> 9472ad4 (first)

        $appURL = env('APP_URL');

        $urls = [
            '/',
            // '/'.App::getlocale().'/',
            // '/home',
<<<<<<< HEAD
            // '/'.App::getlocale().'/home', //questo url mi da errore
=======
            //'/'.App::getlocale().'/home', //questo url mi da errore
>>>>>>> 9472ad4 (first)
        ];

        echo PHP_EOL;

        foreach ($urls as $url) {
            $response = $this->get($url);
            if (200 !== (int) $response->status()) {
                echo $appURL.$url.' (FAILED) did not return a 200.';
<<<<<<< HEAD
                static::assertTrue(false);
            } else {
                echo $appURL.$url.' (success ?)';
                static::assertTrue(true);
=======
                $this->assertTrue(false);
            } else {
                echo $appURL.$url.' (success ?)';
                $this->assertTrue(true);
>>>>>>> 9472ad4 (first)
            }
            echo PHP_EOL;
        }
    }
}
