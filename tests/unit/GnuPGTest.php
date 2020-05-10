<?php declare(strict_types = 1);
namespace PharIo\GnuPG;

use PharIo\Executor\Executor;
use PharIo\Executor\ExecutorResult;
use PharIo\FileSystem\Directory;
use PharIo\FileSystem\Filename;
use PHPUnit\Framework\TestCase;

/**
 * @covers \PharIo\GnuPG\GnuPG
 */
class GnuPGTest extends TestCase {
    public static function importExecutionResultProvider() {
        return [
            [
                'executionOutput' => ['IMPORT_OK 1 someFingerprint'],
                'expectedResult'  => [
                    'imported'    => 1,
                    'fingerprint' => 'someFingerprint'
                ]
            ],
            [
                'executionOutput' => ['ERROR'],
                'expectedResult'  => [
                    'imported' => 0
                ]
            ]
        ];
    }

    public static function verifyExecutionResultProvider() {
        return [
            [
                'executionOutput' => [
                    'SomeUnimportantLine',
                    '[GNUPG:] VALIDSIG D8406D0D82947747A394072C20A 2014-07-19 1405769272 0 4 0 1 10 00 D8C20A'
                ],
                'expectedResult' => [
                    [
                        'fingerprint' => 'D8406D0D82947747A394072C20A',
                        'validity'    => 0,
                        'timestamp'   => '1405769272',
                        'status'      => 0,
                        'summary'     => 0
                    ]
                ]
            ],
            [
                'executionOutput' => ['[GNUPG:] BADSIG 4AA394086372C20A Sebastian Bergmann <sb@sebastian-bergmann.de>'],
                'expectedResult'  => [
                    [
                        'fingerprint' => '4AA394086372C20A',
                        'validity'    => 0,
                        'timestamp'   => 0,
                        'status'      => 0,
                        'summary'     => 4
                    ]
                ]
            ],
            [
                'executionOutput' => ['[GNUPG:] ERRSIG 4AA394086372C20A 1 10 00 1405769272 9'],
                'expectedResult'  => [
                    [
                        'fingerprint' => '4AA394086372C20A',
                        'validity'    => 0,
                        'timestamp'   => '1405769272',
                        'status'      => 0,
                        'summary'     => 128
                    ]
                ]
            ],
            [
                'executionOutput' => ['SOME ERROR'],
                'expectedResult'  => false
            ]
        ];
    }

    /**
     * @dataProvider importExecutionResultProvider
     *
     * @param $executionOutput
     */
    public function testImportReturnsExpectedArray($executionOutput, array $expectedResult): void {
        $executorResult = $this->getExecutorResultMock();
        $executorResult->method('getOutput')->willReturn($executionOutput);
        $executor = $this->getExecutorMock();
        $executor->method('execute')->willReturn($executorResult);

        $gpgBinary = $this->getFilenameMock();

        $tmpFile = $this->getFilenameMock();
        $tmpFile->method('asString')->willReturn(\uniqid('test', true));

        $tmpDirectory = $this->getDirectoryMock();
        $tmpDirectory->method('file')->willReturn($tmpFile);

        $homeDirectory = $this->getDirectoryMock();
        $gpg           = new GnuPG($executor, $gpgBinary, $tmpDirectory, $homeDirectory);

        $actual = $gpg->import('someKey');

        $this->assertSame($expectedResult, $actual);
    }

    /**
     * @dataProvider verifyExecutionResultProvider
     *
     * @param $executionOutput
     * @param array|bool $expectedResult
     */
    public function testVerifyReturnsExpectedArray($executionOutput, $expectedResult): void {
        $executorResult = $this->getExecutorResultMock();
        $executorResult->method('getOutput')->willReturn($executionOutput);
        $executor = $this->getExecutorMock();
        $executor->method('execute')->willReturn($executorResult);

        $gpgBinary = $this->getFilenameMock();

        $tmpFile = $this->getFilenameMock();
        $tmpFile->method('asString')->willReturn(\uniqid('test', true));

        $tmpDirectory = $this->getDirectoryMock();
        $tmpDirectory->method('file')->willReturn($tmpFile);

        $homeDirectory = $this->getDirectoryMock();
        $gpg           = new GnuPG($executor, $gpgBinary, $tmpDirectory, $homeDirectory);

        $actual = $gpg->verify('someMessage', 'someSignature');

        $this->assertEquals($expectedResult, $actual);
    }

    /**
     * @dataProvider infoExecutionResultProvider
     *
     * @param $executionOutput
     * @param array $expectedResult
     */
    public function testInfoReturnsExpectedArray($executionOutput, $expectedResult): void {
        $executorResult = $this->getExecutorResultMock();
        $executorResult->method('getOutput')->willReturn($executionOutput);
        $executor = $this->getExecutorMock();
        $executor->method('execute')->willReturn($executorResult);

        $gpgBinary = $this->getFilenameMock();

        $tmpFile = $this->getFilenameMock();
        $tmpFile->method('asString')->willReturn(\uniqid('test', true));

        $tmpDirectory = $this->getDirectoryMock();
        $tmpDirectory->method('file')->willReturn($tmpFile);

        $homeDirectory = $this->getDirectoryMock();
        $gpg           = new GnuPG($executor, $gpgBinary, $tmpDirectory, $homeDirectory);

        $actual = $gpg->keyinfo('someKeyIdentifier');

        $this->assertEquals($expectedResult, $actual);
    }

    public function infoExecutionResultProvider() {
        return [
            'key1' => [
                'executionOutput' => \file(__DIR__ . '/fixtures/key1-output.txt'),
                'expectedResult'  => include __DIR__ . '/fixtures/key1-array.php'
            ],
            'key2' => [
                'executionOutput' => \file(__DIR__ . '/fixtures/key2-output.txt'),
                'expectedResult'  => include __DIR__ . '/fixtures/key2-array.php'
            ],
            'key3' => [
                'executionOutput' => \file(__DIR__ . '/fixtures/key3-output.txt'),
                'expectedResult'  => include __DIR__ . '/fixtures/key3-array.php'
            ]
        ];
    }

    /**
     * @return ExecutorResult|\PHPUnit_Framework_MockObject_MockObject
     */
    private function getExecutorResultMock() {
        $result = $this->createMock(ExecutorResult::class);
        $result->method('getExitCode')->willReturn(0);

        return $result;
    }

    /**
     * @return Directory|\PHPUnit_Framework_MockObject_MockObject
     */
    private function getDirectoryMock() {
        return $this->createMock(Directory::class);
    }

    /**
     * @return Filename|\PHPUnit_Framework_MockObject_MockObject
     */
    private function getFilenameMock() {
        return $this->createMock(Filename::class);
    }

    /**
     * @return Executor|\PHPUnit_Framework_MockObject_MockObject
     */
    private function getExecutorMock() {
        return $this->createMock(Executor::class);
    }
}
