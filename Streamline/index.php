<?php
	require_once('../lib/functions.php');

	$d = initializeApp('streamline');	
	$ni = sizeof($d['items']);
	$iu = array($ni);	

	for($i=0;$i<$ni;$i++){
		$itemid = $d['items'][$i];
		$idata 	= fetchItemData($itemid);
	}
  include("../index.html");
?>