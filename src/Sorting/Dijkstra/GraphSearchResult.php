<?php
/*
 * This file is part of the phporithms.
 *
 * (c) Alexander Golovnya <snsanich@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 * Date: 3/27/17
 * Time: 11:21 PM
 */

namespace Phporithms\Sorting\Dijkstra;


/**
 * @author Alexander Golovnya <snsanich@gmail.com>
 */

class GraphSearchResult
{
    public function __construct(Node $start, Node $finish, array &$visitedList, array &$distanceList)
    {
        $this->start = $start;
        $this->finish = $finish;
        $this->visitedList = $visitedList;
        $this->distanceList = $distanceList;
    }

    public function getDistance($id)
    {
        return isset($this->distanceList[$id]) ? $this->distanceList[$id] : INF;
    }

    public function isVisited($id)
    {
        return isset($this->visitedList[$id]) ? $this->visitedList[$id] : false;
    }

    public function getStartNode(): Node
    {
        return $this->start;
    }

    public function getFinishNode(): Node
    {
        return $this->finish;
    }

    public function traverseVisit() {

    }
}