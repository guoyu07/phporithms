<?php
/*
 * This file is part of the phporithms.
 *
 * (c) Alexander Golovnya <snsanich@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 * Date: 3/28/17
 * Time: 5:09 PM
 */

namespace Phporithms\Statistics;

use Phporithms\Statistics\SRM236\BusinessTasks;

/**
 * @TODO: ask Topcoder if I can push solution on github
 * Task is taken from https://community.topcoder.com/stat?c=problem_statement&pm=1585&rd=6535
 *
 * This problem statement is the exclusive and proprietary property of TopCoder, Inc. Any unauthorized use or reproduction of this information without the prior written consent of TopCoder, Inc. is strictly prohibited.
 * (c)2010, TopCoder, Inc. All rights reserved.
 *
 * @author Alexander Golovnya <snsanich@gmail.com>
 *
 *
 * A busy businessman has a number of equally important tasks which he must accomplish.
 * To decide which of the tasks to perform first, he performs the following operation.

He writes down all his tasks in the form of a circular list, so the first task is adjacent to the last task.
 * He then thinks of a positive number. This number is the random seed, which he calls n.
 * Starting with the first task, he moves clockwise (from element 1 in the list to element 2 in the list and so on),
 * counting from 1 to n. When his count reaches n, he removes that task from the list and starts counting
 * from the next available task. He repeats this procedure until one task remains.
 * It is this last task that he chooses to execute.

Given a String[] list representing the tasks and an int n, return the task which the businessman chooses to execute.
 */

class SRM236
{
    public function __invoke(array $list, int $n)
    {
        $tasks = new BusinessTasks();
        return $tasks->getTask($list, $n);
    }
}