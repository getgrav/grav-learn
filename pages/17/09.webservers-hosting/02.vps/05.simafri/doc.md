---
title: Simafri
visible: true
taxonomy:
    category: docs
---
# Simafri

[Simafri](https://www.simafri.com/en/managed-vps/) offers managed VPS: you keep root access to the server, while Simafri handles its system and security updates, monitoring and encrypted nightly backups kept off the machine. Simafri publishes a [step-by-step guide](https://www.simafri.com/en/guides/self-host-grav/) to run Grav 2 there with the official `getgrav/grav` Docker image, tested with Grav 2.2.32 and PHP 8.4 on Ubuntu 24.04. In short:

## Install Grav with Docker Compose

With Docker Engine and its Compose plugin installed, create `/opt/grav/compose.yaml`. It publishes Grav on `127.0.0.1` only, for the reverse proxy:

[codesh=yaml]
services:
  grav:
    image: getgrav/grav:php8.4
    restart: unless-stopped
    ports:
      - "127.0.0.1:8101:80"
    volumes:
      - grav_site:/var/www/html

volumes:
  grav_site:
[/codesh]

Run `docker compose up -d` in `/opt/grav`. On its first start, the image installs the latest stable Grav with Admin Next in the volume.

## Create the administrator before going public

Until an account exists, every page redirects to `/admin`, where anyone can create the first administrator. Create yours from the command line while Grav is reachable on `127.0.0.1` only (the command asks for the password):

[codesh=bash]
docker compose exec -u www-data grav bin/plugin login new-user -u admin -e admin@example.com -P b -l en -N "Site Admin" -t "Administrator"
[/codesh]

## HTTPS with Caddy

Put Caddy in front, with `reverse_proxy 127.0.0.1:8101` in the site block of your domain. Grav 2 ignores the `X-Forwarded-*` headers by default, so add these lines to `user/config/system.yaml`: Grav then builds `https` links and marks its session cookie `secure`.

[codesh=yaml]
http_x_forwarded:
  protocol: true
  ip: true
[/codesh]

The guide also covers backing up and restoring the `user/` folder, `bin/grav backup`, and updates with `bin/gpm selfupgrade` and `bin/gpm update`, run in the container as `www-data`.
