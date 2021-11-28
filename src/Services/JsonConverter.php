<?php

namespace App\Services;

class JsonConverter extends Converter
{
    private const EXTENSION = '.json';

    /**
     * @return string
     */
    public function getExtension(): string
    {
        return self::EXTENSION;
    }

    /**
     * @param $xmlData
     * @param string $outputPath
     */
    public function writeToFile($xmlData, string $outputPath): void
    {
        $json = json_encode($xmlData);
        $fp = fopen($outputPath, 'w');
        fwrite($fp, $json);
        fclose($fp);
    }
}