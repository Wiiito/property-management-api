<?php

namespace App\Jobs;

use App\Mail\OwnerConfirmationMail;
use App\Models\Owner;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailSendJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected Owner $owner) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::send(new OwnerConfirmationMail($this->owner));
    }
}
