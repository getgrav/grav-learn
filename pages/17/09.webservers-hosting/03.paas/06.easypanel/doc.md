---
title: Easypanel
menu: Easypanel
visible: true
taxonomy:
    category: docs
---
# Easypanel

[Easypanel](https://easypanel.io) is a self-hosted, Docker-based deployment platform similar in spirit to Dokku or Heroku, but managed through a web panel instead of the command line. It has a one-click deployment template for Grav.

The main advantages of using it would be:

* Self-hosted, so you control the cost of the VM it runs on
* One-click deploy from a template - no server setup or Dockerfile needed
* Persistent storage for your Grav site's `user/` and configuration is handled automatically via volumes
* Free SSL certificates via Let's Encrypt, built in
* Runs any other Docker-based service alongside your Grav site on the same VM

To deploy Grav:

1. Install Easypanel on a fresh VM by following their [documentation](https://easypanel.io/docs)
2. From your Easypanel dashboard, create a new project and deploy the [Grav template](https://easypanel.io/templates/grav)
3. Once deployed, open the domain Easypanel assigns to the service to complete the Grav Admin panel setup

Unlike the Dokku/Heroku approach described above, there's no need to manage a `composer.json` post-deploy script or worry about an ephemeral filesystem - the persistent volume keeps your site's `user/` folder (including installed plugins and themes) intact across restarts and updates.
