<?php
session_start();
include_once('config.php');

$conn=mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname);

 if ( !$conn ) {
    echo mysqli_error( $connection );
    throw new Exception( "Database cannot Connect" );
}

$sessionId = $_SESSION['id'] ?? '';

    if ( $sessionId) {
       $query="select * from users where id=$sessionId";
       $result=mysqli_query($conn,$query);
       if($result){
        
           $data=mysqli_fetch_assoc($result);
           $current_user=$data['name'];
        //    echo  strtoupper($current_user);
          
       }
        
    }
if(isset($_POST['OK'])){

    $identcode=$_POST['identcode'];
    

    $query="select *  from parts where identcode=".$identcode;
    $result=mysqli_query($conn,$query);

    // if(count($result>0)){
    //     echo " Yes";
    // }
   if( $data=mysqli_fetch_assoc($result)){
    // print_r($data);
    $item_name=$data['item_name'];
    $task_name=$data['task_name'];
   }
   else{?>
     
        <h1 style=" color:red; margin-top:50px; margin-left:20px; text-align:center; "> Sorry, No product found for this identcode.</h1>
       <?php
       exit;
   }

}
$date=date('Y-m-d H:i:s');

 ///////////////////////////////////////////////////////////////////////////////////////////
 ////                                                                              /////////
 ////  Now from in next part we are going to build pdf from this dynamic data      /////////
 ////                                                                              /////////
 //////////////////////////////////////////////////////////////////////////////////////////

require_once('tcpdf/tcpdf.php');
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Basit Hussain');
// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
//$pdf->SetTitle('Barcode Generator');
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Barcode Generator', '');
// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, 0, PDF_MARGIN_RIGHT);
////$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 0);
// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// -------------------------------------------------------------------------

// add a page
$pdf->AddPage();


// -----------------------------------------------------------------------------

$pdf->SetFont('helvetica', '', 10);

// define barcode style
$style = array(
    'position' => '',
    'align' => 'C',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => false,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, 
    'text' =>false,
    'label'=>'',
    'font' => 'helvetica',
    'fontsize' => 8,
    'stretchtext' => 4
);

$pdf->Ln();

$barcode_type="C128B";
$params = $pdf->serializeTCPDFtagParameters(array("$identcode", "$barcode_type", '', '', 30, 10, 0.9,
 array('position'=>'L', 'border'=>false, 'padding'=>0, 'fgcolor'=>array(0,0,0), 'bgcolor'=>array(255,255,255),
  'text'=>false, 'font'=>'helvetica', 'fontsize'=>8, 'stretchtext'=>4), 'T'));

$html='<div  width="50" style=" border-bottom:1px solid black; width:50%; margin:1px auto; padding:2px 0 0 0; ">';
$html .= '<tcpdf style="width: 50px; " method="write1DBarcode" params="'.$params.'">  </tcpdf >&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;<img  src="recent-work-04.jpg" width="90"  alt="">';
$html.='<h4>'.$identcode.'</h4><p>'.$item_name.'</p><p>'.$task_name.'</p><p>'.$date.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>'.$current_user.'</p>';
$html.='</div>';


$html.='<div  width="50" style=" border-bottom:1px solid black; width:50%; margin:1px auto; padding:2px 0 0 0; ">';
$html .= '<tcpdf style="width: 50px; " method="write1DBarcode" params="'.$params.'">  </tcpdf >&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;<img  src="recent-work-04.jpg" width="90"  alt="">';
$html.='<h4>'.$identcode.'</h4><p>'.$item_name.'</p><p>'.$task_name.'</p><p>'.$date.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>'.$current_user.'</p>';
$html.='</div>';


$html.='<div  width="50" style=" border-bottom:1px solid black; width:50%; margin:1px auto; padding:2px 0 0 0; ">';
$html .= '<tcpdf style="width: 50px; " method="write1DBarcode" params="'.$params.'">  </tcpdf >&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;<img  src="recent-work-04.jpg" width="90"  alt="">';
$html.='<h4>'.$identcode.'</h4><p>'.$item_name.'</p><p>'.$task_name.'</p><p>'.$date.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>'.$current_user.'</p>';
$html.='</div>';


$html.='<div  width="50" style="  width:50%; margin:1px auto; padding:2px 0 0 0; ">';
$html .= '<tcpdf style="width: 50px; " method="write1DBarcode" params="'.$params.'">  </tcpdf >&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;<img  src="recent-work-04.jpg" width="90"  alt="">';
$html.='<h4>'.$identcode.'</h4><p>'.$item_name.'</p><p>'.$task_name.'</p><p>'.$date.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>'.$current_user.'</p>';
$html.='</div>';

$pdf->SetY(1);
$pdf->SetX(1);

$x = $pdf->getX();
$y = $pdf->getY();

// set color for background
$pdf->SetFillColor(255, 255, 255);

// set color for text
$pdf->SetTextColor(0, 0, 0);

// write the first column
$pdf->writeHTMLCell(105, 296, $x, $y, $html, 1, 0, 5, false, 'TL', false);
// write the second column
$pdf->writeHTMLCell(105, 296, '', '', $html, 1, 0, 1, true, 'TL', true);

//Close and output PDF document
$pdf->Output('BarCode Generator.pdf', 'I');








/////////////////////////////////////////////////////
// NOTE: dimensions are  105+105=210 width and 74x4=296
// if you want to change the dimensions them please edit line no. 174 and 176. 105 is width of one column and 296 is its height.
////////////////////////////////////////////////////////
?>