<?php

namespace App\Core\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

class MatchesPassword extends AbstractRule
{
    public function __construct($password)
    {
        $this->password = $password;
    }
    public function validate($input)
    {
        return password_verify($input, $this->password);
    }
}
