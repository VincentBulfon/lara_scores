<?php

namespace App\Jobs;

use App\Events\MatchCreated;
use App\Mail\MatchAdded;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMatchCreatedEmailToMatchCreator implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $match;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(MatchCreated $event)
    {
        $this->match = $event->match;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(MatchCreated $event)
    {
        dd($this->match);
        Mail::to('vincent.bulfon@student.hepl.be')->send(new MatchAdded($event->match));
    }
}
