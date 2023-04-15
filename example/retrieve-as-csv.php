<?php

use Fowp\WordPressPluginRetriever\Export\CliStatusExporter;
use Fowp\WordPressPluginRetriever\Export\ComposeExporter;
use Fowp\WordPressPluginRetriever\Export\CsvExporter;
use Fowp\WordPressPluginRetriever\Retriever;
use GuzzleHttp\Client;

include_once __DIR__ . '/../vendor/autoload.php';

$retriever = new Retriever(new Client());

if (count($argv) !== 2) {
    echo "\n";
    echo "  \e[0;31;41m Missing filename parameter \e[0m\n";
    echo "   Usage: php " . $argv[0] . ' csvFile.csv';
    echo "\n";
    die;
}

$composeExporter = new ComposeExporter();
$composeExporter->addExporter(new CsvExporter($argv[1]));
$composeExporter->addExporter(new CliStatusExporter());

$retriever->retrieve(400, 2, $composeExporter);
