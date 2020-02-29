<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>


<?php 
include "db_connect.php";
include 'Classes/PHPExcel/IOFactory.php';

//  Read your Excel workbook
$tmpfname = "esanlamli.xlsx";
		$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
		$excelObj = $excelReader->load($tmpfname);
		$worksheet = $excelObj->getSheet(0);
		$lastRow = $worksheet->getHighestRow();
		
		echo "<table>";
		for ($row = 2; $row <= $lastRow; $row++) {
			$db->exec("INSERT INTO kelimeler(kelime1,kelime2) VALUES('".$worksheet->getCell('A'.$row)->getValue()."','".$worksheet->getCell('B'.$row)->getValue()."')");
		}

?>
	
	
</body>
</html>