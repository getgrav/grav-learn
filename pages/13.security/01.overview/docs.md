---
title: Overview
taxonomy:
    category: docs
---

If you discover a possible security issue related to Grav or one of its extensions, please send an email to the core team at [contact@getgrav.org](mailto:contact@getgrav.org) and we'll address it as soon as possible.

Issues should not be publicly disclosed - including on GitHub, Discord, or the Discourse forum - before the core team has had a chance to examine it and contact the relevant parties to solve it. Also, if the issue is not a potential threat for the users of Grav, it should probably be submitted [as an issue](https://github.com/getgrav/grav/blob/develop/CONTRIBUTING.md#bug-reports) instead. If you are unsure, get in touch and we'll help you figure out where the report belongs.

## Submitting a report

When you have discovered a potential vulnerability in Grav's core or in one of its extensions, it is advisable that you follow due diligence in reporting it:

1. Include the **version numbers** of Grav and any installed extensions, as well as **which component** the issue relates to.
2. Describe the vulnerability in a **detailed and concise manner**, so that less time is spent on searching for its source.
3. Write down exact steps needed to **reproduce the environment** in which the vulnerability occurs: What settings are set in system.yaml, what content is created, and what system settings applied?
4. If possible, describe the source of the vulnerability and how to **patch it** so developers can both reconstruct and secure it.

### Responsible disclosure

Grav follows the _responsible disclosure_ model for submittal of discovered vulnerabilities. This means that once an issue is discovered, tested, and successfully demonstrated, the developer(s) should be allowed a period of time to patch the vulnerability before it is publicly disclosed. This is because finding and testing solutions to reported issues are time-consuming and time-sensitive, and Grav is an open-source project whose authors do not have unlimited time to dedicate to it. It is therefore recommended that you also propose how to solve the issue or patch it, if you have knowledge of the relevant code.

## Process of resolution

If your report is accurate and a new security issue is reproduced, the core team will address it as soon as possible. When this is done, the issue and its solution will be included in the [public repository of reports](/security/reports). You will be credited by name and with an optional link to your website/social media profile, but if you prefer you can request it be credited to a pseudonym or "anonymous reporter".

Reports and issues are kept private until the issue is resolved. In the case that the maintainer of an extension fails to address the issue in a timely manner, the extension is removed from the Grav Package Manner until it is resolved.

## Supported versions

Only the current `major.minor` version of Grav is supported. This means that patches are implemented in `major.minor.patch`, but not regressively backwards for older versions of Grav. Keeping your installation up-to-date is important, and many changes are beneficial even if not explicitly needed from a security perspective.

## Risk-levels

There are five levels of risk involved with Grav as a software:

- Highly Critical
- Critical
- Moderately Critical
- Less Critical
- Not Critical

These are calculated based on the "[Common Misuse Scoring System](https://www.nist.gov/news-events/news/2012/07/software-features-and-inherent-risks-nists-guide-rating-software)" (CMSS) by the [National Institute of Standards and Technology](https://www.nist.gov/) (NIST). For lack of an easily available calculator for Grav, use Drupal's [RiskCalc](https://security.drupal.org/riskcalc) ([notes](https://www.mydropwizard.com/blog/understanding-drupal-security-advisories-risk-calculator)).
