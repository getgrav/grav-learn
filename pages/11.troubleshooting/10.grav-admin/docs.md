---
title: Grav Admin
taxonomy:
    category: docs
---

Server errors are almost always caused by misconfiguration of Grav. 

Normally, when you have **Grav Administration** plugin installed, you can browse the Server Errors from there. By clicking the individual errors you can see the debug pages even if the debugger was turned off.

However, if upgrading to a new version of Grav unexpectedly breaks the **Grav Admininistration** interface (for example: conflict with an outdated plugin component), try the following command lines to force Grav to clean.

[prism classes="language-bash command-line"]
bin/grav cleancache
[/prism]

and

[prism classes="language-bash command-line"]
bin/grav cache
[/prism]

Then, try to access the Admin interface again.

## Installation and configuration issues

- system requirements
- file permissions
- installation issues
- configuration issues
