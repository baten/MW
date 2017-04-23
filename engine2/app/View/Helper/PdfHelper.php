<?php
class PdfHelper extends AppHelper {

	public function generatePDF($html = null,$doc_name = '',$author='',$title='',$subject='',$keywords='',$font_size = '10',$font_name = 'times'){

		if($html){

			App::import('Vendor','xtcpdf');
			$rabulation=array('215','315');
			// $tcpdf = new XTCPDF();
			$textfont = 'freesans'; // looks better, finer, and more condensed than 'dejavusans'

			// create new PDF document
			$tcpdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			// set document information
			$tcpdf->SetCreator(PDF_CREATOR);
			$tcpdf->SetAuthor($author);
			$tcpdf->SetTitle($title);
			$tcpdf->SetSubject($subject);
			$tcpdf->SetKeywords($keywords);

			// remove default header/footer
			$tcpdf->setPrintHeader(false);
			$tcpdf->setPrintFooter(false);

			// set default monospaced font
			$tcpdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			//set margins
			$tcpdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
			$tcpdf->SetHeaderMargin(0);
			$tcpdf->SetFooterMargin(0);

			//set auto page breaks
			$tcpdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			//set image scale factor
			$tcpdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			//set some language-dependent strings
			//			$tcpdf->setLanguageArray($l);

			// ---------------------------------------------------------

			// set font
			$tcpdf->SetFont($font_name, '', $font_size);

			// add a page
			$tcpdf->AddPage('P',$rabulation);
			if(isset($html)){
				$tcpdf->writeHTML($html, true, true, true, true, '');
			}
			//Close and output PDF document
			return $tcpdf->Output($doc_name.'.pdf', 'I');
			//============================================================+
			// END OF FILE
			//============================================================+

		}

	}


}

?>