<?php

namespace App\Controllers;

use App\Models\Loan;
use CodeIgniter\HTTP\RedirectResponse;

class LoanController extends BaseController
{
    public function index(): string
    {
        $loans = model(Loan::class)->findAll();

        return view('index', [
            'loans' => $loans,
        ]);
    }

    public function store(): RedirectResponse
    {
        model(Loan::class)->insert([
            'first_name' => $this->request->getPost('first_name'),
            'middle_initial' => $this->request->getPost('middle_initial'),
            'last_name' => $this->request->getPost('last_name'),
            'loan' => $this->request->getPost('loan'),
            'value' => $this->request->getPost('value'),
        ]);

        return redirect()->back();
    }

    public function update(int $id): RedirectResponse
    {
        model(Loan::class)->update($id, [
            'first_name' => $this->request->getPost('first_name'),
            'middle_initial' => $this->request->getPost('middle_initial'),
            'last_name' => $this->request->getPost('last_name'),
            'loan' => $this->request->getPost('loan'),
            'value' => $this->request->getPost('value'),
        ]);

        return redirect()->back();
    }

    public function destroy(int $id): RedirectResponse
    {
        model(Loan::class)->delete($id);

        return redirect()->back();
    }
}
