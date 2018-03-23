<?php
class utree extends db
{
  var $link;
  var $lvl;
  
function GetLevel($ParentID) {
    $table="users";
    $q="SELECT id FROM ".$table." WHERE apiKey IN('". $ParentID ."') ORDER BY id;";
    //print_r($q);
    $result = $this->get_result($q);
return $result;

}

function lvl($parent){
	$out[0]=  $this->GetLevel($parent);
	foreach($out[0] as $v){$a[]=$v->id;}
	if(!empty($a)){
	    $l1=  implode(",", $a);
	    $out[1]=$this->GetLevel($l1);} else{
        return;}
	
	//print_r($out[1]);
	foreach($out[1] as $v){$b[]=$v->id;}
	if(!empty($b)){
	    $l2= implode("','", $b);
	$out[2]=  $this->GetLevel($l2);}
	else {return $out;}

	foreach($out[2] as $v){$c[]=$v->id;}
	if(!empty($c)){
	    $l3=  implode(",", $c);	
	$out[3]=  $this->GetLevel($l3);}
	else {return $out;}
	
	foreach($out[3] as $v){$d[]=$v->id;}
	if(!empty($d)){
	    $l4= implode("','", $d);
	    $out[4]=  $this->GetLevel($l4);}
	else {return $out;}
	
	
	foreach($out[4] as $v){$e[]=$v->id;}
	if(!empty($e)){
	    $l5= implode("','", $e);
	    $out[5]=  $this->GetLevel($l5);}
	else {return $out;}	
	
	foreach($out[5] as $v){$i[]=$v->id;}
	if(!empty($i)){
	    $l6= implode("','", $i);
	    $out[6]=  $this->GetLevel($l6);}
	else {return $out;}		
	
	foreach($out[6] as $v){$f[]=$v->id;}
	if(!empty($f)){
	$l7= implode("','", $f);
	$out[7]=  $this->GetLevel($l7);}
	else {return $out;}			
	
	foreach($out[7] as $v){$j[]=$v->id;}
	if(!empty($j)){
	$l8= implode("','", $j);
	$out[8]=  $this->GetLevel($l8);}
	else {return $out;}		
	
	foreach($out[8] as $v){$h[]=$v->id;}
	if(!empty($h)){
	$l9= implode("','", $h);
	$out[9]=  $this->GetLevel($l9);}
	else {return $out;}
	
	foreach($out[9] as $v){$y[]=$v->id;}
	if(!empty($v)){
	$l10= implode("','", $y);
	$out[10]=  $this->GetLevel($l10);}
	else{
	return $out;}
}
}    
