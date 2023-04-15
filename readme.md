# Friends of WP - Plugin Retriever

This is a simple library that helps to retrieve the information of all plugins that are located in the WordPress.org plugin directory.

## Installation



## Examples


## CSV 

Exports the plugins into a CSV file. Warning: currently there are more than 55.000 plugins in the directory. Excel and Google Spreadsheet are not able to process such file sizes.

````shell
php example/retrieve-as-csv.php plugins.csv
````
Info: at the moment the retrievers are configured to only fetch two pages. if you want to change that just change the parameter in the retriever constructor.
