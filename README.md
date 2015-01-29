kblog_with_yii2
===================================

Not Just A Blog Based On Yii 2 Advanced Application Template


REQUIREMENTS
------------

The minimum requirement by this application template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

### Install from an Archive File

Extract the archive file downloaded from [Release](https://github.com/kangqf/kBlog_with_yii2/releases) to
a directory named `kBlog_with_yii2` that is directly under the Web root.*Please Install The Old Version Only
By This Way*.

Then follow the instructions given in "GETTING STARTED".


### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install the application using the following command:

~~~
php composer.phar global require "fxp/composer-asset-plugin:1.0.0"
php composer.phar create-project --prefer-dist --stability=dev kangqf/kblog_with_yii2 kblog
~~~


GETTING STARTED
---------------

After you install the application, you have to conduct the following steps to initialize
the installed application. You only need to do these once for all.

1. Run command `init` to initialize the application with a specific environment.
2. Create a new database and adjust the `components['db']` configuration in `common/config/main-local.php` accordingly.
3. Apply migrations with console command `yii migrate`. This will create tables needed for the application to work.
4. Set document roots of your Web server:

- for frontend `/path/to/yii-application/frontend/web/` and using the URL `http://frontend/`
- for backend `/path/to/yii-application/backend/web/` and using the URL `http://backend/`
- for backend `/path/to/yii-application/api/web/` and using the URL `http://api/`

