<?php
/* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	functions.php
	
	PHP functionality used on the site
	URL: http://crille.org/uppgift3
	Course: Reponsiv Webdesign (WD450F)
	
	Christian Ohlsson (KROL0019)
	crille@crille.org || kristian.olsson0019@stud.hkr.se
--------------------------------------------------------------------*/

if(isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    switch($action) {
        case 'tour'		:	getTour(); 		break;
        case 'twitter'	:	getTweets();		break;
        case 'images'	:	getImages();		break;
        case 'news'		:	getNews();		break;
        default			:	break;
    }
}


/* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	Gets a Twitter Feed
	INPUT:	none
	CALLS:	https://dev.twitter.com/docs/api/1/get/search to get
				the JSON-formatted search result
	RETURNS:	Twitterfeed from Bad Religion
--------------------------------------------------------------------*/
function getTweets() {	
	$data = 'http://search.twitter.com/search.json?q=%23badreligion'; 
	$feed = file_get_contents($data); //Getting the JSON data.
	 
	$valid_data = json_decode($feed); // Converting the JSON data to PHP format.
	$valid_data = $valid_data->results; // Valid data now with just the tweet result.
	print '<h1>Latest tweets</h1>'. PHP_EOL;
	// Printing out the feed's data in our required format.
	foreach ($valid_data as $key=>$value) {
	  print '<div class="tweet">' . PHP_EOL;
	  print '	<img src="' . $value->profile_image_url . '" class="tweet_image" alt="Profile picture" />' . PHP_EOL;
	  print '	<span class="tweet_from"><a href="http://twitter.com/badreligion" target="_blank">@' . $value->from_user . ':</a></span>' . PHP_EOL;
	  print '	<span class="tweet_text">' . $value->text . '</span>' . PHP_EOL;
	  print '	<span class="tweet_time">' . prettyTime ($value->created_at) . '</span>' . PHP_EOL;
	  print '</div> <!-- END TWEET -->' . PHP_EOL . PHP_EOL;
	}
}


/* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	Pretty-fies the timestamp from Twitter
	INPUT:	UNIX timestamp
	CALLS:	none.
	RETURNS:	Human friendly time (X time ago)
--------------------------------------------------------------------*/
function prettyTime($a) {
	// To start with: what time is now
	$b = strtotime("now"); 
	// And when was the tweet created
	$c = strtotime($a);
	// Get the difference in UNIX timestamps
	$d = $b - $c;
	// Calculate the difference
	$minute = 60;
	$hour = $minute * 60;
	$day = $hour * 24;
	$week = $day * 7;
	
	// Returns human-friendly timestamps 
	if(is_numeric($d) && $d > 0) {
		if($d < 3) return "right now";
		if($d < $minute) return floor($d) . " seconds ago";
		if($d < $minute * 2) return "about 1 minute ago";
		if($d < $hour) return floor($d / $minute) . " minutes ago";
		if($d < $hour * 2) return "about 1 hour ago";
		if($d < $day) return floor($d / $hour) . " hours ago";
		if($d > $day && $d < $day * 2) return "yesterday";
		if($d < $day * 365) return floor($d / $day) . " days ago";
		return "over a year ago";
	}
}


/* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	Finds links in the tweet and returns the tweet with links
	INPUT:	String of tweet from the JSON-formatted text 
	CALLS:	none.
	RETURNS:	The tweet with clickable links
--------------------------------------------------------------------*/
function fixLinks($ret) {
	$ret = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#", "\\1<a href=\"\\2\" target=\"_blank\">\\2", $ret);
	$ret = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2", $ret);
	$ret = preg_replace("/@(\w+)/", "<a href=\"http://www.twitter.com/\\1\" target=\"_blank\">@\\1</a>", $ret);
	$ret = preg_replace("/#(\w+)/", "<a href=\"http://search.twitter.com/search?q=\\1\" target=\"_blank\">#\\1</a>", $ret);
	return $ret;
}


/* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	Get tour location and time from official RSS
	INPUT:	RSS-feed
	CALLS:	none
	RETURNS:	The latest X tourdates and locations
--------------------------------------------------------------------*/
function getTour() {
	$maxDates = 20;	// How many upcoming dates do we want
	$i=0;
	$doc = new DOMDocument();
	$doc->load('http://www.badreligion.com/rss/events/');
	$arrFeeds = array();
	print '<h1>Catch us on tour</h1>'. PHP_EOL;	
	foreach ($doc->getElementsByTagName('item') as $node) {
		// Only get the upcoming X dates
		if($i++ >= $maxDates) break;
		
		// Dig into the array of tourdata to get the elements
		$itemRSS = array ( 
			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
			'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
			'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
			'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue
		);
		array_push($arrFeeds, $itemRSS);
		
		// Title contains all that I need (Bad XML-file... baaad XML...)
		$all = explode("@ ", $itemRSS['title']);
		$where = $all[1];
		$time = explode(" ", $all[0]);
		$day = intval($time[2]);
		$month = $time[1];
		$stadiumAndCity = explode (" in ", $where);
		$stadium = htmlentities($stadiumAndCity[0]);
		$city =  htmlentities ($stadiumAndCity[1]);
		
		// Jolly good. Lets get some DIV's around that
		print '<div class="tourdate">' . PHP_EOL;
		print '	<div class="time">' . PHP_EOL;
		print '		<div class="month">' . $month . '</div>' . PHP_EOL;
		print '		<div class="day">' . $day . '</div>' . PHP_EOL;
		print '	</div> <!-- END TIME -->' . PHP_EOL;
		print '	<div class="stadium">' . $stadium. '</div>' . PHP_EOL;
		print '	<div class="city"><img src="img/map_pin.png" alt="Google Maps" width="12" height="20" /><a href="http://maps.google.com/maps?q=' . urlencode($city) . '" target="_blank">' . $city. '</a></div>' . PHP_EOL;
		print '</div> <!-- END TOURDATE -->' . PHP_EOL . PHP_EOL;
		
	}	
} 


/* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	Gets images from the Flickr Page
	INPUT:	HTML page
	CALLS:	none
	RETURNS:	Photos from Flickr
--------------------------------------------------------------------*/
function getImages() {
	$maxImages = 6;	// How many images do we want
	$i=0;	
	$url="http://www.flickr.com/photos/badreligion/";	
	$html = file_get_contents($url);
	print '<h1>Flickr Images</h1>'. PHP_EOL;
	$doc = new DOMDocument();
	@$doc->loadHTML($html);
	$allImages = $doc->getElementsByTagName('img');
		
	foreach ($allImages as $image)
		/*
		Work in Progress... Flickr decided to relayout their images and this script
		Does not work not...
		
		$newSrc = $image->getAttribute('style');
		echo "SRC:" . $newSrc . PHP_EOL;
		*/
		if(strstr ($image->getAttribute('src'), "_m.jpg")) {
			if($i++ >= $maxImages) break;
			print '<div class="flickr_image">' . PHP_EOL;
			print '	<img src="' . $image->getAttribute('src') . '" alt="'. $image->getAttribute('alt') .'"/>' . PHP_EOL;
			print '</div> <!-- END FLICKR_IMAGE -->' . PHP_EOL . PHP_EOL;
		}
} 


/* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	Reads the newsflow from a SQLite database
	INPUT:	none
	CALLS:	The database
	RETURNS:	The formatted news
--------------------------------------------------------------------*/
function getNews() {
	try {
		// Open the database
		$db = new PDO('sqlite:db/br_news.sqlite');
		$result = $db->query('SELECT * FROM News');
		foreach($result as $row) {
			print '<div class="story">' . PHP_EOL;
			print '	<div class="time">' . PHP_EOL;
			print '		<div class="month">' . $row["Month"] . '</div>' . PHP_EOL;
			print '		<div class="day">' . $row["Day"] . '</div>' . PHP_EOL;
			print '	</div> <!-- END TIME -->' . PHP_EOL;
			print '	<h1 class="rubrik">' . $row["Rubrik"] . '</h1>' . PHP_EOL;
			print '	<p class="ingress">' . $row["Ingress"] . '</p>' . PHP_EOL;
			print '	<p class="texten">' . $row["Texten"] . '</p>' . PHP_EOL;
			print '</div> <!-- END STORY -->' . PHP_EOL . PHP_EOL;
		}
		// close the database connection
		$db = NULL;
		}
		catch(PDOException $e) {
			print 'Exception : '.$e->getMessage();
	}
}

?>
