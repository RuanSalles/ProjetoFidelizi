<?php

namespace App\Http\Controllers;

use App\Mail\RememberRescueMail;
use App\Models\Award;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendRememberRescueMail()
    {
        $customers = Customer::all();
        $awards = Award::query()->orderBy('points_value')->get();

        foreach ($customers as $customer) {
            if($customer->points >= $awards[0]['points_value']) {
                Mail::to($customer->email)->send(new RememberRescueMail($customer));
            }
        }
    }
}
