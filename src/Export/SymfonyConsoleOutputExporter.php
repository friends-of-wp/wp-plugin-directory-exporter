<?php

namespace Fowp\WordPressPluginRetriever\Export;

use Symfony\Component\Console\Output\OutputInterface;

/**
 * This exporter just echos the current status of the retriever process.
 *
 * @example
 *   - Retrieved plugin block 1 of 222.
 *
 * @author nils.langner@startwind.io
 */
class SymfonyConsoleOutputExporter implements Exporter
{
    private OutputInterface $output;

    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
        $this->output->writeln('');
    }

    /**
     * @inheritDoc
     */
    public function process(array $pluginBlock, int $currentPage, int $maxPages): void
    {
        $this->output->writeln(" - Retrieved plugin block " . $currentPage . ' of ' . $maxPages);
    }

    /**
     * @inheritDoc
     */
    public function finish(): void
    {
        $this->output->writeln('');
    }
}
