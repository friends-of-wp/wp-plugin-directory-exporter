<?php

namespace Fowp\WordPressPluginRetriever;

use Fowp\WordPressPluginRetriever\Export\Exporter;
use GuzzleHttp\Client;

/**
 * This retriever fetches plugin information from the WordPress.org plugin
 * directory.
 *
 * @author nils.langner@startwind.io
 */
class Retriever
{
    /**
     * The official API endpoint from the WordPress directory.
     */
    const WORDPRESS_API_ENDPOINT = 'https://api.wordpress.org/plugins/info/1.2/?action=query_plugins&request%5Bpage%5D=##pagenumber##&request%5Bper_page%5D=##perpage##';

    /**
     * The maximal number of pages that are in the directory. This depends
     * on the $requestsForPage parameter and will ne calculated while processing
     * the first response.
     *
     * @var int
     */
    private int $maxNumberOfPages = 888;

    /**
     * Guzzle http client used to retrieve the plugin information.
     *
     * @var Client
     */
    private Client $client;

    /**
     * The constructor
     *
     * If the client is not set the retriever will initiate a simple client
     * on its own.
     *
     * @param Client|null $client
     */
    public function __construct(Client $client = null)
    {
        if (is_null($client)) {
            $this->client = new Client();
        } else {
            $this->client = $client;
        }
    }

    /**
     * Use this function to retrieve all plugins from the WordPress.org directory.
     *
     * This function will not return any data. In order to process the data you have to use
     * an exporter.
     */
    public function retrieve(int $requestsPerPage = 400, int $maxPages = -1, Exporter $exporter = null): void
    {
        $page = 1;

        if ($maxPages === -1) $maxPages = 10000000;

        while ($page < $this->maxNumberOfPages && $page <= $maxPages) {
            $url = $this->getApiUrl($page, $requestsPerPage);
            $plainPluginBlock = $this->fetchPluginBlock($url);
            $this->maxNumberOfPages = $plainPluginBlock['info']['pages'];
            $exporter?->process($plainPluginBlock['plugins'], $page, $this->maxNumberOfPages);
            $page++;
        }

        $exporter?->finish();
    }

    /**
     * Fetch one single page / block from the WordPress endpoint.
     */
    private function fetchPluginBlock(string $url): array
    {
        $response = $this->client->request('GET', $url);
        $jsonString = ((string)$response->getBody());
        return json_decode($jsonString, true);
    }

    /**
     * Get the corresponding URL for the defined requests parameters.
     */
    private function getApiUrl(int $pageNumber, int $requestsPerPage): string
    {
        $url = str_replace('##pagenumber##', $pageNumber, self::WORDPRESS_API_ENDPOINT);
        $url = str_replace('##perpage##', $requestsPerPage, $url);

        return $url;
    }
}
