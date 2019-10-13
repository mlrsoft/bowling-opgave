<?php 
namespace BowlingScore;

use Exception;

class App {
    private $channel;
    private $calculator;
    public function __construct(CommunicationChannel $channel, SumsCalculator $calculator ) {
        $this->channel = $channel;
        $this->calculator = $calculator;
    }

    protected function displayPoints($points) {
        echo "<h1>Received</h1>";
        $received=[];
        foreach($points as $point) {
            array_push($received, "[$point[0],$point[1]]");
        }
        echo "<p>points:".implode(',', $received)."<br/>";        
        echo "token:'".$this->channel->getToken()."</p>";
    }
    protected function displaySums($sums) {
        echo "<h1>Calculated sums</h1>";
        echo "<div>[".implode(',',$sums)."]</div>";        
    }
    protected function displayValidation($validated) {
        echo "<h1>Validation of sums</h1>";
        echo "<div>Sums ".($validated ? "<span style='color:green'>validated</span>" : "<span style='color:red'>invalid</span>")."</div>";

    }
    public function run() {
        try {
            $points = $this->channel->fetchPoints();
            $this->displayPoints($points);
            $sums = $this->calculator->getSums($points);
            $this->displaySums($sums);
            $validated = $this->channel->validateSums($sums);
            $this->displayValidation($validated);
        } catch (Exception $ex) {
            echo "<h1>Communication failure</h1>";
            echo "<div>".$ex->getMessage()."</div>";
        }
    }
}