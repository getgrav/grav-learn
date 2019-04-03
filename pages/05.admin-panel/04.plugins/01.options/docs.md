---
title: Options
taxonomy:
    category: docs
routes:
    aliases:
      - '/admin-panel/plugin-options'
process:
    twig: true
---

![Admin Options](grav-options1.png?width=2546&classes=shadow)

The Admin Panel plugin has a set of options of its own accessible in the **Plugins** area of the admin. To reach them, simply navigate to **Plugins > Admin Panel** and select the title link for the plugin called **Admin Panel**. This will open a page filled with useful options to help you customize your experience with the Admin.

### Plugin Information

![Admin Options](grav-options2.png?width=1964&classes=shadow)

The top of the Admin Panel options page gives you some information about the Admin Panel plugin. This includes the plugin author, homepage, and license, in addition to other links and information to help you find additional information and report any bugs.

This is a pretty standard feature in any plugin's options page.

### Basics

![Admin Options](grav-options3.png?width=1416&classes=shadow)

The **Basics** section of this page gives you a set of options to help you define your experience within the Admin. This includes being able to change the text that appears at the top of the sidebar, create a custom path to the administrator, and more.

We've broken down these options, and what they do, below.

[div class="table table-keycol"]
| Option                          | Description                                                                                                                                 |
| :-----                          | :-----                                                                                                                                      |
| Enable Admin Caching            | Caching in the admin can be **Enabled** or **Disabled** here. This allows you to disable admin caching without affecting front end caching. |
| Administrator Path              | Changing the path to the administrator is done here. The default path is `/admin`, but you can make it whatever you'd like from this field. |
| Logo Text                       | This is where you define the text that appears at the top of the administrator's sidebar.                                                   |
| Body Classes                    | Want to give the body of your admin a different look? You can add body class(es) here. Separate multiple classes with a space.              |
| Sidebar Activation              | Choose between **Tab** and **Hover** methods of expanding the sidebar.                                                                      |
| Hover Delay                     | Set the delay time your cursor needs to hover over the compressed sidebar to expand in **Hover** mode.                                      |
| Sidebar Size                    | Choose between **Automatic** and **Small** as your default sidebar size.                                                                    |
| Edit Mode                       | Choose your default content editor. By default, the options are **Normal** and **Expert**.                                                  |
| Use Google Fonts                | Use Google custom fonts.  Disable this to use Helvetica. Useful when using Cyrillic and other languages with unsupported characters.        |
| Show GitHub Link                | **Enable** or **Disable** display of the "Found an issue? Please report it on GitHub." message.                                             |
| Automatically Check for Updates | Choose to automatically check for updates to the **Admin Panel** plugin.                                                                    |
| Session Timeout                 | Set the session timeout (in seconds) here.                                                                                                  |
| Warn on Page Delete             | **Enable** or **Disable** a warning that asks you to confirm an action that results in a page's deletion.                                   |
[/div]

### Dashboard

![Admin Options](grav-options4.png?width=1068&classes=shadow)

This section of the page lets you customize the items that appear in the main dashboard of the admin. Not a fan of the News Feed and want to get rid of it? Want to streamline your dashboard down to one or two sections you love? This is where you can do that.

[div class="table table-keycol"]
| Option                    | Description                                                                                                  |
| :-----                    | :-----                                                                                                       |
| Maintenance Widget        | **Enable** or **Disable** the display of the **Maintenance** area of the main Dashboard page in the Admin.   |
| Statistics Widget         | **Enable** or **Disable** the display of the **Statistics** area of the main Dashboard page in the Admin.    |
| Notifications Feed Widget | **Enable** or **Disable** the display of the **Notifications** area of the main Dashboard page in the Admin. |
| News Feed Widget          | **Enable** or **Disable** the display of the **News Feed** area of the main Dashboard page in the Admin.     |
| Latest Pages Widget       | **Enable** or **Disable** the display of the **Latest Pages** area of the main Dashboard page in the Admin.  |
[/div]

### Notifications

![Admin Options](grav-options5.png?width=1062&classes=shadow)

You can enable or disable specific types of notifications from this section. You can turn off feed update notifications, as well as notifications for plugins and/or themes.

[div class="table table-keycol"]
| Option                  | Description                                                           |
| :-----                  | :-----                                                                |
| Feed Notifications      | **Enable** or **Disable** feed-based notifications in the admin.      |
| Dashboard Notifications | **Enable** or **Disable** dashboard-based notifications in the admin. |
| Plugins Notifications   | **Enable** or **Disable** plugins-based notifications in the admin.   |
| Themes Notifications    | **Enable** or **Disable** themes-based notifications in the admin.    |
[/div]

### Popularity

![Admin Options](grav-options6.png?width=1928&classes=shadow)

One of the Admin's great features is its ability to track and display traffic information from the Admin's dashboard. This section of the Admin plugin's options gives you the ability to enable or disable traffic tracking, and configure how that data is displayed.

[div class="table table-keycol"]
| Option           | Description                                                                                        |
| :-----           | :-----                                                                                             |
| Visitor tracking | You can **Enable** or **Disable** the visitor tracking feature here.                               |
| Days of stats    | This field lets you set the number of days of visitor data kept in the graph before being dropped. |
| Ignore           | Ignore traffic to specific URLs in your site. For example `/test` or `/modular`                    |
[/div]