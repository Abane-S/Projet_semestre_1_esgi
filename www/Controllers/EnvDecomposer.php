<?php

namespace App\Controllers;

class EnvDecomposer
{
    private string $pdoString;
    private string $tablePrefixString;

    public function __construct() {
        $this->pdoString = $this->pdoStringDecomposer();
        $this->tablePrefixString = $this->getTablePrefix();
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