<?php

namespace Fowp\WordPressPluginRetriever\Export;

/**
 * This exporter just echos the current status of the retriever process.
 *
 * @example
 *   - Retrieved plugin block 1 of 222.
 *
 * @author nils.langner@startwind.io
 */
class CliStatusExporter implements Exporter
{
    public function __construct()
    {
        echo "\n";
    }

    /**
     * @inheritDoc
     */
    public function process(array $pluginBlock, int $currentPage, int $maxPages): void
    {
        echo " - Retrieved plugin block " . $currentPage . ' of ' . $maxPages . ".\n";
    }

    /**
     * @inheritDoc
     */
    public function finish(): void
    {
        echo "\n";
    }
}
