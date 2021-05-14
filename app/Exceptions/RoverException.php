<?php

namespace App\Exceptions;

use Exception;

class RoverException extends Exception
{
    const DATA_COUNT_NOT_MATCH = 1;
    const INVALID_DATA = 2;
    const INVALID_DIRECTION = 3;
    const SOMETHING_WENT_WRONG = 4;
    const INVALID_ACTION = 5;
    const INVALID_LOCATION = 6;
    const INVALID_PATH = 7;

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

    public static function invalidDirection($direction)
    {
        return new self(
            'Invalid direction entered!' . serialize($direction),
            self::INVALID_DATA
        );
    }

    public static function somethingWentWrong()
    {
        return new self(
            'Something went Wrong',
            self::SOMETHING_WENT_WRONG
        );
    }

    public static function invalidAction($action)
    {
        return new self(
            'Invalid Action!' . serialize($action),
            self::INVALID_ACTION
        );
    }

    public static function invalidLocation($location)
    {
        return new self(
            'Invalid location entered!' . serialize($location),
            self::INVALID_LOCATION
        );
    }

    public static function invalidPath($path)
    {
        return new self(
            'Invalid path entered!' . serialize($path),
            self::INVALID_LOCATION
        );
    }
}
