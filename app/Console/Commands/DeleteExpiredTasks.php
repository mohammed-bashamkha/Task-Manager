<?php

namespace App\Console\Commands;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteExpiredTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-expired-tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes expired tasks every 2 month on the first day at midnight';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $twoMonth = Carbon::now()->months(2);
        Task::where('created_at','<',$twoMonth)->delete();
    }
}
