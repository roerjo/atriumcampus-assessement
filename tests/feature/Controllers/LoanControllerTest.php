<?php

use App\Models\Loan;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\Fabricator;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
class LoanControllerTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    use FeatureTestTrait;

    protected $migrate     = true;
    protected $migrateOnce = false;
    protected $refresh     = true;
    protected $namespace   = 'App';

    public function testIndexReturnsLoans()
    {
        $loan = (new Fabricator(Loan::class))->create();

        $result = $this->get('/');

        $result->assertOK();
        $result->assertSeeInField('first_name', $loan['first_name']);
        $result->assertSeeInField('middle_initial', $loan['middle_initial']);
        $result->assertSeeInField('last_name', $loan['last_name']);
        $result->assertSeeInField('loan', $loan['loan']);
        $result->assertSeeInField('value', $loan['value']);
    }

    public function testStoreCreatesLoan()
    {
        $result = $this->post('/', [
            'first_name' => $firstName = 'Testy',
            'middle_initial' => $mi = 'T',
            'last_name' => $lastName = 'McTesterson',
            'loan' => $loan = 5.00,
            'value' => $value = 10.00,
        ]);

        $result->assertRedirectTo('/');

        $this->seeInDatabase('test', [
            'first_name' => $firstName,
            'middle_initial' => $mi,
            'last_name' => $lastName,
            'loan' => $loan,
            'value' => $value,
        ]);
    }

    public function testUpdateModifiesLoan()
    {
        $loan = (new Fabricator(Loan::class))->create();

        $result = $this->post("/{$loan['id']}", [
            'first_name' => $updatedFirstName = $loan['first_name'] . '_Test',
            'middle_initial' => $loan['middle_initial'],
            'last_name' => $loan['last_name'],
            'loan' => $loan['loan'],
            'value' => $loan['value'],
        ]);

        $result->assertRedirectTo('/');

        $this->seeInDatabase('test', [
            'id' => $loan['id'],
            'first_name' => $updatedFirstName,
            'middle_initial' => $loan['middle_initial'],
            'last_name' => $loan['last_name'],
            'loan' => $loan['loan'],
            'value' => $loan['value'],
        ]);
    }

    public function testDestroyDeletesLoan()
    {
        $loan = (new Fabricator(Loan::class))->create();

        $result = $this->delete("/{$loan['id']}");

        $result->assertRedirectTo('/');

        $this->dontSeeInDatabase('test', [
            'id' => $loan['id'],
        ]);
    }
}
