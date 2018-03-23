<?php

/*
 * этот файл распространяется на условиях коммерческой лицензии
 * по вопросам приобретения кода обращайтесь merly2k at gmail.com
 */

/**
 * Description of manage
 * @author Лосев-Пахотин Руслан Витальевич <merly2k at gmail.com>
 *
 */
$template = "cabinet";
$cont_id = $this->param[0];
$mod_name = 'Управление слоями';
$adminmenu = "<h3>Меню администратора</h3>
            <ul class='toggle'>
                <li class='icn_tags'><a href='" . WWW_BASE_PATH . "category'>Управление категориями</a></li>
                <li class='icn_categories'><a href='" . WWW_BASE_PATH . "layers' >Слои</a></li>
                <li class='icn_new_article'><a href='" . WWW_BASE_PATH . "items/'>Артикулы</a></li>
                <li class='icn_folder'><a href='" . WWW_BASE_PATH . "add_media/'>Управление картинками</a></li>
                <li class='icn_edit_article'><a href='" . WWW_BASE_PATH . "pcl/'>Прайс</a></li>
            </ul>
            <hr />";
$context = '<div class="bbody">
                <form id="upload_form" enctype="multipart/form-data" method="post" onsubmit="return checkForm()">
                    <!-- hidden crop params -->
                    <input type="hidden" id="x1" name="x1" />
                    <input type="hidden" id="y1" name="y1" />
                    <input type="hidden" id="x2" name="x2" />
                    <input type="hidden" id="y2" name="y2" />
                    <h2>Шаг 1: Выберите файл для загрузки</h2>
                    <div><input type="file" name="image_file" id="image_file" onchange="fileSelectHandler()" /></div>
                    <div class="error"></div>
                    <div class="step2">
                        <h2>Шаг 2: выделите курсором часть картинки которую вы хотите разместить на сервере</h2>
                        <img id="preview" />

                        <div class="info">
                            <label>File size</label> <input type="text" id="filesize" name="filesize" />
                            <label>Type</label> <input type="text" id="filetype" name="filetype" />
                            <label>Image dimension</label> <input type="text" id="filedim" name="filedim" />
                            <label>W</label> <input type="text" id="w" name="w" />
                            <label>H</label> <input type="text" id="h" name="h" />
                        </div>
                        <input type="submit" value="Upload" />
                    </div>
                </form>
            </div>';

include TEMPLATE_DIR . DS . $template . ".html";
?>
