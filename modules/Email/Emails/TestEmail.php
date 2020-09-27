<?php

    namespace Modules\Email\Emails;

    use App\User;
    use http\Env\Request;
    use Illuminate\Bus\Queueable;
    use Illuminate\Mail\Mailable;
    use Illuminate\Queue\SerializesModels;

    class TestEmail extends Mailable
    {
        use Queueable, SerializesModels;
        protected $password;

        public function __construct($password)
        {
            $this->password = $password;
        }

        public function build()
        {
            if($this->password){
                $subject = 'Your new password for Oson Travel' ;
                return $this->subject($subject)->view('Email::emails.password', ['password' => $this->password]);
            } else{
                $subject = 'Email testing';
                return $this->subject($subject)->view('Email::emails.test');
            }
        }
    }
