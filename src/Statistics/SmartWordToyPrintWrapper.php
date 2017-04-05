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

class SmartWordToyPrintWrapper extends SmartWordToy
{
    protected function enqueue(string $value)
    {
        parent::enqueue($value);
        echo $value . PHP_EOL;
    }
}