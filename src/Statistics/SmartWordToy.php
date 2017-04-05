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

class SmartWordToy
{
    const NOT_ALLOWED = -1;

    private $queue;

    public function __construct()
    {
        $this->queue = new \SplQueue();
    }

    protected function enqueue(string $value)
    {
        $this->queue->enqueue($value);
    }

    private function dequeue(): string
    {
        return $this->queue->dequeue();
    }

    private function isEmpty()
    {
        return $this->queue->isEmpty();
    }

    private function buildNodes(string $node, array $forbid = [])
    {
        $letters = 26;
        $first = ord('a');

        $rawEdges = [
            [$node, 0, -1],
            [$node, 0, 1],
            [$node, 1, -1],
            [$node, 1, 1],
            [$node, 2, -1],
            [$node, 2, 1],
            [$node, 3, -1],
            [$node, 3, 1],
        ];

        $edges = [];
        foreach ($rawEdges as $rawEdge) {
            list($child, $index, $increment) = $rawEdge;
            $newOrd = ord($child[$index]) - $first + $increment;
            if ($newOrd < 0) {
                $newOrd += $letters;
            }
            $child[$index] = chr($newOrd % $letters + $first);

            if (array_key_exists($child, $forbid)) {
                continue;
            }

            $edges[] = $child;
        }
        return $edges;
    }

    private function addDirection(int $weight, array &$directionMap, string $node)
    {
        $currentWeight = $weight + 1;
        if (!array_key_exists($node, $directionMap) || $directionMap[$node] > $currentWeight) {
            $directionMap[$node] = $currentWeight;
        }
    }

    private function forbidMap(array $forbid)
    {
        $result = [];
        foreach ($forbid as $value) {
            $letters = explode(' ', $value);
            if (count($letters) !== 4) {
                return self::NOT_ALLOWED;
            }

            $indexes = [0, 0, 0, 0];

            do {
                $key = $letters[0][$indexes[0]] . $letters[1][$indexes[1]] . $letters[2][$indexes[2]] . $letters[3][$indexes[3]];
                $result[$key] = true;

                if (strlen($letters[3]) - 1 > $indexes[3]) {
                    $indexes[3]++;
                    continue;
                }

                if (strlen($letters[2]) - 1 > $indexes[2]) {
                    $indexes[2]++;
                    $indexes[3] = 0;
                    continue;
                }

                if (strlen($letters[1]) - 1 > $indexes[1]) {
                    $indexes[1]++;
                    $indexes[2] = 0;
                    $indexes[3] = 0;
                    continue;
                }

                if (strlen($letters[0]) - 1 > $indexes[0]) {
                    $indexes[0]++;
                    $indexes[1] = 0;
                    $indexes[2] = 0;
                    $indexes[3] = 0;
                    continue;
                }

                break;
            } while (true);
        }
        return $result;
    }

    public function minPresses(string $start, string $finish, array $forbid): int
    {
        $forbidMap = $this->forbidMap($forbid);
        if ($forbidMap === self::NOT_ALLOWED) {
            return self::NOT_ALLOWED;
        }

        if (array_key_exists($finish, $forbidMap)) {
            return self::NOT_ALLOWED;
        }

        $visitMap = [];
        $directionMap = [
            $start => 0
        ];
        $this->enqueue($start);
        $queueStartPoint = 0;
        do {
            ++$queueStartPoint;
            $node = $this->dequeue();

            if ($node === $finish) {
                fwrite(STDERR, PHP_EOL. $queueStartPoint . PHP_EOL);
                return $directionMap[$node];
            }

            if (array_key_exists($node, $visitMap)) {
                continue;
            }

            $weight = $directionMap[$node];
            foreach ($this->buildNodes($node, $forbidMap) as $child) {

                if (array_key_exists($child, $visitMap)) {
                    continue;
                }

                $this->addDirection($weight, $directionMap, $child);
                $this->enqueue($child);
            }

            $visitMap[$node] = true;

        } while (!$this->isEmpty());

        return -1;
    }
}