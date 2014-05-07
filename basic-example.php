<?php
/**
 * Date/Timezone should be UTC for the server
 */
date_default_timezone_set('UTC');

if (isset($_POST['timezone'])) {
    $timeZone = $_POST['timezone'];
} else {
    $timeZone = 'UTC';
}

// Instantiate a DateTimeZone object using the selected time zone
$dateTimeZone = new \DateTimeZone($timeZone);

// Instantiate DateTime object
$dateTime = new \DateTime('now', $dateTimeZone);

// Define an array holding examples of formatted dates
$formats = array(
    '"d-m-Y H:i:s"' => $dateTime->format('d-m-Y H:i:s'),
    '"Y-m-d H:i:s"' => $dateTime->format('y-m-d H:i:s'),
    '"h:i A"' => $dateTime->format('h:i A'),
    '"h:i a"' => $dateTime->format('h:i a'),
    'DATE_ISO8601' => $dateTime->format(DATE_ISO8601),
    'DATE_ATOM' => $dateTime->format(DATE_ATOM),
    'DATE_COOKIE' => $dateTime->format(DATE_COOKIE),
    'DATE_RFC1036' => $dateTime->format(DATE_RFC1036),
    'DATE_RFC1123' => $dateTime->format(DATE_RFC1123),
    'DATE_RFC2822' => $dateTime->format(DATE_RFC2822),
    'DATE_RFC3339' => $dateTime->format(DATE_RFC3339),
    'DATE_RFC822' => $dateTime->format(DATE_RFC822),
    'DATE_RFC850' => $dateTime->format(DATE_RFC850),
    'DATE_W3C' => $dateTime->format(DATE_W3C),
    'DATE_RSS' => $dateTime->format(DATE_RSS),
);

// If you want to find out when daylight savings transitions etc happen
//var_dump($dateTimeZone->getTransitions());

// Get information about the location
$location = $dateTime->getTimezone()->getLocation();
$countryCode = (isset($location['country_code']) && !empty($location['country_code'])) ? $location['country_code'] : 'N/A';
$latitude = (isset($location['latitude']) && !empty($location['latitude'])) ? $location['latitude'] : 'N/A';
$longitude = (isset($location['longitude']) && ! empty($location['longitude'])) ? $location['longitude'] : 'N/A';
$comments = (isset($location['comments']) && ! empty($location['comments'])) ? $location['comments'] : 'N/A';

?>
<html>

<h2>Select a timezone</h2>
    <form method="POST" name="timezone" action="">
        <select name='timezone'>
            <?php foreach ($dateTimeZone->listIdentifiers() as $identifier): ?>
                <?php $selected = ($identifier == $timeZone) ? 'selected' : ''; ?>
                <option <?php echo $selected; ?> value="<?php echo $identifier; ?>"><?php echo $identifier; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit">
    </form>
<hr>

<h2>Some details about the selected time zone</h2>
<p>Offset from GMT: <?php echo $dateTime->getOffset(); ?></p>
<p>Country Code: <?php echo $countryCode; ?></p>
<p>Latitude: <?php echo $latitude; ?></p>
<p>Longitude: <?php echo $longitude; ?></p>
<p>Comments: <?php echo $comments; ?></p>

<hr>

<h2>Some examples of date formats</h2>
<table style="margin: 5px;">
    <th>Format</th><th>Value</th>
    <tbody>
    <?php foreach ($formats as $fKey => $fVal) : ?>
        <tr>
            <td style="padding: 5px;border: 1px solid #888888;"><?php echo $fKey; ?></td><td style="padding: 5px;border: 1px solid #888888;"><?php echo $fVal; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</html>
