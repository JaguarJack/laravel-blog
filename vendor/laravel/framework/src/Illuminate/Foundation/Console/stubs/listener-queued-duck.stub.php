<?php

namespace DummyNamespace;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DummyClass implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * The events handled by the listener.
     *
     * @var array
     */
    public static $listensFor = [
        //
    ];

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
    }
}
