<?php

use Kisoty\Board;
use Kisoty\UniquePointList;
use Kisoty\WalkingObject;

require_once '../vendor/autoload.php';

function snail(array $array): array
{
    $pointList = UniquePointList::fromMatrix($array);

    $board = new Board($pointList);

    try {
        $obj = new WalkingObject($board);
    } catch (Exception $e) {
        //no starting point => path is empty
        return [];
    }

    return $obj->walkBoard();
}
$matrix = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]
];

$expected_result = [1, 2, 3, 6, 9, 8, 7, 4, 5];

$result = snail($matrix);

//var_dump($result);

if ($expected_result !== $result) {
    throw new Exception('Expected result not reached.');
}
