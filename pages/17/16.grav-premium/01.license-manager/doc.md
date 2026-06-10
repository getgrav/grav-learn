---
title: License Manager
description: Install the License Manager plugin and your product licenses
taxonomy:
    category: docs
---

# License Manager

## Before you start

Before you can install a Premium Plugin, you are required to have the `License Manager` plugin installed. It is a free plugin available in GPM and can be installed like any other through the **Plugin** section of the admin plugin, or via command line.

```
$ bin/gpm install license-manager
```

After installation you should install your product license.  This was sent to you via email when you purchased the product.  If you have lost your license, you can retrieve it from the new [License Portal](https://licensing.getgrav.org/portal). Ensure you use the same email address you used to purchase the product.

### Installing a License

Once you have the `License Manager` plugin installed, you can install your license.  You can do this in two ways:

##### Via Admin Plugin

1. Navigate to the **License Manager** section of the admin plugin.
2. Click the **Install License** button.
3. Enter your license key and click **Install**.
4. You should see a success message and the license will be installed.

##### Via Command Line

You can also install your license via command line.  To do this, you need to run the following command:

```
$ bin/plugin license-manager add -s <product-slug> -l <license-key>
```

---
