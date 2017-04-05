<?php
/*
 * This file is part of the phporithms.
 *
 * (c) Alexander Golovnya <snsanich@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 * Date: 3/28/17
 * Time: 7:50 PM
 */

namespace Phporithms\Statistics;


/**
 * @author Alexander Golovnya <snsanich@gmail.com>
 */

class SmartWordToyWithIdentifier
{
    const C1_SHIFT = 26 * 26 * 26;
    const C2_SHIFT = 26 * 26;
    const C3_SHIFT = 26;

    private function code(string $s)
    {
        return (ord($s[0]) - ord('a')) * self::C1_SHIFT +
            (ord($s[1]) - ord('a')) * self::C2_SHIFT +
            (ord($s[2]) - ord('a')) * self::C3_SHIFT +
            (ord($s[3]) - ord('a'));
    }

    public function minPresses(string $start, string $finish, array $forbid): int
    {
        $forbidCodes = [];
        $queue = [];
        $stepCount = [];
        $visited = [];

        $queueEndPoint = $queueStartPoint = 0;

        while (count($forbid)) {
            $s = array_shift($forbid);
            $strings = explode(' ', $s);
            for ($i1 = 0; $i1 < strlen($strings[0]); ++$i1) {
                $c1 = ord($strings[0][$i1]) - ord('a');
                for ($i2 = 0; $i2 < strlen($strings[1]); ++$i2) {
                    $c2 = ord($strings[1][$i2]) - ord('a');
                    for ($i3 = 0; $i3 < strlen($strings[2]); ++$i3) {
                        $c3 = ord($strings[2][$i3]) - ord('a');
                        for ($i4 = 0; $i4 < strlen($strings[3]); ++$i4) {
                            $c4 = ord($strings[3][$i4]) - ord('a');
                            $code = $c1 * self::C1_SHIFT + $c2 * self::C2_SHIFT + $c3 * self::C3_SHIFT + $c4;
                            $forbidCodes[$code] = true;
                        }
                    }
                }
            }
        }

        $startCode = $this->code($start);
        $finishCode = $this->code($finish);

        if (array_key_exists($startCode, $forbidCodes) || array_key_exists($finishCode, $forbidCodes)) {
            return -1;
        }

        $temp = [];

        $queue[$queueEndPoint++] = $startCode;
        $visited[$startCode] = true;

        while ($queueStartPoint < $queueEndPoint) {
            $step = array_key_exists($queueStartPoint, $stepCount) ? $stepCount[$queueStartPoint] : 0;
            $code = array_key_exists($queueStartPoint, $queue) ? $queue[$queueStartPoint] : 0;
            $queueStartPoint++;

            if ($code === $finishCode) {
                $queueStartPoint--;
                return array_key_exists($queueStartPoint, $stepCount) ? $stepCount[$queueStartPoint] : 0;
            }

            $temp[3] = $code % 26;
            $code /= 26;
            $temp[2] = $code % 26;
            $code /= 26;
            $temp[1] = $code % 26;
            $code /= 26;
            $temp[0] = $code % 26;

            for ($k = 0; $k < 4; ++$k) {
                for ($b = 0; $b < 2; ++$b) {
                    $buf = $this->next($k, $b == 0, $temp);
                    $nextCode = $buf[0] * self::C1_SHIFT + $buf[1] * self::C2_SHIFT + $buf[2] * self::C3_SHIFT + $buf[3];
                    if (!array_key_exists($nextCode, $visited) && !array_key_exists($nextCode, $forbidCodes)) {
                        $visited[$nextCode] = true;
                        $stepCount[$queueEndPoint] = $step + 1;
                        $queue[$queueEndPoint++] = $nextCode;
                    }
                }
            }
        }

        return -1;
    }

    private function next(int $pos, bool $up, array $t)
    {
        $buf = $t;
        if ($up) {
            if (++$buf[$pos] == 26) {
                $buf[$pos] = 0;
            }
        } else {
            if (--$buf[$pos] == -1) {
                $buf[$pos] = 25;
            }
        }

        return $buf;
    }
}