<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run()
    {
        Ticket::create([
            'cstId' => 123,
            'issue' => 'Account Locked',
            'description' => 'I am unable to access my account. It seems to be locked. Can you please help me to unlock it?',
            'status' => 'Unsolved',
        ]);

        Ticket::create([
            'cstId' => 23,
            'issue' => 'Payment Not Processed',
            'description' => 'I made a payment, but it\'s not showing up on my account. Can you please check and let me know what\'s going on?',
            'status' => 'Unsolved',
        ]);

        Ticket::create([
            'cstId' => 89,
            'issue' => 'Cannot Reset Password',
            'description' => 'I am trying to reset my password, but I am not receiving the reset email. Can you please help me to reset my password?',
            'status' => 'Unsolved',
        ]);

        Ticket::create([
            'cstId' => 123,
            'issue' => 'Product Not Delivered',
            'description' => 'I ordered a product, but it has not been delivered yet. Can you please check the status and let me know what\'s going on?',
            'status' => 'Unsolved',
        ]);

        Ticket::create([
            'cstId' => 56,
            'issue' => 'Incorrect Product Received',
            'description' => 'I received a product, but it\'s not the one I ordered. Can you please help me to get the correct product?',
            'status' => 'Unsolved',
        ]);
    }
}
