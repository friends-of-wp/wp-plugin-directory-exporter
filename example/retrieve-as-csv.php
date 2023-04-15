<?php

use Fowp\WordPressPluginRetriever\Export\CliStatusExporter;
use Fowp\WordPressPluginRetriever\Export\ComposeExporter;
use Fowp\WordPressPluginRetriever\Export\CsvExporter;
use Fowp\WordPressPluginRetriever\Retriever;
use GuzzleHttp\Client;

include_once __DIR__ . '/../vendor/autoload.php';

$retriever = new Retriever(new Client());

if (count($argv) === 1) {
    echo "\n";
    echo "  \e[0;31;41m Missing filename parameter \e[0m\n\n";
    echo "   Usage:   php " . $argv[0] . " [file name] [number of pages (optional)]\n";
    echo "   Example: php " . $argv[0] . ' filename.csv 222';
    echo "\n";
    die;
}

if (array_key_exists(2, $argv)) {
    $numberOfPages = $argv[2];
} else {
    $numberOfPages = -1;
}

$composeExporter = new ComposeExporter();
$composeExporter->addExporter(new CsvExporter($argv[1]));
$composeExporter->addExporter(new CliStatusExporter());

$retriever->retrieve(400, $numberOfPages, $composeExporter);
