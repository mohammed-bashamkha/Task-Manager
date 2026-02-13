<?php

namespace App\Console\Commands;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteDoneTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-done-tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes Done tasks every month on the first day at midnight';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $oneMonth = Carbon::now()->months(1);
        Task::where('created_at','<',$oneMonth)
            ->where('status', 'done')
            ->delete();
    }
}
