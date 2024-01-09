<?php
	require_once("connect.php");

	$result = mysqli_query($connect, "SELECT COUNT(*) FROM episodes WHERE episode=1");
	$row = mysqli_fetch_row($result);

	$season = random_int(1, $row[0]);

	$result = mysqli_query($connect, "SELECT COUNT(*) FROM episodes WHERE season='$season'");
	$row = mysqli_fetch_row($result);

	$episode = random_int(1, $row[0]);

	header("Location: ../watch.php?season={$season}&episode={$episode}");