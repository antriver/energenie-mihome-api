<?php

namespace Antriver\EnergenieMihomeApiTests;

use Antriver\EnergenieMihomeApi\Utils;

class UtilsTest extends AbstractTestCase
{
    public function dataForTestSnakeCaseToCamelCaseTest()
    {
        return [
            [
                'hello',
                'hello',
            ],
            [
                'hello_world',
                'helloWorld',
            ],
            [
                'HELLO_WORLD',
                'helloWorld',
            ],
            [
                'hello_there_world',
                'helloThereWorld',
            ],
            [
                'device_id',
                'deviceId',
            ],
        ];
    }

    /**
     * @dataProvider dataForTestSnakeCaseToCamelCaseTest
     *
     * @param string $input
     * @param string $expect
     */
    public function testSnakeCaseToCamelCaseTest(string $input, string $expect)
    {
        $this->assertSame($expect, Utils::snakeCaseToCamelCase($input));
    }
}
