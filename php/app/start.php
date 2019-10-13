<?php
namespace BowlingScore;

require_once dirname(__FILE__) . '/../vendor/autoload.php';

$channel = new CommunicationChannel('http://13.74.31.101/api/points');
$calculator = new SumsCalculator();
$app = new App($channel,$calculator);

$app->run();