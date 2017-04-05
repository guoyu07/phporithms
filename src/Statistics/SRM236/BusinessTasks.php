<?php
/*
 * This file is part of the phporithms.
 *
 * (c) Alexander Golovnya <snsanich@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 * Date: 3/28/17
 * Time: 5:12 PM
 */

namespace Phporithms\Statistics\SRM236;

/**
 * @author Alexander Golovnya <snsanich@gmail.com>
 */
class BusinessTasks
{
    public function getTask(array $list, int $n): string
    {
        if (!$list || !$n)
        {
            return '';
        }

        if (count($list) === 1) {
            return current($list);
        }

        $tasks = $list;
        $i = ($n - 1) % count($tasks);
        do {
            array_splice($tasks, $i, 1);
            $i = ($i + $n - 1) % count($tasks);
        } while (count($tasks) > 1);

        return current($tasks);
    }
}