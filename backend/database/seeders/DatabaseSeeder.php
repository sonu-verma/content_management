<?php

namespace Database\Seeders;

use App\Models\Channel;
use App\Models\Subscription;
use App\Models\User;
use Database\Factories\SubscriptionFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user1  = User::factory()->create([
            'name' => 'Sonu Verma',
            'email' => 'sonu@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $user2  = User::factory()->create([
            'name' => 'Taksh Verma',
            'email' => 'taksh@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $channel1 = Channel::factory()->create([
            'user_id' => $user1->id
        ]);

        $channel2 = Channel::factory()->create([
            'user_id' => $user2->id
        ]);

        $channel1->subscriptions()->create([
            'user_id' => $user2->id
        ]);

         $channel2->subscriptions()->create([
            'user_id' => $user1->id
        ]);

        Subscription::factory(10000)->create([
            'channel_id' => $channel1->id
        ]);
        Subscription::factory(10000)->create([
            'channel_id' => $channel2->id
        ]);
    }
}
