<?php
/*
 * This file is part of the phporithms.
 *
 * (c) Alexander Golovnya <snsanich@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 * Date: 3/24/17
 * Time: 1:28 AM
 */

namespace Phporithms\Sorting;


/**
 * O(x^2) speed
 * @author Alexander Golovnya <snsanich@gmail.com>
 */

class SomeSorting
{
    public function next(\SplFixedArray $list) {

        $list->rewind();
        $min = $list->current();
        $excludeKey = $list->key();
        $list->next();

        while ($list->valid()) {
            $next = $list->current();

            if (is_null($next)) {
                $list->next();
                continue;
            }

            if (is_null($min) || $next < $min) {
                $excludeKey = $list->key();
                $min = $next;
            }
            $list->next();
        }
        return [$min, $excludeKey];
    }

    public function __invoke(\SplFixedArray $list)
    {
        $size = $list->getSize();
        $sorted = new \SplFixedArray($size);

        $i = 0;
        while ($i < $size) {
            list($min, $excludeKey) = $this->next($list);
            $sorted[$i] = $min;
            $list[$excludeKey] = null;
            ++$i;
        }

        return $sorted;
    }
}