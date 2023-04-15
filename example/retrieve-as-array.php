<?php

use Fowp\WordPressPluginRetriever\Export\ArrayExporter;
use Fowp\WordPressPluginRetriever\Retriever;
use GuzzleHttp\Client;

include_once __DIR__ . '/../vendor/autoload.php';

$retriever = new Retriever(new Client());

$pluginExporter = new ArrayExporter();
$retriever->retrieve(400, 2, $pluginExporter);

foreach ($pluginExporter->getArray() as $number => $plugin) {
    echo " - " . $number . '. ' . $plugin['name'] . "\n";
}
