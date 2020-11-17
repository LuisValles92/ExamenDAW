<?php
namespace VivaYasu\Int2Eng\Tests;

use VivaYasu\Int2Eng\Int2Eng;

class Int2EngTest extends \PHPUnit_Framework_TestCase
{
    public function testConvertIntToEng()
    {
        $test_integers = [0, 9, 15, 49, 72, 102, 336, 769, 1190];
        $test_engs = ['zero', 'nine', 'fifteen', 'forty nine', 'seventy two', 'one hundred and two', 'three hundred and thirty six', 'seven hundred and sixty nine', 'eleven hundred and ninety'];

        $i = 0;
        foreach ($test_engs as $t) {
            $int2eng = new Int2Eng($test_integers[$i]);
            $this->assertEquals($t, $int2eng->get_eng());
            $i++;
        }
    }
}