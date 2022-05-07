<?php

namespace Tests\Feature;

use App\Utilities\SNILSValidator;
use Tests\TestCase;

class SNILSValidatorTest extends TestCase
{
    public function test_validator_fails()
    {
        $invalid_snils = '129-957-699 35';

        $this->assertFalse(SNILSValidator::validate($invalid_snils));
    }

    public function test_validator_passes()
    {
        $valid_snils = '129-957-696 35';

        $this->assertTrue(SNILSValidator::validate($valid_snils));
    }
}
