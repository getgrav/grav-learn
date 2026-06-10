---
title: Email Office365
description: Install, Configure, and Use the Email Office365 Plugin
taxonomy:
    category: docs
---

# Email Office365

> [!IMPORTANT]
> Premium products require the free [License Manager](../license-manager) plugin. Install it and add your product license before installing this product.

## Installation

Installing the Email Office365 plugin can be done in one of three ways: The GPM (Grav Package Manager) installation method lets you quickly install the plugin with a simple terminal command, the manual method lets you do so via a zip file, and the admin method lets you do so via the Admin Plugin.

### GPM Installation (Preferred)

To install the plugin via the [GPM](http://learn.getgrav.org/advanced/grav-gpm), through your system's terminal (also called the command line), navigate to the root of your Grav installation, and enter:

```
bin/gpm install email-office365
```

This will install the Email Office365 plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/email-office365`.

### Manual Installation

To install the plugin manually, download the zip-version of this repository and unzip it under `/your/site/grav/user/plugins`. Then rename the folder to `email-office365`. You can find these files on [GitHub](https://github.com/yourname/grav-plugin-email-office365).

You should now have all the plugin files under

```
/your/site/grav/user/plugins/email-office365
```

### Admin Plugin

If you use the Admin Plugin, you can install the plugin directly by browsing the `Plugins` menu and clicking on the `Add` button.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/email-office365/email-office365.yaml` to `user/config/plugins/email-office365.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
client_id: ''
client_secret: ''
tenant_id: ''
test_email: ''
```

Note that if you use the Admin Plugin, a file with your configuration named email-office365.yaml will be saved in the `user/config/plugins/` folder once the configuration is saved in the Admin.

## Azure AD Application Setup

Before using this plugin, you need to register an application in the Azure portal. Here's a quick guide:

1. Sign in to the [Azure portal](https://portal.azure.com/)
2. Search for and select "Azure Active Directory"
3. Under "Manage", select "App registrations" > "New registration"
4. Provide a name for your application
5. For "Supported account types", select "Accounts in this organizational directory only"
6. For Redirect URI, set the type to "Web" and enter your callback URL (e.g., `https://yourdomain.com/office365oauth/callback`)
7. Click "Register"
8. Note down the "Application (client) ID" and "Directory (tenant) ID" from the overview page
9. Under "Manage", select "Certificates & secrets"
10. Click "New client secret", provide a description, select an expiration period, and click "Add"
11. Copy the secret value immediately (you won't be able to see it again)
12. Under "Manage", select "API permissions"
13. Click "Add a permission" > "Microsoft Graph" > "Delegated permissions"
14. Search for and select `Mail.Send`, `User.Read` and `offline_access` permissions
15. Click "Add permissions"
16. Click "Grant admin consent for [your organization]"

## Usage

After installing and configuring the plugin with your Azure AD application credentials:

1. Go to your Grav admin panel > Plugins > Email Office365
2. Configure the plugin with your Azure AD application credentials
3. Click the "Authorize" button to get a refresh token (you'll be redirected to Microsoft to grant permission)
4. After authorization, you'll be redirected back to your Grav site with the refresh token saved automatically
5. Configure the Email plugin to use `Office365` as the mailer engine
6. Test the setup by sending a test email

## Email Plugin Configuration

You need to configure the Email plugin to use the Office365 mailer:

```yaml
mailer:
  engine: office365
```

## Troubleshooting

If you encounter issues with sending emails:

1. Check the refresh token is properly saved
2. Verify your Azure AD application has the correct permissions
3. Ensure your redirect URI matches exactly what's configured in Azure
4. Try regenerating the refresh token by clicking the "Authorize" button again
5. Check Grav logs for detailed error messages
