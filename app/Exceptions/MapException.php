<?php

namespace App\Exceptions;

use Exception;

class MapException extends Exception
{
    const DATA_COUNT_NOT_MATCH = 1;
    const INVALID_DATA = 2;

    public static function dataCountDoesNotMatch()
    {
        return new self(
            'Data count does not match!',
            self::DATA_COUNT_NOT_MATCH
        );
    }

    public static function invalidDataEntered($data)
    {
        return new self(
            'Invalid data entered!' . serialize($data),
            self::INVALID_DATA
        );
    }
}
