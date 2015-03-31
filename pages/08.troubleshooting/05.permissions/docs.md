---
title: Permissions
taxonomy:
    category: docs
---

Depending on your hosting environment, permissions may or may not be an issue you need to concern yourself with.  The important thing to understand is that there is a potential for issue if the user you use to edit your files on the file-system is different from the user that PHP runs under (usually the webserver), or at the very least, the two users don't have **Read/Write** access to these files.

Being a file-based CMS, Grav needs to write to the file-system in order to create cache and log files. There are three main scenarios:

1. ##### PHP/Webserver runs with the same user that edits the files.  (Preferred)
   This is the usual approach used by most **shared hosting** setups and also this approach works great for local development also.  The blog post we wrote regarding [OS X Yosemite, Apache, and PHP](http://getgrav.org/blog/mac-os-x-apache-setup-multiple-php-versions) outlines how to configure Apache to run as your personal user account. This approach is not considered secure enough to use on a dedicated web host, so the second or third option should be used.

2. ##### PHP/Webserver runs with different accounts but same Group
   By using a shared Group between your user and PHP/Webserver account with `775` and `664` permissions you ensure that even though you have two different accounts, both will have **Read/Write** access to the files.  You should also probably set a `umask 0002` on the root so that new files are created with the proper permissions.

3. ##### Different accounts, fix permissions manually
   The last approach is to have completely different accounts and just update the ownership and permissions of the files after editing to ensure that the PHP/Webserver user can **Read/Write** appropriately.

A simple **permissions-fixing** shell script can be used to do this:

    #!/bin/sh
    chown joeblow:staff .
    chown -R joeblow:staff *
    find . -type f | xargs chmod 664
    find . -type d | xargs chmod 775
    find . -type d | xargs chmod +s
    umask 0002

You can use this file and edit as needed for the appropriate user and group that works for your setup.  What this script basically does, is:

1. Changes the user and group of the current directory to `joeblow` and `staff`
2. Changes all files and subfolder to `joeblow` and `staff` ownership
3. Finds all the files from the current directory down and sets the permissions to `664` so they are `RW` for User & Group and `R` for Others.
4. Finds all the folders from the current directory down and sets the permissions to `775` so they are `RWX` for User & Group and `RX` for Others.
5. Sets the **ownership** of all directories to ensure that User and Group changes are maintained
6. Sets the **umask** so that all new files are created with the correct `664` and `775` permissions.
