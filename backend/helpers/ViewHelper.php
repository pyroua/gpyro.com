<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 31.07.17
 * Time: 11:12
 */

namespace backend\helpers;


class ViewHelper
{

    /**
     * @param $context
     * @param string $controller
     * @param array $actions
     * @return bool
     */
    public function isActive($context, string $controller, array $actions)
    {
        if ($context->id == $controller && in_array($context->action->id, $actions)) {
            return true;
        }
    }

    /**
     * @param string $inputName
     * @return string
     */
    public function getDatapickerJsInitiator(string $inputName)
    {
        $script = <<<JS
            $('input[name="$inputName"]').kvDatepicker({
                    format: "dd-mm-yyyy",
                    clearBtn: true
            });
JS;
//маркер конца строки, обязательно сразу, без пробелов и табуляции
        return $script;
    }

    /**
     * @param string $formId
     * @param string $fieldId
     * @param string $fieldName
     * @param array $validators
     * @return string
     */
    public function createDinamycJsValidator(
        string $formId,
        string $fieldId,
        string $fieldName,
        array $validators
    )
    {
        $fieldIdMD5 = md5($fieldId);

        $validatorsData = self::configVaalidators($validators);
        if (!empty($validatorsData)) {
            $validatorsData = "function (attribute, value, messages, deferred, form) {
                $validatorsData
            }";
        } else {
            $validatorsData = 'null';
        }

        $script = <<<JS
    
        // make sure that the form is initialized
        var activeFormWaiter$fieldIdMD5 = setInterval(function(event) {
            if (typeof $('#$formId').yiiActiveForm !== 'undefined') { 
                console.log('ActiveForm inited');
                clearInterval(activeFormWaiter$fieldIdMD5);
                
                $('#$formId').yiiActiveForm('add', {
                    id: '$fieldId',
                    name: '$fieldName',
                    container: '.field-$fieldId',
                    input: '#$fieldId',
                    error: '.help-block',
                    validate: $validatorsData
                }); 
                
            } else {
                console.log('Waiting for ActiveForm...');
            }
        }, 500);

JS;

        return $script;
    }

    /**
     * @param int $type
     * @param bool $required
     * @return array
     * @throws \Exception
     */
    public function getValidatorsByOptionType(int $type, bool $required = false)
    {
        $validators = [];
        switch ($type) {

            case 3:
                $validators[] = ['type' => 'dateValidator'];
                break;

            case 2:
                $validators[] = ['type' => 'string'];
                break;

            case 1:
                $validators[] = ['type' => 'decimal'];
                break;

            case 0:
                $validators[] = ['type' => 'integer'];
                break;

            default:
                throw new \Exception('Type incorrect');
        }

        if ($required) {
            $validators[] = ['type' => 'required'];
        }

        return $validators;

    }

    /**
     * @param array $params
     * @return string
     */
    private static function configVaalidators(array $params)
    {
        \Yii::debug($params);

        $result = '';
        foreach ($params as $validator) {
            switch ($validator['type']) {
                case 'dateValidator':
                    // dd-mm-yyy validator
                    $pattern = '/(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})/';
                    $result .= 'dateValidator(value, messages, {skipOnEmpty: true, message: "Date format incorrect", pattern: ' . $pattern . ', date_format: "dd-mm-yyyy"});' . "\n";
                    break;

                case 'required':
                    $result .= 'yii.validation.required(value, messages, {message: "Required field"});' . "\n";
                    break;

                case 'integer':
                    $result .= 'yii.validation.number(value, messages, {skipOnEmpty: true, type: "integer", message: "Must be an integer", pattern: /^[-+]?\d+$/});' . "\n";
                    break;

                case 'string':
                    $result .= 'yii.validation.string(value, messages, {skipOnEmpty: true, message: "Must be a string"});' . "\n";
                    break;

                case 'decimal':
                    $result .= 'yii.validation.number(value, messages, {skipOnEmpty: true, message: "Must be decimal", pattern: /^\d+(\.\d{1,2})?/});' . "\n";
                    break;
            }
        }

        return $result;
    }
}