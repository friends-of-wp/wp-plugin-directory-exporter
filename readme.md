# Friends of WP - Plugin Retriever

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/friends-of-wp/wp-plugin-directory-exporter/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/friends-of-wp/wp-plugin-directory-exporter/?branch=develop)

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

Info: at the moment the retrievers are configured to fetch all plugins . if you want to change that just change the parameter in the retriever constructor or add a second parameter to the command line script with the number of pages you want to retrieve. 

````shell
php example/retrieve-as-csv.php plugins.csv 10
````
