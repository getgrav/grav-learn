---
title: Cloudflare Manager
description: Get started with Cloudflare Manager in few minutes
taxonomy:
    category: docs
---

# Cloudflare Manager

> [!IMPORTANT]
> Premium products require the free [License Manager](../license-manager) plugin. Install it and add your product license before installing this product.

## Installation

First ensure you are running the latest version of **Grav 1.7** (`-f` forces a refresh of the GPM index).

```
$ bin/gpm selfupgrade -f
```

Cloudflare Manager does not have any dependencies, so installation is a simple process of running the command:

```
$ bin/gpm install cloudflare
```

You can also install the plugin via the **Plugins** section in the admin plugin.

## Configuration

Cloudflare Manager has a very little configuration options, it only requires a `Zone ID` and an `API Token`.


![Configuration](configuration.png?class=image-shadow)

* **Plugin status** → Will enable or disable the entire plugin.

* **API Token** → A Cloudflare Token authorized to perform API actions. Follow the [Cloudflare: Create an API Token](#cloudflare-create-api-token) guide below to obtain one.

* **Zone ID** → The Zone ID associated to the domain you want to manage. Follow the [Cloudflare: Retrieve Zone ID](#cloudflare-retrieve-zone-id) guide below to retrieve it.

## Cloudflare: Create an API Token {#cloudflare-create-api-token}

In order for Cloudflare Manager to be able to communicate with Cloudflare, it requires that an API Token. This can be easily generated on the Cloudflare site:

1. First head to the [API Tokens Section in your Profile](https://dash.cloudflare.com/profile/api-tokens?target=_blank&rel=noopener%20noreferrer) and login
2. Under the **API Tokens** section, Click the `Create Token` button
3. Scroll to the **Create Custom Token** section and click `Get Started`

Now let's fill in the Custom Token:

1. **Token name**: Cloudflare Manager (acme.com)
2. **Permissions**: We are going to require 5 of the Zone permissions:
   
     | Type | Endpoint             | Permissions |
     |------|----------------------|-------------|
     | Zone | Zone Settings        | Edit        |
     | Zone | SSL and Certificates  | Edit        |
     | Zone | Cache Purge          | Purge       |
     | Zone | DNS                  | Edit        |
     | Zone | Analytics            | Read        |
3. **Zone Resources** (optional): This setting is optional but _HIGHLY_ encouraged. It allows to limit the API Token interaction with just the selected domain and nothing else.

     | Action | Zone                 | Domain   |
     |--------|----------------------|----------|
     | Zone   | Specific Zone         | acme.com |
4. Click **Continue to summary**
5. Review the summary and click **Create Token**
6. You will now be taken to the created token page. Click the _Copy_ button to copy the ID in your clipboard and paste it in the Cloudflare Manager API Token field.
   !!!! Once a token has been created, you won't able to recover it again. If you reload, or leave the page, you will have to start the process over. Make sure you copy to the clipboard the generated ID, and store it in Cloudflare Manager. For additional safety, save it someplace safe as well.

![API Token Settings](api-token.png?class=image-shadow,w-80per)

## Cloudflare: Retrieve Zone ID {#cloudflare-retrieve-zone-id}

The `Zone ID` is an ID created by Cloudflare that is associated to your domain name. Retrieving it is very simple.

1. First head to [Cloudflare Dashboard](https://dash.cloudflare.com/?target=_blank&rel=noopener%20noreferrer), login and then select the domain you want to manage (ie, **acme.com**).
2. Once selected you will find yourself in the Overview page with the analytics charts, scroll down and on the right sidebar you will see **API** -> **Zone ID**
3. Click the _Click to copy_ link to copy the ID in your clipboard and paste it in the Cloudflare Manager Zone ID field.
