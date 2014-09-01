---
title: Server Error
taxonomy:
    category: docs
---

> We're sorry! The server encountered an internal error and was unable to complete your request. Please try again later.
> <cite>Grav</cite>

This page only deals with server errors similar to the above quote. If your error message has different title and text in it, please continue to the next page.

Server errors are almost always caused by misconfiguration of Grav. Something unexpected happened and because of that Grav is unable to recover and serve the page.

Usually, server errors are caused by wrong file permissions, which will prevent Grav from caching the configuration, resized images or the template files. Or maybe Grav can not read some of the configuration files because there is a parsing error in it.

>>>>>> If you have the **Grav Administration** plugin installed, you can browse the Server Errors from there. By clicking the individual errors you can see the debug pages even if the debugger was turned off.

## Tracy says: Unable to log error.

> Tracy says: Unable to log error. Check if directory is writable and path is absolute.

This error means that something bad happened, and in addition, the system was unable to log it.

In order to solve the real issue, you need to make the **system/logs** directory writable and try again. If you were successful, you should see a similar error message, but with different explanation under it.

>>> Before moving on, make sure that you do not have other file permission issues like this.

## Installation and configuration issues

- system requirements
- file permissions
- installation issues
- configuration issues

## Troubleshooting

- Enable debugging

or

- Check /system/logs

```
error.log
exception.log
exception-2014-07-15-12-39-09-adb68ae49e04637b9a8ae517173a9bad.html
```

### error.log

Non-fatal errors, warnings and notices.

### exception.log

Fatal server errors.

### exception-2014-07-15-12-39-09-adb68ae49e04637b9a8ae517173a9bad.html

HTML representation of a single error, basically what you would have seen in the debug mode.
