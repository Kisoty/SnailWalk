<?php

declare(strict_types=1);

namespace Kisoty\Board;

class BoardCreationException extends \Exception
{
    protected $message = 'Error occurred while creating board.';
}
