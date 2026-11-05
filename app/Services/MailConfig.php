<?php

namespace App\Services;

use App\Models\EmailSetting;
use Illuminate\Support\Facades\Config;

class MailConfig
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {

    }

    public function configure(): void
    {
        $setting = EmailSetting::first();

        if (!$setting) {
            throw new \Exception('Les paramètres de messagerie ne sont pas configurés.');
        }

        Config::set('mail.default', 'smtp');

        Config::set('mail.mailers.smtp.host', $setting->host);
        Config::set('mail.mailers.smtp.port', $setting->port);
        Config::set('mail.mailers.smtp.username', $setting->username);
        Config::set('mail.mailers.smtp.password', $setting->password);
        Config::set('mail.mailers.smtp.encryption', $setting->encryption);

        Config::set('mail.from.address', $setting->username);
        Config::set('mail.from.name', "Mairie de Banikoara");
    }
}
