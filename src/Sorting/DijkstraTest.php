<?php
/*
 * This file is part of the phporithms.
 *
 * (c) Alexander Golovnya <snsanich@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 * Date: 3/24/17
 * Time: 3:37 PM
 */

namespace Phporithms\Sorting;

use Phporithms\Sorting\Dijkstra\Graph;
use Phporithms\Sorting\Dijkstra\Node;
use Phporithms\Sorting\Dijkstra\Path;

/**
 * @author Alexander Golovnya <snsanich@gmail.com>
 */

class DijkstraTest extends \PHPUnit\Framework\TestCase
{
    public function provider()
    {
        $matrix = <<<EOD
0 5 3 5 6 3 6 7
3 4 5 1 3 4 6 1
0 3 2 5 5 6 0 9
2 3 5 1 1 1 5 3
2 3 4 5 1 2 3 4
9 8 7 1 2 0 0 0
3 4 5 2 1 4 5 6
EOD;

        $graph = Graph::buildFromStringMatrix($matrix);

        $start = $graph->getNode(41);

        return [
            [$graph, $graph->getNode(41), $graph->getNode(24), 29],
            [$graph, $graph->getNode(42), $graph->getNode(7), 30]
        ];
    }

    /**
     * @dataProvider provider
     * @param array $graph
     */
    public function testOne(Graph $graph, Node $start, Node $finish, $expectedDistance)
    {
        $sorting = new Dijkstra();
        $graphSearchResult = $sorting($graph, $start, $finish);
        $this->assertEquals($expectedDistance, $graphSearchResult->getDistance($finish->getId()));
        $map = $graph->buildStringMatrixFromSearchResult($graphSearchResult, 'X');
        fwrite(STDERR, $map);
    }
}