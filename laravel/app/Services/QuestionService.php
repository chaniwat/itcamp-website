<?php

namespace App\Services;

use App\Question;
use App\Section;

class QuestionService
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
     * Create a new question
     * @param string|array $field_id_or_array
     * @param $question
     * @param $description
     * @param $section
     * @param $priority
     * @param $field_type
     * @param $field_setting
     * @return Question
     * @throws FieldTypeNotAcceptException If field type is invalid or not accept
     * @throws InvalidFieldFormatException If field setting is on invalid format to its type format
     */
    public function createQuestion($field_id_or_array, $question = null, $description = null, $section = null, $priority = null, $field_type = null, $field_setting = null)
    {
        $object = new Question();

        if (is_array($field_id_or_array))
        {
            $object->id = $field_id_or_array['field_id'];
            $this->structQuestion($object, $field_id_or_array);
        }
        else
        {
            $object->id = $field_id_or_array;
            $this->structQuestion($object, $question, $description, $section, $priority, $field_type, $field_setting);
        }

        $object->save();

        return $object;
    }

    /**
     * Struct a question
     * @param Question $object
     * @param string|array $question_or_array
     * @param $description
     * @param $section
     * @param $priority
     * @param $field_type
     * @param $field_setting
     * @throws FieldTypeNotAcceptException If field type is invalid or not accept
     * @throws InvalidFieldFormatException If field setting is on invalid format to its type format
     */
    private function structQuestion(Question $object, $question_or_array, $description = null, $section = null, $priority = null, $field_type = null, $field_setting = null) {
        if (is_array($question_or_array))
        {
            // Validate field setting
            $this->validator->validateFieldSetting($question_or_array['field_type'], $question_or_array['field_setting']);

            $object->question = $question_or_array['question'];
            $object->description = $question_or_array['description'];
            $object->section()->associate(Section::find($question_or_array['section']));
            $object->priority = $question_or_array['priority'];
            $object->field_type = $question_or_array['field_type'];
            $object->field_setting = $question_or_array['field_setting'];
        }
        else
        {
            // Validate field setting
            $this->validator->validateFieldSetting($field_type, $field_setting);

            $object->question = $question_or_array;
            $object->description = $description;
            $object->section()->associate(Section::find($section));
            $object->priority = $priority;
            $object->field_type = $field_type;
            $object->field_setting = $field_setting;
        }
    }

}