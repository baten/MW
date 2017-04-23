<?php
echo $this->element('admin/pdf_style');
if ($generate_type == 'pdf') {
    $pdf_html = '';
    $pdf_html .= '<div style="margin: 0px;padding: 0px;">';
    $pdf_html .= '<table  style="margin: 0px;padding: 0px; ">';
    if ($print_content_with_logo) {
        $pdf_html .= '<tr>';
        $pdf_html .= '<td style="text-align: center;padding: 5%;">';
        $pdf_html .= '<h1 style="color:#ff000e;">Matjar Alwatany</h1><div style=" font-size:12px">P.O. Box 275, Al Khobar 31952, Kingdom of Saudi Arabia<br>
		<b style=" font-weight: bold">Tel :</b> +966 13 8951820 / 1760 EXT. 167, <b style=" font-weight: bold">Email</b>: bamatraf@matjaralwatany.com</div>';        
        $pdf_html .= '</td>';
        $pdf_html .= '</tr>';    }
  
    $pdf_html .= '</table>';
    $pdf_html .= '</div>';
    echo $pdf_html .= $html;
} elseif ($generate_type == 'xls') {
    $filename = $doc_name . ".xls";
    header('Content-type: application/ms-excel');
    header('Content-Disposition: attachment; filename=' . $filename);
    header("Pragma: no-cache");
    header("Expires: 0");
    echo $html;
} elseif ($generate_type == 'doc') {
    $filename = $doc_name . ".doc";
    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment;Filename=" . $filename);
    header("Pragma: no-cache");
    header("Expires: 0");
    echo $html;
} else {
    echo $html;
}
?>