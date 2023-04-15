<?php

namespace Fowp\WordPressPluginRetriever\Export;

/**
 * The exporter is used process the data that was fetched by the WordPress plugin
 * retriever.
 *
 * @author nils.langner@startwind.io
 */
interface Exporter
{
    /**
     * This function get called everytime the retriever fetched a new block of
     * plugins via API.
     *
     * @param array $pluginBlock
     * @param int $currentPage
     * @param int $maxPages
     */
    public function process(array $pluginBlock, int $currentPage, int $maxPages): void;

    /**
     * This function gets called when the retriever finished work.
     */
    public function finish(): void;
}
