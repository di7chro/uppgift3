<?php
getTour();

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
		$stadium = $stadiumAndCity[0];
		$city = $stadiumAndCity[1];
		
		// Jolly good. Lets get some DIV's around that
		print '<div class="tourdate">';
		print '	<div class="time">';
		print '		<div class="month">' . $month . '</div>';
		print '		<div class="day">' . $day . '</div>';
		print '	</div> <!-- END TIME -->';
		print '	<div class="stadium">' . $stadium. '</div>\n';
		print '	<div class="city"><a href="http://maps.google.com/maps?q=' . $city . '">' . $city. '</a></div> \n';
		print '</div> <!-- END TOURDATE -->';
		
	}	
} 

?>