<?php

namespace App\Http\Controllers;

use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::latest()->get();

        return view('payments.index', compact('payments'));
    }
}
