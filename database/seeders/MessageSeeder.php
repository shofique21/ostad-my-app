<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        $messages = [
            [
                'sender_id'   => 2,
                'receiver_id' => 1,
                'message'     => 'Hi, is the Toyota Camry still available?',
            ],
            [
                'sender_id'   => 1,
                'receiver_id' => 2,
                'message'     => 'Yes, it is still available. Are you interested?',
            ],
            [
                'sender_id'   => 2,
                'receiver_id' => 1,
                'message'     => 'Yes! Can I come see it this weekend?',
            ],
            [
                'sender_id'   => 1,
                'receiver_id' => 2,
                'message'     => 'Sure, Saturday works for me. Let me know your preferred time.',
            ],
            [
                'sender_id'   => 2,
                'receiver_id' => 1,
                'message'     => 'What is the lowest price you can do for the Honda CR-V?',
            ],
            [
                'sender_id'   => 1,
                'receiver_id' => 2,
                'message'     => 'The price is firm at the listed amount. It is in excellent condition.',
            ],
            [
                'sender_id'   => 2,
                'receiver_id' => 1,
                'message'     => 'Is the Tesla Model 3 still under warranty?',
            ],
            [
                'sender_id'   => 1,
                'receiver_id' => 2,
                'message'     => 'Yes, it has 2 years of manufacturer warranty remaining.',
            ],
        ];

        foreach ($messages as $message) {
            DB::table('messages')->insert(array_merge($message, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
