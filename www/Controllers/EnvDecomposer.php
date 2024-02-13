<?php

namespace App\Controllers;

class EnvDecomposer
{
    private string $pdoString;
    private string $tablePrefixString;
    private string $siteNameString;

    private string $siteLogoString;

    private string $smtpHostString;
    private string $smtpUsernameString;
    private string $smtpPasswordString;
    private string $smtpPortString;
    private string $smtpEmailString;

    private string $smtpNameString;

    public function __construct() {
        $this->pdoString = $this->pdoStringDecomposer();
        $this->tablePrefixString = $this->getTablePrefix();
        $this->siteNameString = $this->getSiteName();
        $this->smtpHostString = $this->getSMTPHost();
        $this->smtpUsernameString = $this->getSMTPUserName();
        $this->smtpPasswordString = $this->getSMTPPassword();
        $this->smtpPortString = $this->getSMTPPort();
        $this->smtpEmailString = $this->getSMTPEmail();
        $this->smtpNameString = $this->getSMTPName();
        $this->siteLogoString = $this->getSiteLogo();
    }

    public function getSiteNameString(): string
    {
        return $this->siteNameString;
    }

    public function setSiteNameString(string $siteNameString): void
    {
        $this->siteNameString = $siteNameString;
    }

    public function getSmtpHostString(): string
    {
        return $this->smtpHostString;
    }

    public function setSmtpHostString(string $smtpHostString): void
    {
        $this->smtpHostString = $smtpHostString;
    }

    public function getSiteLogoString(): string
    {
        return $this->siteLogoString;
    }

    public function getSmtpUsernameString(): string
    {
        return $this->smtpUsernameString;
    }

    public function setSmtpUsernameString(string $smtpUsernameString): void
    {
        $this->smtpUsernameString = $smtpUsernameString;
    }

    public function getSmtpPasswordString(): string
    {
        return $this->smtpPasswordString;
    }

    public function getSmtpNameString(): string
    {
        return $this->smtpNameString;
    }

    public function setSmtpNameString(string $smtpNameString): void
    {
        $this->smtpNameString = $smtpNameString;
    }

    public function setSmtpPasswordString(string $smtpPasswordString): void
    {
        $this->smtpPasswordString = $smtpPasswordString;
    }

    public function getSmtpPortString(): string
    {
        return $this->smtpPortString;
    }

    public function setSmtpPortString(string $smtpPortString): void
    {
        $this->smtpPortString = $smtpPortString;
    }

    public function getSmtpEmailString(): string
    {
        return $this->smtpEmailString;
    }

    public function setSmtpEmailString(string $smtpEmailString): void
    {
        $this->smtpEmailString = $smtpEmailString;
    }


    public function getPdoString(): string
    {
        return $this->pdoString;
    }

    public function setPdoString(string $pdoString): void
    {
        $this->pdoString = $pdoString;
    }

    public function getTablePrefixString(): string
    {
        return $this->tablePrefixString;
    }

    public function setTablePrefixString(string $tablePrefixString): void
    {
        $this->tablePrefixString = $tablePrefixString;
    }

    private function getTablePrefix(): string
    {
        $fileContent = file_get_contents('.env');

        // Rechercher la ligne avec TABLE_PREFIX
        $lines = explode("\n", $fileContent);
        $tablePrefixLine = '';

        foreach ($lines as $line) {
            if (strpos($line, 'TABLE_PREFIX=') === 0) {
                $tablePrefixLine = $line;
                break;
            }
        }

        // Extraire les informations après le signe égal
        $tablePrefixValue = explode('=', $tablePrefixLine, 2)[1];

        return $tablePrefixValue;
    }

    public function getSiteName(): string
    {
        $fileContent = file_get_contents('.env');
        $lines = explode("\n", $fileContent);

        foreach ($lines as $line) {
            if (strpos($line, 'SITE_NAME=') === 0) {
                return trim(explode('=', $line, 2)[1]);
            }
        }

        return ''; // Retourne une chaîne vide si la clé n'est pas trouvée
    }

    public function getSMTPHost(): string
    {
        return $this->getEnvValue('SMTP_HOST');
    }

    public function getSMTPUserName(): string
    {
        return $this->getEnvValue('SMTP_USERNAME');
    }

    public function getSMTPPassword(): string
    {
        return $this->getEnvValue('SMTP_PASSWORD');
    }

    public function getSMTPPort(): string
    {
        return $this->getEnvValue('SMTP_PORT');
    }

    public function getSMTPEmail(): string
    {
        return $this->getEnvValue('SMTP_EMAIL');
    }

    public function getSMTPName(): string
    {
        return $this->getEnvValue('SMTP_NAME');
    }

    public function getSiteLogo(): string
    {
        return $this->getEnvValue('SITE_LOGO');
    }

    private function getEnvValue(string $key): string
    {
        $fileContent = file_get_contents('.env');
        $lines = explode("\n", $fileContent);

        foreach ($lines as $line) {
            if (strpos($line, $key . '=') === 0) {
                return trim(explode('=', $line, 2)[1]);
            }
        }

        return ''; // Retourne une chaîne vide si la clé n'est pas trouvée
    }

    private function pdoStringDecomposer():string
    {
        $fileContent = file_get_contents('.env');

        // Rechercher la ligne avec DB_SETTINGS
        $lines = explode("\n", $fileContent);
        $dbSettingsLine = '';

        foreach ($lines as $line) {
            if (strpos($line, 'DB_SETTINGS=') === 0) {
                $dbSettingsLine = $line;
                break;
            }
        }

        // Extraire les informations après le signe égal
        $dbSettingsValue = explode('=', $dbSettingsLine, 2)[1];

        // Supprimer le contenu après le premier saut de ligne
        $dbSettingsValue = explode("\n", $dbSettingsValue, 2)[0];

        return $dbSettingsValue;
    }

}