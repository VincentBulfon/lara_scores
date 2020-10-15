<?php

namespace App\Listeners;

use App\Events\MatchCreated;
use App\Jobs\SendMatchCreatedEmailToMatchCreator;

class MatchCreatedNotification
{
    public $event;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(MatchCreated $event)
    {
        $this->event = $event;
    }

    /**
     * Handle the event.
     *
     * @param  MatchCreated  $event
     * @return void
     */
    public function handle()
    {
        SendMatchCreatedEmailToMatchCreator::dispatch($this->event);
    }
}
