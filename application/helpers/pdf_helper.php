<?php

function prep_pdf($orientation = 'portrait')
{
	$CI = & get_instance();
	
	$CI->cezpdf->selectFont(base_url() . '/fonts');	
	$now= now();
        $fecha=  unix_to_human($now);
	$all = $CI->cezpdf->openObject();
	$CI->cezpdf->saveState();
	$CI->cezpdf->setStrokeColor(0,0,0,1);
	if($orientation == 'portrait') {
		$CI->cezpdf->ezSetMargins(50,70,50,50);
		$CI->cezpdf->ezStartPageNumbers(500,28,8,'','{PAGENUM}',1);
		$CI->cezpdf->line(20,40,578,40);
		$CI->cezpdf->addText(50,32,8,'Impreso ' . date('d-m-Y',strtotime($fecha)));
		$CI->cezpdf->addText(50,22,8,'Cooperadora - UTN - FRRE ');
	}
	else {
		$CI->cezpdf->ezStartPageNumbers(750,28,8,'','{PAGENUM}',1);
		$CI->cezpdf->line(20,40,800,40);
		$CI->cezpdf->addText(50,32,8,'Impreso ' . date('d-m-Y',strtotime($fecha)));
		$CI->cezpdf->addText(50,22,8,'Cooperadora - UTN - FRRE ');
	}
	$CI->cezpdf->restoreState();
	$CI->cezpdf->closeObject();
	$CI->cezpdf->addObject($all,'all');
}

?>