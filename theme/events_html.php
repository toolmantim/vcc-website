<?php

/* ********************

This script should generate an RSS feed from the events in the database 

Revisions:

- Initial working version
- Added Content-type header
- Added description
- Added support for the syndication field of events
- Added chockstone/full setting
- Fixed a few items that caused errors in the feed
- Added pubDate fields
- Fixed location field & stuff
- Improved special character handling to prevent errors in the the xml
- Modified to use wordpress database
- Improved stripping for captions

******************** */

require_once('wp-config.php');

function clean_string($input, $strip = true) {
	$string = $input;

	if($strip) {
		$string = strip_tags($string, "</br>");
		$string = preg_replace('/\[caption.*\].*\[\/caption\]/', '', $string);
	}

        // Strip random &nbsp; out
        $string = str_ireplace('&nbsp;', ' ', $string);
	$string = str_ireplace('&lsquo;', "'", $string);
	$string = str_ireplace('&rsquo;', "'", $string);
	$string = str_ireplace('&ndash;', "-", $string);

	//$string = str_ireplace('&', '&amp;', $string);
	$string = htmlentities($string, ENT_IGNORE);

	$string = str_ireplace("\n", "</br>\n", $string);

	return $string;
}

function reorder_date($input) {
	$string = substr($input, 6, 2) . "/" . substr($input, 4, 2) . "/" . substr($input, 0, 4);
	return $string;
}

function print_record($record) {
	$date = reorder_date($record['start']);
	if($date == '//') {
		$date = 'TBA';
	}
	else {
		// Format the date correctly for both single and multiday trips
		if ($record['duration'] == 'Multi-Day') {
			$date .= " to ".reorder_date($record['end']);
		}
	}

	if ($record['time'] != '') {
		$date .= " " . $record['time'];
	}

	// Grab the description
	$desc = clean_string($record['post_content']);
	$title = clean_string($record['post_title']);
	$location = clean_string($record['location']);

	// Work the pubdate into the URL
	$datetime = new DateTime($record['post_modified']);
	$pubdate = $datetime->format('j M Y H:i:s O');
	

	// Output the event item
	echo "<strong>$title</strong></br>\n";
	echo "<strong>Location:</strong> $location</br>\n";
	echo "<strong>Date:</strong> $date</br>\n";
	echo "<strong>Details:</strong></br>\n";
	echo "$desc</br>\n";
	echo "<strong>Trip Leader:</strong> ".$record['contact']."</br>\n";
	echo "<strong>Email:</strong> ".$record['email']."</br>\n";
	echo "</br>\n";
}

function get_query($selection) {
	// Pull records from the database
	$query="SELECT ID,
	post_title,
	post_modified,
	post_content,
	post_name,
	(SELECT meta_value FROM wp_postmeta meta WHERE post.ID = meta.post_id AND meta_key = 'start_date') as start,
	(SELECT meta_value FROM wp_postmeta meta WHERE post.ID = meta.post_id AND meta_key = 'duration') as duration,
	(SELECT meta_value FROM wp_postmeta meta WHERE post.ID = meta.post_id AND meta_key = 'end_date') as end,
	(SELECT meta_value FROM wp_postmeta meta WHERE post.ID = meta.post_id AND meta_key = 'time') as time,
	(SELECT meta_value FROM wp_postmeta meta WHERE post.ID = meta.post_id AND meta_key = 'contact_name') as contact,
	(SELECT meta_value FROM wp_postmeta meta WHERE post.ID = meta.post_id AND meta_key = 'contact_email') as email,
	(SELECT meta_value FROM wp_postmeta meta WHERE post.ID = meta.post_id AND meta_key = 'location_name') as location
	FROM wp_posts post
	WHERE post_type = 'event'
	AND post_status = 'publish'
	AND (SELECT meta_value FROM wp_postmeta meta WHERE post.ID = meta.post_id AND meta_key = 'start_date') $selection
	ORDER BY (SELECT meta_value FROM wp_postmeta meta WHERE post.ID = meta.post_id AND meta_key = 'start_date');";
	return $query;
}


// DB Config
$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD)
    or die('Could not connect: ' . mysql_error());
mysql_select_db(DB_NAME) or die('Could not select database');

// Set the content type
header('Content-Type: text/html');

// Print RSS header
echo "<html>\n";
echo "<head>\n";
echo "<title>VCC Events</title>\n";
echo "</head>\n";
echo "<body>\n";

// Records today or in the future
$date = date("Ymd");
$query = get_query(">= '$date'");
$result = mysql_query($query) or die('Query failed: ' . mysql_error());

// Process each record returned
while($record = mysql_fetch_array($result, MYSQL_ASSOC)) {
	print_record($record);
}

// Records TBA dates
$query = get_query("= ''");
$result = mysql_query($query) or die('Query failed: ' . mysql_error());

// Process each record returned
while($record = mysql_fetch_array($result, MYSQL_ASSOC)) {
	print_record($record);
}

echo "</body>\n";
echo "</html>\n";

// Free resultset
mysql_free_result($result);

// Closing connection
mysql_close($link);

// We're done
?>
