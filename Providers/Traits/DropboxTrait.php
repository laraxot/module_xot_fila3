<?php

declare(strict_types=1);

namespace Modules\Xot\Providers\Traits;

use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;
use Spatie\Dropbox\Client as DropboxClient;
use Spatie\FlysystemDropbox\DropboxAdapter;

<<<<<<< HEAD
trait DropboxTrait {
    // lo riabilitiamo in futuro
    private function registerDropbox(): void {
        Storage::extend(
            'dropbox', function ($app, $config) {
                // dddx($config);
=======
trait DropboxTrait
{
    // lo riabilitiamo in futuro
    private function registerDropbox(): void
    {
        Storage::extend(
            'dropbox', function ($app, $config) {
                //dddx($config);
>>>>>>> 9472ad4 (first)

                $client = new DropboxClient($config['authorizationToken']);
                $adapter = new DropboxAdapter($client);
                $filesystem = new Filesystem($adapter, ['case_sensitive' => false]);

                return $filesystem;
            }
        );
    }
}
