---
title: "Grav Admin: Moderately Critical, Access Bypass, ADMIN-2018-001"
published: true
date: 11-07-2018
---

- ID: ADMIN-2018-001
- Project: Grav Admin plugin
- Date: 11-07-2018
- Risk-level: Moderately Critical

Admin tasks a have low level of access-specificity, DirectInstall especially should be allowed only by super-administrators.

### Advisory

Upgrade to v1.8.6 of the Admin-plugin. The vulnerability is more pertinant to sites with multiple or many users, less so for few or single users.

### Description

Certain tasks within the Admin-plugin interface were exposed to lower-level, registered, users. This allows users without the `admin.login` permissions to update the newsfeed, check for updates via GPM, process notifications, and reinstall packages. Users without `admin.pages` permissions could process Markdown, delete media, or change language. Users without the `admin.super` permissions, who can do all of this, could also perform direct installations via uploaded packages.

Users capable of performing low-level POST requests, with authenticated access to the Admin-plugin interface, could execute any of these tasks. Whilst the majority are not critical, especially direct installations would allow remote code execution.

### Versions affected

Versions prior to 1.8.6 of the Admin-plugin are affected, discovered in 1.8.5.

### Solution

Fixed in [Admin/Classes/AdminController](https://github.com/getgrav/grav-plugin-admin/blob/e87217a2426864669cc63740620f5bd702860874/classes/admincontroller.php), lines 879-882, 931-934, 981-984, 1024-1027, 1236-1244, 1873-1875, 2202-2205, 2231-2280 at [Jul 11, 2018, 11:30 PM GMT+2](https://github.com/getgrav/grav-plugin-admin/commit/e87217a2426864669cc63740620f5bd702860874).


### Attribution

Reported by [cure53-alex](https://github.com/cure53-alex), fixed by [Andy Miller](https://github.com/rhukster).