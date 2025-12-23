---
title: Profile
taxonomy:
    category: docs
routes:
    aliases:
      - '/admin-panel/profile'
process:
    twig: true
---

![Admin Profile](grav-profile.png?width=2030&classes=shadow)

The profile page in the admin enables you to view and update your individual profile settings. This is where your avatar, email address, name, language, and more are set. For administrators, this is also where you can adjust the groups and permission levels for individual users.

Accessing the profile page is simple. Once you are logged in to the admin, you can access your profile by selecting the area of the sidebar with your avatar image and name. This will take you directly to your own profile.

Additionally, administrators will enjoy the ease of jumping to another user's profile page by appending `admin/user/example` to their site's URL. Replacing `example` with the username of the user they wish to edit profile information and/or permissions for.

### Profile Photo

![Admin Profile](grav-profile2.png?width=1678&classes=shadow)

The **Profile** area of the admin gives you a quick, styled look at your avatar, name, and title. Your avatar is automatically generated through [Gravatar](http://en.gravatar.com/), a global avatar service that enables you to upload a single profile image and use it across multiple sites and services.

![Admin Profile](grav-profile2b.png?width=1670&classes=shadow)

If you don't have an image uploaded to Gravatar, or if you'd prefer to use an image of your choosing, you can upload an image here by dragging and dropping the image file into the **Drop Your Files Here or Click This Area** section of the page. You can also click the area to bring up a file chooser that will enable you to find, select, and upload an image file from your system.

Once you have a new image uploaded, simply select the **Save** button in the upper-right corner of the page.

### Account

![Admin Profile](grav-profile3.png?width=1660&classes=shadow)

The **Account** section of the profile page is where you can update your contact information, name, language, and more. You are not able to edit your **Username** here, as this is tied directly to where your user information is stored, but you can edit anything else you need to.

### 2-Factor Authentication

![Admin Profile](grav-profile5.png?width=918&classes=shadow)

**2-Factor Authentication** provides an extra layer of security for your website. Find out more about this feature in the [**Security**](../../security/2fa) area of this guide.

### Access Levels

![Admin Profile](grav-profile4.png?width=1814&classes=shadow)

Administrators will find the permissions area especially useful. This is where you can configure exactly what a user will be able to access and do within the administrator.

Here is a quick breakdown of the permissions options and what they enable someone to do.

[div class="table table-striped table-keycol"]
| Option                         | Description                                                                                                      |
| :-----                         | :-----                                                                                                           |
| **admin.super**                | Designates the user as a super admin, giving them the ability to see and configure all areas of the site.        |
| **admin.login**                | Enables the user to log in to the admin. This must be set to **Yes** to enable the user to log in.               |
| **admin.cache**                | Gives the user access to the cache reset buttons.                                                                |
| **admin.configuration**        | Gives the user access to the **Configuration** area of the admin. This does not include any tabs or subsections. |
| **admin.configuration_system** | Gives the user access to the **System** tab in the **Configuration** area of the admin.                          |
| **admin.configuration_site**   | Gives the user access to the **Site** tab in the **Configuration** area of the admin.                            |
| **admin.configuration_media**  | Gives the user access to the **Media** tab in the **Configuration** area of the admin.                           |
| **admin.configuration_info**   | Gives the user access to the **Info** tab in the **Configuration** area of the admin.                            |
| **admin.pages**                | Gives the user access to the **Pages** area of the admin.                                                        |
| **admin.maintenance**          | Gives the user the ability to access the **Maintenance** area of the **Dashboard**.                              |
| **admin.statistics**           | Gives the user the ability to access the **Statistics** area of the **Dashboard**.                               |
| **admin.plugins**              | Gives the user access to the **Plugins** area of the admin.                                                      |
| **admin.themes**               | Gives the user access to the **Themes** area of the admin.                                                       |
| **admin.users**                | Enables the user to access and edit other users' profile information. This does not include permissions.         |
| **site.login**                 | Enables the user to log in to the front end.                                                                     |
[/div]