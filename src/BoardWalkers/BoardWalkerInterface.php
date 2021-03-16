<?php

declare(strict_types=1);

namespace Kisoty\BoardWalkers;

interface BoardWalkerInterface
{
    /**
     * @return array List of point values passed by object
     */
    public function walkBoard(): array;
}
