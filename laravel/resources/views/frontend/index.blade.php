<?php
  $lazyModeDir = "/dev13";
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta id="Viewport" name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <meta name="theme-color" content="#292B2C">

    <link rel="icon" type="image/png" href="assets/frontend/favicon/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="assets/frontend/favicon/favicon-16x16.png" sizes="16x16" />

    <title>ITCAMP 13</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/frontend/css/jquery.fullpage.css">
    <link rel="stylesheet" href="assets/frontend/css/app.css">
  </head>

  <body>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-inverse bg-inverse">
      <div class="navbar-desktop hidden-md-down">
        <div class="nav-left">
          <div class="nav-linker" data-target="home-block">เริ่มต้น</div>
          <div class="nav-linker" data-target="detail-block">รายละเอียด</div>
          <div class="nav-linker" data-target="sponsor-block">ผู้สนับสนุน</div>
          <div class="nav-linker" data-target="camp-block">ค่ายย่อย</div>
        </div>
        <div class="logo">
          <img src="{{ $lazyModeDir }}/assets/frontend/images/logo-only-text.png" />
        </div>
        <div class="nav-right">
          <div class="nav-linker" data-target="timeline-block">กำหนดการ</div>
          <div class="nav-linker" data-target="gallery-block">ภาพกิจกรรม</div>
          <div class="nav-linker" data-target="recommend-block">คำนิยม</div>
          <div class="nav-linker" data-target="faq-block">ถาม-ตอบ</div>
        </div>
      </div>
      <div class="navbar-mobile hidden-lg-up">
        <div class="logo">
          <img src="{{ $lazyModeDir }}/assets/frontend/images/logo-only-text.png" />
        </div>
        <div class="nav-hamburger" id="nav-hamburger">
          <i class="fa fa-bars" aria-hidden="true"></i>
        </div>
      </div>
    </nav>

    <!-- Side nav (mobile) -->
    <nav class="sidenav">
      <div class="overlay"></div>
      <div class="navigation">
        <div class="nav-linker" data-target="home-block">เริ่มต้น</div>
        <div class="nav-linker" data-target="detail-block">รายละเอียด</div>
        <div class="nav-linker" data-target="sponsor-block">ผู้สนับสนุน</div>
        <div class="nav-linker" data-target="camp-block">ค่ายย่อย</div>
        <div class="nav-linker" data-target="timeline-block">กำหนดการ</div>
        <div class="nav-linker" data-target="gallery-block">ภาพกิจกรรม</div>
        <div class="nav-linker" data-target="recommend-block">คำนิยม</div>
        <div class="nav-linker" data-target="faq-block">ถาม-ตอบ</div>
      </div>
    </nav>

    <!-- Sidebar (Sharing & Social) -->
    <nav class="sidebar">
      <div class="sidebar-item share-facebook">
        <i class="fa fa-facebook" aria-hidden="true"></i>
        <span class="count">0</span>
      </div>
      <div class="sidebar-item share-twitter">
        <i class="fa fa-twitter" aria-hidden="true"></i>
        <span class="count">0</span>
      </div>
    </nav>

    <!-- Fullpage wrapper -->
    <section id="fullpage">

      <!-- Home block -->
      <section class="section home-block" data-anchor="home-block">
        <div class="content">
          <div class="logo">
            <img src="{{ $lazyModeDir }}/assets/frontend/images/logo.png" width="400" />
          </div>
          <h5>
            คณะเทคโนโลยีสารสนเทศ<br />
            สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง
          </h5>
          <h6>
            ได้รับเงินสนับสนุนจากงบประมาณแผ่นดินประจำปี 2560
          </h6>
        </div>
      </section>

      <!-- Detail block -->
      <section class="section detail-block" data-anchor="detail-block">
        <div class="content">
          <h1>รายละเอียดค่าย</h1>
          <br />
          <p>แดนเซอร์แฟร์ช็อปปิ้งบอยคอตต์ ภูมิทัศน์เซลส์สปายแจ๊ส ซีอีโอ แต๋วโปสเตอร์มาร์เก็ตแม่ค้าทัวริสต์ ไฮเวย์บลูเบอร์รี่อยุติธรรม คอร์สอุปการคุณไชน่าละอ่อน ยอมรับสคริปต์ ฮอตดอกเทียมทานสามแยกริกเตอร์โบรกเกอร์ โอเลี้ยงพรีเซ็นเตอร์โปรเจ็คก๊วน แอดมิสชันดอกเตอร์ เมจิกโนติสเมเปิลเอสเพรสโซเพรียวบาง ไฟลท์ คาร์โก้ อึ้มกรุ๊ป คอนโดก่อนหน้าซาร์สติ๊กเกอร์ แพ็คซีรีส์แครกเกอร์</p>
          <br />
          <div class="row justify-content-center overview-detail">
            <div class="col-lg-3 offset-lg-0 col-md-5">
              <img />
              <h3>รับสมัคร</h3>
              <h4>xx/xx/xx - xx/xx/xx</h4>
            </div>
            <div class="col-lg-3 col-md-5">
              <img />
              <h3>วันจัดค่าย</h3>
              <h4>xx/xx/xx - xx/xx/xx</h4>
            </div>
            <div class="col-lg-3 offset-lg-0 col-md-6">
              <img />
              <h3>สถานที่</h3>
              <h4>xxxxxxxxxx</h4>
            </div>
          </ul>
        </div>
      </section>

      <!-- Sponsor block -->
      <section class="section sponsor-block" data-anchor="sponsor-block">
        <div class="content">
          <h1>ผู้สนับสนุน</h1>
          <br />
          <div class="row justify-content-center sponsors-list">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
              <img />
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
              <img />
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
              <img />
            </div>
          </div>
        </div>
      </section>

      <!-- Camp block -->
      <section class="section camp-block" data-anchor="camp-block">

        <!-- Camp navigation -->
        <nav class="camp-nav hide">
          <ul>
            <li class="slide-link app" data-target="app"><img /></li>
            <li class="slide-link game" data-target="game"><img /></li>
            <li class="slide-link network" data-target="network"><img /></li>
            <li class="slide-link iot" data-target="iot"><img /></li>
            <li class="slide-link datasci" data-target="datasci"><img /></li>
          </ul>
        </nav>

        <!-- Main slide -->
        <div class="slide">
          <div class="content">
            <h1>ค่ายภายในค่าย</h1>
            <br />
            <div class="camp-characters">
              <div class="slide-link app" data-target="app">app</div>
              <div class="slide-link game" data-target="game">game</div>
              <div class="slide-link network" data-target="network">network</div>
              <div class="slide-link iot" data-target="iot">iot</div>
              <div class="slide-link datasci" data-target="datasci">datasci</div>
            </div>
          </div>
        </div>

        <!-- App camp -->
        <div class="slide app-camp" data-anchor="app">
          <div class="content">
            <h1>Application Camp</h1>
            <br />
          </div>
        </div>

        <!-- Game camp -->
        <div class="slide game-camp" data-anchor="game">
          <div class="content">
            <h1>GameDev Camp</h1>
            <br />
          </div>
        </div>

        <!-- Network camp -->
        <div class="slide network-camp" data-anchor="network">
          <div class="content">
            <h1>Network Camp</h1>
            <br />
          </div>
        </div>

        <!-- IoT camp -->
        <div class="slide iot-camp" data-anchor="iot">
          <div class="content">
            <h1>IoT Camp</h1>
            <br />
          </div>
        </div>

        <!-- DataSci camp -->
        <div class="slide datasci-camp" data-anchor="datasci">
          <div class="content">
            <h1>DataSci Camp</h1>
            <br />
          </div>
        </div>

      </section>

      <!-- Timeline block -->
      <section class="section timeline-block" data-anchor="timeline-block">
        <div class="content">
          <h1>กำหนดการ</h1>
          <br />
          <div>eiei ^__^</div>
        </div>
      </section>

      <!-- Gallery block -->
      <section class="section gallery-block" data-anchor="gallery-block">
        <div class="content">
          <h1>ภาพกิจกรรม</h1>
          <div class="wrapper">
            <div class="grid">
              <div class="grid-item col2x1">
                <img />
              </div>
              <div class="grid-item col1x1">
                <img />
              </div>
              <div class="grid-item col1x1">
                <img />
              </div>
              <div class="grid-item col2x2">
                <img />
              </div>
              <div class="grid-item col1x1">
                <img />
              </div>
              <div class="grid-item col1x1">
                <img />
              </div>
              <div class="grid-item col1x1">
                <img />
              </div>
              <div class="grid-item col1x1">
                <img />
              </div>
              <div class="grid-item col2x2">
                <img />
              </div>
              <div class="grid-item col1x1">
                <img />
              </div>
              <div class="grid-item col1x1">
                <img />
              </div>
              <div class="grid-item col1x1">
                <img />
              </div>
              <div class="grid-item col1x1">
                <img />
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Recommend block -->
      <section class="section recommend-block" data-anchor="recommend-block">
        <div class="content">
          <h1>คำนิยม</h1>
          <br />
          <div>some content</div>
        </div>
      </section>

      <!-- FAQ block -->
      <section class="section faq-block" data-anchor="faq-block">
        <div class="content">
          <h1>FAQ</h1>
          <br />
        </div>
      </section>

    </section>

    <script type="text/javascript" src="assets/frontend/js/app.js"></script>
  </body>
</html>
