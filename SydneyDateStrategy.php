<?php
/**
 * This code draws heavily on the patterns in Zend Framework 2 (http://framework.zend.com)
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 *
 * Original Interface is
 * Zend\Stdlib\Hydrator\Strategy\StrategyInterface
 */

// Note: This matches very closely with a MongoDB compatible strategy.
class SydneyDateStrategy
{

    /**
     * ToDo: Make the datetime formats configurable for a reusable strategy...  Factory to create same obj, diff config.
     */

    /**
     * Converts the given value so that it can be extracted
     *
     * @param mixed $value The original value.
     * @return mixed Returns the value that should be extracted.
     */
    public function extract($value)
    {
        // Return the date in the expected format if it has a value other than equivalent of 'empty'
        $datetime = \DateTime::createFromFormat(DATE_ISO8601, $value);

        return (! empty($value)) ? $datetime->format('U') : null;
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
        $datetime = \DateTime::createFromFormat('U', $value);
        // dependant on system configuration, we can convert to Sydney Australia.
        $datetime->setTimezone( new \DateTimeZone('Australia/Sydney')); // The timezone to that of the user

        return (! empty($value)) ? $datetime->format(DATE_ISO8601) : null;
    }
}
