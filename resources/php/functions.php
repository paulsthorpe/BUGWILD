<?php 

function attr_options($attr){
    if($attr == 1){
	  $select = <<<ATTR
	   <option value="0">No</option>
	   <option value="1" selected>Yes</option>
ATTR;
	} elseif($attr == 0) {
	  $select = <<<ATTR
	   <option value="0"selected>No</option>
	   <option value="1">Yes</option>
ATTR;
	}
	return $select;
}

function status_options($status){
    if($status == 1){
	  $status_option = <<<STATUS
	   <option value="0">Pending</option>
	   <option value="1" selected>Shipped</option>
STATUS;
	} elseif($status == 0) {
	  $status_option = <<<STATUS
	   <option value="0"selected>Pending</option>
	   <option value="1">Shipped</option>
STATUS;
	}
	return $status_option;
}





