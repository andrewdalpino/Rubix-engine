<?php

namespace Rubix\Engine\Preprocessors\Strategies;

interface Strategy
{
    /**
     * Make a guess at a missing value.
     *
     * @param  array  $values
     * @return mixed
     */
    public function guess(array $values);
}