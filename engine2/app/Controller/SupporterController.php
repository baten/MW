<?php

App::uses('AppController', 'Controller');
App::uses('CakeTime', 'Utility');

class SupporterController extends AppController {

    public $helpers = array('Pdf');

    public $components = array('Mpdf.Mpdf');

    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('generate');
    }

    /**
     * Method generating PDF and saving it as file
     */
    public function generate($save=NULL) {
        $pdfdata = $this->Session->read('pdfdata');
        $this->layout = false;
        $html = '';
        $doc_name = time();
        $author = 'mipellim';
        $title = '';
        $subject = '';
        $keywords = '';
        $font_size = '12';
        $font_name = '';
        $print_orientation = 'P';
        $print_page_size = 'A4';
        $generate_type = 'pdf';
        $print_content_with_logo = false;
        $print_generated_datetime = false;
        $print_watermark_text = false;
        $margin_top = 10;

        if(isset($pdfdata['generate_type'])){
            $generate_type = $pdfdata['generate_type'];
        }
        if(isset($pdfdata['print_watermark_text'])){
            $print_watermark_text = $pdfdata['print_watermark_text'];
        }


        if(isset($pdfdata['print_content_with_logo']) and (!empty($pdfdata['print_content_with_logo']))){
            $print_content_with_logo = $pdfdata['print_content_with_logo'];
            $margin_top = 0;
        }
        if(isset($pdfdata['print_generated_datetime']) and (!empty($pdfdata['print_generated_datetime']))){
            $print_generated_datetime = $pdfdata['print_generated_datetime'];
        }


        if(isset($pdfdata['html'])){
            $html = $pdfdata['html'];
        }


        if(isset($pdfdata['author'])){
            $author = $pdfdata['author'];
        }

        if(isset($pdfdata['title'])){
            $title = $pdfdata['title'];
            $doc_name = str_replace(' ', '_', $pdfdata['title']);
        }

        if(isset($pdfdata['subject'])){
            $subject = $pdfdata['subject'];
        }

        if(isset($pdfdata['font_size'])){
            $font_size = $pdfdata['font_size'];
        }

        if(isset($pdfdata['font_name'])){
            $font_name = $pdfdata['font_name'];
        }

        if(isset($pdfdata['print_orientation'])){
            $print_orientation = $pdfdata['print_orientation'];
        }
        if(isset($pdfdata['print_page_size'])){
            $print_page_size = $pdfdata['print_page_size'];
        }




        $this->set(compact('html','doc_name','author','title','subject','keywords','font_size','font_name','generate_type','print_content_with_logo'));
        //$this->Session->delete('pdfdata');
        if ($generate_type == 'pdf') {
            // initializing mPDF

            //mPDF ([ string $mode [, mixed $format [, float $default_font_size [, string $default_font [, float $margin_left , float $margin_right , float $margin_top , float $margin_bottom , float $margin_header , float $margin_footer [, string $orientation ]]]]]])
            //$mpdf = new mPDF('','', $font_size, $font_name, 5, 5, 5, 5, 3, 3, 'L');
            $this->Mpdf->init();

            //$this->Mpdf->AddPage($print_orientation,0,0,0,0);
            $this->Mpdf->AddPage($print_orientation,'','','','',20,20,$margin_top,20,10,10);

            // setting filename of output pdf file
            $this->Mpdf->setFilename($doc_name.'.pdf');
            $this->Mpdf->SetTitle($title);

            // setting output to I, D, F, S SetFooterByName
            

            $print_generated_datetime =1;

            if($print_generated_datetime) {
                $time = CakeTime::convert(time(), new DateTimeZone('Asia/Dhaka'));
                $dateTime = date('dS M Y h:m A', $time);
                $this->Mpdf->SetHTMLFooter('Generated Date: ' . $dateTime.' Powered By: <a target="_blank" href="http://uysys.co.uk">uysys.com</a>');
            }

            if($print_watermark_text) {
                $this->Mpdf->SetWatermarkText($print_watermark_text);
                $this->Mpdf->showWatermarkText = true;
                $this->Mpdf->watermarkTextAlpha = 0.1;
                $this->Mpdf->watermark_font = 'DejaVuSansCondensed';
            }

            // you can call any mPDF method via component, for example:


        }     
      
        $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
        
        if($save){            
            $this->Mpdf->WriteHTML($html);
            $this->Mpdf->Output(WWW_ROOT.'files/'."order-{$save}.pdf","F");
             return $this->redirect(array('plugin' => false,'controller'=>'shops','action' => 'confirmation',$save));
        }else{
            $this->Mpdf->setOutput($html);
        }
       
    }

    /**
     * Method calling generate_pdf()
     */


    public function generate2() {
        // initializing mPDF
        $this->Mpdf->init();

        // setting filename of output pdf file
        $this->Mpdf->setFilename('file.pdf');

        // setting output to I, D, F, S
        $this->Mpdf->setOutput('D');

        // you can call any mPDF method via component, for example:
        $this->Mpdf->SetWatermarkText("Draft");
    }

    public function generateDomPdf() {
        $pdfdata = $this->Session->read('pdfdata');
        $this->layout = false;
        $html = '';
        $doc_name = 'pdf';
        $author = '';
        $title = '';
        $subject = '';
        $keywords = '';
        $font_size = '12';
        $font_name = '';
        $generate_type = 'pdf';
        $print_content_with_logo = false;
        
        if(isset($pdfdata['generate_type'])){
            $generate_type = $pdfdata['generate_type'];            
        }
        
        if(isset($pdfdata['print_content_with_logo']) and (!empty($pdfdata['print_content_with_logo']))){
            $print_content_with_logo = $pdfdata['print_content_with_logo'];            
        }        
       
        if(isset($pdfdata['html'])){
            $html = $pdfdata['html'];            
        }
        
                
        if(isset($pdfdata['author'])){
            $author = $pdfdata['author'];
        }
        
        if(isset($pdfdata['title'])){
            $title = $pdfdata['title'];
            $doc_name = str_replace(' ', '_', $pdfdata['title']);
        }
        
        if(isset($pdfdata['subject'])){
            $subject = $pdfdata['subject'];
        }
        
        if(isset($pdfdata['font_size'])){
            $font_size = $pdfdata['font_size'];
        }
        
        if(isset($pdfdata['font_name'])){
            $font_name = $pdfdata['font_name'];
        }
        
        $this->set(compact('html','doc_name','author','title','subject','keywords','font_size','font_name','generate_type','print_content_with_logo'));
        $this->Session->delete('pdfdata');
    }

    public function set_session($session_name = null, $session_data = null) {
        $this->layout = false;
        if ($this->request->is('post')) {
            $session_name = $this->request->data['session_name'];
            $session_data = $this->request->data['session_data'];
        }
        if ($session_name) {
            $this->Session->write($session_name, $session_data);
        }
        if ($this->request->is('ajax')) {
            echo true;
            exit;
        }
        $this->redirect($this->here);
    }

}