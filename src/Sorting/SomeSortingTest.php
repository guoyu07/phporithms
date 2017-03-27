<?php
/*
 * This file is part of the phporithms.
 *
 * (c) Alexander Golovnya <snsanich@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 * Date: 3/24/17
 * Time: 1:14 AM
 */

namespace Phporithms\Sorting;

class SomeSortingTest extends \PHPUnit\Framework\TestCase
{
    public function provider()
    {
        return [
            [
                \SplFixedArray::fromArray(["first", "second", "third", "fourth"], $saveIndexes = false),
                \SplFixedArray::fromArray(["first", "fourth", "second", "third"], false)
            ],
            [
                \SplFixedArray::fromArray(["next", "prev", "none", "mine"], false),
                \SplFixedArray::fromArray(["mine", "next", "none", "prev"], false)
            ]
        ];
    }

    /**
     * @dataProvider provider
     * @param \SplFixedArray $array
     */
    public function testOne(\SplFixedArray $array, \SplFixedArray $expected)
    {
        $sorting = new SomeSorting();
        $actual = $sorting($array);
        $this->assertEquals($expected->toArray(), $actual->toArray());
    }
}
