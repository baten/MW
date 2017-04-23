<?php
App::uses('Component', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class EmailSenderComponent extends Component
{

    public function sendEmail($options = array())
    {
        $uyEmailSender = new CakeEmail();
        $uyEmailSender->from(array($options['from_email'] => $options['from_name']));
        $uyEmailSender->to($options['to']);

        if(isset($options['cc']) and !empty($options['cc'])){
            $uyEmailSender->cc(array($options['cc'] => $options['from_name']));
        }       

        if(isset($options['attachments'])){
            $uyEmailSender->attachments($options['attachments']);
        }

        $uyEmailSender->subject($options['subject']);
        $uyEmailSender->template($options['template']);
        $uyEmailSender->emailFormat('html');
        $uyEmailSender->viewVars(array('data' => $options['data']));
        return $uyEmailSender->send();
    }
}