This feature will allow a user to reset their own password by logging on as a known user (Selfservice user).  The Selfservice users password will be set to never expire and be simple to remember, i.e. password.

Having a well known user with a simple password presents an obvious security risk. To mitigate this risk the selfservice user will be segragated away from normal users within that active directory and placed within its own OU.  This OU will have a group policy attached to it, the group policy will change the default UI i.e. explorer.exe to Internet Explorer in Kiosk mode and force internet explorer to open our password self service page.

  * User Configuration
    * Administrative Templates
      * System
        * Custom user interface -> Set this to "C:\program files\internet explorer\iexplorer.exe" -k http:\\path
        * Run only allowed Windows Applications -> Add only iexplore.exe
        * System/Ctrl+Alt+Del Options
          * Remove Change Password -> enabled
          * Remove Task Manager -> enabled
      * Windows Components
        * Internet Explorer
          * Browser Menus
            * Disable Context Menu -> enabled
            * File menu: Disable closing the brwser and explorer windows -> enabled