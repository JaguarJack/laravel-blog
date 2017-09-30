<?php

namespace App\Listeners;

use App\Events\RegisterIpEvent;
use App\Http\Requests\Request;

class RegisterIpListener
{
    protected $request;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    /**
     * Handle the event.
     *
     * @param  Event  $event
     * @return void
     */
    public function handle(RegisterIpEvent $event)
    {
        return $event->ips->store($this->request->ip());
    }
}
