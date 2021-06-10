---
title: Reports
published: true
taxonomy:
    category: docs
content:
    items: '@self.children'
    order:
        by: date
        dir: desc
    limit: 10
    pagination: true
process:
    markdown: true
    twig: true
twig_first: true
---

Since GitHub now have support for security advisories for each repository, this is where you'll find up-to-date reports and policies. You can always find more details on [MITRE's CVE](https://cve.mitre.org/cgi-bin/cvekey.cgi?keyword=Grav)-program.

Most prominently, Grav itself and the Admin-plugin are what every other extension builds on, therefore their advisories and policies are most important to follow:

- Grav Core [Security Advisories](https://github.com/getgrav/grav/security/advisories) and [Security Policy](https://github.com/getgrav/grav/security/policy)
- Admin [Security Advisories](https://github.com/getgrav/grav-plugin-admin/security/advisories) and [Security Policy](https://github.com/getgrav/grav-plugin-admin/security/policy)
