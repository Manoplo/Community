<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\LinkCreated;

class sendLink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:link';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends an email with a link to the admin';

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
     * @return int
     */
    public function handle()
    {
        $details = [
            'title' => 'New links created',
            'body' => 'You have new links created since last visit'
        ];
        Mail::to('fawexep599@mxclip.com')->send(new LinkCreated($details));
    }
}
