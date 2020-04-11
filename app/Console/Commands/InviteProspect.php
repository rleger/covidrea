<?php

namespace App\Console\Commands;

use App\Prospect;
use Illuminate\Console\Command;
use App\Jobs\MailInviteProspect;

class InviteProspect extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prospect:invite';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send invitation to prospects';

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
        $prospects = Prospect::isActive()->where('user_email', '!=', '')->get();

        $nb_emails_sent = 0;

        $prospects->each(function($prospect) use (&$nb_emails_sent) {
            // Send invite email
            MailInviteProspect::dispatch($prospect);

            // Show message in command line
            $this->info("Envoi email à " . $prospect->etab_name . " (" . $prospect->user_email . ")");

            // Increase counter
            $nb_emails_sent++;
        });

        $this->info("-----------------------------------");
        $this->info($nb_emails_sent ." emails envoyés");
    }
}
