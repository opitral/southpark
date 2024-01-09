<?php
  if (!isset($_GET["season"])) {
    header("Location: seasons.php?season=1");

  } else {
    header("Location: seasons.php?season={$_GET["season"]}");
  }