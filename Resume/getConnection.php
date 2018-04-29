<!-- Author: Syed Alfran Ali
	ID : 2015Kucp1032
	Work: The page to create connection to database. This page is included in all other pages that need databse connection.
-->


<?php

	// connect to mongodb
	$conn = new MongoClient();

	// select a database
	$db = $conn->resume;
