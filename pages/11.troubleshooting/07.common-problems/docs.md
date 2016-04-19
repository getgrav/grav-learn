---
title: Common Problems
taxonomy:
    category: docs
---

Here you can find information on problems and issues raised on [Grav forum](http://getgrav.org/forum) and in the [Gitter Chat room](https://gitter.im/getgrav/grav) that occur frequently enough that we thought we would save time and list the problem and the relevant solution in one easy to find location.

1. [Call to a member function set() on null](#call-to-a-member-function-set-on-null)
2. [Cannot connect to the GPM](#cannot-connect-to-the-gpm)

### Call to a member function set() on null

**Problem:** We removed some code to optimize GPM in Grav 1.0.0-rc.6, however this code was causing invalid plugins to be skipped.  However, certain people had extra folders that were not valid plugins in their `user/plugins/` folder.  This tripped up GPM causing the error message: `Call to a member function set() on null` to be returned for all GPM methods and also in the details of some of the Ajax calls made by the admin plugin.

**Solution:** The easiest fix is simply to remove those extraneous folders.  The full solution that automatically skips these invalid plugins will be available in 1.0.0-rc.7.

### Cannot connect to the GPM

**Problem:** The GPM cannot be reached, and you get this error in the Admin panel

**Solution:** 

First, make sure PHP has cURL and OpenSSL installed. You can check this in the Admin panel, in Configuration -> Info. You should see a "OpenSSL" section with `OpenSSL support: enabled`. Same for cURL, a section with `cURL support: enabled`.

If this is ok, make sure you're not behind a proxy. If so, [configure it](/basics/grav-configuration#system-configuration) in the Grav System configuration and [make sure there are no issues with the connection](/troubleshooting/proxy).

Then, [check your permissions](/troubleshooting/permissions).

If at this point it's still not working, get in touch, or report back if you were pointed here via chat/forum.

Also, check the CLI command is working, by opening a SSH connection to the server and running `bin/gpm index` and check if it's just inside Admin that you get this error, or in the command line too.
