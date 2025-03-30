<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\users;
use App\Models\winner;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class ResetScore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset-score';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset Points of all users to zero and declare a winner if applicable';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        info("Reset all Scores ". now());
        DB::table('Users')->update(['points' => '0']);
        $highestScore = users::max('points');
        $this->info('Points Reset successfully!');
    }
    
}
