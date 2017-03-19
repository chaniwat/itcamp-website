<?php
//  $lazyModeDir = "/13";
//  $lazyModeDir = "/dev13";
  $lazyModeDir = "";
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
    <link rel="stylesheet" href="assets/frontend/css/app.css?v={{ (int)microtime(true) }}">
  </head>

  <body>
    <!-- Loading Screen -->
    <div class="loading-overlay" id="loadingScreen">
      <div class="loading-content">This is a loading screen.</div>
    </div>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-inverse bg-inverse">
      <div class="navbar-desktop hidden-md-down">
        <div class="nav-left">
          <div class="nav-linker active" data-target="home-block">เริ่มต้น</div>
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
        <div class="nav-hamburger" id="nav-hamburger">
          <i class="fa fa-bars" aria-hidden="true"></i>
        </div>
        <div class="logo">
          <img src="/dev13/assets/frontend/images/logo-only-text.png" />
        </div>
      </div>
    </nav>

    <!-- Side nav (mobile) -->
    <nav class="sidenav">
      <div class="overlay"></div>
      <div class="navigation">
        <div class="nav-linker active" data-target="home-block">เริ่มต้น</div>
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
        <div class="waves">
          <div class="waving-blue"></div>
          <div class="waving-green"></div>
          <div class="waving-purple"></div>
        </div>
      </section>

      <!-- Detail block -->
      <section class="section detail-block" data-anchor="detail-block">
        <div class="content">
          <h1 class="block-title">รายละเอียดค่าย</h1>
          <p>กลับมาอีกครั้ง! ค่ายไอทีแคมป์ ครั้งที่ 13 ค่ายแนะแนวคณะไอทีสำหรับน้องๆ ที่กำลังขึ้นชั้นเรียน ม.4-6 <br class="hidden-md-down" />
            ที่มีใจรักพร้อมเรียนรู้ทางด้านเทคโนโลยีไปกับพวกพี่ๆ จากคณะไอทีลาดกระบัง <span class="br-0_5"></span>
            เมื่อไวรัสพัฒนา ยุคของเทคโนโลยีกำลังจะเปลี่ยนไป! เมื่อเหล่าผู้พิทักษ์ตื่นขึ้นมาต้องเจอกับโลกไซเบอร์ที่เต็มไปด้วยไวรัส มาร่วมทีมปราบไวรัสวายร้ายทั้ง 5 ชนิดที่กำลังกัดกินโลกไซเบอร์ของเรากับ 5 ค่ายที่จะพัฒนาน้อง ๆ ไปสู่ทีมที่แข็งแกร่งอย่าง AppVira, GamePersky, NetworkTon, IOTSecure และ DataScan หากพร้อมแล้วก็มาร่วมเป็นส่วนหนึ่งในกระบวนการกำจัดไวรัสไปด้วยกัน!!</p>
          <div class="row justify-content-center overview-detail">
            <div class="col-lg-3 offset-lg-0 col-md-5">
              <img src="{{ $lazyModeDir }}/assets/frontend/images/home-regis.png" />
              <h3>รับสมัคร</h3>
              <span class="sub">19 มีนาคม - 1 พฤษภาคม 2560</span>
            </div>
            <div class="col-lg-3 col-md-5">
              <img src="{{ $lazyModeDir }}/assets/frontend/images/home-calendar.png" />
              <h3>วันจัดค่าย</h3>
              <span class="sub">8-12 มิถุนายน 2560</span>
            </div>
            <div class="col-lg-3 offset-lg-0 col-md-6">
              <img src="{{ $lazyModeDir }}/assets/frontend/images/home-place.png" />
              <h3>สถานที่</h3>
              <span class="sub font-weight-bold">IT<span class="text-orange">KMITL</span></span>
            </div>
          </ul>
        </div>
      </section>

      <!-- Sponsor block -->
      <section class="section sponsor-block" data-anchor="sponsor-block">
        <div class="waves">
          <div class="waves-bg"></div>
          <div class="waving-blue"></div>
          <div class="waving-green"></div>
          <div class="waving-purple"></div>
        </div>
        <div class="content">
          <h1 class="block-title">ผู้สนับสนุน</h1>
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
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
              <img />
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
              <img />
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
              <img />
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
              <img />
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
              <img />
            </div>
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
        <div class="camp-connect" id="sponsor-camp-connect-el"></div>
      </section>

      <!-- Camp block -->
      <section class="section camp-block" data-anchor="camp-block">

        <!-- Camp navigation -->
        <nav class="camp-nav hide">
          <ul>
            <li class="slide-link app" data-target="app"></li>
            <li class="slide-link game" data-target="game"></li>
            <li class="slide-link network" data-target="network"></li>
            <li class="slide-link iot" data-target="iot"></li>
            <li class="slide-link datasci" data-target="datasci"></li>
          </ul>
        </nav>

        <!-- Camp Background (Parallax independent) -->
        <div class="camp-background">

        </div>

        <!-- Main slide -->
        <div class="slide">
          <div class="content">
            <h1 class="block-title">ค่ายย่อย</h1>
            <div class="camp-characters">
              <img src="{{ $lazyModeDir }}/assets/frontend/images/camp-all-character-bg.png" class="camp-bg" />
              <img src="{{ $lazyModeDir }}/assets/frontend/images/camp-all-character-com.png" class="camp-comp" />
              <div class="slide-link camp-character camp-character-app" data-target="app">
                <img src="{{ $lazyModeDir }}/assets/frontend/images/character-app.png" />
                <div class="camp-cloud app force-fredoka">AppVira</div>
              </div>
              <div class="slide-link camp-character camp-character-game" data-target="game">
                <img src="{{ $lazyModeDir }}/assets/frontend/images/character-game.png" />
                <div class="camp-cloud game force-fredoka">GamePersky</div>
              </div>
              <div class="slide-link camp-character camp-character-network" data-target="network">
                <img src="{{ $lazyModeDir }}/assets/frontend/images/character-network.png" />
                <div class="camp-cloud network force-fredoka">NetworkTon</div>
              </div>
              <div class="slide-link camp-character camp-character-iot" data-target="iot">
                <img src="{{ $lazyModeDir }}/assets/frontend/images/character-iot.png" />
                <div class="camp-cloud iot force-fredoka">IOTSecure</div>
              </div>
              <div class="slide-link camp-character camp-character-datasci" data-target="datasci">
                <img src="{{ $lazyModeDir }}/assets/frontend/images/character-datasci.png" />
                <div class="camp-cloud datasci force-fredoka">DataScan</div>
              </div>
            </div>
            <div class="camp-helper">
              (ลองกดที่ตัวไวรัสดูสิ~)
            </div>
          </div>
        </div>

        <!-- App camp -->
        <div class="slide app-camp" data-anchor="app">
          <div class="slide-content">
            <div class="row">
              <div class="camp-image col-12 col-lg-6">
                <img src="{{ $lazyModeDir }}/assets/frontend/images/camp-app-o.png" />
              </div>
              <div class="camp-detail col-12 col-lg-6">
                <div class="camp-detail-wrapper">
                  <span class="badge badge-pill badge-default">ค่ายย่อย Application Development</span>
                  <h2 class="camp-name">AppVira</h2>
                  <hr />
                    <p><span class="space-4"></span>ฉีกตำราเดิมๆ และมาสร้างสรรค์สิ่งใหม่ในโลกความรู้แอปพลิเคชั่นกับ AppVira ค่ายที่จะพาน้องๆ ไปสร้างแอปพลิเคชั่นด้วยฝีมือตัวเองด้วยสุดยอดโปรแกรมอย่าง Visual Studio 2015 บนระบบปฏิบัติการ Windows 10 แล้วจะพบว่าเราก็สามารถสร้างสรรค์สิ่งต่างๆ ได้อีกมากมายเพียงแค่น้องลงมือทำ! <br />
                        <span class="space-4"></span>โอ้โห! ได้สร้างแอปพลิเคชั่นใหม่ๆ ด้วยตัวเองอย่างนี้แถมมีพี่ๆ ที่พร้อมจะสอนน้องๆ ให้ได้ความรู้ด้วย จะรอช้าทำไมกดปุ่มสมัครเลย!</p>
                  <a href="{{ route('view.frontend.register', ['camp' => 'app']) }}" class="btn btn-regis-app">สมัครค่ายนี้</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Game camp -->
        <div class="slide game-camp" data-anchor="game">
          <div class="slide-content">
            <div class="row">
              <div class="camp-image col-12 col-lg-6">
                <img src="{{ $lazyModeDir }}/assets/frontend/images/camp-game-o.png" />
              </div>
              <div class="camp-detail col-12 col-lg-6">
                <div class="camp-detail-wrapper">
                  <span class="badge badge-pill badge-default">ค่ายย่อย Game Development</span>
                  <h2 class="camp-name">GamePersky</h2>
                  <hr />
                  <p><span class="space-4"></span>พร้อมกันหรือยัง? กับค่าย GamePersky ที่จะเปลี่ยนน้องจากผู้เล่นสู่ผู้สร้างบนเส้นทางแห่งสายเกมเมอร์ สร้างสรรค์เกมในแบบที่น้องๆ จินตนาการไว้ดั่งใจนึกด้วยโปรแกรม Construct 2 ที่จะช่วยน้องสรรสร้างเกมออกมาได้สุดแสนจะง่ายดายเพียงแค่คลิก ลาก และวางเท่านั้น <br />
         	          <span class="space-4"></span>ว้าว! ได้ทั้งความรู้ ได้ทั้งประสบการณ์ในการทำเกมอีกอย่างนี้พลาดไม่ได้แล้ว! สมัครเลย แล้วมาร่วมกันเป็นผู้กล้าแห่ง GamePersky กันเถอะ</p>
                  <a href="{{ route('view.frontend.register', ['camp' => 'game']) }}" class="btn btn-regis-game">สมัครค่ายนี้</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Network camp -->
        <div class="slide network-camp" data-anchor="network">
          <div class="slide-content">
            <div class="row">
              <div class="camp-image col-12 col-lg-6">
                <img src="{{ $lazyModeDir }}/assets/frontend/images/camp-network-o.png" />
              </div>
              <div class="camp-detail col-12 col-lg-6">
                <div class="camp-detail-wrapper">
                  <span class="badge badge-pill badge-default">ค่ายย่อย Network</span>
                  <h2 class="camp-name">NetworkTon</h2>
                  <hr />
                    <p><span class="space-4"></span>ท่องระบบเครือข่ายกับค่าย NetworkTon พาน้องๆ มาค้นหา และทำความเข้าใจความลับต่างๆ ของการทำงานบนโครงสร้างเครือข่ายที่ซับซ้อนกันอย่างง่ายดาย อีกทั้งยังได้ใช้โปรแกรมสุดเจ๋งอย่าง Cisco Packet Tracer โปรแกรมจำลองสร้างระบบเครือข่ายอย่างง่ายอีกด้วย <br />
                        <span class="space-4"></span>โห! ได้ความรู้ในระดับมหาวิทยาลัยที่เข้าใจง่ายอย่างนี้ อีกทั้งยังมีพี่ๆ ที่สุดแสนจะน่ารักคอยช่วยสอน และยังได้ทดลองสร้างระบบจำลองด้วยตัวเองอีก ประสบการณ์อย่างนี้หาไม่ได้จากที่ไหนอีกแล้วอย่ารอช้าเลย! รีบมาสมัครกัน</p>
                  <a href="{{ route('view.frontend.register', ['camp' => 'network']) }}" class="btn btn-regis-network">สมัครค่ายนี้</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- IoT camp -->
        <div class="slide iot-camp" data-anchor="iot">
          <div class="slide-content">
            <div class="row">
              <div class="camp-image col-12 col-lg-5">
                <img src="{{ $lazyModeDir }}/assets/frontend/images/camp-iot-o.png" />
              </div>
              <div class="camp-detail col-12 col-lg-7">
                <div class="camp-detail-wrapper">
                  <span class="badge badge-pill badge-default">ค่ายย่อย IoT (Internet Of Things)</span>
                  <h2 class="camp-name">IOTSecure</h2>
                  <hr />
                    <p><span class="space-4"></span>ร่วมมือกันสร้างไอเดียชิ้นใหม่เพื่อต่อต้านไวรัสในโลกไซเบอร์ด้วยเทคโนโลยี Internet of Things มาสร้างสรรค์ไอเดียเจ๋งๆ กันได้ที่ค่าย IOTSecure ที่จะพาน้องๆ เรียนรู้ในสิ่งประดิษฐ์ที่ทันสมัยไม่ซ้ำใคร รวมถึงได้ทดลองใช้อุปกรณ์เสริมไม่ว่าจะเป็น Arduino Uno R3, ESP8266 และอื่นๆ อีกมากมาย <br />
                        <span class="space-4"></span>ว้าว! มีอุปกรณ์แปลกๆ ให้เล่นด้วย แถมยังได้สร้างสิ่งประดิษฐ์จากไอเดียเจ๋งๆ อีก รู้อย่างนี้แล้วรีบกดปุ่มสมัครแล้วเอาไอเดียของน้องมาแชร์ให้โลกได้รู้กันเถอะ!</p>
                  <a href="{{ route('view.frontend.register', ['camp' => 'iot']) }}" class="btn btn-regis-iot">สมัครค่ายนี้</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- DataSci camp -->
        <div class="slide datasci-camp" data-anchor="datasci">
          <div class="slide-content">
            <div class="row">
              <div class="camp-image col-12 col-lg-5">
                <img src="{{ $lazyModeDir }}/assets/frontend/images/camp-datasci-o.png" />
              </div>
              <div class="camp-detail col-12 col-lg-7">
                <div class="camp-detail-wrapper">
                  <span class="badge badge-pill badge-default">ค่ายย่อย Data Science</span>
                  <h2 class="camp-name">DataScan</h2>
                  <hr />
                  <p><span class="space-4"></span>ค่ายน้องใหม่ไฟแรงอย่างค่าย DataScan จะพาน้อง ๆ มาช่วยกันไขความลับแห่งข้อมูลที่ซุกซ่อนอยู่รอบตัวน้อง ๆ ด้วยตัวช่วยสุดเจ๋งอย่างโปรแกรม Rapid miner อีกทั้งยังมีพี่ ๆ ที่พร้อมจะให้คำปรึกษาและสอนน้องๆ ในปัญหาที่น้องสงสัยอีกมากมายเลยล่ะ แล้วน้องจะค้นพบว่าข้อมูลที่อยู่รอบตัวน้องนั้นมีประโยชน์มากกว่าที่น้องเคยคิด! <br />
	                   <span class="space-4"></span>พลาดไม่ได้! อย่างนี้ต้องลองมาเรียนแล้ว มาร่วมเป็นส่วนหนึ่งไปกับการขุดค้นหาข้อมูลกับค่าย DataScan กันเถอะ อย่ารอช้ากดปุ่มสมัครกันได้เลย!</p>
                  <a href="{{ route('view.frontend.register', ['camp' => 'datasci']) }}" class="btn btn-regis-datasci">สมัครค่ายนี้</a>
                </div>
              </div>
            </div>
          </div>
        </div>

      </section>

      <!-- Timeline block -->
      <section class="section timeline-block" data-anchor="timeline-block">
        <div class="camp-connect-bg" id="timeline-camp-connect-bg-el"></div>
        <div class="camp-connect" id="timeline-camp-connect-el"></div>
        <div class="content">
          <h1 class="block-title">กำหนดการ</h1>
          <div class="timeline-wrapper row">
            <div class="timeline-1 col">
              <img src="{{ $lazyModeDir }}/assets/frontend/images/tv-1.png" height="200" />
              <span class="timeline-date">19 มี.ค. 2560</span>
              <span class="timeline-sub">วันรับสมัคร</span>
            </div>
            <div class="timeline-2 col">
              <img src="{{ $lazyModeDir }}/assets/frontend/images/tv-2-wait.gif" height="200" />
              <span class="timeline-date">1 พ.ค. 2560</span>
              <span class="timeline-sub">วันปิดรับสมัคร</span>
            </div>
            <div class="w-100 hidden-xs-down hidden-md-up"></div>
            <div class="timeline-3 col">
              <img src="{{ $lazyModeDir }}/assets/frontend/images/tv-3-wait.gif" height="200" />
              <span class="timeline-date">8 พ.ค. 2560</span>
              <span class="timeline-sub">ประกาศผลและโอนเงินยืนยันสิทธ์ (ตัวจริง)</span>
            </div>
            <div class="w-100 hidden-sm-down hidden-lg-up"></div>
            <div class="timeline-4 col">
              <img src="{{ $lazyModeDir }}/assets/frontend/images/tv-4-wait.gif" height="200" />
              <span class="timeline-date">19 พ.ค. 2560</span>
              <span class="timeline-sub">วันสุดท้ายของการยืนยันสิทธ์ (ตัวจริง)</span>
            </div>
            <div class="w-100 hidden-xs-down hidden-md-up"></div>
            <div class="timeline-5 col">
              <img src="{{ $lazyModeDir }}/assets/frontend/images/tv-5-wait.gif" height="200" />
              <span class="timeline-date">8-12 มิ.ย. 2560</span>
              <span class="timeline-sub force-fredoka">ITCAMP13 Day!</span>
            </div>
          </div>
        </div>
      </section>

      <!-- Gallery block -->
      <section class="section gallery-block" data-anchor="gallery-block">
        <div class="content">
          <h1 class="block-title">ภาพกิจกรรม</h1>
          <div class="wrapper">
            <div class="grid">
              <div class="grid-item col2x1">
                <img src="{{ $lazyModeDir }}/assets/frontend/images/1.jpg" />
              </div>
              <div class="grid-item col1x1">
                <img src="{{ $lazyModeDir }}/assets/frontend/images/2.jpg" />
              </div>
              <div class="grid-item col1x1">
                <img src="{{ $lazyModeDir }}/assets/frontend/images/3.jpg" />
              </div>
              <div class="grid-item col2x2">
                <img src="{{ $lazyModeDir }}/assets/frontend/images/4.jpg" />
              </div>
              <div class="grid-item col1x1">
                <img src="{{ $lazyModeDir }}/assets/frontend/images/5.jpg" />
              </div>
              <div class="grid-item col1x1">
                <img src="{{ $lazyModeDir }}/assets/frontend/images/6.jpg" />
              </div>
              <div class="grid-item col2x2">
                <img src="{{ $lazyModeDir }}/assets/frontend/images/7.jpg" />
              </div>
              <div class="grid-item col1x1">
                <img src="{{ $lazyModeDir }}/assets/frontend/images/8.jpg" />
              </div>
              <div class="grid-item col1x1">
                <img src="{{ $lazyModeDir }}/assets/frontend/images/9.jpg" />
              </div>
              <div class="grid-item col1x1">
                <img src="{{ $lazyModeDir }}/assets/frontend/images/10.jpg" />
              </div>
              <div class="grid-item col1x1">
                <img src="{{ $lazyModeDir }}/assets/frontend/images/11.jpg" />
              </div>
              <div class="grid-item col1x1">
                <img src="{{ $lazyModeDir }}/assets/frontend/images/12.jpg" />
              </div>
              <div class="grid-item col1x1">
                <img src="{{ $lazyModeDir }}/assets/frontend/images/13.jpg" />
              </div>
              <div class="grid-item col1x1 hidden-sm-down hidden-lg-up">
                <img src="{{ $lazyModeDir }}/assets/frontend/images/14.jpg" />
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Recommend block -->
      <section class="section recommend-block" data-anchor="recommend-block">
        <div class="content">
          <h1 class="block-title">คำนิยม</h1>
          <div class="recommend-list">

            <div class="recommend-group left">
              <div class="recommend-picture">
                <img />
                <div class="recommend-picture-frame"></div>
              </div>
              <p class="recommend-detail">
                ค่าย <b>"ไอทีแคมป์"</b> ค่ายไอทีที่เปิดโอกาสให้ น้อง ๆ ได้เข้ามาเรียนรู้ สัมผัสบรรยากาศและสถานที่ภายในรั้วมหาวิทยาลัย และที่สำคัญคือได้มาค้นหาอนาคต มีหลายคนที่ผ่านค่ายนี้ไปแล้วค้นพบว่าตนเองชื่นชอบด้านเทคโนโลยีขนาดไหน ชอบสถานที่นี้หรือไม่ นอกจากจะได้ความรู้ความสนุกสนานและค้นหาตนเองแล้ว ยังได้พบเจอกับเพื่อนและพี่ใหม่และเกิดเป็นมิตรภาพใหม่ที่ไม่สามารถหาที่ใดได้ <b>ขอฝากไอทีแคมป์ครั้งนี้ไว้ในใจของน้อง ๆ ด้วยนะครับ</b> <span class="br-0_5"></span>
                <b class="d-name">นายวิชวิทย์ นิลสวัสดิ์ (พี่แบงค์)</b> <br />
                ITCAMP 10 - ประธานค่าย <br />
                ITCAMP 9, 11, 12 - พี่ค่าย <br />
                ITCAMP 8 - น้องค่าย Network plus plus <br />
                ปัจจุบัน Project Engineer บริษัท Advanced Information Technology PCL <br />
                <span class="recommend-triangle"></span>
              </p>
            </div>

            <div class="recommend-group right">
              <p class="recommend-detail">
                <b>ไอทีแคมป์</b>คือค่ายที่เป็นจุดเริ่มต้นของความผูกพันธ์ที่พี่มีต่อคณะไอทีแห่งนี้ ทั้งสาระความรู้ที่ทำให้พี่ได้ค้นพบเส้นทางของตัวเองทางด้านเทคโนโลยี ซึ่งสำหรับใครที่มีพื้นฐานหรือชอบในด้านนี้อยู่แล้วก็จะได้มาพบเจอกับเพื่อนใหม่ ๆ ที่สนใจในด้านเดียวกัน แต่สำหรับใครที่ยังหาตัวเองไม่เจอว่าชอบอะไรก็มาลองค้นหาตัวเองจากค่ายนี้ได้เช่นกัน นอกจากสาระความรู้แล้วก็ยังมีความสนุกสนานจากกิจกรรมต่าง ๆ รวมถึงการดูแลเอาใจใส่จากจากพี่ๆ ภายในคณะที่จะทำให้น้องรู้สึกเหมือนเป็นส่วนหนึ่งของครอบครัวไอทีแห่งนี้เลย แล้วน้องจะรู้ว่า 4 วัน 3 คืนนี้มันคุ้มจริง ๆ จนไม่อยากกลับเลยล่ะ และนี่ก็คือความทรงจำของพี่กับค่ายนี้ที่อยากให้น้อง ๆ ได้ลองมาสัมผัสกันดู <b>แล้วน้องจะไม่มีทางลืมมันได้เล๊ยยยย! #เสียงสู๊งง</b> <span class="br-0_5"></span>
                <b class="d-name">นายธนวัฒน์ กุสูงเนิน (พี่อาร์มี่)</b> <br />
                ITCAMP 12 - ประธานค่าย <br />
                ITCAMP 11 - พี่ค่าย <br />
                ITCAMP 10 - น้องค่าย <br />
                <span class="recommend-triangle"></span>
              </p>
              <div class="recommend-picture">
                <img />
                <div class="recommend-picture-frame"></div>
              </div>
            </div>

            <div class="recommend-group left">
              <div class="recommend-picture">
                <img />
                <div class="recommend-picture-frame"></div>
              </div>
              <p class="recommend-detail">
                ช่วงมัธยมปลายนั้นถือว่าเป็นช่วงหัวเลี้ยวหัวต่อของชีวิต สำหรับน้อง ๆ คนไหนที่ยังไม่รู้ว่าจะเรียนสายไหน หรือว่าอยากสัมผัสประสบการณ์จริงค่าย <b>ITCAMP</b> นี้สามารถตอบโจทย์น้องสายคอมพิวเตอร์ได้เป็นอย่างดี ค่ายนี้ได้ทั้งความสนุก ความรู้ ให้น้อง ๆ ได้ค้นหาตัวเองและสัมผัสบรรยากาศคณะไอทีของเราจริง ๆ ตัวพี่เองก็ได้เค้าค่ายในช่วงมัธยมปลายมาหลายค่าย และค่ายนี้เป็นหนึ่งในค่ายที่ประทับใจที่สุดที่เคยเข้ามาเลยทีเดียว <b>ใครเป็นสายคอมพิวเตอร์พลาดไม่ได้เลยครับผม</b> <span class="br-0_5"></span>
                <b class="d-name">นายพัชรพล จอกสมุทร (พี่ฟิล์ม)</b> <br />
                ITCAMP 12 - พี่ค่าย <br />
                ITCAMP 10 - น้องค่าย <br />
                <span class="recommend-triangle"></span>
              </p>
            </div>

          </div>
        </div>
        <div class="line-dot"></div>
      </section>

      <!-- FAQ block -->
      <section class="section faq-block" data-anchor="faq-block">
        <div class="line-dot"></div>
        <div class="content">
          <h1 class="block-title">ถามตอบ</h1>
          <div class="faq-list">
            <div class="faq-group">
              <div class="faq-question">
                <div class="avatar hidden-sm-down"></div>
                <p>
                  Q: ค่ายนี้จัดขึ้นที่ไหน อย่างไร ?
                </p>
              </div>
              <div class="faq-answer">
                <p>
                  A: ค่ายนี้จัดที่คณะเทคโนโลยีสารสนเทศ สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง ตลอดระยะเวลา 5 วัน 4 คืน การเดินทางมายังคณะเทคโนโลยีสารสนเทศ สามารถดูได้ที่<a href="http://www.it.kmitl.ac.th/" target="_blank">เว็บไซต์ของคณะ</a>ได้เลยนะครับ
                </p>
                <div class="avatar hidden-sm-down"></div>
              </div>
            </div>
            <div class="faq-group">
              <div class="faq-question">
                <div class="avatar hidden-sm-down"></div>
                <p>
                  Q: มีค่าใช้จ่ายหรือไม่ จำนวนเท่าไหร่ และชำระตอนไหน สละสิทธิ์ได้เงินคืนหรือไม่ ?
                </p>
              </div>
              <div class="faq-answer">
                <p>
                  A: มีค่าใช้จ่าย จำนวน 200 บาท โดยชำระตามเวลาที่กำหนด (8 - 19 พฤษภาคม 2560) หากน้องคนใดจะสละสิทธิ์ สามารถกดปุ่มสละสิทธิ์ที่หน้าเว็บและขอให้น้องๆ คิดให้รอบคอบก่อนจะชำระเงิน เพราะหากน้องสละสิทธิ์จะไม่ได้รับเงินคืนครับ และหากโอนเงินไม่ทันภายในวันที่กำหนดจะถือว่าสละสิทธิ์นะครับ
                </p>
                <div class="avatar hidden-sm-down"></div>
              </div>
            </div>
            <div class="faq-group">
              <div class="faq-question">
                <div class="avatar hidden-sm-down"></div>
                <p>
                  Q: ต้องพักค้างคืนที่ค่ายหรือเปล่า ?
                </p>
              </div>
              <div class="faq-answer">
                <p>
                  A: ใช่ครับ น้องๆ จะได้นอนพักในห้องพักที่พี่ๆ จัดเตรียมไว้ให้ที่คณะ ซึ่งติดแอร์เย็นฉ่ำ สะดวกสบาย ง่ายต่อการทำกิจกรรมของน้องๆ และที่สำคัญพี่ๆ จะดูแลน้องได้ตลอด 24 ชั่วโมงตลอดโครงการ น้องๆ สบายใจได้ครับ และน้องๆ จะไม่ได้รับอนุญาตให้ออกจากบริเวณที่จัดกิจกรรม ยกเว้นในกรณีที่ติดธุระเร่งด่วน และมีผู้ปกครองมารับด้วยตนเองครับ
                </p>
                <div class="avatar hidden-sm-down"></div>
              </div>
            </div>
            <div class="faq-group">
              <div class="faq-question">
                <div class="avatar hidden-sm-down"></div>
                <p>
                  Q: สมัครมากกว่าหนึ่งค่ายย่อยหรือเปลี่ยนไปอยู่ค่ายอื่นได้หรือไม่ ?
                </p>
              </div>
              <div class="faq-answer">
                <p>
                  A: ไม่สามารถสมัครได้ครับ ดังนั้นน้องๆ ควรจะตัดสินใจให้ชัดเจนว่าจะสมัครค่ายไหน เพราะช่วงที่มีการเรียนการสอน แต่ละค่ายจะจัดการเรียนการสอนแยกกันอย่างชัดเจน
                </p>
                <div class="avatar hidden-sm-down"></div>
              </div>
            </div>
            <div class="faq-group">
              <div class="faq-question">
                <div class="avatar hidden-sm-down"></div>
                <p>
                  Q: จำเป็นต้องมีความรู้มาก่อนหรือไม่ ?
                </p>
              </div>
              <div class="faq-answer">
                <p>
                  A: ไม่จำเป็นครับ ขอแค่เพียงน้องๆ มีความสนใจและใฝ่รู้ก็พอครับ ที่เหลือพี่ๆ จะเป็นคนช่วยสอนน้องๆ เอง
                </p>
                <div class="avatar hidden-sm-down"></div>
              </div>
            </div>
            <div class="faq-group">
              <div class="faq-question">
                <div class="avatar hidden-sm-down"></div>
                <p>
                  Q: ค่ายรับระดับชั้นไหนบ้าง ปวช. สามารถสมัครได้หรือเปล่า ?
                </p>
              </div>
              <div class="faq-answer">
                <p>
                  A: ค่ายนี้จะรับเฉพาะน้องๆ ที่กำลังศึกษาอยู่ระดับชั้นมัธยมศึกษาตอนปลาย ทุกแผนการเรียน และปวช. เท่านั้นครับ
                </p>
                <div class="avatar hidden-sm-down"></div>
              </div>
            </div>
            <div class="faq-group">
              <div class="faq-question">
                <div class="avatar hidden-sm-down"></div>
                <p>
                  Q: ค่าย IoT คืออะไร ?
                </p>
              </div>
              <div class="faq-answer">
                <p>
                  A: IoT (Internet of things) คือเทคโนโลยีที่เชื่อมทุกสิ่งทุกอย่างเข้าด้วยกันบนโลกอินเทอร์เน็ต ทำให้มนุษย์สามารถสั่งการ ควบคุมใช้งาน อุปกรณ์ต่างๆ ผ่านทางเครือข่ายอินเทอร์เน็ตได้ เช่น หากเราอยู่นอกบ้านแล้วอยากต้มน้ำร้อน  เราก็สามารถสั่งให้กาต้มน้ำเพิ่มอุณหภูมิผ่านโทรศัพท์มือถือเพื่อทำให้น้ำเดือดได้ โดยในค่าย IoT น้องๆ จะได้ลองเขียนโปรแกรมควบคุมอุปกรณ์เหล่านี้อีกด้วย
                </p>
                <div class="avatar hidden-sm-down"></div>
              </div>
            </div>
            <div class="faq-group">
              <div class="faq-question">
                <div class="avatar hidden-sm-down"></div>
                <p>
                  Q: ค่าย Data Science คืออะไร
                </p>
              </div>
              <div class="faq-answer">
                <p>
                  A: Data Science (วิทยาศาสตร์ข้อมูล) เกี่ยวข้องกับการค้นหาความรู้ที่ซ่อนอยู่ในข้อมูลหลายแหล่งที่มา ทั้งจากระบบคอมพิวเตอร์ในองค์กรและอินเทอร์เน็ต โดยใช้สถิติ อัลกอริทึม และสมการทางคณิตศาสตร์ต่างๆ เพื่อสกัดข้อมูลเหล่านั้น เช่น การตรวจสภาพการจราจรของแผนที่กูเกิ้ล จะนำพิกัดจาก GPS ของสมาร์ทโฟนของเรา มาคำนวณว่ารถสามารถเคลื่อนที่ด้วยความเร็วเท่าไหร่ ทิศทางไหน และในค่ายนี้น้องๆ จะได้ทดลองนำข้อมูลจากโลกจริงมาวิเคราะห์หาความรู้ที่ซ่อนอยู่ ซึ่งใครจะรู้ความรู้ที่น้องๆ ค้นพบในค่ายนี้อาจจะเปลี่ยนโลกของเราไปเลยก็ได้
                </p>
                <div class="avatar hidden-sm-down"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="content-contact">
          <h1 class="block-title">ติดต่อเรา</h1>
          <div class="wrapper">
            <div class="row contact-detail">
              <div class="contact-left col-12 col-lg-6">
                <ul class="force-fredoka">
                  <li><a href="https://www.facebook.com/itcampKMITL" target="_blank"><span class="box facebook"><i class="fa fa-facebook" aria-hidden="true"></i> fb.com/itcampKMITL</span></a></li>
                  <li><a href="https://twitter.com/ITCAMP" target="_blank"><span class="box twitter"><i class="fa fa-twitter" aria-hidden="true"></i> @ITCAMP</span></a></li>
                  <li><a href="mailto:itcamp.it.kmitl@gmail.com" target="_blank"><span class="box email"><i class="fa fa-envelope" aria-hidden="true"></i> itcamp.it.kmitl@gmail.com</span></a></li>
                </ul>
              </div>
              <div class="contact-right col-12 col-lg-6">

              </div>
            </div>
            <div class="row sharing-link">
              <div class="col-12">
                <h3 class="block-title">ร่วมประชาสัมพันธ์กับเรา</h3>
                <a href="javscript:;" class="btn btn-sharing-link disabled">เร็วๆนี้</a>
              </div>
            </div>
          </div>
        </div>
      </section>

    </section>

    <script type="text/javascript" src="assets/frontend/js/app.js?v={{ (int)microtime(true) }}"></script>
  </body>
</html>
