<?php
/*
 * This file is part of the phporithms.
 *
 * (c) Alexander Golovnya <snsanich@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 * Date: 3/27/17
 * Time: 10:15 PM
 */

namespace Phporithms\Sorting\Dijkstra;


/**
 * @author Alexander Golovnya <snsanich@gmail.com>
 */

class GraphTest extends \PHPUnit\Framework\TestCase
{
    public function testOne()
    {
        $matrix = <<<EOD
0 5 3
3 4 5
0 3 2
EOD;

        $graph = Graph::buildFromStringMatrix($matrix);
        $this->assertEquals(4, $graph->getEdgeWeight(4, 5));

        $this->assertCount(24, $graph->getEdges());
    }
}