<?php
/**
 * https://blog.madbob.org/routing-reactphp-with-laravel/.
 */

declare(strict_types=1);

namespace Modules\Xot\Console;

use App;
use Illuminate\Console\Command;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Symfony\Component\HttpFoundation\Response;

class RunServer extends Command {
    protected $signature = 'run:server';
    protected $description = 'Run asyncronous server';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        $loop = \React\EventLoop\Factory::create();
        $kernel = App::make(\Illuminate\Contracts\Http\Kernel::class);

        $psr17Factory = new Psr17Factory();
        $symfonyHttpFactory = new HttpFoundationFactory();
        $psrHttpFactory = new PsrHttpFactory($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory);

        $server = new \React\Http\Server(function (ServerRequestInterface $request) use ($kernel, $symfonyHttpFactory, $psrHttpFactory) {
            /*
              Here, the incoming PSR-7 Request is transformed into a Laravel Request
            */
            $symfonyRequest = $symfonyHttpFactory->createRequest($request);
            $laravelRequest = \Illuminate\Http\Request::createFromBase($symfonyRequest);

            $laravelResponse = $kernel->handle($laravelRequest);

            /*
              Here, the Laravel Response is transformed into a PSR-7 Response
            */
            $response = $psrHttpFactory->createResponse($laravelResponse);

            return $response;
        });

        $socket = new \React\Socket\Server(8080, $loop);
        $server->listen($socket);

        $loop->run();
    }
}
