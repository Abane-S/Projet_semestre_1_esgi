<?php

namespace App\Controllers;


use App\Models\Templates as TemplateModel;

class Templates
{
    public function SetTemplates (): void
    {
        $template = new TemplateModel();
        $templateActive = $template->getOneBy(["active" => True], "object");
        header('Content-Type: application/json');
        echo json_encode([
            'fontName' => $templateActive->getPoliceName(),
            'fontSizePx' => intval($templateActive->getPoliceSize()),
            'bodyColor' => $templateActive->getBackgroundColor(),
            'textColor' => $templateActive->getTextColor(),
            'navbarColor' => $templateActive->getNavbarColor(),
            'navbarmenusColor' => $templateActive->getMenuColor()
        ]);
        exit;
    }
}