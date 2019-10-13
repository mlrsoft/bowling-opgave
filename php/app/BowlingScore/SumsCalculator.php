<?php
namespace BowlingScore;

class SumsCalculator {

    protected function calculateBowledScore($frameNum) {
        if (!isset($this->frames[$frameNum])) {
            return 0;
        }
        $frame = $this->frames[$frameNum];                 
        return $frame[0] + $frame[1];   
    }
    protected function isStrike($frameNum) {
        return $this->frames[$frameNum][0] === 10;
    }
    protected function isSpare($frameNum) {
        $frame = isset($this->frames[$frameNum]) ? $this->frames[$frameNum]: [0,0];
        return $frame[0]+$frame[1] === 10;
        
    }

    public function getSums($frames) {        
        $sums = [];
        $lastScore = 0;
        $this->frames = $frames;
        $frameCount = min(count($frames),10);
        for ($frameNum=0; $frameNum < $frameCount; $frameNum++)
        {   
            $frameScore = $lastScore + $this->calculateBowledScore($frameNum);
            if ($this->isStrike($frameNum)) {
                $nextFrame = isset($this->frames[$frameNum+1]) ? $this->frames[$frameNum+1]: [0,0];
                $nextBallScore = $nextFrame[0];
                $afteNextBallScore = $nextFrame[1];

                if ($frameNum < 9 && $nextBallScore === 10) {
                    $afterNextFrame = isset($this->frames[$frameNum+2])? $this->frames[$frameNum+2]: [0,0];
                    $afteNextBallScore = $afterNextFrame[0];
                }
                $frameScore += $nextBallScore + $afteNextBallScore;
            } else if ($this->isSpare($frameNum)) {
                $nextFrame = isset($this->frames[$frameNum+1]) ? $this->frames[$frameNum+1]: [0,0];
                $nextBallScore = $nextFrame[0];
                $frameScore += $nextBallScore;
            }
            array_push($sums, $frameScore);
            $lastScore = $frameScore;
        }
        return $sums;
    }
}

?>