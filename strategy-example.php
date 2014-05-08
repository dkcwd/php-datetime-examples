<?php

require_once 'SydneyDateStrategy.php';

/**
 * Setup initial timezone configuration
 */
date_default_timezone_set('UTC');

// We use this constant inside the strategy.
define('SAMPLE_TIMEZONE', 'UTC');

// Sample timestamp/  6pm, 08/05/2014
$timeFromDatabase = 1407261600;

// we Create a strategy for dealing with this date.
// This might be configurable via a factory based on, e.g. the user's current preferences or location.
$dateStrategy = new SydneyDateStrategy();

// We use this strategy to convert the timestamp into a userfriendly format.
$formattedForUser = $dateStrategy->hydrate($timeFromDatabase);

// Alternatively we might get back (from a datepicker?) a formatted date.
// We can convert that date to the timestamp:
$timeToSaveInDatabase = $dateStrategy->extract($formattedForUser);


?>
<html>

<h2>Using a strategy to convert dates</h2>
<p>
    <h4>The date we get from the database.  e.g. a timestamp</h4>
    <span><?= $timeFromDatabase; ?></span>
</p>

<p>
<h4>We convert the date using the strategy.  We now show the user this:</h4>
<span><?= $formattedForUser; ?></span>
</p>

<p>
<h4>If we receive a formatted date from the user, we convert it back to the timestamp for persistence.</h4>
<span><?= $timeToSaveInDatabase; ?></span>
</p>

</html>


 