<?php
/*
 * This file is part of the phporithms.
 *
 * (c) Alexander Golovnya <snsanich@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 * Date: 3/28/17
 * Time: 6:59 PM
 */

namespace Phporithms\Statistics;


class MedalTableTest extends \PHPUnit\Framework\TestCase
{
    public function provider()
    {
        return [
            [
                ["ITA JPN AUS", "KOR TPE UKR", "KOR KOR GBR", "KOR CHN TPE"],
                [
                    "KOR 3 1 0",
                    "ITA 1 0 0",
                    "TPE 0 1 1",
                    "CHN 0 1 0",
                    "JPN 0 1 0",
                    "AUS 0 0 1",
                    "GBR 0 0 1",
                    "UKR 0 0 1"
                ]
            ],
            [
                ["USA AUT ROM"],
                ["USA 1 0 0", "AUT 0 1 0", "ROM 0 0 1"]
            ],
            [
                ["GER AUT SUI", "AUT SUI GER", "SUI GER AUT"],
                ["AUT 1 1 1", "GER 1 1 1", "SUI 1 1 1"]
            ]
        ];
    }

    /**
     * @dataProvider provider
     */
    public function testOne(array $results, array $result)
    {
        $table = new MedalTable();
        $this->assertEquals($result, $table->generate($results));
    }
}
