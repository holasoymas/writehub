<?php

namespace Database\Seeders;

use App\Models\Broadcast;
use App\Models\User;
use App\Notifications\Announcement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Notification;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        $broadcast = Broadcast::create([
            "title" => "Seeder Broadcast",
            "message" => "this is my message",
            "total_send" => $users->count(),
            "send_at" => now(),
        ]);

        Notification::send($users, new Announcement($broadcast));
    }
}
