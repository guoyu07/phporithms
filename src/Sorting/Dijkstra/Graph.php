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

class Graph
{
    private $vertexes;
    private $edges;
    private $rowCount;
    private $columnCount;

    /**
     * Graph constructor.
     * @param array|Node[] $vertexes
     * @param $edges
     */
    private function __construct($vertexes, $edges, $rowCount, $columnCount)
    {
        $this->vertexes = $vertexes;
        $this->edges = $edges;
        $this->rowCount = $rowCount;
        $this->columnCount = $columnCount;
    }

    public function getEdgeWeight($from, $to): int
    {
        return $this->getNode($from)->getEdgeWeight($to);
    }

    public function getEdges()
    {
        return $this->edges;
    }

    public function getWeight($from)
    {
        return $this->getNode($from)->getWeight();
    }

    /**
     * @param $id
     * @return mixed|Node
     */
    public function getNode($id)
    {
        if (!isset($this->vertexes[$id])) {
            throw new \RuntimeException('No vertex is found!');
        }
        return $this->vertexes[$id];
    }

    /**
     * Map contains elements with delimiters between elements.
     * Algorithm might not work on windows with their \r\n new line delimeter
     * @param string $map
     * @return Graph
     */
    public static function buildFromStringMatrix(string $square): self
    {
        $rows = explode(PHP_EOL, $square);
        $rowCount = count($rows);
        reset($rows);
        next($rows);
        $line = current($rows);
        $columnCount = substr_count($line, ' ') + 1;

        $vertexes = [];
        $edges = [];
        foreach ($rows as $rowNumber => $row) {
            foreach (explode(' ', $row) as $columnNumber => $value) {
                $from = $rowNumber * $columnCount + ($columnNumber + 1);
                $vertexes[$from] = new Node($from, [
                    Node::ROW_NUMBER => $rowNumber,
                    Node::COLUMN_NUMBER => $columnNumber,
                    Node::WEIGHT => (int) $value
                ]);
                foreach ([
                             [$rowNumber - 1, $columnNumber],
                             [$rowNumber, $columnNumber - 1],
                             [$rowNumber, $columnNumber + 1],
                             [$rowNumber + 1, $columnNumber]
                         ] as $arrayVertex2) {
                    if ($arrayVertex2[0] < 0 || $arrayVertex2[1] < 0) {
                        continue;
                    }
                    if ($arrayVertex2[0] >= $rowCount || $arrayVertex2[1] >= $columnCount) {
                        continue;
                    }

                    $rowForVertex2 = $rows[$arrayVertex2[0]];
                    $length = $rowForVertex2[$arrayVertex2[1] * 2];

                    $to = $arrayVertex2[0] * $columnCount + ($arrayVertex2[1] + 1);
                    $edges[] = [
                        'from' => $from,
                        'to' => $to,
                        'weight' => $length
                    ];
                }
            }
        }

        foreach ($edges as &$edge) {
            $from = $vertexes[$edge['from']];
            $to = $vertexes[$edge['to']];
            $edge = new Edge($from, $to, $edge['weight']);

            $id = $to->getId();
            $from->addNeighbor($id, $edge);
        }
        unset($edge);

        return new self($vertexes, $edges, $rowCount, $columnCount);
    }

    public function buildStringMatrixFromSearchResult(GraphSearchResult $result, $marker)
    {
        $start = $result->getStartNode();
        $node = $result->getFinishNode();

        $visitedList = [];
        $shortList = [
            $node->getId() => $marker
        ];

        $stack = new \SplQueue();
        $stack->enqueue($node);

        $vertexes = $this->vertexes;

        while ($stack->count()) {
            $node = $stack->dequeue();

            if (isset($visitedList[$node->getId()])) {
                continue;
            }

            $shortest = [INF, INF];

            $node->traverseNeighbours(function (Edge $neighbour, $id) use ($stack, $result, &$shortest, $marker) {

                $distance = $result->getDistance($neighbour->getDestinationId());

                if ($shortest[0] > $distance) {
                    $shortest[0] = $distance;
                    $shortest[1] = $neighbour->getDestination();
                }
            });

            $destination = $shortest[1];
            if ($destination) {
                $shortList[$destination->getId()] = $marker;
                $stack->enqueue($destination);
            }
            $visitedList[$node->getId()] = true;
            if ($node === $start) {
                break;
            }
        }

        $line = str_repeat(' ', $this->columnCount * 2);
        $line[strlen($line) - 1] = PHP_EOL;
        $map = str_repeat($line, $this->rowCount);

        foreach ($this->vertexes as $id => $vertex) {
            $weight = $this->getWeight($id);
            if (isset($visitedList[$id])) {
                $weight = $result->getDistance($id);
                if (isset($shortList[$id]) && $shortList[$id] === $marker) {
                    $weight = 'X';
                }
            }

            $map[($id - 1) * 2] = (string) $weight;
        }

        return PHP_EOL . $map;
    }

    public function buildUnvisitedSet(): NodeSet
    {
        $vertexes = [];
        foreach ($this->vertexes as $id => $vertex) {
            $vertexes[$id] = clone $vertex;
        }
        return new NodeSet($vertexes);
    }
}