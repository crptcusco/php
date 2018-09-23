<?php
$min=10;
$max=20;
$i =-1;
while ($i<100){
	$i++;
	if ($min>$i)
		continue;
	if ($max<$i)
		exit;
	print $i.'<br>';
	
}


// for ($i=0;$i<=100;$i++) {
	// if ($min>$i)
		// continue;
	// if ($max<$i)
		// exit;
	// print $i.'<br>';
// }

?>