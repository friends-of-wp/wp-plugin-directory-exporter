# Friends of WP - Plugin Retriever

This is a simple library that helps to retrieve the information of all plugins that are located in the WordPress.org plugin directory.

## Installation

To install the Plugin Retriever you can use composer, clone the repository or just download the ZIP file.  

```shell
composer require friends-of-wp/pluginretriever
```

## Examples

We prepared some examples in the `/example` directory that are easy to understand and can be reused.

## CSV

Exports the plugins into a CSV file. Warning: currently there are more than 55.000 plugins in the directory. Excel and Google Spreadsheet are not able to process such file sizes.

````shell
php example/retrieve-as-csv.php plugins.csv
````
Info: at the moment the retrievers are configured to only fetch two pages. if you want to change that just change the parameter in the retriever constructor.
