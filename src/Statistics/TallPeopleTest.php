<?php
/*
 * This file is part of the phporithms.
 *
 * (c) Alexander Golovnya <snsanich@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 * Date: 3/28/17
 * Time: 5:36 PM
 */

namespace Phporithms\Statistics;


class TallPeopleTest extends \PHPUnit\Framework\TestCase
{
    public function provider()
    {
        return [
            [
                [
                    "34 45 66 134",
                    "335 512 34 55"
                ],
                [34, 66]
            ],
            [
                [
                    "9 2 3",
                    "4 8 7"
                ],
                [4, 7],
                "The heights 2 and 4 are the shortest from the rows, so 4 is the taller of the two. The heights 9, 8, and 7 are the tallest from the columns, so 7 is the shortest of the 3."
            ],
            [
                [
                    "1 2",
                    "4 5",
                    "3 6"
                ],
                [4, 4]
            ],
            [
                [
                    "1 1",
                    "1 1"
                ],
                [1, 1]
            ]
        ];
    }

    /**
     * @dataProvider provider
     */
    public function testOne(array $people, array $result)
    {
        $tallPeople = new TallPeople();
        $this->assertEquals($result, $tallPeople->getPeople($people));
    }
}
