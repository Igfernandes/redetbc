<?php

namespace Modules\User\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordToken extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $user;
    public $resetUrl;

    const CODE = [
        'first_name'   => '[first_name]',
        'last_name'    => '[last_name]',
        'name'         => '[name]',
        'email'        => '[email]',
        'buttonReset'  => '[button_reset_password]',
    ];

    public function __construct(string $token, $user)
    {
        $this->token = $token;
        $this->user  = $user;

        // URL correta de redefinição
        $this->resetUrl = route('password.reset', [
            'token' => $this->token,
            'email' => $this->user->email,
        ]);
    }

    public function build()
    {
        $subject = __('Recuperação de senha');

        return $this->subject($subject)
            ->view('User::emails.forgotPassword')
            ->with([
                'token'     => $this->token,
                'user'      => $this->user,
                'resetUrl'  => $this->resetUrl,
            ]);
    }

    /**
     * Mantido para compatibilidade caso o sistema
     * ainda utilize emails dinâmicos por conteúdo
     */
    public function replaceContentEmail($content)
    {
        if (!empty($content)) {
            foreach (self::CODE as $item => $value) {

                if ($item === 'buttonReset') {
                    $content = str_replace($value, $this->buttonReset(), $content);
                    continue;
                }

                $content = str_replace(
                    $value,
                    data_get($this->user, $item),
                    $content
                );
            }
        }

        return $content;
    }

    /**
     * Fallback (caso alguém ainda use)
     */
    public function defaultBody()
    {
        return '
            <h1>' . __('Recuperação de senha') . '</h1>
            <p>' . __('Recebemos uma solicitação para redefinir sua senha.') . '</p>
            <p style="text-align:center">' . $this->buttonReset() . '</p>
            <p>' . __('Este link expira em 60 minutos.') . '</p>
            <p>' . __('Se você não solicitou, ignore este email.') . '</p>
            <p>' . __('Atenciosamente') . ',<br>' . setting_item('site_title') . '</p>
        ';
    }

    /**
     * Botão HTML (usado apenas em conteúdo dinâmico)
     */
    public function buttonReset()
    {
        return '<a
            href="' . $this->resetUrl . '"
            style="
                background:#50a6fb;
                color:#fff;
                text-decoration:none;
                padding:14px 28px;
                border-radius:8px;
                display:inline-block;
            ">
            ' . __('Redefinir senha') . '
        </a>';
    }
}
