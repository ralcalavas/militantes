<? 
	require("classes/PHPExcel.php");		
	require("classes/PHPExcel/IOFactory.php");	
	require("classes/FuncionesDao.php");
	
	//filtros
	$id=1;
	$fini="";
	$ffin="";	
	if ($_GET['id'] != ''){		
		$id=$_GET['id'];	
	}	
	if ($_GET['fi'] != ''){		
		$fini=$_GET['fi'];	
	}	
	if ($_GET['ff'] != ''){		
		$ffin=$_GET['ff'];	
	}
	
	$rowcr=FuncionesDao::ConsultarReporte($id);		
	$rowr=FuncionesDao::ConsultarMilitantesReporte($id,$fini,$ffin);		
		
	$nombre="Militantes";	
	if($id==2){
		$nombre="Candidatos";	
	}
	else if($id==3){
		$nombre="CNE";	
	}
	
	//nombre de archivo
	$nombreArchivo = "Reporte".$nombre."_" . date("Ymd") . ".xls";
	header('Content-Type: text/html;charset=utf-8');
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="'.$nombreArchivo.'"');
	header('Cache-Control: max-age=0');
	
	ini_set("memory_limit","1032M");
	set_time_limit(2000);		
	      									
	$objPHPExcel = new PHPExcel();
	
	// Set properties
	$objProps = $objPHPExcel->getProperties(); 
    $objProps->setCreator("PHP"); 
    $objProps->setLastModifiedBy("UMV"); 
    $objProps->setTitle("Office 2007 XLSX"); 
    $objProps->setSubject("Office 2007 XLSX"); 
    $objProps->setDescription("Office 2007 XLSX, generated by PHPExcel."); 
    $objProps->setKeywords("office excel 2007 PHPExcel"); 
    $objProps->setCategory("Formulario"); 
				
	//Estilos
	$colorN=array('rgb' => '000000');
	$colorG=array('rgb' => 'CCCCCC');
	$colorGL=array('rgb' => 'EEECEC');
	$colorGB=array('rgb' => 'CEF0FB');
	$colorY=array('rgb' => 'F4FA58');
	$fillG=array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => $colorG);
	$fillGL=array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => $colorGL);
	$fillGB=array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => $colorGB);
	$fillY=array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => $colorY);
	$fontTit=array('size' => 13,'bold' => true,'color' => $colorN);
	$fontTextN=array('size' => 10,'bold' => true,'color' => $colorN);
	$fontText=array('size' => 10,'bold' => false,'color' => $colorN);
	$alignH=array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$alignV=array('vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$alignC=array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$alignHR=array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $borders=array('bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
					  			         'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
								         'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),	
								         'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN));
	$styleTit = array('font' => $fontTit, 'alignment' => $alignC, 'borders' => $borders, 'fill' => $fillGB);
	$styleSTCF = array('font' => $fontTextN, 'alignment' => $alignC, 'borders' => $borders, 'fill' => $fillG);			
	$styleSTCFL = array('font' => $fontTextN, 'alignment' => $alignC, 'borders' => $borders, 'fill' => $fillGL);			
	$styleSTC = array('font' => $fontTextN, 'alignment' => $alignC, 'borders' => $borders);			
	$styleST = array('font' => $fontTextN, 'alignment' => $alignV, 'borders' => $borders);			
	$styleTextC = array('font' => $fontText, 'alignment' => $alignC, 'borders' => $borders);	
	$styleText = array('font' => $fontText, 'borders' => $borders);	
	$styleTextY = array('font' => $fontText, 'borders' => $borders, 'fill' => $fillY);	
	$styleTextSB = array('font' => $fontText);
	$styleTextN = array('font' => $fontTextN, 'borders' => $borders);	
	$styleTextNum = array('font' => $fontTextN, 'alignment' => $alignHR, 'borders' => $borders);		
			
	//Creaci�n hoja
	$objPHPExcel->setActiveSheetIndex(0); 
    $objActSheet = $objPHPExcel->getActiveSheet(); 	
	$objActSheet->setTitle($nombre); 
	
	$fila = 1;		
	$col = 0;	
				
	//encabezado
	for ($numcr=0; $numcr<count($rowcr); $numcr++) { 		
		$objActSheet->setCellValueByColumnAndRow($col++, $fila, $rowcr[$numcr]["nombre"]);	
		$objActSheet->getStyle(FuncionesDao::ObtenerCeldaXlsC($col,$fila))->applyFromArray($styleTextN);	
	}	

	//se recorren las preguntas y se genera el archivo excel
	for ($numr=0; $numr<count($rowr); $numr++) { 	
		$col=0;	
		$fila++;	
		for ($numcr=0; $numcr<count($rowcr); $numcr++) { 						
			$codigo=$rowcr[$numcr]["codigo"];
			$objActSheet->setCellValueByColumnAndRow($col++, $fila, $rowr[$numr][$codigo]);	
			$objActSheet->getStyle(FuncionesDao::ObtenerCeldaXlsC($col,$fila))->applyFromArray($styleText);							 
		}	
	}
		
	//se crea el archivo
	$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');			
	//$objWriter->setPreCalculateFormulas(false);     
	$objWriter->save('php://output');	
	
exit;	

?>