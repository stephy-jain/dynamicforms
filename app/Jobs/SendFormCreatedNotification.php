<?php

namespace App\Jobs;

use App\Notifications\FormCreatedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendFormCreatedNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $form;
    /**
     * Create a new job instance.
     */
    public function __construct($form)
    {
        //
        $this->form = $form;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
//        Mail::to('stephyjain11@gmail.com')->send(new FormCreatedNotification($this->form));



        $subject = "New Form Created";
        $content = "A new form has been created. Form Name: " . $this->form->name;

        // Send a simple mail with custom subject and content
        Mail::raw($content, function ($message) use ($subject) {
            $message->to('stephyjain11@gmail.com')
                ->subject($subject);
        });
    }
}
