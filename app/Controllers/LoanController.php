<?php

namespace App\Controllers;

use App\Models\Loan;

class LoanController extends BaseController
{
    public function index(): string
    {
        $loans = model(Loan::class)->findAll();

        return view('index', [
            'loans' => $loans,
        ]);
    }
}
