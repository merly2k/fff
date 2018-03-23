<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.

$context='
      <section class="mbr-section article mbr-parallax-background" id="msg-box8-6" style="background-image: none; padding-top: 120px; padding-bottom: 120px; position: relative; background-attachment: scroll; background-size: auto auto;" data-jarallax-original-styles="background-image: url(&quot;../../img/uzbg2.jpg&quot;); padding-top: 120px; padding-bottom: 120px; position: relative;">
    <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(34, 34, 34);"> </div>
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2 text-xs-center">
<h3 class="header-blue">    Представляем вашему вниманию небольшой обзор продуктов, поставками которых наша компания обеспечивает свою доходность</h3>        </div>
      </div>
    </div>
    <div style="position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -100;" id="jarallax-container-0">
      <div style="background-position: 50% 50%; background-size: 100% auto; background-repeat: no-repeat no-repeat; background-image: url(&quot;../../img/uzbg2.jpg&quot;); position: fixed; top: 0px; left: 0px; width: 1583px; height: 1081.98px; overflow: hidden; pointer-events: none; margin-left: 0px; margin-top: -140.49px; visibility: visible; transform: translate3d(0px, -137.255px, 0px);"></div>
    </div>

<div class="container" style="z-index:1000;">
  <div class="row">
    <div class="col-md-12">
      <div class="carousel slide media-carousel" id="media">
        <div class="carousel-inner">
          <div class="item  active">
            <div class="row">
              <div class="col-md-4">
                <a class="thumbnail" href="#"><img src="../../img/production/2.jpg" class="img-responsive center-block"></a>
              </div>          
              <div class="col-md-4">
                <a class="thumbnail" href="#"><img src="../../img/production/3.jpg" class="img-responsive center-block"></a>
              </div>
              <div class="col-md-4">
                <a class="thumbnail" href="#"><img src="../../img/production/4.jpg" class="img-responsive center-block"></a>
              </div>        
            </div>
          </div>
          <div class="item">
            <div class="row">
              <div class="col-md-4">
                <a class="thumbnail" href="#"><img src="../../img/production/5.jpg" class="img-responsive center-block"></a>
              </div>          
              <div class="col-md-4">
                <a class="thumbnail" href="#"><img src="../../img/production/6.jpg" class="img-responsive center-block"></a>
              </div>
              <div class="col-md-4">
                <a class="thumbnail" href="#"><img src="../../img/production/7.jpg" class="img-responsive center-block"></a>
              </div>        
            </div>
          </div>
          <div class="item">
            <div class="row">
              <div class="col-md-4">
                <a class="thumbnail" href="#"><img src="../../img/production/8.jpg" class="img-responsive center-block"></a>
              </div>          
              <div class="col-md-4">
                <a class="thumbnail" href="#"><img src="../../img/production/9.jpg" class="img-responsive center-block"></a>
              </div>
              <div class="col-md-4">
                <a class="thumbnail" href="#"><img src="../../img/production/10.jpg" class="img-responsive center-block"></a>
              </div>      
            </div>
          </div>
          
        </div>
        <a data-slide="prev" href="#media" class="left carousel-control">‹</a>
        <a data-slide="next" href="#media" class="right carousel-control">›</a>
      </div>                          
    </div>
  </div>
</div>
  </section>
';*/

$context='<style>
    @import url(http://fonts.googleapis.com/css?family=Anaheim);

*{  margin: 0;  padding: 0;  outline: none;  border: none;    box-sizing: border-box;}
*:before,*:after{    box-sizing: border-box;}
html,body{ min-height: 100%;}
body{	background-image: radial-gradient(mintcream 0%, #F8FCFF 100%);}
h1{	display: table;	margin: 5% auto 0;	text-transform: uppercase;	font-family: "Anaheim", sans-serif;
	font-size: 4em;	font-weight: 400;	text-shadow: 0 1px white, 0 2px blue;}
.container{	margin: 4% auto;	width: 210px;	height: 140px;
	position: relative;	perspective: 1000px;}
#carousel{width: 100%;	height: 100%; 	position: absolute;	transform-style: preserve-3d;	animation: rotation 20s infinite linear;}
#carousel:hover{	animation-play-state: paused;}
#carousel figure{ display: block; position: absolute;width: 90%;height: 50%px;left: 10px;top: 10px; background: #2582C4;overflow: hidden; border: solid 5px #2582C4;}
#carousel figure:nth-child(1){transform: rotateY(0deg) translateZ(288px);}
#carousel figure:nth-child(2) { transform: rotateY(40deg) translateZ(288px);}
#carousel figure:nth-child(3) { transform: rotateY(80deg) translateZ(288px);}
#carousel figure:nth-child(4) { transform: rotateY(120deg) translateZ(288px);}
#carousel figure:nth-child(5) { transform: rotateY(160deg) translateZ(288px);}
#carousel figure:nth-child(6) { transform: rotateY(200deg) translateZ(288px);}
#carousel figure:nth-child(7) { transform: rotateY(240deg) translateZ(288px);}
#carousel figure:nth-child(8) { transform: rotateY(280deg) translateZ(288px);}
#carousel figure:nth-child(9) { transform: rotateY(320deg) translateZ(288px);}

img{ 	-webkit-filter: grayscale(1);	cursor: pointer; transition: all .5s ease;}
img:hover{	-webkit-filter: grayscale(0);  transform: scale(1.2,1.2);}
@keyframes rotation{
from{transform: rotateY(0deg);}
to{transform: rotateY(360deg);}
}
    </style>
<section class="mbr-parallax-background" id="msg-box8-6" style="background-image: none; padding-top: 120px; padding-bottom: 120px; position: relative; background-attachment: scroll; background-size: auto auto;" data-jarallax-original-styles="background-image: url(&quot;../../img/uzbg2.jpg&quot;); padding-top: 120px; padding-bottom: 120px; position: relative;z-index:-10">
    <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(34, 34, 34);"> </div>
<div class="row">
    <div class="col-md-8 col-md-offset-2 text-xs-center">
	<h3 class="header-blue" style="
    margin-bottom: 5%;
    -webkit-text-fill-color: #2900ff; /* цвет текста для webkit */  3
    -webkit-text-stroke: 1px black;
    -webkit-text-stroke: 1px white;
    font-weight: 900;
">    Представляем вашему вниманию небольшой обзор продуктов, поставками которых наша компания обеспечивает свою доходность</h3>
    </div>
</div>
<div style="position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -100;" id="jarallax-container-0">
    <div style="background-position: 50% 50%; background-size: 100% auto; background-repeat: no-repeat no-repeat; background-image: url(&quot;../../img/uzbg2.jpg&quot;); position: fixed; top: 0px; left: 0px; width: 1583px; height: 1081.98px; overflow: hidden; pointer-events: none; margin-left: 0px; margin-top: -140.49px; visibility: visible; transform: translate3d(0px, -137.255px, 0px);"></div>
</div>

<style>
.col-md-3 {float:left;     width: 25%;}
</style>
<div class="tab-content">
	<div class="news-sborka">
		<div class="col-md-3 col-sm-4 col-xs-6 catalog">
<img alt="Xiaomi" src="https://hk-digital.com/assets/cache/images/Catalog/Plansheti/300x280-xiaomi.112.jpg" title="Xiaomi">
			<h3>Xiaomi</h3>
		</div>
		<div class="col-md-3 col-sm-4 col-xs-6 catalog">
<img alt="Cube" src="https://hk-digital.com/assets/cache/images/Catalog/Plansheti/300x280-cube.112.jpg" title="Cube">
			<h3>Cube</h3>
		</div>
		<div class="col-md-3 col-sm-4 col-xs-6 catalog">
 <img alt="Ainol" src="https://hk-digital.com/assets/cache/images/Catalog/Plansheti/300x280-ainol.112.jpg" title="Ainol">
			<h3>Ainol</h3>
		</div>
		<div class="col-md-3 col-sm-4 col-xs-6 catalog">
<img alt="Ramos" src="https://hk-digital.com/assets/cache/images/Catalog/Plansheti/300x280-ramos.112.jpg" title="Ramos">
			<h3>Ramos</h3>
		</div>
		<div class="col-md-3 col-sm-4 col-xs-6 catalog">
 <img alt="Chuwi" src="https://hk-digital.com/assets/cache/images/Catalog/Plansheti/300x280-chuwi.112.jpg" title="Chuwi">
			<h3>Chuwi</h3>
		</div>
		<div class="col-md-3 col-sm-4 col-xs-6 catalog">
 <img alt="Pipo" src="https://hk-digital.com/assets/cache/images/Catalog/Plansheti/300x280-pipo.112.jpg" title="Pipo">
			<h3>Pipo</h3>
		</div>
		<div class="col-md-3 col-sm-4 col-xs-6 catalog">
<img alt="Vido" src="https://hk-digital.com/assets/cache/images/Catalog/Plansheti/300x280-vido.112.jpg" title="Vido">
			<h3>Vido</h3>
		</div>
		<div class="col-md-3 col-sm-4 col-xs-6 catalog">
 <img alt="Sanei" src="https://hk-digital.com/assets/cache/images/Catalog/Plansheti/300x280-sanei.112.jpg" title="Sanei">
			<h3>Sanei</h3>
		</div>
		<div class="col-md-3 col-sm-4 col-xs-6 catalog">
 <img alt="Lenovo" src="https://hk-digital.com/assets/cache/images/Catalog/Plansheti/300x280-lenovo.112.jpg" title="Lenovo">
			<h3>Lenovo</h3>
		</div>
		<div class="col-md-3 col-sm-4 col-xs-6 catalog">
 <img alt="Teclast" src="https://hk-digital.com/assets/cache/images/Catalog/Plansheti/300x280-teclast.112.jpg" title="Teclast">
			<h3>Teclast</h3>
		</div>
		<div class="col-md-3 col-sm-4 col-xs-6 catalog">
<img alt="Huawei" src="https://hk-digital.com/assets/cache/images/Catalog/Plansheti/300x280-huawei.112.jpg" title="Huawei">
			<h3>Huawei</h3>
		</div>
		<div class="col-md-3 col-sm-4 col-xs-6 catalog">
<img alt="Asus" src="https://hk-digital.com/assets/cache/images/Catalog/Plansheti/300x280-asus.112.jpg" title="Asus">
			<h3>Asus</h3>
		</div>
	</div>
	<div class="clearfix">
	</div>

</div>
<br>
	</section>
	

';
$template="blog";

include TEMPLATE_DIR.$template.".html";

