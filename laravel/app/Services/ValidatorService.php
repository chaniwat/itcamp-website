<?php

namespace App\Services;


use Illuminate\Contracts\Validation\Factory;
use Illuminate\Http\Request;

class ValidatorService
{

    /**
     * Validator instance.
     */
    private $validatorFactory;

    /**
     * Internal variables
     */
    private $validator = null;
    private $rules = [];
    private $uniqueErrors = [];

    public function __construct(Factory $validator)
    {
        $this->validatorFactory = $validator;
    }

    public function setRules($rules)
    {
        $this->rules = $rules;
    }

    /**
     * Validate the request's input
     * @param Request $request
     * @param $rules
     * @throws \Exception
     */
    public function validate(Request $request, $rules = null)
    {
        if($rules != null)
        {
            $this->setRules($rules);
        }

        if($this->rules == null)
        {
            throw new \Exception("Set rules first before validate the inputs!!");
        }

        $this->validator = $this->validatorFactory->make($request->all(), $this->rules);

        $this->uniqueErrors = $this->validator->errors()->unique();
    }

    /**
     * Is contain error (after validate)
     * @param $error
     * @return bool
     */
    public function containError($error)
    {
        return in_array($error, $this->uniqueErrors);
    }

}