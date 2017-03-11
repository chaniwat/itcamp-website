<?php

namespace App\Services;

use App\ApplicantDetailKey;
use App\Question;
use App\Section;

class QuestionService
{

    const CRITICAL_APPLICANT_FIELD = ['p_name', 'p_name_other', 'f_name', 'l_name', 'nickname', 'birthday', 'sex', 'religion'];

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
     * @param $require
     * @param $description
     * @param $section
     * @param $priority
     * @param $field_type
     * @param $field_class
     * @param $field_setting
     * @param $other
     * @return Question
     * @throws FieldTypeNotAcceptException If field type is invalid or not accept
     * @throws InvalidFieldFormatException If field setting is on invalid format to its type format
     */
    public function createCampQuestion($field_id_or_array, $question = null, $require = false, $description = null, $section = null, $priority = null, $field_type = null, $field_class = null, $field_setting = null, $other = null)
    {
        $object = new Question();

        if (is_array($field_id_or_array))
        {
            $object->id = $field_id_or_array['field_id'];
            $this->structCampQuestion($object, $field_id_or_array);
        }
        else
        {
            $object->id = $field_id_or_array;
            $this->structCampQuestion($object, $question, $require, $description, $section, $priority, $field_type, $field_class, $field_setting, $other);
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
     * Update the question
     * @param $field_id
     * @param string|array $question_or_array
     * @param $require
     * @param $description
     * @param $section
     * @param $priority
     * @param $field_type
     * @param $field_class
     * @param $field_setting
     * @param $other
     * @return Question
     * @throws FieldTypeNotAcceptException If field type is invalid or not accept
     * @throws InvalidFieldFormatException If field setting is on invalid format to its type format
     */
    public function updateCampQuestion($field_id, $question_or_array, $require = false, $description = null, $section = null, $priority = null, $field_type = null, $field_class = null, $field_setting = null, $other = null)
    {
        $object = Question::find($field_id);

        if (is_array($question_or_array))
        {
            $this->structCampQuestion($object, $question_or_array);
        }
        else
        {
            $this->structCampQuestion($object, $question_or_array, $require, $description, $section, $priority, $field_type, $field_class, $field_setting, $other);
        }

        $object->save();

        return $object;
    }

    /**
     * Delete the question
     * @param $field_id
     */
    public function deleteCampQuestion($field_id)
    {
        Question::destroy($field_id);
    }

    /**
     * Struct a question
     * @param Question $object
     * @param string|array $question_or_array
     * @param $require
     * @param $description
     * @param $section
     * @param $priority
     * @param $field_type
     * @param $field_class
     * @param $field_setting
     * @param $other
     * @throws FieldTypeNotAcceptException If field type is invalid or not accept
     * @throws InvalidFieldFormatException If field setting is on invalid format to its type format
     */
    private function structCampQuestion(Question $object, $question_or_array, $require = false, $description = null, $section = null, $priority = null, $field_type = null, $field_class = null, $field_setting = null, $other = null)
    {
        if (is_array($question_or_array))
        {
            // Validate field setting
            $this->validator->validateFieldSetting($question_or_array['field_type'], $question_or_array['field_setting']);

            $object->question = $question_or_array['question'];
            $object->require = isset($question_or_array['require']) && ($question_or_array['require'] == 'on' || $question_or_array['require'] == true);
            $object->description = $question_or_array['description'];
            $object->section()->associate(Section::find($question_or_array['section']));
            $object->priority = $question_or_array['priority'];
            $object->field_type = $question_or_array['field_type'];
            $object->field_class = $question_or_array['field_class'];
            $object->field_setting = $question_or_array['field_setting'];
            $object->other = isset($question_or_array['other']) && $question_or_array['other'] == 'on' ? true : false;
        }
        else
        {
            // Validate field setting
            $this->validator->validateFieldSetting($field_type, $field_setting);

            $object->question = $question_or_array;
            $object->require = $require === 'on' || $require === true;
            $object->description = $description;
            $object->section()->associate(Section::find($section));
            $object->priority = $priority;
            $object->field_type = $field_type;
            $object->field_class = $field_class;
            $object->field_setting = $field_setting;
            $object->other = $other == 'on' || $other === true ? true : false;
        }
    }

    /**
     * Create a new applicant question
     * @param string|array $field_id_or_array
     * @param $question
     * @param $require
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
    public function createApplicantQuestion($field_id_or_array, $question = null, $require = false, $priority = null, $description = null, $field_type = null, $field_class = null, $field_setting = null, $other = null)
    {
        $object = new ApplicantDetailKey();

        if (is_array($field_id_or_array))
        {
            $object->id = $field_id_or_array['field_id'];
            $this->structApplicantQuestion($object, $field_id_or_array);
        }
        else
        {
            $object->id = $field_id_or_array;
            $this->structApplicantQuestion($object, $question, $require, $priority, $description, $field_type, $field_class, $field_setting, $other);
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
     * @param $require
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
    public function updateApplicantQuestion($field_id, $question_or_array, $require = false, $priority = null, $description = null, $field_type = null, $field_class = null, $field_setting = null, $other = null)
    {
        $object = ApplicantDetailKey::find($field_id);

        if (is_array($question_or_array))
        {
            $this->structApplicantQuestion($object, $question_or_array);
        }
        else
        {
            $this->structApplicantQuestion($object, $question_or_array, $require, $priority, $description, $field_type, $field_class, $field_setting, $other);
        }

        $object->save();

        return $object;
    }

    /**
     * Delete the applicant question
     * @param $field_id
     * @throws \Exception
     */
    public function deleteApplicantQuestion($field_id)
    {
        if(in_array($field_id, QuestionService::CRITICAL_APPLICANT_FIELD)) {
            throw new \Exception("Cannot delete critical field");
        }

        ApplicantDetailKey::destroy($field_id);
    }

    /**
     * Struct a question
     * @param ApplicantDetailKey $object
     * @param string|array $question_or_array
     * @param $require
     * @param $priority
     * @param $description
     * @param $field_type
     * @param $field_class
     * @param $field_setting
     * @param $other
     * @throws FieldTypeNotAcceptException If field type is invalid or not accept
     * @throws InvalidFieldFormatException If field setting is on invalid format to its type format
     */
    private function structApplicantQuestion(ApplicantDetailKey $object, $question_or_array, $require = false, $priority = null, $description = null, $field_type = null, $field_class = null, $field_setting = null, $other = null)
    {
        if (is_array($question_or_array))
        {
            // Validate field setting
            $this->validator->validateFieldSetting($question_or_array['field_type'], $question_or_array['field_setting']);

            $object->question = $question_or_array['question'];
            $object->require = isset($question_or_array['require']) && ($question_or_array['require'] == 'on' || $question_or_array['require'] == true);
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
            $object->require = $require === 'on' || $require === true;
            $object->priority = $priority;
            $object->description = $description;
            $object->field_type = $field_type;
            $object->field_class = $field_class;
            $object->field_setting = $field_setting;
            $object->other = $other === 'on' || $other === true;
        }
    }

}