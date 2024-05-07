---
title: User Accounts
taxonomy:
    category: docs
routes:
    aliases:
      - '/admin-panel/accounts-users'
process:
    twig: true
---

![User Listing](accounts-user1.png?width=2030&classes=shadow)

## User Profile

![User Profile](accounts-user1.png?width=2030&classes=shadow)

The profile page in the admin enables you to view and update your individual profile settings. This is where your avatar, email address, name, language, and more are set. For administrators, this is also where you can adjust the groups and permission levels for individual users.

Accessing the profile page is simple. Once you are logged in to the admin, you can access your profile by selecting the area of the sidebar with your avatar image and name. This will take you directly to your own profile.

Additionally, administrators will enjoy the ease of jumping to another user's profile page by appending `admin/user/example` to their site's URL. Replacing `example` with the username of the user they wish to edit profile information and/or permissions for.

### General Tab

#### Profile Photo

![User Photo](accounts-user1.png?width=1678&classes=shadow)

The **Profile** area of the admin gives you a quick, styled look at your avatar, name, and title. Your avatar is automatically generated through [Gravatar](http://en.gravatar.com/), a global avatar service that enables you to upload a single profile image and use it across multiple sites and services.

![User Photo](accounts-user1.png?width=1670&classes=shadow)

If you don't have an image uploaded to Gravatar, or if you'd prefer to use an image of your choosing, you can upload an image here by dragging and dropping the image file into the **Drop Your Files Here or Click This Area** section of the page. You can also click the area to bring up a file chooser that will enable you to find, select, and upload an image file from your system.

Once you have a new image uploaded, simply select the **Save** button in the upper-right corner of the page.

#### Account

![Account Section](accounts-user1.png?width=1660&classes=shadow)

The **Account** section of the profile page is where you can update your contact information, name, language, and more. You are not able to edit your **Username** here, as this is tied directly to where your user information is stored, but you can edit anything else you need to.

#### 2-Factor Authentication

![2-Factor Authentication](accounts-user1.png?width=918&classes=shadow)

**2-Factor Authentication** provides an extra layer of security for your website. Find out more about this feature in the [**Security**](../../security/2fa) area of this guide.

### Access Tab

![Access Tab](accounts-user1.png?width=1814&classes=shadow)

This tab is visible only for users who have permissions to manage users.

[div class="table table-striped table-keycol"]
| Option                                | Description                                                       |
| :-----                                | :-----                                                            |
| **Groups** | List of the [groups](/admin-panel/accounts/groups) user is part of. |
| **Permissions** | List of all permissions in your site. See [Group Permissions](/admin-panel/accounts/groups#permissions). |
[/div]
