<?php

declare(strict_types=1);

namespace Kisoty\Board;

class PointNotFoundException extends \Exception
{
    protected $message = 'Point not found.';
}
