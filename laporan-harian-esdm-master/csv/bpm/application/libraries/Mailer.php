<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
 
class Mailer { 
 
    protected $to; 
 
    protected $subject; 
 
    protected $userName; 
 
    protected $password; 
 
    protected $emailHost; 
 
    protected $mailFrom; 
 
    protected $mailDirectory; 
 
 
    public function __construct() { 
 
        $this->userName = "noreply@esdm.go.id";
        $this->password = '06Cikini03';
        $this->emailHost = 'SMTP_SETTINGS';
        $this->mailFrom = ['noreply@esdm.go.id' => 'WebOmnizz'];
 
        // Define email directory
        $this->mailDirectory = VIEWPATH . '/emails';
    }
 
 
 
    protected function init()
    {
        $transport = (new Swift_SmtpTransport( $this->emailHost, 465, 'ssl'))
                        ->setUsername( $this->userName )
                        ->setPassword( $this->password );
 
        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);
        return $mailer;
    }
 
 
 
 
    protected function initializeTemplate( $template, $__data ) {
 
        ob_start();
        extract( $__data );
        
        include $this->mailDirectory .'/'.$template;
 
        return ltrim( ob_get_clean() );
    }
 
 
 
    public function to( $email ) 
    {
        $this->to = $email;
        return $this;
    }
 
 
 
    public function subject( $subject )
    {
        $this->subject = $subject;
        return $this;
    }
 
 
 
    public function send( $view, array $data = [] )
    {
        // Initialize Swift Mailer
        $mailer = $this->init();
        $template = $this->initializeTemplate( $view, $data );
 
        // Create a message
        $message = (new Swift_Message( $this->subject ))
                    ->setFrom( $this->mailFrom )
                    ->setTo([$this->to])
                    ->setBody( $template, 'text/html' );
 
        // Send the message
        $result = $mailer->send($message);
    }
}