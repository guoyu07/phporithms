<?php
/*
 * This file is part of the phporithms.
 *
 * (c) Alexander Golovnya <snsanich@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 * Date: 3/28/17
 * Time: 10:03 PM
 */

namespace Phporithms\Statistics;

class SmartWordToyTest extends \PHPUnit\Framework\TestCase
{
    public function provider()
    {
        return [
            [
                "aaaa",
                "zzzz",
                ["a a a z", "a a z a", "a z a a", "z a a a", "a z z z", "z a z z", "z z a z", "z z z a"],
                8
            ],
            [
                "aaaa",
                "bbbb",
                [],
                4
            ],
            [
                "aaaa",
                "mmnn",
                [],
                50
            ],
            [
                "aaaa",
                "zzzz",
                ["bz a a a", "a bz a a", "a a bz a", "a a a bz"],
                -1
            ],
            [
                "aaaa",
                "zzzz",
                [
                    "cdefghijklmnopqrstuvwxyz a a a",
                    "a cdefghijklmnopqrstuvwxyz a a",
                    "a a cdefghijklmnopqrstuvwxyz a",
                    "a a a cdefghijklmnopqrstuvwxyz"
                ],
                6
            ],
            [
                "aaaa",
                "bbbb",
                ["b b b b"],
                -1
            ],
            [
                "zzzz",
                "aaaa",
                [
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                    "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk"
                ],
                -1
            ]
        ];
    }

    /**
     * @dataProvider provider
     * @param string $start
     * @param string $finish
     * @param array $forbid
     * @param int $expected
     */
    public function testOne(string $start, string $finish, array $forbid, int $expected)
    {
        $toy = new SmartWordToyWithIdentifier;
        $this->assertEquals($expected, $toy->minPresses($start, $finish, $forbid));
    }
}
