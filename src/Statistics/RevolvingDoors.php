<?php
/*
 * This file is part of the phporithms.
 *
 * (c) Alexander Golovnya <snsanich@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 * Date: 3/29/17
 * Time: 11:31 AM
 */

namespace Phporithms\Statistics;


/**
 * General idea is to implement
 * @author Alexander Golovnya <snsanich@gmail.com>
 */

class Node
{
    public $x;
    public $y;
    public $doorMask;
    public $moved;

    public function __construct($x, $y, $doorMask, $moved)
    {
        $this->x = $x;
        $this->y = $y;
        $this->doorMask = $doorMask;
        $this->moved = $moved;
    }
}

class RevolvingDoors
{

    const SPACE = 0;
    const DOOR_VERTICAL = 1;
    const DOOR_HORIZONTAL = 2;
    const UNAVAILABLE = 255;

    private function assignDoors(array &$doors, array &$doorMasks, $doorMoved, $x, $y, array $map)
    {
        $top = $map[$y - 1][$x];
        $left = $map[$y][$x - 1];
        $horizontalIndex = $top == '|' ? $doorMoved : 0;
        $verticalIndex = $left == '-' ? $doorMoved : 0;

        $doors[$y][$x - 1][$horizontalIndex] = self::DOOR_HORIZONTAL;
        $doors[$y][$x + 1][$horizontalIndex] = self::DOOR_HORIZONTAL;
        $doors[$y - 1][$x][$horizontalIndex] = self::SPACE;
        $doors[$y + 1][$x][$horizontalIndex] = self::SPACE;
        $doors[$y][$x - 1][$verticalIndex] = self::SPACE;
        $doors[$y][$x + 1][$verticalIndex] = self::SPACE;
        $doors[$y - 1][$x][$verticalIndex] = self::DOOR_VERTICAL;
        $doors[$y + 1][$x][$verticalIndex] = self::DOOR_VERTICAL;

        $doorMasks[$y][$x - 1] = $doorMoved;
        $doorMasks[$y][$x + 1] = $doorMoved;
        $doorMasks[$y - 1][$x] = $doorMoved;
        $doorMasks[$y + 1][$x] = $doorMoved;
    }

    /**
     * y coordinates - number of lines (strings) in map
     * x coordinates - number of symbols in line (string)
     * @param array $map
     * @return int
     *
     */
    public function turns(array $map): int
    {
        if (!count($map) || !strlen($map[0])) {
            return -1;
        }

        $rowCount = count($map);
        $columnCount = strlen($map[0]);

        $doors = [];
        $doorMasks = [];
        $doorsMoved = 0;
        $numberDoors = 0;
        $mapMe = [];
        foreach ($map as $y => $string) {

            $row = [];
            for ($x = 0; $x < strlen($string); ++$x) {
                $type = $string[$x];

                if ($type == 'S') {
                    $startPoint = new Node($x, $y, 0, 0);
                    $row[$x] = self::SPACE;
                    continue;
                }

                if ($type == 'E') {
                    $endPoint = new Node($x, $y, 0, 0);
                    $row[$x] = self::SPACE;
                    continue;
                }

                if ($type == ' ') {
                    $row[$x] = self::SPACE;
                    continue;
                }

                if ($type == '#') {
                    $row[$x] = self::UNAVAILABLE;
                    continue;
                }

                if ($type == 'O') {

                    $row[$x] = self::UNAVAILABLE;

                    // each door increase total quantity of states by two
                    $numberDoors = 1 << $numberDoors;

                    $this->assignDoors($doors, $doorMasks, $numberDoors, $x, $y, $map);

                    continue;
                }

                $row[$x] = self::SPACE;
            }
            $mapMe[$y] = $row;
        }

        $numberDoors = 1 << $numberDoors;

        if (!isset($startPoint, $endPoint)) {
            return -1;
        }

        $queue = [];
        $visited = [];

        $queueStartPoint = 0;
        $queueEndPoint = 0;

        $queue[$queueStartPoint++] = $startPoint;
        $visited[$startPoint->y][$startPoint->x][$startPoint->doorMask] = true;

        while ($queueEndPoint < $queueStartPoint) {

            if (!array_key_exists($queueEndPoint, $queue)) {
                break;
            }

            $point = $queue[$queueEndPoint++];

            if ($point->x === $endPoint->x && $point->y === $endPoint->y) {
                return $point->moved;
            }

            $this->next(-1, 0, $point, $mapMe, $queue, $queueStartPoint, $columnCount, $rowCount, $visited, $doors,
                $doorMasks);
            $this->next(1, 0, $point, $mapMe, $queue, $queueStartPoint, $columnCount, $rowCount, $visited, $doors,
                $doorMasks);
            $this->next(0, -1, $point, $mapMe, $queue, $queueStartPoint, $columnCount, $rowCount, $visited, $doors,
                $doorMasks);
            $this->next(0, 1, $point, $mapMe, $queue, $queueStartPoint, $columnCount, $rowCount, $visited, $doors,
                $doorMasks);
        }

        return -1;
    }

    private function next(
        $offsetX,
        $offsetY,
        Node $point,
        array $map,
        array &$queue,
        int &$queueStartPoint,
        $columnCount,
        $rowCount,
        array &$visited,
        array $doors,
        array $doorMasks
    ) {
        $x = $offsetX + $point->x;
        $y = $offsetY + $point->y;
        $doorMask = $point->doorMask;
        if ($x < 0 || $x >= $columnCount) {
            return;
        }

        if ($y < 0 || $y >= $rowCount) {
            return;
        }

        if ($y === 4 && $x === 4) {
            $x = 4;
        }

        if (isset($visited[$y][$x][$doorMask])) {
            return;
        }
        $visited[$y][$x][$doorMask] = true;

        $doorPosition = self::UNAVAILABLE;
        $doorMoveMask = 0;
        if (isset($doors[$y][$x])) {
            foreach ($doors[$y][$x] as $doorMaskVariant => $doorPositionVariant) {
                if (($doorMask & $doorMaskVariant) === $doorMaskVariant) {
                    $doorPosition = $doorPositionVariant;
                    $doorMoveMask = $doorMaskVariant;
                }
            }
        }

        if (($doorPosition === self::DOOR_VERTICAL && $offsetX !== 0) ||
            ($doorPosition === self::DOOR_HORIZONTAL && $offsetY !== 0)
        ) {
            $doorMask ^= $doorMoveMask;
            if (isset($visited[$y][$x][$doorMask])) {
                return;
            }
            $visited[$y][$x][$doorMask] = true;
            $queue[$queueStartPoint++] = new Node($x, $y, $doorMask, $point->moved + 1);
            return;
        }

        switch ($map[$y][$x]) {
            case self::SPACE:
                $queue[$queueStartPoint++] = new Node($x, $y, $doorMask, $point->moved);
                return;
            case self::UNAVAILABLE:
                return;
        }
    }
}