<?php

class RegistrationPlateFormatter
{
    const REG_EX = [
        '/[A-Za-z]{1}\d{1}|\d{1}[A-Za-z]{1}/',
        '/[A-Za-z]{4}|\d{4}/'
    ];


    /**
     * @param $input
     * @return string
     */
    public function format($input)
    {
        $result = preg_replace_callback(self::REG_EX, function ($match) {
            $position = strlen($match[0]) == 4 ? 2 : 1;
            return substr_replace($match[0], '-', $position, 0);
        }, $input);
        return $result;
    }
}