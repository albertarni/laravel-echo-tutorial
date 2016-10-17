<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\OrderShipped;

class SendOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send order';

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
        event(new OrderShipped('test message'));
    }
}
