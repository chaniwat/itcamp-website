<?php

namespace App\Services;

use App\ApplicantDetailKey;

class ApplicantQuestionService
{

    // TODO merge into question service

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
     * @param $priority
     * @param $description
     * @param $field_type
     * @param $field_class
     * @param $field_setting
     * @param $other
     * @return Question
     * @throws FieldTypeNotAcceptException If field type is invalid or not accept
     * @throws InvalidFieldFormatException If field setting is on invalid format to its type format
     */
    public function createQuestion($field_id_or_array, $question = null, $priority = null, $description = null, $field_type = null, $field_class = null, $field_setting = null, $other = null)
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
            $this->structQuestion($object, $question, $priority, $description, $field_type, $field_class, $field_setting, $other);
        }

        $object->save();

        if ($object->other)
        {
            $otherObject = $object->replicate();
            $otherObject->id .= "_other";
            $otherObject->field_type = "TEXT";
            $otherObject->other = false;
            $otherObject->parent()->associate($object);
            $otherObject->save();
        }

        return $object;
    }

    /**
     * Update the applicant question
     * @param $field_id
     * @param string|array $question_or_array
     * @param $priority
     * @param $description
     * @param $field_type
     * @param $field_class
     * @param $field_setting
     * @param $other
     * @return Question
     * @throws FieldTypeNotAcceptException If field type is invalid or not accept
     * @throws InvalidFieldFormatException If field setting is on invalid format to its type format
     */
    public function updateQuestion($field_id, $question_or_array, $priority = null, $description = null, $field_type = null, $field_class = null, $field_setting = null, $other = null)
    {
        $object = ApplicantDetailKey::find($field_id);

        if (is_array($question_or_array))
        {
            $this->structQuestion($object, $question_or_array);
        }
        else
        {
            $this->structQuestion($object, $question_or_array, $priority, $description, $field_type, $field_class, $field_setting, $other);
        }

        $object->save();

        return $object;
    }

    /**
     * Delete the applicant question
     * @param $field_id
     * @throws \Exception
     */
    public function deleteQuestion($field_id)
    {
        // NO YOU CAN'T DELETE THIS ROFL
        throw new \Exception("Not Implement");
    }

    /**
     * Struct a question
     * @param ApplicantDetailKey $object
     * @param string|array $question_or_array
     * @param $priority
     * @param $description
     * @param $field_type
     * @param $field_class
     * @param $field_setting
     * @param $other
     * @throws FieldTypeNotAcceptException If field type is invalid or not accept
     * @throws InvalidFieldFormatException If field setting is on invalid format to its type format
     */
    private function structQuestion(ApplicantDetailKey $object, $question_or_array, $priority = null, $description = null, $field_type = null, $field_class = null, $field_setting = null, $other = null)
    {
        if (is_array($question_or_array))
        {
            // Validate field setting
            $this->validator->validateFieldSetting($question_or_array['field_type'], $question_or_array['field_setting']);

            $object->question = $question_or_array['question'];
            $object->priority = $question_or_array['priority'];
            $object->description = $question_or_array['description'];
            $object->field_type = $question_or_array['field_type'];
            $object->field_class = $question_or_array['field_class'];
            $object->field_setting = $question_or_array['field_setting'];
            $object->other = isset($question_or_array['other']) && ($question_or_array['other'] == 'on' || $question_or_array['other'] == true);
        }
        else
        {
            // Validate field setting
            $this->validator->validateFieldSetting($field_type, $field_setting);

            $object->question = $question_or_array;
            $object->priority = $priority;
            $object->description = $description;
            $object->field_type = $field_type;
            $object->field_class = $field_class;
            $object->field_setting = $field_setting;
            $object->other = $other === 'on' || $other === true;
        }
    }

}