<?php

namespace App\Services;

use App\Mail\RememberRescueMail;
use App\Models\Award;
use App\Models\Customer;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public function sendRememberRescueMail()
    {
        $maxPoints = Award::orderBy('points_value', 'desc')->first()->points_value;
        $customers = Customer::where('points', '>=', $maxPoints)->get();

        foreach ($customers as $customer) {
            Mail::to($customer->email)->send(new RememberRescueMail($customer));
        }
    }
}
