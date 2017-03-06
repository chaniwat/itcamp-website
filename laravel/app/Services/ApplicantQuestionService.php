<?php

namespace App\Services;

use App\ApplicantDetailKey;

class ApplicantQuestionService
{

    /**
     * Validator service instance
     */
    private $validator;

    public function __construct(ValidatorService $validatorService)
    {
        $this->validator = $validatorService;
    }

    /**
     * Create a new applicant question
     * @param string|array $field_id_or_array
     * @param $question
     * @param $description
     * @param $field_type
     * @param $field_setting
     * @return Question
     * @throws FieldTypeNotAcceptException If field type is invalid or not accept
     * @throws InvalidFieldFormatException If field setting is on invalid format to its type format
     */
    public function createQuestion($field_id_or_array, $question = null, $description = null, $field_type = null, $field_setting = null)
    {
        $object = new ApplicantDetailKey();

        if (is_array($field_id_or_array))
        {
            $object->id = $field_id_or_array['field_id'];
            $this->structQuestion($object, $field_id_or_array);
        }
        else
        {
            $object->id = $field_id_or_array;
            $this->structQuestion($object, $question, $description, $field_type, $field_setting);
        }

        $object->save();

        return $object;
    }

    /**
     * Update the applicant question
     * @param $field_id
     * @param string|array $question_or_array
     * @param $description
     * @param $field_type
     * @param $field_setting
     * @return Question
     * @throws FieldTypeNotAcceptException If field type is invalid or not accept
     * @throws InvalidFieldFormatException If field setting is on invalid format to its type format
     */
    public function updateQuestion($field_id, $question_or_array, $description = null, $field_type = null, $field_setting = null)
    {
        $object = ApplicantDetailKey::find($field_id);

        if (is_array($question_or_array))
        {
            $this->structQuestion($object, $question_or_array);
        }
        else
        {
            $this->structQuestion($object, $question_or_array, $description, $field_type, $field_setting);
        }

        $object->save();

        return $object;
    }

    /**
     * Delete the applicant question
     * @param $field_id
     */
    public function deleteQuestion($field_id)
    {
//        ApplicantDetailKey::destroy($field_id);
        // NO YOU CAN'T DELETE THIS ROFL
    }

    /**
     * Struct a question
     * @param ApplicantDetailKey $object
     * @param string|array $question_or_array
     * @param $description
     * @param $field_type
     * @param $field_setting
     * @throws FieldTypeNotAcceptException If field type is invalid or not accept
     * @throws InvalidFieldFormatException If field setting is on invalid format to its type format
     */
    private function structQuestion(ApplicantDetailKey $object, $question_or_array, $description = null, $field_type = null, $field_setting = null) {
        if (is_array($question_or_array))
        {
            // Validate field setting
            $this->validator->validateFieldSetting($question_or_array['field_type'], $question_or_array['field_setting']);

            $object->question = $question_or_array['question'];
            $object->description = $question_or_array['description'];
            $object->field_type = $question_or_array['field_type'];
            $object->field_setting = $question_or_array['field_setting'];
        }
        else
        {
            // Validate field setting
            $this->validator->validateFieldSetting($field_type, $field_setting);

            $object->question = $question_or_array;
            $object->description = $description;
            $object->field_type = $field_type;
            $object->field_setting = $field_setting;
        }
    }

}