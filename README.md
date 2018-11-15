## ms2Kanboard

Create tasks in Kanboard from minishop2 orders.

Change task column with order status change. 

## Quick start

* Install MODX Revolution

* Upload this package into the `Extras` directory in the root of site

```
php ~/www/Extras/ms2Kanboard/rename_it.php anyOtherName
```
*path on your site may differs*


[![](https://file.modx.pro/files/3/a/b/3ab2753b9e8b6c09a4ca0da819db37b6s.jpg)](https://file.modx.pro/files/3/a/b/3ab2753b9e8b6c09a4ca0da819db37b6.png) [![](https://file.modx.pro/files/c/1/a/c1afbb8988ab358a0b400cdcdb0391d4s.jpg)](https://file.modx.pro/files/c/1/a/c1afbb8988ab358a0b400cdcdb0391d4.png)

orders from minishop2 to tasks in kanboard

guzzle installation is requared

Path to install: MODX_CORE_PATH.'components/guzzle/'

system events for plugin:

msOnChangeOrderStatus

msOnCreateOrder