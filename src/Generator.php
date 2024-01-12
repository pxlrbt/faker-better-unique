<?php

namespace pxlrbt\FakerBetterUnique;

use Faker\UniqueGenerator;

class Generator extends \Faker\Generator
{
    public array $uniqueGenerators = [];

    /**
     * With the unique generator you are guaranteed to never get the same two
     * values.
     *
     * <code>
     * // will never return twice the same value
     * $faker->unique()->randomElement(array(1, 2, 3));
     * </code>
     *
     * @param bool $reset      If set to true, resets the list of existing values
     * @param int  $maxRetries Maximum number of retries to find a unique value,
     *                         After which an OverflowException is thrown.
     *
     * @throws \OverflowException When no unique value can be found by iterating $maxRetries times
     *
     * @return self A proxy class returning only non-existing values
     */
    public function betterUnique($key, $reset = false, $maxRetries = 10000)
    {
        if ($reset || ! array_key_exists($key, $this->uniqueGenerators)) {
            $this->uniqueGenerators[$key] = new UniqueGenerator($this, $maxRetries);
        }

        return $this->uniqueGenerators[$key];
    }
}
