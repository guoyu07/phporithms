<?php
/*
 * This file is part of the phporithms.
 *
 * (c) Alexander Golovnya <snsanich@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 * Date: 3/29/17
 * Time: 2:43 PM
 */

namespace Phporithms\Statistics;


class RevolvingDoorsTest extends \PHPUnit\Framework\TestCase
{
    public function provider()
    {
        return [
            /**[
                [
                    "    ### ",
                    "    #E# ",
                    "   ## # ",
                    "####  ##",
                    "# S -O-#",
                    "# ###  #",
                    "#      #",
                    "########"
                ],
                2
            ],
            [
                [
                    "#### ",
                    "#S|##",
                    "# O #",
                    "##|E#",
                    " ####"
                ],
                -1
            ],*/
            [
                [
                    " |  |  |     |  |  |  |  |  | ",
                    " O  O EO -O- O  O  O  O  OS O ",
                    " |  |  |     |  |  |  |  |  | "
                ],
                7
            ]/**,
            [
                [
                    "###########",
                    "#    #    #",
                    "#  S | E  #",
                    "#    O    #",
                    "#    |    #",
                    "#         #",
                    "###########"
                ],
                0
            ],
            [
                [
                    "        E",
                    "    |    ",
                    "    O    ",
                    "    |    ",
                    " -O-S-O- ",
                    "    |    ",
                    "    O    ",
                    "    |    ",
                    "         "
                ],
                -1
            ],
            [
                [
                    "##E#   ",
                    "#  ##  ",
                    " -O-## ",
                    " #  ## ",
                    " ##  ##",
                    "  -O-  ",
                    "##  ## ",
                    " # ### ",
                    " #  S  "
                ],
                5
            ],
            [
                [
                    "#############",
                    "#  #|##|#   #",
                    "#   O  O    #",
                    "# E || || S #",
                    "#    O  O   #",
                    "#   #|##|#  #",
                    "#############"
                ],
                4
            ]*/
        ];
    }

    /**
     * @dataProvider provider
     * @param array $map
     * @param int $result
     */
    public function testOne(array $map, int $result)
    {
        $doors = new RevolvingDoors();
        $this->assertEquals($result, $doors->turns($map));
    }
}
