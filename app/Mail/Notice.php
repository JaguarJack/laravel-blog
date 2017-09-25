<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Notice extends Mailable
{
    use Queueable, SerializesModels;
    protected $message;
    protected $title;
    protected $user_name;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $message = [])
    {
        $this->message  = $message['title'] ?? '注册邮箱激活';
        $this->url      = $message['url'] ?? '/';
        $this->user_name = $message['user_name'] ?? '游客';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->message)
                    ->view('home.mail.index')
                    ->with([
                        '_message'  => $this->message,
                        '_url'      => $this->url,
                        'user_name' => $this->user_name,
                    ]);
    }
}
