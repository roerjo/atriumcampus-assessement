<?php

namespace App\Database\Seeds;

use App\Models\Loan;
use CodeIgniter\Database\Seeder;
use CodeIgniter\Test\Fabricator;

class LoanSeeder extends Seeder
{
    public function run()
    {
        $fabricator = new Fabricator(Loan::class);

        $fabricator->create(10);
    }
}
