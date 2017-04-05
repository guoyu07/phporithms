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


/**
 *
 *
 * The Olympic Games in Athens end tomorrow. Given the results of the olympic disciplines,
 * generate and return the medal table.
 *
 *
 * The results of the disciplines are given as a String[] results, where each element is in
 * the format "GGG SSS BBB". GGG, SSS and BBB are the 3-letter country codes (three capital
 * letters from 'A' to 'Z') of the czountries winning the gold, silver and bronze medal, respectively.
 *
 *
 * The medal table is a String[] with an element for each country appearing in results.
 * Each element has to be in the format "CCO G S B" (quotes for clarity), where G, S
 * and B are the number of gold, silver and bronze medals won by country CCO, e.g.
 * "AUT 1 4 1". The numbers should not have any extra leading zeros.
 *
 *
 * Sort the elements by the number of gold medals won in decreasing order.
 * If several countries are tied, sort the tied countries by the number of silver medals won in decreasing order.
 * If some countries are still tied, sort the tied countries by the number of bronze medals won in decreasing order.
 * If a tie still remains, sort the tied countries by their 3-letter code in ascending alphabetical order.
 *
 *
 * @author Alexander Golovnya <snsanich@gmail.com>
 */

class MedalTable
{
    public function generate(array $results): array
    {
        $countriesMap = [];
        foreach ($results as $result) {
            list($gold, $silver, $bronze) = explode(' ', $result);
            if (!isset($countriesMap[$gold])) {
                $countriesMap[$gold] = [0, 0, 0];
            }
            $countriesMap[$gold][0] += 1;

            if (!isset($countriesMap[$silver])) {
                $countriesMap[$silver] = [0, 0, 0];
            }
            $countriesMap[$silver][1] += 1;

            if (!isset($countriesMap[$bronze])) {
                $countriesMap[$bronze] = [0, 0, 0];
            }
            $countriesMap[$bronze][2] += 1;
        }

        $result = [];
        foreach ($countriesMap as $country => $data) {
            $sortKey = $data[0] * 1000000 + $data[1] * 1000 + $data[2];
            $secondSortKey = $country;
            $result[] = [
                $sortKey,
                $secondSortKey,
                sprintf("%'.03s %d %d %d", $country, $data[0], $data[1], $data[2])
            ];
        }

        usort($result, function ($a, $b) {
            if ($a[0] !== $b[0]) {
                return $a[0] > $b[0] ? -1 : 1;
            }

            return $a[1] > $b[1] ? 1 : -1;
        });

        return array_map(function ($a) {
            return $a[2];
        }, $result);
    }
}