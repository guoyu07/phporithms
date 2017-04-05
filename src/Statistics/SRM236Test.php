<?php
/*
 * This file is part of the phporithms.
 *
 * (c) Alexander Golovnya <snsanich@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 * Date: 3/28/17
 * Time: 5:14 PM
 */

namespace Phporithms\Statistics;

class SRM236Test extends \PHPUnit\Framework\TestCase
{

    public function provider()
    {
        return [
            [
                ["a"],
                35234,
                "a"
            ],
            [
                [],
                34534,
                ""
            ],
            [
                ["a"],
                0,
                ""
            ],
            [
                ["a", "b", "c", "d"],
                2,
                "a",
                "We start counting from a. So a is 1, b is 2. We remove b, so list is now {a,c,d}. We continue from c. So c is 1, d is 2. We remove d, so list is now {a,c}. We continue from a. So a is 1, c is 2. We remove c, and now we are left with the last task a."
            ],
            [
                ["a", "b", "c", "d", "e"],
                3,
                "d",
                "We start counting from a. So a is 1, b is 2, c is 3. We remove c, now list = {a,b,d,e}. We continue from d. So d is 1, e is 2, a is 3. We remove a, now list = {b,d,e}. We continue from b. So b is 1, d is 2, e is 3. We remove e, now list = {b,d}. We continue from b. So b is 1, d is 2 and finally b is 3. We remove b, and now we are left with just one task d."
            ],
            [
                ["alpha", "beta", "gamma", "delta", "epsilon"],
                1,
                "epsilon"
            ],
            [
                ["a", "b"],
                1000,
                "a"
            ],
            [
                [
                    "a",
                    "b",
                    "c",
                    "d",
                    "e",
                    "f",
                    "g",
                    "h",
                    "i",
                    "j",
                    "k",
                    "l",
                    "m",
                    "n",
                    "o",
                    "p",
                    "q",
                    "r",
                    "s",
                    "t",
                    "u",
                    "v",
                    "w",
                    "x",
                    "y",
                    "z"
                ],
                17,
                "n"
            ],
            [
                [
                    "zlqamum",
                    "yjsrpybmq",
                    "tjllfea",
                    "fxjqzznvg",
                    "nvhekxr",
                    "am",
                    "skmazcey",
                    "piklp",
                    "olcqvhg",
                    "dnpo",
                    "bhcfc",
                    "y",
                    "h",
                    "fj",
                    "bjeoaxglt",
                    "oafduixsz",
                    "kmtbaxu",
                    "qgcxjbfx",
                    "my",
                    "mlhy",
                    "bt",
                    "bo",
                    "q"
                ],
                9000000,
                "fxjqzznvg"
            ]
        ];
    }

    /**
     * @dataProvider provider
     */
    public function testOne(array $list, int $n, string $result, $message = '')
    {
        $srm = new SRM236;
        $this->assertEquals($result, $srm($list, $n), $message);
    }
}
