<?php
/**
* 打印函数
*/
function p($arr){
	
	$str = '<pre style="display: block;padding: 9.5px;margin: 44px 0 0 0;font-size: 13px;line-height: 1.42857;color: #333;word-break: break-all;word-wrap: break-word;background-color: #F5F5F5;border: 1px solid red;border-radius: 4px;">';
	if(is_bool($arr)) {
		$show = $arr? 'true' : 'false';
		
	}elseif(is_null($arr)){
		$show = 'null';
	}else{
		$show = print_r($arr,true);
	}
	$str .= $show;
	$str .= '</pre>';
	echo $str;
	
}



//导数据
function exportExcel($data, $savefile = null, $title = null, $sheetname = 'sheet1') {
       import("ORG.Util.PHPExcel");
    //若没有指定文件名则为当前时间戳
    if (is_null($savefile)) {
        $savefile = time();
    }
    //若指字了excel表头，则把表单追加到正文内容前面去
    if (is_array($title)) {
        array_unshift($data, $title);
    }
    $objPHPExcel = new PHPExcel();
    //Excel内容
    $head_num = count($title);

    foreach ($data as $k => $v) {
        $obj = $objPHPExcel->setActiveSheetIndex(0);
        $row = $k + 1; //行
        $nn = 0;

        foreach ($v as $vv) {
            $col = chr(65 + $nn); //列
            $obj->setCellValue($col . $row, $vv); //列,行,值
            $nn++;
        }
    }
    //设置列头标题
    for ($i = 0; $i < $head_num - 1; $i++) {
        $alpha = chr(65 + $i);
        $objPHPExcel->getActiveSheet()->getColumnDimension($alpha)->setAutoSize(true); //单元宽度自适应 
        $objPHPExcel->getActiveSheet()->getStyle($alpha . '1')->getFont()->setName("Candara");  //设置字体
        $objPHPExcel->getActiveSheet()->getStyle($alpha . '1')->getFont()->setSize(12);  //设置大小
        $objPHPExcel->getActiveSheet()->getStyle($alpha . '1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLACK); //设置颜色
        $objPHPExcel->getActiveSheet()->getStyle($alpha . '1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平居中
        $objPHPExcel->getActiveSheet()->getStyle($alpha . '1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直居中
        $objPHPExcel->getActiveSheet()->getStyle($alpha . '1')->getFont()->setBold(true); //加粗
    }

    $objPHPExcel->getActiveSheet()->setTitle($sheetname); //题目
    $objPHPExcel->setActiveSheetIndex(0); //设置当前的sheet  
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="' . $savefile . '.xls"');//文件名称
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); //Excel5
    $objWriter->save('php://output');
}


?>