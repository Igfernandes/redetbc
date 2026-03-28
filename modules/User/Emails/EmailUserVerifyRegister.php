<?php

namespace Modules\User\Emails;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailUserVerifyRegister extends Mailable
{
	use Queueable, SerializesModels;

	const CODE = [
		'first_name'    => '[first_name]',
		'last_name'     => '[last_name]',
		'name'          => '[name]',
		'email'         => '[email]',
		'button_verify' => '[button_verify]',
	];

	public $user;
	public $url;

	public function __construct(User $user, $url)
	{
		$this->user = $user;
		$this->url = $url;
	}


	public function build()
	{
		$subject = setting_item("subject_email_verify_register_user");

		if (empty($subject)) {
			$subject = __('[:site_name] Verify Register', ['site_name' => setting_item('site_title')]);
		} else {
			$subject = $this->replaceSubjectEmail($subject);
		}

		// Passa as variáveis que a view vai precisar
		return $this->subject($subject)
			->view('User::emails.verify-registered') // arquivo Blade separado
			->with([
				'user' => $this->user,
				'url' => $this->url,
				'avatar' => $this->user->getAvatarUrl(),
				'buttonVerify' => $this->buttonVerify(),
			]);
	}


	public function replaceSubjectEmail($subject)
	{
		if (!empty($subject)) {
			foreach (self::CODE as $item => $value) {
				if (method_exists($this, $item)) {
					$replace = $this->$item();
				} else {
					$replace = '';
				}
				$subject = str_replace($value, $replace, $subject);
			}
		}
		return $subject;
	}

	public function replaceContentEmail($content)
	{
		if (!empty($content)) {
			foreach (self::CODE as $item => $value) {

				if ($item == "button_verify") {
					$content = str_replace($value, $this->buttonVerify(), $content);
				}

				$content = str_replace($value, @$this->user->$item, $content);
			}
		}
		return $content;
	}


	public function defaultBody()
	{
		$body = '
            <h1>Hello!</h1>
            <p>Please click the button to verify your email address!</p>
            <p style="text-align: center">' . $this->buttonVerify() . '</p>
            <p>If you did not create account, no further action is required.</p>
            <p>Regards,<br>' . setting_item('site_title') . '</p>';
		return $body;
	}

	public function buttonVerify()
	{
		$text = __('Verifique o endereço de e-mail');
		$button = '<a style="border-radius: 3px;
                color: #fff;
                display: inline-block;
                text-decoration: none;
                background-color: #3490dc;
                border-top: 10px solid #3490dc;
                border-right: 18px solid #3490dc;
                border-bottom: 10px solid #3490dc;
                border-left: 18px solid #3490dc;" href="' . $this->url . '">' . $text . '</a>';
		return $button;
	}
}
