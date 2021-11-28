<?php

namespace App\Services;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelConverter extends Converter
{
    private const EXTENSION = '.xlsx';

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
     * @throws Exception
     */
    public function writeToFile($xmlData, string $outputPath): void
    {
        $spreadsheet = new Spreadsheet();
        $activeSheet = $spreadsheet->getActiveSheet();
        $i = 1;
        $header = false;
        foreach ($xmlData as $value) {
            if (!$header) {
                $activeSheet->setCellValue('A1', array_keys(get_object_vars($value))[0]);
                $activeSheet->setCellValue('B1', array_keys(get_object_vars($value))[1]);
                $header = true;
            }
            $i = $i + 1;
            $activeSheet->setCellValue('A' . $i, array_values(get_object_vars($value))[0]);
            $activeSheet->setCellValue('B' . $i, array_values(get_object_vars($value))[1]);
        }

        $excelWriter = new Xlsx($spreadsheet);
        $excelWriter->save($outputPath);
    }

}