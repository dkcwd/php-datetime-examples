<?php
/**
 * This code draws heavily on the patterns in Zend Framework 2 (http://framework.zend.com)
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 *
 * Original Sample is from
 * Zend\Stdlib\Hydrator\Strategy\StrategyInterface
 */

// Note: This matches very closely with a MongoDB compatible strategy.
class DateTimeStrategy
{
    /**
     * Converts the given value so that it can be extracted
     *
     * @param mixed $value The original value.
     * @return mixed Returns the value that should be extracted.
     */
    public function extract($value)
    {
        // Return the date in the expected format if it has a value other than equivalent of 'empty'
        return (! empty($value)) ? date(DATE_ISO8601, strtotime($value)) : null;
    }

    /**
     * Converts the given value so that it can be hydrated
     *
     * @param mixed $value The original value.
     * @return mixed Returns the value that should be hydrated.
     */
    public function hydrate($value)
    {
        // Return the date in the expected format if it has a value other than equivalent of 'empty'
        return (! empty($value)) ? date('d.m.Y', strtotime($value)) : null;
    }
}
