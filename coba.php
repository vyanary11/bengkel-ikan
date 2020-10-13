<?php 
	for ($i=1; $i < 4; $i++) { 
		for ($j=$i+8; $j < $i+9; $j++) { 
			if ($i!=3) {
				echo " ".$i;
			}
			echo " ".$j;
		}
	}
?>