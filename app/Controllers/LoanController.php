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

    public function store(): string
    {
        //

        return $this->index();
    }

    public function update(int $id): string
    {
        //

        return $this->index();
    }

    public function destroy(int $id): string
    {
        model(Loan::class)->delete($id);

        return $this->index();
    }
}
