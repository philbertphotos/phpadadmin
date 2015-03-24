# Installation #

## Step 1 ##

  * Download from http://www.php.net/downloads.php
  * Unzip php directory to root of your C: drive
  * from the PHP directory copy the php.ini-reccommended to C:\windows direcotry and rename it to php.ini
  * Uncomment the windows include path under "Paths and Direcotries" ( Line 515 on current build )
    * So it reads
```
include_path = ".;c:\php\includes"
```
  * set cgi.force\_redirect to 1 this is done by uncommenting the existing line ( Line 540 on current build )
    * So it reads:
```
cgi.force_redirect = 1 
```
  * Enable the PHP Ldap module this is done by uncommenting the extension under the "Windows Extensions" ( Line 650 on current build)
    * So it Reads:
`extension=php_ldap.dll`
  * Add the PHP directory to the windows path
    * right click My Computer on the server
    * Click the Advanced tab
    * Select PATH from the system variables section
    * Click Edit and add:
```
C:\php; 
```
note: this last point requires a server reboot which will be done in the next step.

## Step 2 ##

  * Assumption here
    * IS6
    * ou are going to install php-AD-admin in the default website ( C:\inetpub\wwwroot\ )
    * he php directory in the root of you C: Drive i.e. C:\php
  * pen Internet INformation Services (IIS) Manager
  * xpand the Web Service Extensions
    * ight click Web Service Extensions
    * elect Add a new Web Service extension
    * he new web service Extension window will appear
    * n Extension name enter PHP
    * n required files click add
    * hen add the following path
    * C:\php\php5isapi.dll `
    * lick ok
    * heck the box marked Set extension status to allowed

Expand the Default Web Site folder

  * ight click the Default Web Site
  * elect Properties
  * elect the Documents Tab
    * lick Add
    * nder Default content page: add index.php
    * lick ok
  * elect the Home Directory Tab
    * nder Application settings Set Execute Permissions to Scripts Only
    * nder Application settings select configuration
    * lick Add
    * ext to Executable enter the following Path:
    * :\php\php5isapi.dll
    * ext to extension enter .php
    * lick ok
    * lick ok
  * elect the Directory Security
    * nder Authentication and access control
    * elect Edit
    * ake sure the only option selected is Integrated Windows authenication
    * lick ok
  * lick ok