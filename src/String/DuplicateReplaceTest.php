<?php
/*
 * This file is part of the phporithms.
 *
 * (c) Alexander Golovnya <snsanich@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 * Date: 3/24/17
 * Time: 6:31 PM
 */

namespace Phporithms\String;


/**
 * Verify if string links can be separated during modifing one string
 * @author Alexander Golovnya <snsanich@gmail.com>
 */

class DuplicateReplaceTest extends \PHPUnit\Framework\TestCase
{
    public function testReplacementInDuplicate()
    {
        $str1 = 'Hello world!';
        $str2 = $str1;
        $str2[6] = 'G';
        $str2[8] = '.';
        $this->assertNotEquals($str2, $str1);
        $this->assertEquals('Hello Go.ld!', $str2);
    }
}