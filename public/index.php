<?php

declare(strict_types=1);

use Kisoty\Board\Board;
use Kisoty\BoardWalkers\SnailWalker;
use Kisoty\Directions\RightDirection;

require_once '../vendor/autoload.php';

/**
 * @param array[] $array
 */
function snail(array $array): array
{

    try {
        $board = new Board($array);
        $obj = new SnailWalker($board, new RightDirection(), 1);
    } catch (Exception $e) {
        //if wrong input, just return empty path
        return [];
    }

    return $obj->walkBoard();
}
$matrix = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]
];

$result = snail($matrix);

var_dump($result);
