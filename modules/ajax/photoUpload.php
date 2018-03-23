<html>
<link rel="stylesheet" href="<?php echo WWW_CSS_PATH?>hero/css.css">
<link id="mainstyle" rel="stylesheet" href="<?php echo WWW_CSS_PATH?>hero/demo.css">
        <link id="mainstyle" rel="stylesheet" href="<?php echo WWW_CSS_PATH?>hero/theme-libs-plugins.css">
        <!-- Demo only-->
        <link id="mainstyle" rel="stylesheet" href="<?php echo WWW_CSS_PATH?>hero/demo.css">
        <link href="<?php echo WWW_BASE_PATH;?>css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo WWW_BASE_PATH;?>css/bootstrap-editable.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo WWW_JS_PATH?>hero/modernizr-custom.js"></script>
        <script src="<?php echo WWW_JS_PATH?>hero/respond.js"></script>
        <link rel="stylesheet" href="<?php echo WWW_CSS_PATH;?>blosker.css">
        <link rel="stylesheet" href="<?php echo WWW_BASE_PATH;?>css/dashboard1.css">
        <link id="mainstyle" rel="stylesheet" href="<?php echo WWW_CSS_PATH?>hero/skin.css">

<link href="<?php echo WWW_CSS_PATH ?>jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>

<div class="card">
<div class="card-title">
    <h4>Загрузка фотографии пользователя</h4>
</div>
<div class="card-block">
    <div class="row">
        <form enctype="multipart/form-data" method="POST" action="<?php echo WWW_BASE_PATH; ?>ajax/savephoto">
            <div class="col-sm-6">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-preview thumbnail img-circle" data-trigger="fileinput" style="width: 150px; height: 150px;"></div>
                    <div>
                        <span class="btn btn-default btn-file">
                            <span class="fileinput-new">Выбрать</span>
                            <span class="fileinput-exists">Сменить</span>
                            <input type="file" name="load"></span>
                      
                        <input type="hidden" name="userId" value="<?php echo $this->param[0]; ?>">
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <p>Выберите файл для загрузки и нажмите кнопку "загрузить". Если вы выбрали не тот файл, нажмите кнопку "сменить" и выберите другой файл.<hr>Будте внимательны! поддерживается загрузка только PNG, GIF, JPG форматов</p>
                <span class="btn btn-default" data-dismiss="modal" aria-hidden="true">отменить</span>
                <button class="btn btn-default fileinput-exists" type="submit" value="submit">Загрузить</button>
            </div>
        </form>
    </div>
</div>
</div>
 <script src="<?php echo WWW_JS_PATH?>jquery.min.js"></script>
 <script src="<?php echo WWW_JS_PATH; ?>jasny-bootstrap.js" type="text/javascript"></script>
</html>