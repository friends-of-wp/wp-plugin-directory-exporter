<?php

namespace Fowp\WordPressPluginRetriever\Export;

/**
 * This exporter combines a group of exporters that all are processed.
 *
 * @author nils.langner@startwind.io
 */
class ComposeExporter implements Exporter
{
    /**
     * List of exportes that are called
     *
     * @var Exporter[]
     */
    private array $exporters;

    /**
     * Add a new exporter to the composed exporter.
     *
     * @param Exporter $exporter
     * @return void
     */
    public function addExporter(Exporter $exporter): void
    {
        $this->exporters[] = $exporter;
    }

    /**
     * @inheritDoc
     */
    public function process(array $pluginBlock, int $currentPage, int $maxPages): void
    {
        foreach ($this->exporters as $exporter) {
            $exporter->process($pluginBlock, $currentPage, $maxPages);
        }
    }

    /**
     * @inheritDoc
     */
    public function finish(): void
    {
        foreach ($this->exporters as $exporter) {
            $exporter->finish();
        }
    }
}
