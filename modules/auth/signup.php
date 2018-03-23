<!DOCTYPE html>
<?php
$ref = $this->_DATA['Referal'];
?>
<html lang='en'>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content='width=device-width, initial-scale=1'>
        <meta name='description' content=''>
        <meta name='author' content=''>
        <link href='<?php echo WWW_CSS_PATH; ?>bootstrap.min.css' rel='stylesheet'>

        <!-- Custom CSS -->
        <link href='<?php echo WWW_CSS_PATH; ?>sb-admin.css' rel='stylesheet'>

        <!-- Custom Fonts -->
        <link href='<?php echo WWW_CSS_PATH; ?>font-awesome.css' rel='stylesheet' type='text/css'>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js'></script>
            <script src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js'></script>
        <![endif]-->
        <title>Регистрация партнёров</title>

	<style>
	    .form-title,
	    .form-sub-title{
		font-size:20px;
		font-family:"Lucida Grande",Tahoma,Verdana,Arial,sans-serif;
		font-size:20px;
		font-weight:bold;
	    }
	    .form-sub-title{
		font-weight:normal;
		padding:6px 0 15px 0;
	    }
	    #loading{
		left:10px;
		position:relative;
		top:3px;
		visibility:hidden;
	    }
	    .procmessage{
		background: none repeat scroll 0 0 #FFFFCC;
		border: 1px solid #CC9933;
		margin-left: 30px;
		padding: 3px;
		width: auto;
	    }
	    .goodmessage {
		background: none repeat scroll 0 0 #C9FFCA;
		border: 1px solid #349534;
		color: #008000;
		font-weight: bold;
		margin-left: 30px;
		padding: 3px;
		width: auto;
	    }
	    .badmessage {
		background: none repeat scroll 0 0 #F7CBCA;
		border: 1px solid #CC0000;
		color: #CC0000;
		font-weight: bold;
		margin-left: 30px;
		padding: 3px;
		width: auto;
	    }

	</style>
    </head>
    <body>
	<script type="text/javascript" src='//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js'></script>
	<script language="javascript">
            $(document).ready(function ()
            {
               $("#login").on('keyup',function(e){
                    $("#msgbox").removeClass().addClass('procmessage').text('Проверка...').fadeIn("slow");
                    $.post("<?php echo WWW_BASE_PATH; ?>user_availability", {login: $(this).val()}, function (data)
                    {
                        if (parseInt(data) == 1)
                        {
                            $("#msgbox").fadeTo(200, 0.1, function ()
                            {
                                $(this).html('Логин свободен').addClass('goodmessage').fadeTo(900, 1);
                            });
                        }
                        else
                        {
                            $("#msgbox").fadeTo(200, 0.1, function ()
                            {
                                $(this).html('Логин занят').addClass('badmessage').fadeTo(900, 1);
                            });

                        }

                    });

                });
            });

$().ready(function() {
        $('.abs').click(function() {
            var supa =$("input:checkbox:checked").push(); 
	    if(supa==2){
	$("#button1id").removeClass('disabled');
	    }else{
		$("#button1id").removeClass('disabled');
		$("#button1id").addClass('disabled');
	    }
        });
});
	</script>
	<div class='row'>
	    <div class='col-sm-6 col-md-6 col-md-offset-3'>
		<div class='panel panel-default center-block'>
		    <div class='panel-heading'><img src="https://finansicalservice.com/img/logo_1.png" style="height: 32px; display: inline-block;">
			<strong>Регистрация в системе </strong><?php if(!empty($ref)): echo 'ваш спонсор - '.$ref; endif;?>
		    </div>
		    <div class='panel-body '>
			
		    <form id="regForm" action="<?php echo WWW_BASE_PATH; ?>auth/reg" method="post" class="form-horizontal" data-toggle="validator">
			<fieldset>
			    <div class="form-control-link col-md-12 text-center"><i class=""><a href="" data-toggle="modal" data-target="#myModal">Условия публичной оферты</a></i></div>
			<div id="msgbox">
			    &nbsp;
			</div>
			<div class="form-group">
			    <label class="col-md-4 control-label" for="login">Логин *</label>  
			    <div class="col-md-4">
				<input id="login" name="login" placeholder="your login" class="form-control input-md" type="text" required>
				<div id="msgbox"></div>
			    </div>
			</div>
			<div class="form-group">
			    <label class="col-md-4 control-label" for="mail">E-mail *</label>  
			    <div class="col-md-4">
				<input id="mail" name="mail" placeholder="your mail" class="form-control input-md" type="email"  pattern='[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$' required>
			    </div>
			</div>

			<div class="form-group">
			    <label class="col-md-4 control-label" for="fname">Имя *</label>  
			    <div class="col-md-4">
				<input id="textinput" name="fname" placeholder="Имя" class="form-control input-md" type="text" required>

			    </div>
			</div>
			<div class="form-group">
			    <label class="col-md-4 control-label" for="lname">Фамилия</label>  
			    <div class="col-md-4">
				<input id="textinput" name="lname" placeholder="Фамилия" class="form-control input-md" type="text">

			    </div>
			</div>
			<div class="form-group">
			    <label class="col-md-4 control-label" for="inputPassword">Пароль *</label>  
			    <div class="col-md-4">
				<input id="inputPassword" type="password" name="pass" class="form-control input-md" data-minlength="5">

			    </div>
			</div>
			<div class="form-group">
			    <label class="col-md-4 control-label" for="pass" >Повтор Пароля *</label>  
			    <div class="col-md-4">
				<input id="passConfirm" type="password" class="form-control input-md" data-match="#inputPassword" data-match-error="пароли не совпадают">
				 <div class="help-block with-errors"></div>
			    </div>
			</div>
			<div class="form-group">
  <label class="col-md-4 control-label" for="checkboxes"></label>
  <div class="col-md-4">
  <div class="checkbox">
    <label for="checkboxes-0">
      <input name="checkboxes" id="checkboxes-0" class="abs" value="1" type="checkbox">
      Я принимаю условия публичной оферты *
    </label>
	</div>
  <div class="checkbox">
    <label for="checkboxes-1">
      <input name="checkboxes" id="checkboxes-1" class="abs" value="2" type="checkbox">
       Я согласен получать новости и предложения от компании. *
    </label>
	</div>
  </div>
</div>    


			    <div class="msgbox"></div>
			<div class="form-group">
			    <div class="col-md-4"></div>
			    <div class="col-md-8"><!--div class="g-recaptcha" data-sitekey="6Lc9ByAUAAAAAKOlFnpa91fVuvltXVZYkBUVBOVD"></div--></div>
			    <label class="col-md-4 control-label" for="button1id"></label>
			    <div class="col-md-8">
				<a class="btn btn-info" href="<?php echo WWW_BASE_PATH ?>">Вернуться на сайт</a>
				<button id="button1id" name="button1id" type="submit" class="btn btn-primary disabled">Зарегистрироваться</button>
			    </div>
			</div>
			    
</fieldset>
		    </form>
		</div>
	    </div>
	</div>
	</div>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                 <h4 class="modal-title">FinansicalService: Условия публичной оферты</h4>
            </div>
		    <div class="modal-body">
			<div class="form-group te">
			     <textarea class="form-control" rows="20">Любое физическое или юридическое лицо из любой страны может открыть счет с нами. Вы должны быть не моложе 18 лет, чтобы использовать этот сайт. 
Каждый инвестор может зарегистрировать только один личный счет, перерегистрация не допускается. В случае множественных регистраций, Компания оставляет за собой право заблокировать все счета до выяснения обстоятельств. 
Вы должны зарегистрироваться в качестве члена, чтобы получить доступ к определенным функциям сайта. Вы обязаны предоставлять только полную и точную информацию о себе ( "Регистрационные данные") при регистрации в качестве члена или обновлении ваши регистрационные данные. 
Вы согласны с тем, чтобы сохранить и сохранить текущие данные регистрации и обновлять регистрационные данные, как только она меняется. Вы несете ответственность за обеспечение безопасности своего пароля. Наша компания и ее поставщики услуг не несут ответственности за любые убытки, которые вы можете понести за счет использования вашего пароля другими. 
Каждый депозит считается частной сделке между finansicalservice.com и ее членом. Члены выполнять все финансовые операции исключительно по своему усмотрению и свой страх и риск. Инвестор лично решает, следует ли инвестировать и сколько инвестировать. Все начисления на лицевой счет производятся в соответствии с выбранным инвестиционного пакета. Инвестор имеет право свободно распоряжаться средствами, которые находятся на его личном счете. Инвестор может сделать депозит только с помощью электронных платежных систем, используемых Компанией. 
Вы можете использовать и передавать любые ссылки на любую страницу этого сайта. Вы должны использовать свою уникальную ссылку для приглашений принять участие в партнерской программе. Вы можете публично поделиться своей реферальной ссылке в подписи на специализированных форумах инвесторов или на страницах собственного сайта или блога. Вы также можете отправить его своим друзьям, родственникам или коллегам, чтобы зарегистрировать их в проекте. У нас нет никаких ограничений на использование реферальной ссылке, кроме массовой рассылки людей, неизвестных вам (также известный как спам). Пожалуйста, следуйте этому правилу, чтобы избежать каких-либо проблем, связанных с блокировкой Вашего лицевого счета. 
Вы можете найти информацию о нашей компании на различных мониторинга веб-сайтов, форумов, блогов и т.д. Мы не отслеживать информацию, опубликованную таких веб-сайтов. Мнения или материалы, предоставляемые такими веб-сайтов могут отличаться от мнений и материалов, опубликованных на этом сайте, и не одобрены или совместно руководством нашей компании. Наша компания не несет ответственности за политику конфиденциальности и других правил, используемых сторонних сайтов. Мы не несем ответственности за любые потери или повреждения или раскрытия ваших личных данных в результате использования сторонних веб-сайтов. 
Наш сайт использует куки-файлы. Куки представляет собой файл, содержащий идентификатор (строка из букв и цифр), который посылается веб-сервером на веб-браузер и хранится браузером. Идентификатор затем отправляется обратно на сервер каждый раз, когда браузер запрашивает страницу с сервера. Файлы cookie могут быть либо "стойкими" печенье или "сессии" печенье. Стойкие печенье будет храниться с помощью веб-браузера и будет оставаться в силе до его установленного срока годности, если они не удалены пользователем до истечения срока действия; сессионные куки, с другой стороны, истекает в конце сеанса пользователя, когда веб-браузер закрыт. Файлы cookie не содержат никакой информации, которая лично идентифицирует пользователя и абсолютно безвредны. 

Информация, представленная членом является важной частью наших отношений с каждым нашим клиентом. Мы хотим, чтобы вы знали, как мы используем вашу личную информацию.
Мы относимся к вашей личной информации, такой как ваш адрес электронной почты и электронного кошелька, конфиденциальной. Мы делаем все возможное, чтобы защитить эти данные от тех, кто не уполномочен получить к нему доступ. Мы не продаем эту информацию кому-либо. Мы гарантируем, что мы и будем держать все операции, связанные с вашего членства с finansicalservice.com  строго конфиденциальной и принимать все разумные меры для защиты вашей информации. В процессе предоставления наших финансовых услуг и продуктов для вас мы можем собирать определенную непубличную информацию о вас. В соответствии с нашей политикой, мы держим эту информацию строго конфиденциальной и защищена, и мы не будем использовать эту информацию для других целей, чем предоставление наших услуг или раскрывать эту информацию кому-либо, если иное не предусмотрено законом. Защита вашей приватности важна для нас. У нас есть процедуры, которые мы считаем разумно предназначены для защиты безопасности и конфиденциальности вашей информации. К ним относятся соглашения о конфиденциальности с компаниями, мы нанимаем, чтобы помочь нам предоставлять вам услуги, защищенный паролем доступ пользователей к нашим компьютерным файлам и строгой политики конфиденциальности, которые применяются ко всему персоналу finansicalservice.com
Компания обязуется не разглашать какую-либо личную информацию инвестора третьим лицам. Мы действуем в соответствии с политикой полной конфиденциальности. Никакой информации о вас, в том числе персональные данные, информацию об операциях и доходов никому, кроме вас, не доступны. Ваша информация может быть использована только уполномоченными работниками Общества в случае необходимости. Инвестор имеет право принимать любое имя за исключением нецензурного или вульгарного. Мы гарантируем конфиденциальность всех сделок, вытекающих из вашего членства с Компанией в любое время.
Мы ценим имя нашей компании и во избежание любого конфликта, строго относимся к использованию нашего домена и любой другой информации взятой с нашего сайта сторонними лицами. Мы постоянно работаем над улучшением сайта и будем стараться соответствовать нашему статусу.
Мы оставляем за собой право изменять правила, комиссий и темпы программы в любое время и по собственному усмотрению без предварительного уведомления, особенно в целях соблюдения целостности и безопасности интересов членов. Вы согласны с тем , что это ваша личная ответственность рассматривать текущие условия. 
finansicalservice.com не несет ответственности за любые убытки, потери и расходы , возникшие в результате нарушения условий и сроков  или использования нашего сайта членом. Вы гарантируете, что вы не будете использовать этот сайт в любом незаконным путем , и Вы соглашаетесь уважать ваши местные, национальные и международные законы. 
Не оставлять плохой голос на общественных форумах и на Gold Рейтинг сайта без связи с администратором нашей программы. Может быть , там была техническая проблема с вашей сделки, поэтому , пожалуйста , всегда согласовывайтесь  с администратором. 
Мы не будем терпеть СПАМ или любой тип UCE в этой программе. СПАМ нарушители будут немедленно и окончательно удалены из программы. 
finansicalservice.com оставляет за собой право принять или отклонить любого члена на членство без объяснения причин. 

Если вы не согласны с выше сказанной информацией-регистрируйтесь!

Спасибо за внимание, с уважением команда finansicalservice.com
</textarea>
		
			</div>
		    </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

	<canvas id="flying-bubbles" style=" position: absolute; top: 0px; z-index:-1;"></canvas>
	
	<script>

            window.onload = function () {
                //Создаем сам фон и его функции
                var canvas = document.getElementById("flying-bubbles");
                var ctx = canvas.getContext("2d");
                //Установим размеры фона равны размеру окна
                var W = window.innerWidth, H = window.innerHeight;
                canvas.width = W;
                canvas.height = H;
                //Создаем массив кругов
                var circles = [];
                for (var i = 0; i < 20; i++) {
                    circles.push(new create_circle());
                }
                //Функции для создания кругов с различными положениями и скоростями
                function create_circle() {
                    //Случайная позиция
                    this.x = Math.random() * W;
                    this.y = Math.random() * H;
                    //Случайная скорость
                    this.vx = 0.1 + Math.random() * 1;
                    this.vy = -this.vx;
                    //Случайный радиус
                    this.r = 10 + Math.random() * 50;
                }
                //Функции для прорисовки фона
                function draw() {
                    //Create the gradient
                    var grad = ctx.createLinearGradient(0, 0, W, H);
                    grad.addColorStop(0, 'rgb(19, 105, 168)');
                    grad.addColorStop(1, 'rgb(0, 0, 0)');
                    //Заполняем фон градиентом
                    ctx.globalCompositeOperation = "source-over";
                    ctx.fillStyle = grad;
                    ctx.fillRect(0, 0, W, H);
                    //Заполняем фон кругами
                    for (var j = 0; j < circles.length; j++) {
                        var c = circles[j];
                        //Рисуем круги и размытие
                        ctx.beginPath();
                        ctx.globalCompositeOperation = "lighter";
                        ctx.fillStyle = grad;
                        ctx.arc(c.x, c.y, c.r, Math.PI * 2, false);
                        ctx.fill();
                        //Используем скорость
                        c.x += c.vx;
                        c.y += c.vy;
                        //Для предотвращения перемещения кругов за рамки
                        if (c.x < -50)
                            c.x = W + 50;
                        if (c.y < -50)
                            c.y = H + 50;
                        if (c.x > W + 50)
                            c.x = -50;
                        if (c.y > H + 50)
                            c.y = -50;
                    }
                }
                setInterval(draw, 25);
            }


	</script>
	<script src='https://www.google.com/recaptcha/api.js?hl=ru'></script>
	<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
        <script src="<?php echo WWW_JS_PATH;?>bootstrap.min.js"></script>
	<script src='<?php echo WWW_JS_PATH?>validator.js'></script>
    </body>
</html>