<?php
  /*
	try
	{
    //open the database
    $db = new PDO('sqlite:/webbroot/blog/uppgift3/db/br_news.sqlite');
    $db = new PDO('sqlite:db/br_news.sqlite');

    //create the database
    $db->exec("CREATE TABLE News (Id INTEGER PRIMARY KEY, Month TEXT, Day TEXT, Rubrik TEXT, Ingress TEXT, Texten TEXT)");    

    //insert some data...
    $db->exec("INSERT INTO News (Month, Day, Rubrik, Ingress, Texten) VALUES ('April', '25', 'Bad Religion to appear on Jimmy Fallon', 'On January 30th Bad Religion will be making their first ever appearance on Late Night With Jimmy Fallon. The show will air at 12:35 am Eastern/11:35 pm Central on NBC. On top of that, in an article that mentions this news they also talk about an in-store pre-order for fans that buy the new album at a Trans World shop. Apparently, this pre-order includes an exclusive download of the track Crisis Time.', 'Pork loin shoulder ball tip jowl turducken, tongue meatloaf. Strip steak andouille kielbasa short loin. Pork loin bacon corned beef beef ribs swine cow fatback filet mignon. Jowl biltong pork chop meatloaf bresaola pancetta fatback pork loin shoulder. Venison ribeye pancetta brisket kielbasa. Corned beef shankle short ribs leberkas tenderloin. Swine corned beef tri-tip strip steak frankfurter ham hock short ribs shank hamburger spare ribs. Tenderloin frankfurter swine biltong, pancetta tongue flank doner meatball filet mignon ham salami. Jerky shoulder pastrami strip steak jowl drumstick ground round, kielbasa andouille meatball leberkas turkey rump salami sirloin. Ham hock pancetta ham corned beef tongue jerky rump ribeye. Shankle t-bone jowl, venison short loin leberkas pig. Sausage jowl swine, doner kielbasa brisket short loin. Pork chop flank shankle pork, spare ribs pig chicken venison jowl biltong rump ham doner tri-tip.');");
    $db->exec("INSERT INTO News (Month, Day, Rubrik, Ingress, Texten) VALUES ('April', '14', 'Bad Religion to headline Musink festival', 'Another new show has been added Bad Religions schedule: the 6th annual Musink festival that takes place on March 8-10 in Costa Mesa, Ca. Other bands that will be playing there are The Vandals, Pennywise, TSOL, Guttermouth, Lagwagon and more.', 'Shankle drumstick leberkas, pig t-bone kielbasa venison shank hamburger biltong pork fatback prosciutto bresaola ham hock. Pork ham hock ham shankle cow flank pork loin. Jowl jerky flank short loin corned beef tail andouille fatback. Drumstick tri-tip capicola turkey sausage ground round. Short loin meatball pancetta t-bone ham frankfurter ball tip ribeye doner jowl cow. Bresaola turducken pork chop jowl, short ribs sirloin chicken meatball rump. Swine pancetta jowl venison tri-tip sausage salami pork prosciutto.');");
    $db->exec("INSERT INTO News (Month, Day, Rubrik, Ingress, Texten) VALUES ('April', '03', 'Los Angeles show announced', 'Bad Religion will be playing a show at The Echo in Los Angeles on wednesday January 23. This is the first announcement of a show in the US this year. Jay recently revealed in an interview that the band has planned to hit the road early 2013. So this could be the first of more. Ticket sale will start on January 11.', 'Bacon ipsum dolor sit amet tenderloin turkey meatball, pork belly bacon cow ball tip spare ribs bresaola boudin jerky. Hamburger t-bone jerky, pork loin tongue drumstick leberkas. Pork belly pork pork loin shankle chicken, fatback andouille meatball sausage sirloin ribeye biltong. Short loin tenderloin flank, pancetta chicken boudin meatloaf ribeye capicola corned beef t-bone ham hock sirloin pastrami jerky. Jowl swine rump shank sirloin, prosciutto fatback turkey ham biltong pastrami tongue brisket ribeye. Turkey brisket ball tip, pastrami ham hamburger prosciutto turducken beef tongue. Ham hock short ribs boudin shank. Ham hock chuck biltong drumstick tail fatback jerky capicola cow frankfurter salami prosciutto spare ribs. Meatball tongue swine, ball tip sirloin turducken tri-tip pork chop cow bacon prosciutto pastrami beef ribs. Tenderloin ham hock andouille t-bone, sirloin shankle beef tri-tip venison spare ribs jerky jowl pancetta short loin. Shankle prosciutto pork, capicola brisket hamburger t-bone turducken pork chop pork belly short loin rump. Meatball pork chop sausage turkey, biltong strip steak ball tip meatloaf corned beef ham kielbasa. Pastrami venison spare ribs ball tip, tongue andouille fatback jowl brisket beef ribs leberkas.');");

    //now output the data to a simple html table...
    print "<table border=1>";
    print "<tr><td>Id</td><td>Month</td><td>Day</td><td>Rubrik</td><td>Ingress</td><td>Texten</td></tr>";
    $result = $db->query('SELECT * FROM News');
    foreach($result as $row)
    {
      print "<tr><td>".$row['Id']."</td>";
      print "<td>".$row['Month']."</td>";
      print "<td>".$row['Day']."</td>";
      print "<td>".$row['Rubrik']."</td>";
      print "<td>".$row['Ingress']."</td>";
      print "<td>".$row['Texten']."</td></tr>";
    }
    print "</table>";

    // close the database connection
    $db = NULL;
  }
  catch(PDOException $e)
  {
    print 'Exception : '.$e->getMessage();
  }
  */
?>