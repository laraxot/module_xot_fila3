<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels\Actions;

use Illuminate\Support\Facades\Mail;

//-------- models -----------

//-------- services --------

//-------- bases -----------

/**
 * Class TestAction.
 */
class TestMailAction extends XotBasePanelAction {
    public bool $onContainer = true;

    /**
     * @return mixed
     */
    public function handle() {
        return $this->panel->view();
    }

    public function postHandle() {
        $data = request()->all();
        $mail_driver = 1;
        switch ($mail_driver) {
            case 1:return $this->test1($data);
        }
    }

    public function test1($data) {
        $to_name = 'RECEIVER_NAME';
        $to_email = 'RECEIVER_EMAIL_ADDRESS';
        $data = [
            'name' => 'Ogbonna Vitalis(sender_name)',
            'body' => 'A test mail',
        ];
        Mail::send(
            'emails.mail',
            $data,
            function ($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                    ->subject('Laravel Test Mail');
                $message->from('SENDER_EMAIL_ADDRESS', 'Test Mail');
            }
        );
    }

    public function test2($data) {
        //Mail::mailer('mandrill')
        //Mail::mailer('postmark')
        Mail::to($request->user())->send(new OrderShipped($order));
    }

    public function test3($data) {
        // Backup your default mailer
        $backup = Mail::getSwiftMailer();

        // Setup your gmail mailer
        $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl');
        $transport->setUsername('your_gmail_username');
        $transport->setPassword('your_gmail_password');
        // Any other mailer configuration stuff needed...

        $gmail = new Swift_Mailer($transport);

        // Set the mailer as gmail
        Mail::setSwiftMailer($gmail);

        // Send your message
        Mail::send();

        // Restore your original mailer
        Mail::setSwiftMailer($backup);
    }
}
