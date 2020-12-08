---
title: Developers
taxonomy:
    category: docs
---

When creating a plugin or theme for Grav, it is not only important to follow best practices, but to consider whether your work opens up any avenues of attack for potential intruders to a site. As Grav is a flat-file CMS and reliant on few dependencies, it is by nature more secure than similar systems, but insecure channels can be created inadvertently.

## Best practices

These are some recommendations for how to best create a secure and trustworthy extension to Grav, and should be considered essential knowledge for any theme- or plugin-author 

- When writing Twig-templates that output user-submitted information, always [escape the input](https://twig.sensiolabs.org/doc/2.x/filters/escape.html), this also includes [assets](https://twig.sensiolabs.org/doc/2.x/filters/raw.html).
- PHP-code should [sanitize](https://php.net/manual/en/filter.filters.sanitize.php) input and output.
- Blueprints should prefer preset options: When possible, give the user a set of choices rather than raw input.
- Be aware of how memory and processor-usage affect the extension, and avoid using system resources unjustifiably.
- Use Grav's ecosystem of functionalities and procedures rather than writing untested code, and consider battle-tested [third-party libraries](https://packagist.org/) if you need more.
- Do not use [unsafe PHP-functions](https://www.owasp.org/index.php/PHP_Security_Cheat_Sheet#Other_Injection_Cheat_Sheet). Also, read [PHP's own recommendations](https://php.net/manual/en/security.php) and the [PHP Security Consortium's guide](http://phpsec.org/projects/guide/) on the subject.
- Use error-specific [exceptions](https://php.net/manual/en/language.exceptions.php), not error reporting, for when a script should fail. Never include user, installation, or system data in exceptions or publicly visible debugging.

## Flat-file CMS

Grav has limited, modern [basic requirements](https://learn.getgrav.org/basics/requirements), and notably its flat-file architecture alleviates the need for a database. This is beneficial because a common attack-vector is a system's database. Sanitizing and securing input is a much harder task when the whole CMS relies on a database, and SQL-injection attacks can automatically try to execute SQL-statements even on remote hosts.
