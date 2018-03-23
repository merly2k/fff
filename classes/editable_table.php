<?php

/*
 * этот файл распространяется на условиях коммерческой лицензии
 * по вопросам приобретения кода обращайтесь merly2k at gmail.com
 * 
 * Description of editable_table
 * @abstract: генерация редактируемой таблицы
 * @author Лосев-Пахотин Руслан Витальевич <merly2k at gmail.com>
 */
class editable_table {

    public $classname = __CLASS__;
    public $ajax;//аякс на выход
    public $content;//хтмл на выход
    public $table;//имя таблицы
    public $fieldset=array();
    public $request_uri;//куда направлять запрос
    public $act;
    public $in_param=array();//масив данных для таблицы
    public $t_header=array();//заголовок таблицы в формате заголовок=имя поля
    public $greed=array();// список строк для редактирования в формате №строки(переменная=>значение)
    public $onclick;//внутренняя переменная используетсся для генерации аяксов
    public $change;//внутренняя переменная используетсся для генерации аяксов
    public $dataString;//внутренняя переменная используетсся для генерации аяксов
    public $required=array();//внутренняя переменная используетсся для генерации аяксов
    
    function __construct() {
                
    }

    public function greed_header() {
        $this->content.="<table style='width:100%' id='$this->table'><tr>\r\n";
        foreach ($this->t_header as $col => $name) {
            $this->content.="<th>$name</th>\r\n";
        } 
        $this->content.="</tr>\r\n";
    }

    public function render_cel($id,$name,$value,$params) {
        $this->content.="<td class='edit_td'><span id='".$name."_$id' class='text'>$value</span>\r\n";
            if(is_array($params)){
                $this->content.="<select class='editbox' id='".$name."_input_$id' >\r\n";
                foreach ($params as $key => $val) {
                    if($val!=''){$o_val="value='$val'";}else{$o_val='';}
                    if($val==$value){$o_sel=" selected='selected'";}else{$o_sel='';}
                $this->content.="<option $o_val $o_sel> $key</option>\r\n";    
                }
                $this->content.="</select>\r\n";
            }  elseif ($params=="textarea") {
            $this->content.="<textarea id='".$name."_input_$id' class='editbox' name='$name' rows='4' cols='20'>$value</textarea>";
            }elseif($params=="readonly"){
            $this->content.= "<input type='text' size='6' disabled='disabled' value='$value' class='editbox' id='".$name."_input_$id' />";
            
            }elseif($params=="hidden"){
            $this->content.= "<input type='hidden' value='$value' class='editbox' id='".$name."_input_$id' />";
            
            }else{
            $this->content.= "<input type='text' size='9' value='$value' class='editbox' id='".$name."_input_$id' />";
            
            }
            $this->content.="</td>";
    }
    
    public function render_row() {
        foreach ($this->greed as $key => $cels) {
            //echo $key;
            $this->content.="<tr id='$key' class='edit_tr'>";
            
            foreach($cels as $field=>$c_value){
                $tt=$this->fieldset;
                $this->render_cel($key,$field,$c_value,$tt[$field]);
            
        }
        $this->content.="</tr>";
    }
    
    }
    
    public function render_greed(){
        $this->greed_header();
        $this->render_row();
        $this->content.="</table>";
        $this->render_ajax();
    }
    

    public function get_ajax($field_name) {
       $this->onclick.="\t $('#".$field_name."_'+ID).hide();\r\n";
       $this->onclick.="\t $('#".$field_name."_input_'+ID).show();\r\n";
       $this->change.="\t var ".$field_name."=$('#".$field_name."_input_'+ID).val();\r\n";
       $this->dataString.="'".$field_name."':".$field_name.",\r\n";
       $this->required[]=$field_name.".length>0";
    }

public function render_ajax() {
    foreach ($this->t_header as $field=>$name) {
        $this->get_ajax($field);
    }
    $this->ajax.="
  $('table#$this->table tr.edit_tr').click(function(){\r\n
\t var ID=$(this).attr('id');
    $this->onclick  \r\n
    }).change(function() {\r\n
         var ID=$(this).attr('id');
$this->change
 ;

if(".implode("&&",$this->required)."){\r\n
            $.ajax({\r\n
                    type: 'POST',\r\n
                    contentType: 'application/x-www-form-urlencoded',\r\n
                    url: '$this->request_uri',\r\n
                    data: { $this->dataString'act':'$this->act'},\r\n
                    cache: false,\r\n
                    success: function(response)\r\n
                    {\r\n
                    //$('#ajax_status').html(response);\r\n
                   location.reload();\r\n
                    }\r\n
                    });\r\n
         }\r\n
         else \r\n
         {\r\n
            alert('Enter something.');\r\n
            }\r\n
            });\r\n

        // Edit input box click action\r\n
        $('.editbox').mouseup(function()\r\n
        {\r\n
            return false\r\n
        });\r\n

        // Outside click action
        $(document).mouseup(function()\r\n
        {\r\n
        $('.editbox').hide();\r\n
        $('.text').show();\r\n
        });          \r\n
  
";
}
}
?>
