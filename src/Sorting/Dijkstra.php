<?php
/*
 * This file is part of the phporithms.
 *
 * (c) Alexander Golovnya <snsanich@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 * Date: 3/24/17
 * Time: 3:56 PM
 */

namespace Phporithms\Sorting;

use Phporithms\Sorting\Dijkstra\Graph;
use Phporithms\Sorting\Dijkstra\Node;
use Phporithms\Sorting\Dijkstra\Edge;
use Phporithms\Sorting\Dijkstra\GraphSearchResult;
use Phporithms\Sorting\Dijkstra\Path;

/**
 * @author Alexander Golovnya <snsanich@gmail.com>
 */
class Dijkstra
{
    public function __invoke(Graph $graph, Node $start, Node $finish): GraphSearchResult
    {
        /**
         * Assign to every node a tentative distance value: set it to zero for our initial node and to infinity for all other nodes.
         * Set the initial node as current. Mark all other nodes unvisited. Create a set of all the unvisited nodes called the unvisited set.
         *
         * For the current node, consider all of its unvisited neighbors and calculate their tentative distances . Compare the newly calculated tentative distance to the current assigned value and assign the smaller one . For example, if the current node A is marked with a distance of 6, and the edge connecting it with a neighbor B has length 2, then the distance to B(through A) will be 6 + 2 = 8. If B was previously marked with a distance greater than 8 then change it to 8. Otherwise, keep the current value .
         * When we are done considering all of the neighbors of the current node, mark the current node as visited and remove it from the unvisited set . A visited node will never be checked again .
         * If the destination node has been marked visited(when planning a route between two specific nodes) or if the smallest tentative distance among the nodes in the unvisited set is infinity(when planning a complete traversal; occurs when there is no connection between the initial node and remaining unvisited nodes), then stop . The algorithm has finished .
         * Otherwise, select the unvisited node that is marked with the smallest tentative distance, set it as the new "current node", and go back to step 3.
         */

        $visitedList = [];
        $distanceList = [$start->getId() => 0];

        $stack = new \SplQueue();
        $stack->enqueue($start);

        while ($stack->count()) {
            $node = $stack->dequeue();

            if (isset($visitedList[$node->getId()])) {
                continue;
            }

            $node->traverseNeighbours(function (Edge $neighbour, $id) use ($stack, &$distanceList) {

                $destinationId = $neighbour->getDestinationId();

                $initialWeight = &$distanceList[$neighbour->getId()];

                if (!isset($distanceList[$destinationId])) {
                    $distanceList[$destinationId] = INF;
                }
                $maxDistance = $distanceList[$destinationId];

                $newDistance = $initialWeight + $neighbour->getWeight();
                $distance = min($newDistance, $maxDistance);
                $distanceList[$destinationId] = $distance;

                $stack->enqueue($neighbour->getDestination());
            });

            $visitedList[$node->getId()] = true;
            if ($node === $finish) {
                break;
            }
        }

        return new GraphSearchResult($start, $finish, $visitedList, $distanceList);
    }
}