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

******************** */

require_once('wp-config.php');

function clean_string($input, $strip = true) {
	$string = $input;

	if($strip) {
		$string = strip_tags($string, "<br>");
	}

	$string = htmlentities($string, ENT_IGNORE);

        // Strip random &nbsp; out
        $string = str_ireplace('&nbsp;', ' ', $string);
	$string = str_ireplace('&lsquo;', "'", $string);
	$string = str_ireplace('&rsquo;', "'", $string);
	$string = str_ireplace('&ndash;', "-", $string);
	//$string = str_ireplace('&', '&amp;', $string);
	$string = str_ireplace("\n", " ", $string);

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
	echo "<item>\n";
	echo "<title>".$date." - ".$title."</title>\n";
	echo "<pubDate>".$pubdate."</pubDate>\n";
	echo "<description>Location: ".$location." &lt;br /&gt;\n";
	echo "Leader: ".$record['contact']." &lt;br /&gt;\n";
	echo "Details: ".$desc."</description>\n";
	$pubdate = str_ireplace(" ", "", $record['post_modified']);
	$pubdate = str_ireplace(",", "", $pubdate);
	$pubdate = str_ireplace("+", "", $pubdate);
	$pubdate = str_ireplace(":", "", $pubdate);
	echo "<link>http://".$_SERVER['SERVER_NAME']."/events/".$record['post_name']."#".$pubdate."</link>\n";
	echo "<guid>http://".$_SERVER['SERVER_NAME']."/events/".$record['post_name']."#".$pubdate."</guid>\n";
	echo "</item>\n";
	echo "\n";
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
header('Content-Type: application/xml');

// Print RSS header
echo "<?xml version=\"1.0\"?>\n";
echo "<rss version=\"2.0\" xmlns:atom=\"http://www.w3.org/2005/Atom\">\n";
echo "<channel>\n";
echo "<title>VCC Events</title>\n";
echo "<description>The Victorian Climbing Club runs a variety of climbing trips to many different locations, primarily around Victoria but with many trips further abroad.  Other more social events like movie nights and the annual dinner will also appear here as well as details of CliffCare working bees.  Subscribe to stay up to date with the latest VCC events.</description>\n";
echo "<link>http://vicclimb.org.au/events</link>\n";
echo "<atom:link href=\"http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']."\" rel=\"self\" type=\"application/rss+xml\" />\n";

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

echo "</channel>\n";
echo "</rss>\n";

// Free resultset
mysql_free_result($result);

// Closing connection
mysql_close($link);

// We're done
?>
