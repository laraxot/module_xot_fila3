<?php
/**
 * https://chasboon.ir/failed-jobs-in-laravel
 */

namespace Modules\Xot\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Arr;

class WorkerRetry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'worker:retry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'retry all failed jobs';

    /**
     * Create a new command instance.
     *
     * @return void
     */


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
            $ids = Arr::pluck($this->laravel['queue.failer']->all(), 'id');
        foreach ($ids as $id) {
            $this->retryJob($id);
        }
    }

    protected function retryJob($id)
    {
        $failed = $this->laravel['queue.failer']->find($id);

        if (! is_null($failed)) {
            $failed = (object) $failed;

            $failed->payload = $this->resetAttempts($failed->payload);

            $this->laravel['queue']->connection($failed->connection)
                ->pushRaw($failed->payload, $failed->queue);

            $this->laravel['queue.failer']->forget($failed->id);

            $this->info("The failed job [{$id}] has been pushed back onto the queue!");
        } else {
            $this->error("No failed job matches the given ID [{$id}].");
        }
    }

    protected function resetAttempts($payload)
    {
        $payload = json_decode($payload, true);

        if (isset($payload['attempts'])) {
            $payload['attempts'] = 1;
        }

        return json_encode($payload);
    }

}