# Active Directory PHP LDAPS connection #

I have been pulling my hair out trying to get, PHP to bind to Active Directory with Secure LDAP (LDAPS) on port 636.  This is in fact rediculously simple, so I can only assume everyone who's has worked this out doesn't want to share it with the rest of us!.

## Solution ##

In order to enable connections on LDAPS your domain must have a Root CA installed. Once installed LDAPS is now enabled.

This can be verified if you have the windows 2003 support tools installed and you can use lpd.exe to connect to your server on port 636 with ssl enabled.

Once this is done you can create the following directory
c:\openldap\sysconf
within that directory create a file called ldap.conf with the following line it in:

TLS\_REQCERT never

Restart IIS

and you done.