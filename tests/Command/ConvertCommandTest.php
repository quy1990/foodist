<?php

namespace App\Tests\Command;

use Exception;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class ConvertCommandTest extends KernelTestCase
{
    private $convertCommand;

    public function setUp(): void
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find('app:convert');
        $this->convertCommand = new CommandTester($command);
    }

    public function test_convert_xml_to_csv()
    {
        $this->convertCommand->execute([
            'path' => dirname(__FILE__) . '/test.xml',
            'type' => 'csv',
        ]);
        $this->assertStringContainsString('done', $this->convertCommand->getDisplay());
    }

    public function test_convert_xml_to_excel()
    {
        $this->convertCommand->execute([
            'path' => dirname(__FILE__) . '/test.xml',
            'type' => 'excel',
        ]);
        $this->assertStringContainsString('done', $this->convertCommand->getDisplay());
    }

    public function test_convert_xml_to_json()
    {
        $this->convertCommand->execute([
            'path' => dirname(__FILE__) . '/test.xml',
            'type' => 'json',
        ]);

        $this->assertStringContainsString('done', $this->convertCommand->getDisplay());
    }

    public function test_convert_fail()
    {
        $this->expectException(Exception::class);
        $this->convertCommand->execute([
            'path' => dirname(__FILE__) . '/test.xml',
            'type' => 'doc',
        ]);
    }
}