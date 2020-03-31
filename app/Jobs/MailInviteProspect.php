<?php

namespace App\Jobs;

use Mail;
use App\Prospect;
use App\Mail\ProspectInvite;
use Illuminate\Bus\Queueable;
use App\Events\EmailWasSentToProspect;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class MailInviteProspect implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $prospect;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Prospect $prospect)
    {
        $this->prospect = $prospect;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mailgunVariables =  json_encode([
            'type' => 'prospect',
            'mail' => 'initial invite',
            'id' => $this->prospect->id,
        ]);

        // Send the email
        Mail::to($this->prospect->user_email)
            ->send(new ProspectInvite($this->prospect), [], function($message) use ($mailgunVariables) {
                $message->getHeaders()->addTextHeader('X-Mailgun-Variables', $mailgunVariables);
            });

        // Emit an event once an email has been sent
        event(new EmailWasSentToProspect($this->prospect));
    }
}
