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

Since GitHub now have support for security advisories for each repository, this is where you'll find up-to-date reports and policies. You can always find more details on [MITRE's CVE](https://cve.mitre.org/cgi-bin/cvekey.cgi?keyword=Grav)-program, and an overview on [CVE Details](https://www.cvedetails.com/vulnerability-list.php?vendor_id=20511&order=1&trc=9&sha=2d99a894afce93a4722e6f89c4baddfb1a6c010f).

Most prominently, Grav itself and the Admin-plugin are what every other extension builds on, therefore their advisories and policies are most important to follow:

- Grav Core [Security Advisories](https://github.com/getgrav/grav/security/advisories) and [Security Policy](https://github.com/getgrav/grav/security/policy)
- Admin [Security Advisories](https://github.com/getgrav/grav-plugin-admin/security/advisories) and [Security Policy](https://github.com/getgrav/grav-plugin-admin/security/policy)
