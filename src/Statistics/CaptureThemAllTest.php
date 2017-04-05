<?php
/*
 * This file is part of the phporithms.
 *
 * (c) Alexander Golovnya <snsanich@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 * Date: 3/29/17
 * Time: 12:51 AM
 */

namespace Phporithms\Statistics;


class CaptureThemAllTest extends \PHPUnit\Framework\TestCase
{
    public function provider()
    {
        return [
            [
                "a1",
                "b3",
                "c5",
                2
            ],
            [
                "b1",
                "c3",
                "a3",
                3
            ],
            [
                "a1",
                "a2",
                "b2",
                6
            ],
            [
                "a5",
                "b7",
                "e4",
                3
            ],
            [
                "h8",
                "e2",
                "d2",
                6
            ]
        ];
    }

    /**
     * @dataProvider provider
     * @param string $knight
     * @param string $rook
     * @param string $queen
     * @param int $result
     */
    public function testOne(string $knight, string $rook, string $queen, int $result)
    {
        $capture = new CaptureThemAll();
        $this->assertEquals($result, $capture->fastKnight($knight, $rook, $queen));
    }
}
