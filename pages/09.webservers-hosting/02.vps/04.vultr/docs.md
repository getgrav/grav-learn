---
title: Vultr
localname: vultr.dev
twig_first: true
process:
    twig: true
taxonomy:
    category: docs
---

[Vultr](https://www.vultr.com) is another entry in the **SSD-Powered VPS** market and offers similar features and functionality as the other VPS providers, but for slightly less money. You get **100% SSD Storage**, **Ultra fast Intel CPUs** and **14 low latency locations**.

![](vultr.png?classes=center)

After creating an account and navigating to the **Vultr Control Manager**, click on the **Deploy** tab.  Leave the server type on **Compute Instances** and choose a location:

![](deploy.png?classes=center)

Next select the **Operating System** from the list available.  We have selected **Ubuntu 18.04 LTS** to be consistent with the other guides and because it's the latests, very popular, reliable, and well supported distribution.

For the **Server Size** you can pick a size that is appropriate for you but Grav will run great on any of them.  For the sake of this guide, we'll use the 1 CPU, 1GB memory option that is currently priced at $8/month.

![](os-and-server.png?classes=center)

You can choose any optional features you would like, and then provide a simple **Server Label** to identify the VPS instance.  We'll use `Grav`.  Then click **Place Order** to create and install the server.

![](manage-server.png?classes=center)

After a minute or so, your server should be ready and you can click the **manage** link next to your server in the list to get the server details.  On this page you will be shown a control panel for the server that lets you control the state, along with the initial root username and password.  You can can SSH via the command provided in this tab using the password you entered when you created the distribution instance. Public key authentication is recommended, and Vultur has [SSH public key authentication documentation](https://www.vultr.com/docs/using-your-ssh-key-to-login-to-non-root-users) that walks you through the steps required.

---

[plugin:content-inject](/webservers-hosting/vps/ubuntu-18.04)



