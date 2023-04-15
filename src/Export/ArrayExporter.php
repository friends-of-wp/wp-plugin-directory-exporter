<?php

namespace Fowp\WordPressPluginRetriever\Export;

/**
 * This exporter returns all retrieved plugins as an array.
 *
 * WARNING: This array can get quite big and can cause out of memory exceptions
 * if PHP only has 128 MB of memory. If you want to process the data it is recommended
 * to write a special exporter or to increase the usable memory.
 *
 * @author nils.langner@startwind.io
 */
class ArrayExporter implements Exporter
{
    /**
     * List of all plugins that where retrieved so far.
     *
     * @var array
     */
    private array $plugins = [];

    /**
     * @inheritDoc
     */
    public function process(array $pluginBlock, int $currentPage, int $maxPages): void
    {
        $this->plugins = array_merge($this->plugins, $pluginBlock);
    }

    /**
     * @inheritDoc
     */
    public function finish(): void
    {

    }

    /**
     * Return all retrieved plugins in array structure.
     *
     * @return array
     */
    public function getArray(): array
    {
        return $this->plugins;
    }
}
