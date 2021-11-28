<?php

namespace App\Services;

abstract class Converter
{
    /**
     * @return string
     */
    public abstract function getExtension(): string;

    /**
     * @param $xmlData
     * @param string $outputPath
     */
    public abstract function writeToFile($xmlData, string $outputPath): void;

    /**
     * @param string $xmlFileInput
     */
    public function execute(string $xmlFileInput): void
    {
        $xmlData = simplexml_load_file($xmlFileInput);
        $outputPath = $this->generateOutputPath($xmlFileInput);
        $this->writeToFile($xmlData, $outputPath);
    }

    /**
     * @param string $xmlFileInput
     * @return string
     */
    private function generateOutputPath(string $xmlFileInput): string
    {
        $pathInfo = pathinfo($xmlFileInput);
        return ($pathInfo['dirname'] === '.' ? '' : $pathInfo['dirname']) .
            $pathInfo['filename'] .
            $this->getExtension();
    }
}