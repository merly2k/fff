<?php
Class utree extends db
{
  var $link;
  var $lvl;
  
function GetLevel($ParentID) {
    $table="users";
    $q="SELECT id,apiKey FROM ".$table." WHERE apiKey IN('". $ParentID ."') ORDER BY id;";
    //print_r($q);
    $result = $this->get_result($q);
return $result;

}

function lvl($parent){
	$out[0]=  $this->GetLevel($parent);
	foreach($out[0] as $v){$a[]=$v->id;}
	$l1=  implode(",", $a);
    
	$out[1]=$this->GetLevel($l1);
	//print_r($out[1]);
	foreach($out[1] as $v){$b[]=$v->id;}
	$l2= implode("','", $b);
	$out[2]=  $this->GetLevel($l2);

	foreach($out[2] as $v){$c[]=$v->id;}
	$l3= implode("','", $c);
	$out[3]=  $this->GetLevel($l3);
	
	foreach($out[3] as $v){$d[]=$v->id;}
	$l4= implode("','", $d);
	$out[4]=  $this->GetLevel($l4);
	
	foreach($out[4] as $v){$e[]=$v->id;}
	$l5= implode("','", $e);
	$out[5]=  $this->GetLevel($l5);
		
	
	foreach($out[5] as $v){$i[]=$v->id;}
	$l6= implode("','", $i);
	$out[6]=  $this->GetLevel($l6);
		
	
	foreach($out[6] as $v){$f[]=$v->id;}
	$l7= implode("','", $f);
	$out[7]=  $this->GetLevel($l7);
		
	
	foreach($out[7] as $v){$j[]=$v->id;}
	$l8= implode("','", $j);
	$out[8]=  $this->GetLevel($l8);
	
	foreach($out[8] as $v){$h[]=$v->id;}
	$l9= implode("','", $h);
	$out[9]=  $this->GetLevel($l9);
	
	foreach($out[9] as $v){$y[]=$v->id;}
	$l10= implode("','", $y);
	$out[10]=  $this->GetLevel($l10);
		
		return $out;
}
}    
$a=new utree();
echo "<pre>";
print_r($a->lvl(1));