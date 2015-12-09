---
title: Common Problems
taxonomy:
    category: docs
---

Here you can find information on problems and issues raised on [Grav forum](http://getgrav.org/forum) and in the [Gitter Chat room](https://gitter.im/getgrav/grav) that occur frequently enough that we thought we would save time and list the problem and the relevant solution in one easy to find location.

1. [Call to a member function set() on null](#call-to-a-member-function-set-on-null)


### Call to a member function set() on null

**Problem:** We removed some code to optimize GPM in Grav 1.0.0-rc.6, however this code was causing invalid plugins to be skipped.  However, certain people had extra folders that were not valid plugins in their `user/plugins/` folder.  This tripped up GPM causing the error message: `Call to a member function set() on null` to be returned for all GPM methods and also in the details of some of the Ajax calls made by the admin plugin.

**Solution:** The easiest fix is simply to remove those extraneous folders.  The full solution that automatically skips these invalid plugins will be available in 1.0.0-rc.7.


