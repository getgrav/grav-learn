---
title: Dashboard
taxonomy:
    category: docs
process:
    twig: true
---

![Admin Dashboard](grav-dashboard.png?width=1264&classes=shadow)

The **Dashboard** serves as a hub of information for the **Administration Panel** plugin. From this one page, you can check traffic statistics, maintenance information, Grav updates, create new backups, see the latest page updates, as well as to quickly clear Grav's cache.

It's a starting point for your administrative experience.

!! The Dashboard content will change depending on the user permissions. For example, giving `access.admin.super` unlocks everything. If that access level is not granted, `access.admin.maintenance` allows cache clearing and updates. `access.admin.pages` allows access to pages. `access.admin.statistics` allows display of the site visitors stats.


### Cache and Updates Checking

![Admin Dashboard](grav-dashboard-cache.png?width=323px&classes=shadow)

Along the top of the Dashboard, you will find two buttons. The first of which initiates a clearing of the Grav cache. Clicking the main **Clear Cache** button will wipe the entire cache, including any caching of assets and images. Using the **drop-down** feature to the right, you can choose from specific types of cache clearing processes.

For example, if you only want to clear the **image cache** without disrupting any other cached data, you can do so here.

The second button initiates an update check for your site. This includes any supported plugins, themes, and Grav itself. If new updates are discovered, you receive a notification on the Dashboard. This isn't the only method Grav has for checking for new updates.

!! Update checks are also triggered whenever a new page in the admin is loaded, and cached for one day. If you clear all of Grav's cache and load a new page in the admin, an update check will automatically take place.

### Maintenance and Statistics

![Admin Dashboard](grav-dashboard-maintenance.png?width=1007&classes=shadow)

The **Maintenance** and **Statistics** sections give you quick access to important information about your site.

On the **Maintenance** side, you can see a percentage graph letting you know how many of Grav's bits and pieces are completely up-to-date.

![Admin Dashboard](grav-dashboard-maintenance-2.png?width=1009&classes=shadow)

If new updates are available, an <i class="fa fa-cloud-download"></i> **Update** button will appear that enables you to perform a one-click update for all plugins and themes. This button will not update Grav itself, which notifies you about a required update just above the Maintenance and Statistics sections.

You can update Grav's core by selecting the **Update Grav Now** button in its notification bar.

There is also a graph indicating how long the site has gone without being backed up. Selecting the <i class="fa fa-database"></i> **Backup** button will generate a zip file you can download and store as a backup for your site's data.

!! Backups are also stored in the `backup/` folder of your Grav install.  You can grab them via FTP or web manager tools provided by your hosting company.

The **Statistics** section displays simple, at-a-glance traffic data breaking down the number of visitors the front end of the site has received in the past day, week, and month (30 days). Statistics for the past week are displayed in a bar graph separated by days of the week.

### Latest Page Updates

![Admin Dashboard](grav-dashboard-latest.png?width=1006&classes=shadow)

The **Latest Page Updates** area of the admin gives you an at-a-glance view of the latest content changes made to pages in your Grav site. This list is sorted by most recently updated, and is generated each time you refresh the page. Selecting the title of a page in this list will take you directly to the page's editor in the admin.

The **Manage Pages** button takes you to the **Pages** administrative panel.
