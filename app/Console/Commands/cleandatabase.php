<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class cleandatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:cleandatabase';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command Clean database';

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
        DB::table('posts')
            ->where('created_at',  '<=',Carbon::now()->subMinute(2))
            ->where('status','=','private')
            ->delete();
    }
}
