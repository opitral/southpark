<?php
  require_once("inc/connect.php");

  $result = mysqli_query($connect, "SELECT * FROM contacts");
  $assoc = mysqli_fetch_assoc($result);

  $email = $assoc["email"];
  $telegram = $assoc["telegram"];
  $usdt = $assoc["usdt"];
  $btc = $assoc["btc"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Связь с нами | SouthParkFun</title>
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


    <main class="all:с-0 bg-f flex flex-col gap-30 m-md:p-20 p-30+50 grow">
      <div class="pч-30 flex flex-col gap-60">
        <div class="flex flex-col gap-20">
          <h4 class="fs-18">Если у вас есть пожелания для усовершенствования сайта или предложение по сотрудничеству,
            свяжитесь с нами используя контакты ниже</h4>
          <p><?php echo "Электронная почта: {$email}"; ?></p>
          <p><?php echo "Telegram: {$telegram}"; ?></p>
        </div>
        <div class="flex flex-col gap-20">
          <h4 class="fs-18">
            Вы можете отблагодарить создателей сайта монетой, адреса кошельков находяться ниже
          </h4>
          <p><?php echo "USDT (trc20): {$usdt}"; ?></p>
          <p><?php echo "BTC (bitcoin): {$btc}"; ?></p>
        </div>
      </div>


    </main>
  </div>


  <script>
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