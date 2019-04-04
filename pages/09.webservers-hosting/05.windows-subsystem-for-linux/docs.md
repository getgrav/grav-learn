---
title: Windows Subsystem for Linux
---
The Windows Subsystem for Linux lets developers run GNU/Linux environment -- including most command-line tools, utilities, and applications -- directly on Windows, unmodified, without the overhead of a virtual machine.

You can:
- Choose your favorite GNU/Linux distributions from the Windows Store.
- Run common command-line free software such as grep, sed, awk, or other ELF-64 binaries.
- Run Bash shell scripts and GNU/Linux command-line applications including:
  - Tools: vim, emacs, tmux
  - Languages: Javascript/node.js, Ruby, Python, C/C++, C# & F#, Rust, Go, etc.
  - Services: sshd, MySQL, Apache, lighttpd
- Install additional software using own GNU/Linux distribution package manager.
- Invoke Windows applications using a Unix-like command-line shell.
- Invoke GNU/Linux applications on Windows.

For more information visit: [Windows Subsustem for Linux Documentation](https://docs.microsoft.com/en-us/windows/wsl/about)

## Installing Windows Subsystem for Linux
The installation of *Windows Subsystem for Linux* is well described by Microsoft's own document [Install the Windows Subsystem for Linux](https://docs.microsoft.com/en-us/windows/wsl/install-win10?target=_blank).
Instead of the standard Ubuntu distro mentioned in the installation guide, search for and choose the latest Ubuntu 18.04 LTS.

To initialize and update the Ubuntu installation follow [Initializing a newly installed distro](https://docs.microsoft.com/en-us/windows/wsl/initialize-distro?target=_blank).
This step may be skipped if you have already initialized the Ubuntu distro in the previous step.

! An important aspect of WSL is that **Windows tools** are **not** able to access files stored inside Ubuntu. However, Ubuntu can (almost) freely read/write the Windows filesystem. Therefore, files that need to be accessed by Windows tools (e.g. your IDE, Backup) need to be stored on the Windows filesystem.<br><br>
! When accessing the Windows filesystem from within the bash shell, you need to prepend the path with `/mnt/c/`. Although not required, it is best to use the exact same file path casing when creating symlinks.


## Installing Apache
Use the following command in the bash shell to install Apache:

[prism classes="language-bash command-line"]
sudo apt install apache2
[/prism]

!!! The terminal used by WSL does not support the pasting of text as you are used to. Use **right-click** for pasting.

Create a project folder for your websites. For reasons mentioned above, this folder needs to be outside of the WSL filesystem. You could use for example: `C:/Users/<Username>/Documents/Development/Web/webroot`, or simply `C:/webroot`.

In Ubunto, create a symbolic link to the `webroot` folder.

[prism classes="language-bash command-line"]
sudo ln -s /mnt/c/your/path/to/webroot /var/www/webroot
[/prism]

Open the Apache default virtual host configuration file:

[prism classes="language-bash command-line"]
sudo nano /etc/apache2/sites-available/000-default.conf
[/prism]

!!! Remove existing content by keeping the `Shift`-key pressed and scroll down using the `↓`-key. Then press `Ctrl`<small>+</small>`K` to cut the selection.

Insert the following VirtualHost configuration:

[prism classes="language-apacheconf line-numbers"]
<VirtualHost *:80>

    ServerName localhost

    ServerAdmin webmaster@localhost
    DocumentRoot  /var/www/webroot

    <Directory /var/www/>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined

</VirtualHost>
[/prism]

!!! Save the file by pressing `Ctrl`<small>+</small>`O`, and hit `Enter` to confirm. Exit with `Ctrl`<small>+</small>`X`.<br>
!!! (In the command bar: `^` meants `Ctrl` and `M` means `Alt`)

Open your favorite Windows editor/IDE, and create an `index.html` file in your webroot folder with the following content:

[prism classes="language-html line-numbers"]
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>It works!</title>
</head>
<body>
  <h1>It works!</h1>
</body>
</html>
[/prism]

Start the Apache service:

[prism classes="language-bash command-line"]
sudo service apache2 start
[/prism]

!! You will probably get the following known error message [which you can ignore](https://github.com/Microsoft/WSL/issues/1953?target=_blank):<br>
!! *(92)Protocol not available: AH00076: Failed to enable APR_TCP_DEFER_ACCEPT*

Open [http://localhost](http://localhost?target=_blank) in your browser and you should see the text 'It works!'.

For your future Grav sites to work properly, the Apache module `rewrite` needs to be enabled.

[prism classes="language-bash command-line"]
sudo a2enmod rewrite
[/prism]

## Installing PHP
Use the following command to install the latest PHP version:

[prism classes="language-bash command-line"]
sudo apt install php
[/prism]

To verify that PHP is installed and checking its version, run the following command:

[prism classes="language-bash command-line"]
php -v
[/prism]
You should get a response similar to this:

[prism classes="language-bash"]
PHP 7.2.7-0ubuntu0.18.04.2 (cli) (built: Jul  4 2018 16:55:24) ( NTS )
Copyright (c) 1997-2018 The PHP Group
Zend Engine v3.2.0, Copyright (c) 1998-2018 Zend Technologies
[/prism]

To meet Grav's PHP requirements, a few extra PHP extensions need to be installed:

[prism classes="language-bash command-line"]
sudo apt install php-mbstring php-gd php-curl php-xml php-zip
[/prism]

Restart Apache to pick up the changes:

[prism classes="language-bash command-line"]
sudo service apache2 restart
[/prism]

## Installing Grav
You can install Grav either from within Windows or from within Ubuntu.

#### Option 1: Windows
Install Grav by downloading the ZIP package and extracting it:
1. Download the latest-and-greatest [**Grav**](https://getgrav.org/download/core/grav/latest?target=_blank) or [**Grav + Admin**](https://getgrav.org/download/core/grav-admin/latest?target=_blank) package.
1. Extract the ZIP file into the webroot you have created before.
1. Rename the extracted folder to `mysite`.
1. Open [http://localhost/mysite](http://localhost/mysite?target=_blank) in the browser and you should have a working Grav installation.

#### Option 2: Ubuntu
Run the following commands to install Grav inside the default webroot of Apache:

[prism classes="language-bash command-line"]
wget -O grav.zip https://getgrav.org/download/core/grav/latest
sudo apt install unzip  # unzip is not installed by default on WSL/Ubuntu
unzip grav.zip -d /var/www/webroot
mv /var/www/webroot/grav /var/www/webroot/mysite
[/prism]

Open [http://localhost/mysite](http://localhost/mysite?target=_blank) in the browser and you should have a working Grav installation.

For other installation options, visit Grav's [Installation](https://learn.getgrav.org/basics/installation?target=_blank) documentation.

## Installing XDebug (optional)
If you are a developer and want to develop your own plugins and themes, you ~~probably~~ inevitably need to debug your code at some point...

Install XDebug using the following command:

[prism classes="language-bash command-line"]
sudo apt install php-xdebug
[/prism]

XDebug needs to be enabled in `php.ini`.<br>
Open the editor:

[prism classes="language-bash command-line"]
sudo nano /etc/php/7.2/apache2/php.ini
[/prism]

And add the following lines to the end of the file:

[prism classes="language-text"]
[XDebug]
xdebug.remote_enable = 1
[/prism]

!!! In Nano, you can use `Alt`<small>+</small>`/` to jump to the bottom of the file.

Restart Apache again:

[prism classes="language-bash command-line"]
sudo service apache2 restart
[/prism]

#### Activating debugger
In order to start debugging, you first need to activate the debugger on the server. For this, you need to set a special GET/POST or COOKIE parameter. You can do that [manually](https://xdebug.org/docs/remote?target=_blank#starting), but it is much more convenient to use a browser extension. It allows you to enable the debugger with the click of a button. When the extension is active, it sends the XDEBUG_SESSION cookie directly, instead of going through XDEBUG_SESSION_START. Below you can find a table with the link to the relevant extension for your browser.


| Browser       | Helper extension  |
| ------------- |-------------|-----|
|Chrome         |[Xdebug Helper](https://chrome.google.com/extensions/detail/eadndfjplgieldjbigjakmdgkmoaaaoc?target=_blank)|
|Firefox|[Xdebug Helper](https://addons.mozilla.org/en-US/firefox/addon/xdebug-helper-for-firefox/?target=_blank) or [The easiest Xdebug](https://addons.mozilla.org/en-US/firefox/addon/the-easiest-xdebug/?target=_blank)|
|Opera  |[Xdebug launcher](https://addons.opera.com/addons/extensions/details/xdebug-launcher/?target=_blank)|

When you want to switch on/off debugging for a website, just toggle 'Debug' in the browser extention.

#### Launching debugger in Visual Studio Code (optional)
When using Vistual Studio Code, the default PHP debug launchers won't work when Apache/PHP is running in WSL, because of the file mappings.

Insert the following configuration into an already created PHP [launch configuration](https://code.visualstudio.com/docs/editor/debugging?target=_blank#_launch-configurations) in `.vscode/launch.json`:

[prism classes="language-json line-numbers"]
{
    "name": "LSW Listen for XDebug",
    "type": "php",
    "request": "launch",
    "port": 9000,
    "pathMappings": {
        "/mnt/c": "c:/",
    }
}
[/prism]

## Adding extra virtual hosts (optional)
During the different stages in the lifecycle of our site (development, testing, production) different Grav configurations may be needed. Take for example caching or asset pipelines. You might want to switch them off during development and switch them on when testing performance. For more information see the documentation on [Automatic Environment Configuration](https://learn.getgrav.org/advanced/environment-config?target=_blank#automatic-environment-configuration).
- Start an editor as Administrator and open file `C:/Windows/System32/drivers/etc/hosts`.
You could, for example, add the following hosts:

    [prism classes="language-bash"]
    127.0.0.1 mysite-dev
    127.0.0.1 mysite-prod
    [/prism]

    Hosts defined in Windows hosts file will automatically be available in `/etc/hosts` in WSL/Ubuntu.
- Create new VirtualHost config files in folder `/etc/apache2/sites-available`.
    [prism classes="language-bash command-line"]
    sudo nano /etc/apache2/sites-available/mysite-dev.conf
    [/prism]
    Past the following into the editor:
    [prism classes="language-apacheconf line-numbers"]
    <VirtualHost *:80>

        ServerName mysite-dev

        ServerAdmin webmaster@localhost
        DocumentRoot  /var/www/webroot/mysite

        <Directory /var/www/>
            Options Indexes FollowSymLinks
            AllowOverride All
            Require all granted
        </Directory>

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined

    </VirtualHost>
    [/prism]
Repeat the above commands for `mysite-prod.conf` and use `ServerName mysite-prod` as server.

Enable the new VirtualHosts in the Apache configuration:
[prism classes="language-bash command-line"]
sudo a2ensite mysite-*
sudo service apache2 reload
sudo service apache2 restart
[/prism]
Now you can point the browser to [http://mysite-dev](http://mysite-dev?target=_blank) and it will open the Grav installation at `C:/your/path/to/webroot/mysite` using the config files in folder `/user/mysite-dev/config/`.

## Automatically start Apache (optional)
For starting and stopping Apache, elevated privileges are required. And to be granted the elevated privileges, a password is requested. To prevent Ubuntu asking for a password you can grant yourself permanent elevated privileges for certain services.

Start the [visudo](http://manpages.ubuntu.com/manpages/trusty/man8/visudo.8.html?target=_blank) editor to edit the sudoer file:
[prism classes="language-bash command-line"]
sudo visudo -f /etc/sudoers.d/services
[/prism]
Copy the following lines into the editor:
[prism classes="language-bash"]
%sudo ALL=(root) NOPASSWD: /usr/sbin/service *
%wheel ALL=(root) NOPASSWD: /usr/sbin/service *
[/prism]

Apache can now be started with elevated privileges without providing a password.

To start Apache whenever an Ubuntu shell is started, the `sudo service apache2 start` command needs to be added to the `.bashrc` startup script. This script is run whenever you start a WSL terminal.
[prism classes="language-bash command-line"]
nano .bashrc
[/prism]
Add the following script to the end of the file:
[prism classes="language-apacheconf line-numbers"]
## Start apache2 if not running
status=`service apache2 status`
if [[ $status == *"apache2 is not running" ]]
then
  sudo service apache2 start
fi
[/prism]
And add the following to `.bash_logout` to stop Apache when closing the bash shell.
[prism classes="language-apacheconf line-numbers"]
## Stop apache2 if running
status=`service apache2 status`
if [[ $status == *"apache2 is running" ]]
then
  sudo service apache2 stop
fi
[/prism]

## Tips and Tricks

### GUI Linux terminal emulator
If you're not a fan of the default terminal experience and would like to install a "native" Linux GUI terminal, you might want to have a look at the article [Configuring a pretty and usable terminal emulator for WSL](https://blog.ropnop.com/configuring-a-pretty-and-usable-terminal-emulator-for-wsl/?target=_blank).

### Multiple websites, one Grav codebase
If you are like me and have multiple Grav websites deployed for separate projects, you might want to read the documentation on [Symbolic Links](https://learn.getgrav.org/cli-console/command-line-intro?target=_blank#symbolic-links) and on [Copying a Project](https://learn.getgrav.org/cli-console/grav-cli?target=_blank#copying-a-project) to create a symlinked copy of a single Grav core.