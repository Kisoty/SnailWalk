<?php

declare(strict_types=1);

namespace Kisoty\BoardWalkers;

use Kisoty\Board\Board;
use Kisoty\Point;

abstract class AbstractBoardWalker
{
    protected Point $point;
    protected Board $board;

    abstract public function walkBoard(): array;
}
