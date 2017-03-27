<?php
/*
 * This file is part of the phporithms.
 *
 * (c) Alexander Golovnya <snsanich@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 * Date: 3/24/17
 * Time: 6:24 PM
 */

namespace Phporithms\Sorting\Dijkstra;


/**
 * @author Alexander Golovnya <snsanich@gmail.com>
 */

class Node
{
    const ROW_NUMBER = 0;
    const COLUMN_NUMBER = 1;
    const WEIGHT = 2;

    public $id;
    public $arguments;

    /**
     * @var array|Edge[]
     */
    public $neighbours = [];

    public function __construct($id, $arguments = [])
    {
        $this->id = $id;
        $this->arguments = $arguments;
    }

    /**
     * @param Edge $neighbor
     */
    public function addNeighbor($id, Edge $neighbor)
    {
        $this->neighbours[$id] = $neighbor;
    }

    public function traverseNeighbours(callable $callback)
    {
        foreach ($this->neighbours as $id => $neighbour) {
            $callback($neighbour, $id);
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getWeight()
    {
        if (isset($this->arguments[self::WEIGHT])) {
            return $this->arguments[self::WEIGHT];
        }
        return INF;
    }

    public function getEdgeWeight($id)
    {
        if (!isset($this->neighbours[$id])) {
            throw new \RuntimeException("No neighbour $id is found!");
        }

        return $this->neighbours[$id]->getWeight();
    }
}