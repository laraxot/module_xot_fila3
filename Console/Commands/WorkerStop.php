<?php

/**
 * @see https://www.egeniq.com/blog/how-gracefully-stop-laravel-cli-command
 */

declare(strict_types=1);


namespace Modules\Xot\Console\Commands;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Queue\Worker;
use Illuminate\Console\Command;

class WorkerStop extends Command {
    protected $signature = 'worker:stop';

    protected $description = 'Demonstration worker that gracefully stops on exit';

    private $run = true;

    public function fire() {
        // PHP 7.0 and before can handle asynchronous signals with ticks
        declare(ticks=1);
        
        // PHP 7.1 and later can handle asynchronous signals natively
        pcntl_async_signals(true);
        
        pcntl_signal(SIGINT, [$this, 'shutdown']); // Call $this->shutdown() on SIGINT
        pcntl_signal(SIGTERM, [$this, 'shutdown']); // Call $this->shutdown() on SIGTERM

        $this->info('Worker started');

        $worker = new Worker();
        while ($this->run) {
            $worker->work();
        }

        $this->info('Worker stopped');
    }

    public function shutdown() {
        $this->info('Gracefully stopping worker...');

        // When set to false, worker will finish current item and stop.
        $this->run = false;
    }
}