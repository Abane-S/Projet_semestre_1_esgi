<?php

namespace App\Controllers;

class EnvDecomposer
{
    private string $pdoString;
    private string $installerStep;

    public function __construct() {
        $this->pdoString = $this->pdoStringDecomposer();
        $this->installerStep = $this->installerStepDecomposer();
    }

    public function getPdoString(): string
    {
        return $this->pdoString;
    }

    public function setPdoString(string $pdoString): void
    {
        $this->pdoString = $pdoString;
    }

    public function getInstallerStep(): string
    {
        return $this->installerStep;
    }

    public function setInstallerStepEnv(string $installerStep): void
    {
        $this->installerStep = $installerStep;
    }

    private function installerStepDecomposer(): string
    {
$fileContent = file_get_contents('.env');

// Rechercher la ligne avec INSTALL
$lines = explode("\n", $fileContent);
$installLine = $lines[1];  // Deuxième ligne

// Extraire les informations après le signe égal pour INSTALL
$installValue = explode('=', $installLine, 2)[1];
$installValue = trim($installValue);  // Supprimer les espaces éventuels

        return $installValue;
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