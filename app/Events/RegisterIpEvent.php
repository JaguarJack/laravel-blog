<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;


class RegisterIpEvent
{
    use SerializesModels;
    
    public $ips;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($ips)
    {
        $this->ips = $ips;
    }
    
}
