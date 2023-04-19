<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\Reminder;
use App\Notifications\SendReminder;

class SendReminderEmailNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-reminder-email-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $timestamp = (string) Carbon::now('UTC')->unix();
        $length = strlen($timestamp);
        $timestamp[$length - 1] = 0;
        $reminders = Reminder::with('user:id,email')->where('scheduled_at', $timestamp)->get();
        foreach ($reminders as $key => $reminder) {
            $reminder->user->notify(new SendReminder($reminder));
        }
    }
}
