---
title: Grav Server Error
taxonomy:
    category: docs
---

![](grav-server-error.png?classes=center)

Server errors are almost always caused by misconfiguration of Grav. Something unexpected happened and because of that Grav is unable to recover and serve the page.

When you see this message it means your server is running in `Production` mode to hide potentially sensitive information from displaying to your users.  The error itself will be stored in the `logs/grav.log` file.  Please examine this file to determine the exact nature of the error.

Possible reasons include:

* Server errors are caused by out-of-date configuration
* Incorrect file permissions which prevents Grav from writing data
* Changes in the file-system that Grav is not yet aware about
* Errors in parsing configuration due to invalidly formatted configuration files


!!! If you have the **Grav Administration** plugin installed, you can browse the Server Errors from there. By clicking the individual errors you can see the debug pages even if the debugger was turned off.

## Out-of-date configuration

The first thing you should do is flush the cache to ensure that the configuration is up to date:

[prism classes="language-bash command-line"]
bin/grav clear-cache
[/prism]

!! Before moving on, make sure that you do not have other file permission issues like this.

## Installation and configuration issues

- system requirements
- file permissions
- installation issues
- configuration issues
