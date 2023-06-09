<!--This is an example file of a php index. It is by no means ready and shall not be displayed yet.
My intention is to use this instead of the index.html.
I have taken a break for a few weeks because I was on vacation and defenetly lost momentum for the release of this website,
But I doubt that anyone will ever read this note... If anyone doeas, please understand that my life is very stressful at this moment and I just want to make a few commits to start being active again.
I have some great ideas for the new feature.
My first idea will be to actually use this index.php and delete this comment.-->

<!DOCTYPE html>
<head>
    <meta charset='utf-8'/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css" media="screen and (min-width:768px)" id="theme-style">
    <link rel="stylesheet" type="text/css" href="dark.css" media="screen and (min-width:768px)" id="dark-theme" disabled>
    <link rel="stylesheet" type="text/css" href="mobile.css" media="screen and (max-width:767px)">
    <title>Straight Line Wiki</title>
    <link rel="icon" href="assets/images/logo.svg" type="image/icon type">
</head>
<body>
    <header>
        <h1>Straight Line Wiki</h1>
        <div class="menudiv">
          <a href="#slms"><button class="menubutton">Straight line what?</button></a>
          <a href="#criteria"><button class="menubutton">How to measure lines</button></a>
          <button id="open-dialog-btn" class="menubutton">Submit a straight line</button>
          <button class="menubutton" id="theme-toggle">Light theme / Dark theme</button>
        </div>
        <dialog id="dialog" class="infodialog">
          <h3>Sorry...</h3>
          <p>...This functionality is not available yet.</p>
          <p>I am gonna implement it soon!</p>
        </dialog>
    </header>




    <main style="position: relative;">

	<hr>
  <!--notes-->
  <b>This website is dedicated to those who take on the mad challenge of straight line missions.</b>
  <p>Our ultimate goal is to index every relevant straight line a human has ever walked.</p>
  <hr>
  <h4>Meaning of abbreviations:</h4>
  <p>N/D = No Data</p>
  <p>N/A = Non-Applicable</p>
  <p>DCS = Data Coming Soon</p>
  <hr>
  <!--old table>
	<div class="simple" id="My-iframe">
		<iframe class="simple" src="table.html" id="My-iframe"></iframe>
		<p></p>
	</div>
<old table ends-->





    <h1>Data from MySQL Table</h1>

    <table>
	<tr>
	    <th>Title</th>
	    <th>Straightliner</th>
	    <th>Posted On</th>
	    <th>Completeness</th>
		<th>Medal</th>
		<th>Burdell Score</th>
		<th>Line Length</th>
		<th>Max Deviation</th>
	</tr>
	<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//IF YOU HAPPEN TO CLONE THIS PROJECT, DON'T FORGET TO CHANGE YOUR ENVIRONMENT VARIABLES.
		$servername = "localhost";
		$username = getenv("DB_USERNAME");
		$password = getenv("DB_PASSWORD");
		$dbname = getenv("DB_DATABASE");

        // Create a connection
        	$conn = new mysqli($servername, $username, $password, $dbname);

        // Check the connection
        	if ($conn->connect_error) {
        	    die("Connection failed: " . $conn->connect_error);
        	}

        // Query to retrieve data from the table
        	$sql = "SELECT * FROM straightlines";
        	$result = $conn->query($sql);

        // Loop through the data and generate table rows
        	if ($result->num_rows > 0) {
        	    while ($row = $result->fetch_assoc()) {
        	        echo "<tr>";
					//Title
        	        echo "<td>" . $row["Title"] . "</td>";
					//Name
        	        echo "<td>" . $row["Straightliner"] . "</td>";
					//Date
        	        echo "<td>" . $row["Posted_On"] . "</td>";
					//Completeness
					echo "<td>";
					if ($row["Completeness"] !== null) {
						echo $row["Completeness"] . "%";
					} else {
						echo "Incomplete";
					}
					echo "</td>";
					//Medal
					echo "<td>";
					$medal = $row["Medal"];
					switch ($medal) {
						case 1:
							echo "Platinum";
							break;
						case 2:
							echo "Gold";
							break;
						case 3:
							echo "Silver";
							break;
						case 4:
							echo "Bronze";
							break;
						case 5:
							echo "N/A";
							break;
						default:
							echo "-";
							break;
					}
					echo "</td>";
					
					//Burdell Score
					echo "<td>";
					if ($row["Burdell_Score"] !== null) {
					    echo $row["Burdell_Score"] . "%";
					} else {
					    echo "N/D";
					}
					echo "</td>";

					//Length
					echo "<td>";
					if ($row["Line_Length"] !== null) {
						echo $row["Line_Length"] . " km";
					} else {
						echo "N/D";
					}
					echo "</td>";
					//Max Deviation

					echo "<td>";
					if ($row["Max_Deviation"] !== null) {
					    echo $row["Max_Deviation"] . " m";
					} else {
					    echo "N/D";
					}
					echo "</td>";

        	        echo "</tr>";
        	    }
        	} else {
        	    echo "<tr><td colspan='4'>No data found</td></tr>";
        	}
	
        // Close the database connection
	$conn->close();
        ?>

</table>

<!--explanations etc-->
<hr>
  <div class="container">
    <section id="slms">
      <h3>Straight Line Missions</h3>
      <p>The Concept of a Straight Line Mission has been probably invented, certainly made popular, by youtuber Tom Davis, AKA Geowizard, long time lover of mischief and adventure. In the winter of 2018 he attempted something that, as far as we know, has never been done before: Walk across an entire country in a straight line.<br>Ever since, people have been inspired by him and attempted the same across other countries, parks, states, provinces, areas, etc.<br>Whether you consider this a sport, a trend, or just a mad idea, it has a rapidly growing fan base and many people are trying to follow all the insane adventurers who take on this ordeal.</p>
      <hr>
    </section>
    <hr>
    <section id="criteria">
      <h3>The criteria by which Lines may be measured</h3>
      <p>Straightness of lines can be measured in many ways, but there are two that have been established and accepted on the Geowizard channel: The Medals and the Burdell score.<br>The Medals are a simple standard invented by Tom Davis himself. They are scored based on the maximum deviation from the original line:<br>Platinum: 0-25m<br>Gold: 25-50m<br>Silver: 50-80m<br>Bronze: 80-120m</p><p>The Burdell Score is a method to score a line that is much more complex. It was created by a fan and you can read more about it on <a href="https://scoremyline.com">scoremyline.com</a>.</p>
    </section>
    <hr>
    <section id="mission">
      <h3>The Mission of this website</h3>
      <p>This website is made by me in my free time. I am not being paid or sponsored. I am also not a professional developer, and I am using this site to learn. I am just a Straight Line Mission enthusiast.<br>The ultimate mission of this website is to list every single straight line mission that has ever been documented. My primary source of research is <a href="https://youtube.com">Youtube</a>, but some missions are not on there and I have to do research on random pages across the web.<br>If you see some wrong information, don't hesitate to <a href="#contact">contact me</a>. Also, check out the <a href="#next">next steps</a> of this website.</p>
    </section>
    <hr>
  </div>

  <!--next steps-->
  <div id="next">
	  <h3>Future Plans for this website</h3>
	  <p>As you can see, this website is not close to complete yet. It lacks some important SLM data, and a lot of functionality.<br>My next steps on here are:</p>
	  <hr>
	  <b>Adding more data</b>
	  <p>There are quite a few more straight line missions on youtube.<br>Some of them are really impressive!<br>I am watching them one by one to get the correct data.</p>
	  <hr>
	  <b>Migrating the database</b>
	  <p>Right now, the database is just an html table.<br>I want to migrate all the data to a MySQL database.</p>
	  <hr>
	  <b>Fixing the sorting</b>
	  <p>Right now, the sorting function is not working properly for all columns.<br>Some of the columns are still sorted alphabetically when they shouldn't be.<br>I could just fiz the javascript, but I would probably have to fix it again after migrating the data, so I am leaving it for later.</p>
	  <hr>
	  <b>Creating a detail section for every mission</b>
	  <p>Some missions have important details about them that is not displayed in the table.<br>I want to make a section where I can paste more info about every mission, maybe even including a map.<br>This section should also contain a comment section where people can talk about the mission.</p>
    <hr>
    <b>Fixing the Dark mode</b>
	  <p>And by that I mean making it work on the table.</p>
  	 <hr>
	  <b>Making a section where people can submit more straight line missions</b>
	  <p>...or even suggest edits in the existing ones.<br>This should be a form that is easy to fill out.<br>I am not prioritizing this because I would have to connect it to a database, and right now I don't have a real functioning database.<br>I promise I will, soon.</p>
	  <hr>
    <b>Creating a Logo</b>
	  <p>...Or asking someone to create one.<br>I also need artwork for the buttons.</p>
	  <hr>
	  <b>Asking people for help</b>
	  <p>Maintaining the integrity of all the gathered data is more then I can just do in my free time.<br>For now, if you want to get in contact with me, you can email me at mail@simonjoel.com<br>Please note that I am not a professional.<br>I am just a random guy with a job and a life, making this site in my free time because I admire the people who go out and do straight line missions.</p>
  </div>

  <!--contacts-->
  <div id="contact">
    <h3>Contact</h3>
    <p>For now, you can use this email address to contact me: mail@simonjoel.com</p>
  </div>

  <!--js source-->
    <script src="script.js"></script>
    </main>

</body>

<footer>
	    <a href="https://github.com/SimonJoelWarkentin/straightlinewiki" style="font-size: 10px;">This website is an Open Source project by Simon Joel.</a>
</footer>

</html>

