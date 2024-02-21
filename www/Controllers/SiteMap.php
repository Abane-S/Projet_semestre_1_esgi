<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Pages as PagesModel;
use App\Models\Menus as menusModel;

class SiteMap
{
    public function gererateSiteMap(): void
    {
        $baseURL = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'];

        $getUrls = new PagesModel();
        $urlsContent = $getUrls->getAllPages();

        $urls = [];

        if ($urlsContent) {
            foreach ($urlsContent as $urlContent) {
                $urls[] = $baseURL . "/page/" . $urlContent['id'];
            }
        }

        $getUrls2 = new menusModel();
        $urlsContent2 = $getUrls2->ORMLiteSQL("SELECT");

        $urls2 = [];

        if ($urlsContent2) {
            foreach ($urlsContent2 as $urlContent2) {
                $urls2[] = $baseURL. "/menu/" . $urlContent2['id'];
            }
        }
        $urls3 = [];
        $routes = yaml_parse_file("routes.yaml");
        foreach ($routes as $key => $value) {
            if (isset($value['public']) ? !$value['public'] : false) {
                if(substr($key, 1) != "page/{id}" && substr($key, 1) != "menu/{id}")
                {
                $urls3[] = $baseURL . "/" . substr($key, 1);
                }
            }
        }
        $urls = array_merge($urls3, $urls, $urls2);

        // Create a new SimpleXMLElement with formatting options
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset></urlset>', LIBXML_NOERROR | LIBXML_ERR_NONE | LIBXML_ERR_FATAL);
        $xml->addAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $xml->addAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $xml->addAttribute('xsi:schemaLocation', 'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd');

        foreach ($urls as $url) {
            $xmlUrl = $xml->addChild('url');
            $xmlUrl->addChild('loc', $url);
        }

        // Format the XML output with indentation
        $dom = dom_import_simplexml($xml)->ownerDocument;
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $xmlString = $dom->saveXML();

        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/sitemap.xml';


        file_put_contents($filePath, $xmlString);
        $view = new View("SiteMap/showSiteMap", "front");

            $modal = [
                "title" => "SiteMap générée avec succès.",
                "content" => "Le fichier sitemap.xml a bien été généré",
                "redirect" => "/sitemap.xml"
            ];
            $view->assign("modal", $modal);
    }
}
