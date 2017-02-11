<?php

namespace App\Utility;

use App\Question;
use App\Services\StringHelperService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use League\Flysystem\Exception;

class FormUtility
{
    const acceptField = ['TEXT', 'TEXTAREA', 'PASSWORD', 'EMAIL', 'NUMBER', 'DATE', 'RADIO', 'CHECKBOX', 'SELECT', 'SELECT_MULTIPLE', 'FILE'];
    const acceptFileTypeSetting = ['picture', 'document', 'any'];

    const fileType = [
        "picture" => ["image/jpeg", "image/gif", "image/png"],
        "document" => ["application/pdf"]
    ];

    /**
     * Construct a JSON array object
     * @param string $jsonText
     * @return array
     * @throws \Exception
     */
    public static function constructArrayObject($jsonText) {
        return json_decode($jsonText, True);
    }

    /**
     * Construct a JSON text
     * @param array $arrayObject
     * @return string
     * @throws \Exception
     */
    public static function constructJSONText($arrayObject) {
        return json_encode($arrayObject);
    }

    /**
     * Check JSON Format correction of the given JSON text
     * @param string $jsonText
     * @return bool
     */
    public static function isFormattableJSON($jsonText) {
        return gettype(self::constructArrayObject($jsonText)) == 'array';
    }

    /**
     * Check the setting's type format correction of given JSON Object (array)
     * @param $type
     * @param mixed $jsonObject
     * @return bool
     * @throws \Exception
     */
    public static function checkSettingTypeFormat($type, $jsonObject) {
        if(gettype($jsonObject) == 'string') {
            if(self::isFormattableJSON($jsonObject)) {
                $jsonObject = self::constructArrayObject($jsonObject);
            } else {
                return false;
            }
        } else if(gettype($jsonObject) != 'array') {
            return false;
        }

        switch ($type) {
            case 'CHECKBOX':
            case 'RADIO':
            case 'SELECT':
            case 'SELECT_MULTIPLE': return self::checkListSettingFormat($jsonObject);
            case 'FILE': return self::checkFileSettingFormat($jsonObject);
            case 'DATE':
            case 'EMAIL':
            case 'NUMBER':
            case 'PASSWORD':
            case 'TEXT':
            case 'TEXTAREA':
            default: return self::checkTextSettingFormat($jsonObject);
        }
    }

    /**
     * For DATE, EMAIL, NUMBER, PASSWORD, TEXT, TEXTAREA setting field
     * @param array $arrayObject
     * @return bool
     */
    private static function checkTextSettingFormat($arrayObject) {
        return !sizeof($arrayObject);
    }

    /**
     * For CHECKBOX, RADIO, SELECT, SELECT_MULTIPLE setting field
     * @param array $arrayObject
     * @return bool
     */
    private static function checkListSettingFormat($arrayObject) {
        if(sizeof($arrayObject) == 1 && array_key_exists("lists", $arrayObject) && gettype($arrayObject['lists']) == 'array') {
            foreach($arrayObject['lists'] as $option) {
                if(!(sizeof($option) == 2 && array_key_exists("key", $option) && gettype($option['key']) == 'array'
                    && array_key_exists("text", $option) && gettype($option['text']) == 'array')) {
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * For FILE setting field
     * @param $arrayObject
     * @return bool
     */
    private static function checkFileSettingFormat($arrayObject) {
        if(sizeof($arrayObject) == 2 && array_key_exists("directory", $arrayObject) && gettype($arrayObject['directory']) == 'string'
            && array_key_exists("acceptTypes", $arrayObject) && gettype($arrayObject['acceptTypes']) == 'string') {
            if(in_array($arrayObject['acceptTypes'], self::acceptFileTypeSetting)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check the value's type format correction of given JSON Object (array)
     * @param $type
     * @param mixed $jsonObject
     * @return bool
     * @throws \Exception
     */
    public static function checkValueTypeFormat($type, $jsonObject) {
        if(gettype($jsonObject) == 'string') {
            if(self::isFormattableJSON($jsonObject)) {
                $jsonObject = self::constructArrayObject($jsonObject);
            } else {
                return false;
            }
        } else if(gettype($jsonObject) != 'array') {
            return false;
        }

        switch ($type) {
            case 'CHECKBOX':
            case 'SELECT_MULTIPLE': return self::checkMultipleListValueFormat($jsonObject);
            case 'RADIO':
            case 'SELECT': return self::checkSingleListValueFormat($jsonObject);
            case 'FILE': return self::checkFileValueFormat($jsonObject);
            case 'DATE': return self::checkDateValueFormat($jsonObject);
            case 'EMAIL':
            case 'NUMBER':
            case 'PASSWORD':
            case 'TEXT':
            case 'TEXTAREA':
            default: return self::checkTextValueFormat($jsonObject);
        }
    }

    /**
     * For EMAIL, NUMBER, PASSWORD, TEXT, TEXTAREA value field
     * @param array $arrayObject
     * @return bool
     */
    private static function checkDateValueFormat($arrayObject) {
        if(sizeof($arrayObject) == 2 && array_key_exists("date", $arrayObject) && gettype($arrayObject["date"]) == "string"
            && array_key_exists("time", $arrayObject) && gettype($arrayObject["time"]) == "string") {
            if(preg_match("/^[0-9]{2}/[0-9]{2}/[0-9]{4}$/", $arrayObject['date']) && preg_match("/^[0-9]{2}:[0-9]{2}:[0-9]{2}$/", $arrayObject['time'])) {
                // TODO check date and time value correction (now only check pattern)
                return true;
            }
            return false;
        } else {
            return false;
        }
    }

    /**
     * For EMAIL, NUMBER, PASSWORD, TEXT, TEXTAREA value field
     * @param array $arrayObject
     * @return bool
     */
    private static function checkTextValueFormat($arrayObject) {
        if(sizeof($arrayObject) == 1 && array_key_exists("value", $arrayObject) && gettype($arrayObject["value"]) == "string") {
            return true;
        } else {
            return false;
        }
    }

    /**
     * For CHECKBOX, SELECT_MULTIPLE value field
     * @param array $arrayObject
     * @return bool
     */
    private static function checkMultipleListValueFormat($arrayObject) {
        if(sizeof($arrayObject) == 1 && array_key_exists("value", $arrayObject) && gettype($arrayObject["value"]) == "array") {
            return true;
        } else {
            return false;
        }
    }

    /**
     * For RADIO, SELECT value field
     * @param array $arrayObject
     * @return bool
     */
    private static function checkSingleListValueFormat($arrayObject) {
        return self::checkTextValueFormat($arrayObject);
    }

    /**
     * For FILE value field
     * @param $arrayObject
     * @return bool
     */
    private static function checkFileValueFormat($arrayObject) {
        if(sizeof($arrayObject) == 1 && array_key_exists("value", $arrayObject) && gettype($arrayObject["value"]) == "string") {
            return true;
        }

        return false;
    }

    public static function constructValueTypeFormat($type, $value) {
        $json = '';

        if(in_array($type, ['EMAIL', 'FILE', 'NUMBER', 'PASSWORD', 'TEXT', 'TEXTAREA'])) {
            $json = '{"value": "'.$value.'"}';
        } else if(in_array($type, ['RADIO', 'SELECT'])) {
            $json = '{"value": "'.$value.'"}';
        } else if(in_array($type, ['CHECKBOX', 'SELECT_MULTIPLE'])) {
            $flag = false;
            $json = '{"value": [';
            foreach($value as $item) {
                if(!$flag) {
                    $json .= '"'.$item.'"';
                    $flag = true;
                } else {
                    $json .= ', "'.$item.'"';
                }

            }
            $json .= ']}';
        }

        return $json;
    }

    public static function checkMatchFileType(UploadedFile $file, $type) {
        $typeArray = $type == 'all' ? FormUtility::fileType['picture'] + FormUtility::fileType['document'] : FormUtility::fileType[$type];

        if(in_array($file->getMimeType(), $typeArray)) {
            return true;
        }

        return false;
    }

    /**
     * Set the session for generate the input field for applicant's registering page
     * @param $oldSessionName
     */
    public static function setCreateFieldForRegisterPageSession($oldSessionName) {
        Session::put('cFieldRegisPageSession', session($oldSessionName));
    }

    /**
     * Generate the input field for applicant's registering page
     * @param $fieldDetail
     * @param $fieldTitle
     * @param bool $require
     * @param bool $otherField
     * @param bool $disabled
     * @return mixed
     */
    public static function createFieldForRegisterPage($fieldDetail, $fieldTitle, $require = false, $otherField = false, $disabled = false) {
        $oldSession = Session::get('cFieldRegisPageSession');

        if(in_array($fieldDetail->field_type, ['DATE', 'EMAIL', 'NUMBER', 'PASSWORD', 'TEXT'])) {
            $data = [
                'id' => $fieldDetail->id,
                'title' => $fieldTitle,
                'require' => $require,
                'disabled' => $disabled,
                'oldvalue' => $oldSession && array_key_exists($fieldDetail->id, $oldSession) ? $oldSession[$fieldDetail->id] : null,
                'type' => strtolower($fieldDetail->field_type)
            ];

            return view('frontend.register.component.input_text')->with('data', $data);
        } else if(in_array($fieldDetail->field_type, ['TEXTAREA'])) {
            $data = [
                'id' => $fieldDetail->id,
                'title' => $fieldTitle,
                'require' => $require,
                'oldvalue' => $oldSession && array_key_exists($fieldDetail->id, $oldSession) ? $oldSession[$fieldDetail->id] : null,
            ];

            return view('frontend.register.component.input_textarea')->with('data', $data);
        } else if(in_array($fieldDetail->field_type, ['SELECT', 'SELECT_MULTIPLE'])) {
            $data = [
                'id' => $fieldDetail->id,
                'title' => $fieldTitle,
                'require' => $require,
                'oldvalue' => $oldSession ? $oldSession[$fieldDetail->id] : null,
                'lists' => self::constructArrayObject($fieldDetail->field_value)['lists'],
                'type' => $fieldDetail->field_type
            ];

            return view('frontend.register.component.input_select')->with('data', $data);
        } else if(in_array($fieldDetail->field_type, ['RADIO', 'CHECKBOX'])) {
            $data = [
                'id' => $fieldDetail->id,
                'title' => $fieldTitle,
                'require' => $require,
                'oldvalue' => $oldSession && array_key_exists($fieldDetail->id, $oldSession) ? $oldSession[$fieldDetail->id] : null,
                'lists' => self::constructArrayObject($fieldDetail->field_value)['lists'],
                'type' => strtolower($fieldDetail->field_type),
                'other' => $otherField,
                'otheroldvalue' => $oldSession && $otherField ? $oldSession[$fieldDetail->id."_other"] : null
            ];

            return view('frontend.register.component.input_select_box')->with('data', $data);
        } else if(in_array($fieldDetail->field_type, ['FILE'])) {
            $data = [
                'id' => $fieldDetail->id,
                'title' => $fieldTitle,
                'require' => $require,
                'type' => strtolower($fieldDetail->field_type)
            ];

            return view('frontend.register.component.input_file')->with('data', $data);
        }

        return '';
    }

    /**
     * Generate the form field for backend page
     * @param $fieldDetail
     * @param $fieldValue
     * @param bool $require
     * @param bool $disable
     * @return mixed
     * @throws \Exception
     */
    public static function createFieldForBackendPage($fieldDetail, $fieldValue, $require = false, $disable = false) {
        if(in_array($fieldDetail->field_type, ['DATE', 'EMAIL', 'NUMBER', 'PASSWORD', 'TEXT'])) {
            $data = [
                'id' => $fieldDetail->id,
                'title' => (new StringHelperService())->convertApplicantDetailKeyToName($fieldDetail->id),
                'value' => self::constructArrayObject($fieldValue)['value'],
                'require' => $require,
                'disable' => $disable,
                'type' => strtolower($fieldDetail->field_type)
            ];

            return view('backend.component.form.input_text')->with('data', $data);
        } else if(in_array($fieldDetail->field_type, ['TEXTAREA'])) {
            $data = [
                'id' => $fieldDetail->id,
                'title' => (new StringHelperService())->convertApplicantDetailKeyToName($fieldDetail->id),
                'value' => $fieldValue = self::constructArrayObject($fieldValue)['value'],
                'require' => $require,
                'disable' => $disable,
            ];

            return view('backend.component.form.input_textarea')->with('data', $data);
        } else if(in_array($fieldDetail->field_type, ['SELECT', 'SELECT_MULTIPLE'])) {
            $data = [
                'id' => $fieldDetail->id,
                'title' => (new StringHelperService())->convertApplicantDetailKeyToName($fieldDetail->id),
                'value' => self::constructFieldValueTypeSelect($fieldValue),
                'require' => $require,
                'disable' => $disable,
                'lists' => self::constructArrayObject($fieldDetail->field_value)['lists'],
                'type' => $fieldDetail->field_type
            ];

            return view('backend.component.form.input_select')->with('data', $data);
        } else if(in_array($fieldDetail->field_type, ['RADIO', 'CHECKBOX'])) {
            $data = [
                'id' => $fieldDetail->id,
                'title' => (new StringHelperService())->convertApplicantDetailKeyToName($fieldDetail->id),
                'value' => self::constructFieldValueTypeSelect($fieldValue),
                'require' => $require,
                'disable' => $disable,
                'lists' => self::constructArrayObject($fieldDetail->field_value)['lists'],
                'type' => strtolower($fieldDetail->field_type)
            ];

            return view('backend.component.form.input_select_box')->with('data', $data);
        } else if(in_array($fieldDetail->field_type, ['FILE'])) {
            $data = [
                'id' => $fieldDetail->id,
                'title' => (new StringHelperService())->convertApplicantDetailKeyToName($fieldDetail->id),
                'require' => $require,
                'disabled' => $disable,
                'type' => strtolower($fieldDetail->field_type)
            ];

            return view('backend.component.form.input_file')->with('data', $data);
        }

        return '';
    }

    private static function constructFieldValueTypeSelect($fieldValue) {
        if($fieldValue) {
            if(gettype($fieldValue) == 'string') {
                if(self::isFormattableJSON($fieldValue)) {
                    $valueArray = self::constructArrayObject($fieldValue)['value'];
                    if(gettype($valueArray) == 'string') {
                        $fieldValue = array($valueArray);
                    } else {
                        $fieldValue = $valueArray;
                    }
                } else {
                    $fieldValue = array($fieldValue);
                }
            } else if(gettype($fieldValue) != 'array') {
                throw new \Exception('unacceptable type fieldValue');
            }
        }

        return $fieldValue;
    }

}