<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\users;
use App\Models\winner;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class WinnerDeclared extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:winnerDeclared';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'For winner of the game';

    /**
     * Execute the console command.
     */
    public function handle()
    {
    $this->info("Cron Job running at ". now());
    $highestScore = users::max('points');
    $usersWithHighestScore = users::where('points', $highestScore)->count();
    if ($usersWithHighestScore == 1) {
        $winner = users::where('points', $highestScore)->first();
        winner::create([
            'user_id' => $winner->id,
            'username' => $winner->name,
            'status' => 'winner',
            'declared_at' => Carbon::now(),
            'highestpoint' => $winner->points
        ]);
        $this->info('Winner declared successfully!');
    } else {
         $this->info('No winner declared due to a tie.');
    }
    }
}
