<?php

	foreach ($this->areas as $area) {
		$item = new Area();
		$item = $area;
		echo '<option value="'.$item->getIdArea().'">'.$item->getNombre().'</option>';
	}

?>