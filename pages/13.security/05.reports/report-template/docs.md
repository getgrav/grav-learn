---
title: "Report Template"
published: false
date: 17-06-2017
---

Short details including ID, Project's Full Name, Date, Risk-level. Eg:

- ID: CORE-2017-001
- Project: Grav Core
- Date: 17-06-2017
- Risk-level: Less Critical

Summary. Eg. "REST-API is publicly exposed without authentication required."

Title is "PROJECT_FULL: LEVEL, TARGET, ID", eg. `Grav Core: Less Critical, Access Bypass, CORE-2017-001`, where ID is "ID: PROJECT_SHORT-YEAR-INT(3)", eg. `CORE-2017-001`. ID should be incremented following previous report within the project, year. Date should be in [Grav-parsable format](https://learn.getgrav.org/content/headers#date).

### Advisory

What users should do to solve the issue or to prevent the vulnerability. Eg. "Update to v1.2.2 of Grav Core", "Change PHP settings to `safe_mode = On`", "Ensure Server-configuration prevents access via HTTP/1.1".

### Description

What the vulnerability exposes, why it is insecure, and how it would be used. Eg. "Public requests to /api could modify a page with a `POST` or `PATCH` request, without being authenticated."

### Versions affected

Specific versions of Grav Core affected, including backward SemVer-ranges such as `1.1.x` and current SemVer-ranges such as `1.2.x` and specific versions such as `1.2.2`. Eg. "Core `v1.1.x`, discovered in `v1.1.5`."

### Solution

How the vulnerability was fixed in code, with specific file-at-tag references, and what specific version afterwards has solved it, such as `1.2.2`. Eg. "Fixed in [Grav/Common/Page/Page](https://github.com/getgrav/grav/blob/1.1.4/system/src/Grav/Common/Page/Page.php#L94-L97), lines 94-97 at v1.1.4."

### Attribution

Who reported the issue, who solved the issue, who coordinated the effort to solve the issue. Eg:

Reported by [John Doe](https://en.wikipedia.org/wiki/John_Doe), fixed by [Foo](https://en.wikipedia.org/wiki/Placeholder_name#Computing), [Bar](https://en.wikipedia.org/wiki/Placeholder_name#Computing), [Alice](https://en.wikipedia.org/wiki/Placeholder_name#Computing), and [Bob](https://en.wikipedia.org/wiki/Placeholder_name#Computing). Coordinated by the [core team](https://getgrav.org/about).
