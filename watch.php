<?php
  require_once("inc/connect.php");

  $season = mysqli_real_escape_string($connect, $_GET["season"]);
  $episode = mysqli_real_escape_string($connect, $_GET["episode"]);

  $result = mysqli_query($connect, "SELECT COUNT(*) FROM episodes WHERE season='{$season}' AND episode='{$episode}'");
  $row = mysqli_fetch_row($result);

  if (!$row[0]) {
    header("HTTP/1.0 404 Not Found");
    header("HTTP/1.1 404 Not Found");
    header("Status: 404 Not Found");
    die();
  }

  $result = mysqli_query($connect, "SELECT * FROM episodes WHERE season='{$season}' AND episode='{$episode}'");
  $assoc = mysqli_fetch_assoc($result);

  $season = $assoc["season"];
  $episode = $assoc["episode"];
  $link = $assoc["link"];
  $title = $assoc["title"];

  $temp = $episode - 1;
  $result = mysqli_query($connect, "SELECT COUNT(*) FROM episodes WHERE season='{$season}' AND episode='{$temp}'");
  $pre_ep = mysqli_fetch_row($result);

  $temp = $episode + 1;
  $result = mysqli_query($connect, "SELECT COUNT(*) FROM episodes WHERE season='{$season}' AND episode='{$temp}'");
  $next_ep = mysqli_fetch_row($result);

  $temp = $season - 1;
  $result = mysqli_query($connect, "SELECT COUNT(*) FROM episodes WHERE season='{$temp}'");
  $count_pre_s = mysqli_fetch_row($result);

  $temp = $season - 1;
  $result = mysqli_query($connect, "SELECT COUNT(*) FROM episodes WHERE season='{$temp}' AND episode='{$count_pre_s[0]}'");
  $pre_s = mysqli_fetch_row($result);

  $temp = $season + 1;
  $result = mysqli_query($connect, "SELECT COUNT(*) FROM episodes WHERE season='{$temp}' AND episode=1");
  $next_s = mysqli_fetch_row($result);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo "S{$season} · E{$episode} | SouthParkFun"; ?></title>
  <!-- <script src="https://unpkg.com/blickcss"></script>  -->
  <script src="https://unpkg.com/feather-icons"></script>
  <script src="assets/js/playerjs.js"></script>
  <script>
    blick.font.main = 'comfortaa'
    blick.screen.xl = '1000px'
  </script>
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <img src="assets/img/bg.png" class="fixed w-full h-full top-0 z--9 m-md:hide" alt="">

  <div class="wrapper md:pt-20 h-screen flex flex-col">
    <img src="assets/img/logo.svg" class="center w-500 mb-20 m-md:hide" alt="logo">


    <nav
      class="w-full bg-#FFC137 all:fs-18 all:time-200 all:c-0 flex flex-space gap-10 flex-wrap p-25+50 m-md:p-20 md:round-10+10+0+0">
      <a href="/" class="md:hide">
        <img src="logo.svg" class="h-20 m-md:brightness-0" alt="South Park">
      </a>
      <a href="index.php" class="h:scale-1.2 m-md:hide">Смотреть</a>
      <a href="inc/random.php" class="h:scale-1.2 m-md:hide">Случайная серия</a>
      <a href="http://t.me/SouthParkFun_bot" target="_blank" class="h:scale-1.2 m-md:hide">Telegram бот</a>
      <a href="contacts.php" class="h:scale-1.2 m-md:hide">Связь с нами</a>
      <div class="pointer md:hide" id="burgerBtn">
        <i data-feather="menu"></i>
      </div>
    </nav>

    <div class="rel z-9">
      <div id="burgerMenu" class="abs h-0 time-200 flex flex-col over-y-hidden gap-20 bg-#FFC137 w-full">
        <a href="index.php" class="c-0 pb-20 px-20">Смотреть</a>
        <a href="inc/random.php" class="c-0 pb-20 px-20">Случайная серия</a>
        <a href="http://t.me/SouthParkFun_bot" class="c-0 pb-20 px-20">Telegram бот</a>
        <a href="contacts.php" class="c-0 pb-20 px-20">Связь с нами</a>
      </div>
    </div>

    <main class="all:с-0 bg-f flex flex-col ai-c gap-30 p-20+50 m-md:p-20 grow">
      <div class="flex flex-col gap-20 grow md:w-95vh w-full">
        <h6><?php echo "{$title} | S{$season} · E{$episode}"; ?></h6>
        <div class="md:grow">
          <div id="player"></div>
        </div>
        <div class="flex jc-sb gap-20">

          <?php

          if ($pre_ep[0]) {
            $temp = $episode - 1;

            echo "
              <a href='watch.php?season={$season}&episode={$temp}' class='flex flex-center gap-10 bg-#FFC137 c-0 p-7+15 round-10'>
              <i width='15' data-feather='arrow-left'></i>
              <span class='fs-14'>Предыдущая серия</span>
              </a>
            ";

          } elseif ($pre_s[0]) {
            $temp = $season - 1;

            echo "
              <a href='watch.php?season={$temp}&episode={$count_pre_s[0]}' class='flex flex-center gap-10 bg-#FFC137 c-0 p-7+15 round-10'>
              <i width='15' data-feather='arrow-left'></i>
              <span class='fs-14'>Предыдущая серия</span>
              </a>
            ";
          }

          if ($next_ep[0]) {
            $temp = $episode + 1;

            echo "
              <div></div>
              <a href='watch.php?season={$season}&episode={$temp}' class='flex flex-center gap-10 bg-#FFC137 c-0 p-7+15 round-10'>
              <span class='fs-14'>Следующая серия</span>
              <i width='15' data-feather='arrow-right'></i>
              </a>
            ";

          } elseif ($next_s[0]) {
            $temp = $season + 1;

            echo "
              <div></div>
              <a href='watch.php?season={$temp}&episode=1' class='flex flex-center gap-10 bg-#FFC137 c-0 p-7+15 round-10'>
              <span class='fs-14'>Следующая серия</span>
              <i width='15' data-feather='arrow-right'></i>
              </a>
            ";
          }

          ?>

        </div>
      </div>
    </main>
  </div>


  <script>
    let player = new Playerjs({
      id: "player",
      file: "<?php echo $link; ?>"
    });

    let burderOpen = false

    burgerBtn.onclick = function () {
      if (burderOpen) {
        burgerMenu.style.height = 0
      }
      else {
        burgerMenu.style.height = '230px'
      }

      burderOpen = !burderOpen
    }

    feather.replace()
  </script>

</body>

</html>