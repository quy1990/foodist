<?php

namespace App\Services;

class CSVConverter extends Converter
{
    const EXTENSION = '.csv';

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
        $header = false;
        $outputFile = fopen($outputPath, 'w');
        foreach ($xmlData as $value) {
            if (!$header) {
                fputcsv($outputFile, array_keys(get_object_vars($value)));
                $header = true;
            }
            fputcsv($outputFile, get_object_vars($value));
        }

        fclose($outputFile);
    }
}