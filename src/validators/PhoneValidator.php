<?php

namespace egor260890\feedback\validators;

use yii\validators\RegularExpressionValidator;

class PhoneValidator extends RegularExpressionValidator
{
    public $pattern = '/^[+]\d{3}\s\d{2}\s\d{3}\s\d{2}\s\d{2}/';
    public $message = 'Неправильный номер';
    protected static $mask='+375 99 999 99 99';

    public static function getMask(){
        return self::$mask;
    }
}
