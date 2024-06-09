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
        $rules = $this->validationRules();

        $data = $this->request->getPost(array_keys($rules));

        if (! $this->validateData($data, $rules)) {
            return redirect()->back()->withInput();
        }

        $validData = $this->validator->getValidated();

        model(Loan::class)->insert([
            'first_name' => $validData['first_name'],
            'middle_initial' => $validData['middle_initial'],
            'last_name' => $validData['last_name'],
            'loan' => $validData['loan'],
            'value' => $validData['value'],
        ]);

        return redirect()->back();
    }

    public function update(int $id): RedirectResponse
    {
        $rules = $this->validationRules();

        $data = $this->request->getPost(array_keys($rules));

        if (! $this->validateData($data, $rules)) {
            return redirect()->back()->withInput();
        }

        $validData = $this->validator->getValidated();

        model(Loan::class)->update($id, [
            'first_name' => $validData['first_name'],
            'middle_initial' => $validData['middle_initial'],
            'last_name' => $validData['last_name'],
            'loan' => $validData['loan'],
            'value' => $validData['value'],
        ]);

        return redirect()->back();
    }

    public function destroy(int $id): RedirectResponse
    {
        model(Loan::class)->delete($id);

        return redirect()->back();
    }

    private function validationRules(): array
    {
        return [
            'first_name' => 'string|max_length[30]',
            'middle_initial' => 'string|max_length[1]',
            'last_name' => 'required|string|max_length[30]',
            'loan' => 'required|decimal',
            'value' => 'required|decimal',
        ];
    }
}
