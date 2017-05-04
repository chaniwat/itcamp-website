<?php

namespace App\Services;

use App\Exceptions\FieldTypeNotAcceptedException;
use App\Exceptions\InvalidFieldFormatException;
use App\Exceptions\ValidatorNoRulesGivenException;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Http\Request;

class ValidatorService
{

    /**
     * Validator instance.
     */
    private $validatorFactory;

    /**
     * Form Service instance.
     */
    private $formService;

    /**
     * Internal variables
     */
    private $validator = null;
    private $rules = [];
    private $uniqueErrors = [];

    public function __construct(Factory $validator, FormService $formService)
    {
        $this->validatorFactory = $validator;
        $this->formService = $formService;
    }

    public function getValidator() {
        return $this->validator;
    }

    #region validate request's inputs

    public function setRules($rules)
    {
        $this->rules = $rules;
    }

    /**
     * Validate the request's input
     * @param $inputs
     * @param $rules
     * @param $message
     * @throws ValidatorNoRulesGivenException
     */
    public function validate($inputs, $rules = null, $message = [])
    {
        if($inputs instanceof Request) {
            $inputs = $inputs->all();
        }

        if($rules != null) {
            $this->setRules($rules);
        }

        if($this->rules == null) {
            throw new ValidatorNoRulesGivenException();
        }

        $this->validator = $this->validatorFactory->make($inputs, $this->rules, $message);

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

    #endregion

    #region validate form setting (for question field)

    /**
     * Validate field setting for Question (format)
     * @param $field_type
     * @param $field_setting
     * @throws FieldTypeNotAcceptedException
     * @throws InvalidFieldFormatException
     */
    public function validateFieldSetting($field_type, $field_setting)
    {
        if(!$this->formService->checkFieldTypeAccepted($field_type)) {
            throw new FieldTypeNotAcceptedException($field_type);
        } else if(!$this->formService->checkSettingFormat($field_type, $field_setting)) {
            throw new InvalidFieldFormatException();
        }
    }

    /**
     * Validate field value for Question (format)
     * @param $field_type
     * @param $field_value
     * @throws FieldTypeNotAcceptedException
     * @throws InvalidFieldFormatException
     */
    public function validateFieldValue($field_type, $field_value)
    {
        if(!$this->formService->checkFieldTypeAccepted($field_type)) {
            throw new FieldTypeNotAcceptedException($field_type);
        } else if(!$this->formService->checkSettingValue($field_type, $field_value)) {
            throw new InvalidFieldFormatException();
        }
    }

    #endregion

}