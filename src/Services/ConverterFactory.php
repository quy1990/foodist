<?php

namespace App\Services;

use Exception;

class ConverterFactory
{
    /**
     * @throws Exception
     */
    public static function getConverter(string $type): Converter
    {
        switch ($type) {
            case "csv":
                return new CSVConverter();
            case "excel":
                return new ExcelConverter();
            case "json":
                return new JsonConverter();
            default:
                throw new Exception('we dont support this type: Csv, json, excel are supported');
        }
    }
}