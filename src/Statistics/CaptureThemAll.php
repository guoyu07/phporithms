<?php
/*
 * This file is part of the phporithms.
 *
 * (c) Alexander Golovnya <snsanich@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 * Date: 3/29/17
 * Time: 12:50 AM
 */

namespace Phporithms\Statistics;


/**
 * @author Alexander Golovnya <snsanich@gmail.com>
 */

class CaptureThemAll
{

    private function buildNodes(string $node)
    {
        $first = ord('a');
        $last = ord('h');
        $column = ord($node[0]);
        $row = (int)$node[1];

        $rawEdges = [
            [$column - 2, $row - 1],
            [$column - 2, $row + 1],
            [$column + 2, $row - 1],
            [$column + 2, $row + 1],
            [$column - 1, $row - 2],
            [$column - 1, $row + 2],
            [$column + 1, $row - 2],
            [$column + 1, $row + 2]
        ];

        $edges = [];
        foreach ($rawEdges as $rawEdge) {
            list($y, $x) = $rawEdge;
            if ($y < $first || $y > $last) {
                continue;
            }

            if ($x < 1 || $x > 8) {
                continue;
            }

            $edges[] = chr($y) . $x;
        }
        return $edges;
    }

    public function fastKnight(string $knight, string $rook, string $queen): int
    {
        $x1 = $this->fastKnightToGoal($knight, $rook);
        $x2 = $this->fastKnightToGoal($rook, $queen);

        $y1 = $this->fastKnightToGoal($knight, $queen);
        $y2 = $this->fastKnightToGoal($queen, $rook);

        $x = INF;
        $y = INF;
        if ($x1 !== -1 && $x2 !== -1) {
            $x = $x1 + $x2;
        }

        if ($y1 !== -1 && $y2 !== -1) {
            $y = $y1 + $y2;
        }

        $result = min($x, $y);

        if ($result === INF) {
            return -1;
        }

        return $result;
    }

    public function fastKnightToGoal(string $knight, string $finish): int
    {
        $visitMap = [];
        $directionMap = [
            $knight => 0
        ];

        $queue = new \SplQueue();
        $queue->enqueue($knight);
        do {
            $node = $queue->dequeue();

            if ($node === $finish) {
                return $directionMap[$node];
            }

            $weight = $directionMap[$node];
            foreach ($this->buildNodes($node) as $child) {

                if (array_key_exists($child, $visitMap)) {
                    continue;
                }

                $this->addDirection($weight, $directionMap, $child);
                $queue->enqueue($child);
            }

            $visitMap[$node] = true;

        } while (!$queue->isEmpty());

        return -1;
    }

    private function addDirection(int $weight, array &$directionMap, string $node)
    {
        $currentWeight = $weight + 1;
        if (!array_key_exists($node, $directionMap) || $directionMap[$node] > $currentWeight) {
            $directionMap[$node] = $currentWeight;
        }
    }
}