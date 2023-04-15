<?php

namespace Fowp\WordPressPluginRetriever\Export;

/**
 * This exporter writes the retrieved plugins to a given CSV file.
 *
 * @author nils.langner@startwind.io
 */
class CsvExporter implements Exporter
{
    /**
     * The file resource of the opened CSV file
     *
     * @var resource
     */
    private $fileHandle;

    /**
     * True if it is the first run. We need that property as with the first run
     * we have to write the CSV header.
     *
     * @var bool
     */
    private bool $firstRun = true;

    /**
     * @param string $filename
     * @param string $fileMode
     */
    public function __construct(string $filename, string $fileMode = 'w')
    {
        $this->fileHandle = fopen($filename, $fileMode);
    }

    /**
     * @inheritDoc
     */
    public function process(array $pluginBlock, int $currentPage, int $maxPages): void
    {
        foreach ($pluginBlock as $plugin) {
            if ($this->firstRun) {
                $this->firstRun = false;
                fputcsv($this->fileHandle, array_keys($plugin));
            }

            $plugin['requires_plugins'] = implode(', ', $plugin['requires_plugins']);
            $plugin['tags'] = implode(', ', $plugin['tags']);

            $plugin['ratings'] = json_encode($plugin['ratings']);
            $plugin['icons'] = json_encode($plugin['icons']);

            fputcsv($this->fileHandle, $plugin);
        }
    }

    /**
     * @inheritDoc
     */
    public function finish(): void
    {
        fclose($this->fileHandle);
    }
}
