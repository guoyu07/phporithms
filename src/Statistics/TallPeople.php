<?php
/*
 * This file is part of the phporithms.
 *
 * (c) Alexander Golovnya <snsanich@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 * Date: 3/28/17
 * Time: 5:35 PM
 */

namespace Phporithms\Statistics;


/**
 *
 * A group of people stand before you arranged in rows and columns.
 * Looking from above, they form an R by C rectangle of people.
 * You will be given a String[] people containing the height of each person.
 * Elements of people correspond to rows in the rectangle. Each element contains a space-delimited list of integers representing the heights of the people in that row. Your job is to return 2 specific heights in a int[]. The first is computed by finding the shortest person in each row, and then finding the tallest person among them (the "tallest-of-the-shortest"). The second is computed by finding the tallest person in each column, and then finding the shortest person among them (the "shortest-of-the-tallest").
 *
 * @author Alexander Golovnya <snsanich@gmail.com>
 */

class TallPeople
{
    /**
     * @param array|string[] $people
     * @return array|int[]
     */
    public function getPeople(array $people): array
    {
        $table = [];
        $tallestOfTheShortests = [];
        foreach ($people as $i => $row) {
            $table[$i] = explode(' ', $row);
            $tallestOfTheShortests[] = min($table[$i]);
        }

        $columnCount = count(current($table));
        $rowCount = count($table);
        $shortestOfTheTallests = [];

        for ($j = 0; $j < $columnCount; $j++) {
            $list = [];
            for ($i = 0; $i < $rowCount; $i++) {
                $list[] = $table[$i][$j];
            }
            $shortestOfTheTallests[] = max($list);
        }

        return [
            (int)max($tallestOfTheShortests),
            (int)min($shortestOfTheTallests)
        ];
    }
}