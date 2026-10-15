---
title: Pethost
menu: Pethost
visible: true
taxonomy:
    category: docs
---
# Pethost

[Pethost](https://pethost.dev) is a small cloud for personal projects that runs Docker Compose apps, each with its own domain and HTTPS. It has a one-click template for Grav.

To deploy Grav:

1. Open the [Grav template](https://pethost.dev/templates/grav/) and press Deploy on Pethost
2. Enter the admin's email and password, and create the project
3. Open `https://<your address>/admin` and sign in as `admin` with that password

The template runs the official `getgrav/grav` image. The admin account is created from the email and password you enter before the site starts answering, so the Admin's first-account page is never open to a visitor. Grav, with its `user/` folder, installed plugins and themes, lives on a persistent volume and is kept across restarts and updates.
