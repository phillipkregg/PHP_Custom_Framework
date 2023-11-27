<?php

namespace PhilLackey\Framework\Routing;

use PhilLackey\Framework\Http\Request;

interface RouterInterface
{
    public function dispatch(Request $request): array;
}