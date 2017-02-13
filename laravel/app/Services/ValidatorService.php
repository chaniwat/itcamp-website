<?php

namespace App\Services;

use App\Exceptions\FieldTypeNotAcceptException;
use App\Exceptions\InvalidFieldFormatException;
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

    #region validate request's inputs

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

    #endregion

    #region validate form setting (for question field)

    /**
     * Validate field setting for Question (format)
     * @param $field_type
     * @param $field_setting
     * @return bool|string
     * @throws FieldTypeNotAcceptException
     * @throws InvalidFieldFormatException
     */
    public function validateFieldSetting($field_type, $field_setting)
    {
        if(!$this->formService->isFieldTypeAccept($field_type)) {
            throw new FieldTypeNotAcceptException('Field type not accept: ' + $field_type);
        } else if(!$this->formService->checkSettingFormat($field_type, $field_setting)) {
            throw new InvalidFieldFormatException('Invalid setting format');
        }
    }

    /**
     * Validate field value for Question (format)
     * @param $field_type
     * @param $field_value
     * @return bool|string
     * @throws FieldTypeNotAcceptException
     * @throws InvalidFieldFormatException
     */
    public function validateFieldValue($field_type, $field_value)
    {
        if(!$this->formService->isFieldTypeAccept($field_type)) {
            throw new FieldTypeNotAcceptException('Field type not accept: ' + $field_type);
        } else if(!$this->formService->checkSettingValue($field_type, $field_value)) {
            throw new InvalidFieldFormatException('Invalid setting format');
        }
    }

    #endregion

}