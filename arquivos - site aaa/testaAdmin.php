<?php 
	function isAdmin($id){
	  if (($id == 3) || ($id == 4) || ($id == 6) || ($id == 7) || ($id == 8) || ($id == 9)){      
		  return true;
	  }else{
		return false;
	  }
	} 
?>