<?php

use BowlingScore\SumsCalculator;
use PHPUnit\Framework\TestCase;

class SumsCalculatorTest extends TestCase {
    
    public function provider () {
        return [
            'no frames' => [
                [],
                []
            ],
            'single frame' => [ 
                [[5,1]], // frames
                [6] // sums
            ],
            'single frame spare' => [ 
                [ [7,3] ], 
                [10] 
            ],
            'single frame strike' => [ 
                [ [10,0] ], 
                [10] 
            ],

            'two frames, first spare' => [
                [[4,6], [3,5]],
                [13, 21]
            ],
            'two frames, first strike' => [
                [[10,0], [3,5]],
                [18, 26]
            ],
            'two frames, two strikes' => [
                [[10,0], [10,0]],
                [20, 30]
            ],
            'tree frames, first two strikes' => [
                [[10,0], [10,0], [5,3]],
                [25, 43, 51]
            ],
            'tree frames, last two strikes' => [
                [[5,3], [10,0], [10,0]],
                [8, 28, 38]
            ],
            '10 strikes' => [
                [[10,0], [10,0], [10,0], [10,0], [10,0], [10,0], [10,0], [10,0], [10,0], [10,0]],
                [30, 60, 90, 120, 150, 180, 210, 240,260, 270]
            ],
            'example given' => [
                [[3,7], [10,0], [8,2], [8,1], [10,0], [3,4], [7,0], [5,5], [3,2], [2,5]],
                [20, 40, 58, 67, 84, 91, 98, 111, 116,123]
            ],
            'all strikes' => [
                [[10,0],[10,0],[10,0],[10,0],[10,0],[10,0],[10,0],[10,0],[10,0],[10,0],[10,10]],
                [  30,    60,    90,    120,   150,   180,   210,   240,   270,   300]
            ],
            'special 10 spare' => [
                [[10,0],[10,0],[10,0],[10,0],[10,0],[10,0],[10,0],[10,0],[10,0],[5,5],[5,0]],
                [  30,    60,    90,    120,   150,   180,   210,   235,   255,   270]                    
            ],
            'special 10 strike' => [
                [[10,0],[10,0],[10,0],[10,0],[10,0],[10,0],[10,0],[10,0],[10,0],[10,0],[5,5]],
                [  30,    60,    90,    120,   150,   180,   210,   240,   265,   285]
            ]
            
        ];
    }

    /**
     * @dataProvider provider
     * @param array $frames 
     * @param array $expectedSums
     */
    public function testCalculation($frames, $expectedSums) {
        $calculator = new SumsCalculator();
        $calculatedSums = $calculator->getSums($frames);
        $this->assertEquals($expectedSums, $calculatedSums);
    }
}