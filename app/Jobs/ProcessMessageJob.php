<?php

namespace App\Jobs;

use App\Events\MessageSent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ProcessMessageJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected int $id,public $message)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        broadcast(new MessageSent($this->id,$this->message));
    }
}
