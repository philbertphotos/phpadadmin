# Self Service Password GPO #

I have also had a dabble at creating a GPO for password change self service today, this was alot more simple than I had predicted.  Having created policies to secure Terminal/Citrix servers before, which can be a bit of a pain.


## Solution ##


Create an OU for you self service user. Create your new user i have used called mine  password, and then set the password and make it simple i.e. password and set it to never expire.

Create a Policy opbject for the new OU (using group policy management console http://www.microsoft.com/windowsserver2003/gpmc/default.mspx) and modify the following

User Configuration
> Administrative Templates
> > System
> > > Custom user interface -> Set this to "C:\program files\internet explorer\iexplore.exe" -k http:\\path


> Run only allowed Windows Applications -> Add only iexplore.exe

> System/Ctrl+Alt+Del Options
> > Remove Change Password -> enabled
> > Remove Task Manager -> enabled


> Windows Components
> > Internet Explorer
> > > Browser Menus
> > > > Disable Context Menu -> enabled
> > > > File menu: Disable closing the brwser and explorer windows -> enabled

With the above policy your self service password will be forced in to IE in Kiosk mode and the user can only browse the site you point it at.


> Note: if site contains links that will navigate out of its own site this will still work

Users are can only log out by pressing Ctrl+Alt+Del where they will only be presented with the options to log off or shutdown the machine.