---
title: htaccess
taxonomy:
    category: docs
---

Grav comes complete with its own `.htaccess` file. This file enables Grav to operate properly and should be kept in its root folder. You may encounter issues that can be resolved using the `.htaccess` file.

Apache is one of the most popular server solutions available today. It's free, and widely available just about everywhere. Unfortunately, Apache isn't perfect, and sometimes the `.htaccess` file can give you a headache. Don't worry, it's almost always fixable.

## How to Edit .htaccess in Windows and macOS

The .htaccess file is a hidden file, meaning that by default, users of macOS and Windows will be unable to see this file in the file manager (Finder) unless they enable hidden files to be viewed.

In **macOS**:

1. Open **Terminal**.
2. Enter `defaults write com.apple.finder AppleShowAllFiles YES` into the **Terminal** and hit **return**.
3. Enter `killall Finder` into the **Terminal** and hit **return**.

You should now be able to see the `.htaccess` file in the root directory of the unzipped Grav folder. You can return your settings to their original hidden state by repeating the process and entering `NO` at the end of step 2 instead of `YES`.

In **Windows 10**:

1. Open **File Explorer**.
2. Select the **View** tab.
3. Check the box next to **Hidden Items**.

Unchecking this box will hide these hidden files again, returning the **File Explorer** to its default state.

## Testing .htaccess

Let's say you go to your browser and navigate to your new Grav site and... it's not there! A big, bold message stating `Not Found` is where your beautiful Grav site should be. This is not a fun problem to have, but the solution could be as simple as adjusting your `.htaccess` file.

The first step in troubleshooting issues with the `.htaccess` file should be making sure that the file is actually being picked up and utilized by the server. Make sure the file is in the root directory of your Grav site where it should be, and that it is properly named `.htaccess` with a leading (`.`) period.

If the file is there, your next step is to give it a test and make sure your server is picking it up. This is a simple process that involves adding a single line at the top of the file.

To test, open up the `.htaccess` file in a text editor. Then, you'll want to create a new first line and place the text `Test.` and save.

![HTACCESS Test](test.png?classes=border,shadow)

This error doesn't solve your problem by itself, but it does let you know that the `.htaccess` in the root directory of your Grav site is the one your server is parsing.

If you don't receive this error, make sure you have the file in your site's root directory. This should be the file included with the original Grav install. This is one of the reasons we recommend unpacking the zipped Grav directory and moving that directory where you want your site to be on your server, rather than copying the files and pasting them. This ensures that all of the files and the directory structure is kept the same, avoiding issues like these.

## Troubleshooting a Broken .htaccess

If nothing changed when you edited the .htaccess file, you may need to make sure that `.htaccess` is enabled. If not, your server won't even look for it in the first place.

Here's what you can do:

Find and open `httpd.conf` or `apache.conf` file in a text editor. In Windows, this will probably be Notepad or a text editor made for development. Word processors can add unnecessary information that could make the problem worse.

Next, you'll want to look for the `Directory` area of the file. There should be a block of text like this:

[prism classes="language-text line-numbers"]
    #
    # AllowOverride controls what directives may be placed in .htaccess files.
    # It can be "All", "None", or any combination of the keywords:
    #   Options FileInfo AuthConfig Limit
    #
    AllowOverride All
[/prism]

If `AllowOverride` is set to `None` or anything other than `All`, you will need to change it to `All` and save. This change will require a reset of your Apache server to register.

Once you have done this, give your site another test.

We've also included troubleshooting guides to help you should you encounter a [404](../page-not-found) or [500](../internal-server-error) internal server error while working with Grav.
