<?php
use App\Models\Log;

 function SaveLog($data){
 	$Log = new Log($data);
 	
 	if ($Log->save()) {
 		return true;
 	}else{
 		return false;
 	}
    

}

