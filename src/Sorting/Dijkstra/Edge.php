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

class Edge
{
    public $from;
    private $to;
    private $weight;

    public function __construct(Node $from, Node $to, $weight)
    {
        $this->from = $from;
        $this->to = $to;
        $this->weight = (int)$weight;
    }

    public function getId()
    {
        return $this->from->getId();
    }

    public function getDestinationId()
    {
        return $this->to->getId();
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function getDestination(): Node
    {
        return $this->to;
    }
}