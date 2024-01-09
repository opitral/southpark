<?php
  require_once("inc/connect.php");

  $season = mysqli_real_escape_string($connect, $_GET["season"]);

  $result = mysqli_query($connect, "SELECT COUNT(*) FROM episodes WHERE season='{$season}'");
  $row = mysqli_fetch_row($result);

  if (!$row[0]) {
    header("HTTP/1.0 404 Not Found");
    header("HTTP/1.1 404 Not Found");
    header("Status: 404 Not Found");
    die();
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo "{$season} сезон | SouthParkFun"; ?></title>
  <!-- <script src="https://unpkg.com/blickcss"></script> -->
  <script src="https://unpkg.com/feather-icons"></script>
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

    <main class="all:с-0 bg-f flex flex-col gap-30 p-30+50 m-md:p-20 grow">
      <div class="select w-fit">
        <div class="select" id="sel">
          <div class="select_elem" id="selElem">
            <div class="flex ai-c">
              <i data-feather="chevron-down" stroke-width="1px"></i>
              <span><?php echo "Сезон {$season}"; ?></span>
            </div>
          </div>
          <div class="select_container" id="selCont">
            <?php
              $result = mysqli_query($connect, "SELECT COUNT(*) FROM episodes WHERE episode=1");
              $row = mysqli_fetch_row($result);

              for ($i=1; $i <= $row[0]; $i++) { 
                echo "<a href='seasons.php?season={$i}'>Сезон {$i}</a>";
              }
            ?>
          </div>
        </div>
      </div>

      <?php 
        $result = mysqli_query($connect, "SELECT * FROM episodes WHERE season='$season'");

        while ($assoc = mysqli_fetch_assoc($result)) {
          echo "
            <a href='watch.php?season={$assoc["season"]}&episode={$assoc["episode"]}' class='episode flex m-md:flex-col md:gap-30 gap-10'>
              <h3 class='md:hide'>{$assoc["episode"]}. {$assoc["title"]}</h3>
              <img src='{$assoc["preview"]}' class='md:w-250 md:round-5 fit-contain' alt='ep1'>
              <div class='flex flex-col  jc-sb h-full'>
                <div>
                  <h3 class='m-md:hide'>{$assoc["episode"]}. {$assoc["title"]}</h3>
                  <p class='mt-10'>{$assoc["description"]}</p>
                </div>
                <p class='c-gray time'>Серия вышла: {$assoc["date"]}</p>
              </div>
            </a>
          ";
        }
      ?>
      
    </main>
  </div>


  <script>
    let opened = false

    sel.onclick = function () {
      if (opened) {
        sel.classList.remove('opened')
      } else {
        sel.classList.add('opened');
      }
      opened = !opened
    }

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