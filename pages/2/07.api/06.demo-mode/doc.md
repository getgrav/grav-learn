---
title: Demo Mode
taxonomy:
    category: docs
---
# Demo Mode

Demo mode lets you put a Grav site online for anyone to try. Visitors sign in to Admin2 with a shared account, look at everything, and change only what you allow. The site then resets itself to a saved starting state on a timer, so whatever visitors do is gone a few minutes later.

> [!IMPORTANT]
> Demo mode is for a **dedicated demo site**: a copy of Grav set up only to be shown to the public, with sample content, the demo account and your own admin account. It is not a way to give someone a limited account on a real, working site. Resets roll back real content, and demo accounts can read things a real site would want private, such as the list of accounts. For limited access on a working site, use ordinary [permissions](/2/api/authentication#permissions) instead.

> [!NOTE]
> The create, edit and delete grants, the settings grants, `allow_routes`, `escape_html`, `include_code`, `extra_roots` and `demo:status` need API plugin **1.0.54** or newer. Earlier versions only had `api.pages.write` and `api.media.write`, let demo accounts edit pages and media by default, and refused demo accounts at sign-in.

## How it works

Demo mode is turned on **per account**, not for the whole site. Any account with the **Demo Mode** permission (`access.api.demo`) is a demo account. Your own admin account is not affected, so you can keep looking after the demo site while visitors use it.

A demo account:

- can open every screen and read everything its other permissions allow (it is usually also a super user, so that is everything),
- is refused every change except the ones listed in `demo.writable`,
- never sees server paths, logs, backups or the audit trail.

Two more pieces make a public demo work:

- the **baseline**, a saved copy of the folders a demo account can change, taken when the site is in the state you want every visitor to start from, and
- **resets**, which put those folders back to the baseline every `demo.reset_interval` minutes, automatically or when you run one by hand.

The demo settings live in the API plugin's settings, on the **Demo Mode** tab, or under `demo:` in `user/config/plugins/api.yaml`. They do nothing until an account has the Demo Mode permission.

## Setting up a demo

### 1. Create the demo account

The demo account is an ordinary Grav account with two permissions: **API Super User** (`access.api.super`), so it can see every screen, and **Demo Mode** (`access.api.demo`), which takes away every change you don't allow.

> [!WARNING]
> Until the Demo Mode permission is added, the account is a full super user. Create it disabled, add Demo Mode, and only then enable it and publish the password.

From the command line:

```bash
bin/plugin login new-user -u demo -e demo@example.com -N "Demo Visitor" -P a --admin-type api -s disabled
```

`-P a --admin-type api` gives the account Admin2 access as a super user. Leave out `-p` and the command asks for the password, so it doesn't end up in your shell history. The password has to meet the site's password policy (`pwd_regex` in the System configuration), so a short one like `demo` is refused unless you relax the policy.

Then open `user/accounts/demo.yaml`, add `demo: true` under `access.api`, and set `state` to `enabled`:

```yaml
# user/accounts/demo.yaml
email: demo@example.com
fullname: 'Demo Visitor'
state: enabled
access:
  api:
    login: true
    super: true
    demo: true
```

In Admin2 you can do the same under **Users**: create the account with **Enabled** off, turn on **API Super User** and **Demo Mode (read-only account)** in its permissions, save, then enable it.

Some things to know about the demo account:

- **It is shared.** Everyone who signs in with it is the same user, and visitors can't change its password, profile, avatar, two-factor settings or API keys, because users are always refused (see [What is always refused](#what-is-always-refused)).
- **You can have more than one.** Every account with Demo Mode is a demo account, and they all get the same `demo.writable` grants, which are site-wide.
- **It doesn't have to be super.** Leave out `super` for a demo that only shows part of the admin. The account then needs `api.access` and the read permissions for the areas it should see, like any other account. Demo mode only ever takes permissions away.
- **Tell visitors how to sign in.** Put the username and password on the site's home page or wherever you send people.

### 2. Choose what visitors may change

With nothing listed in `demo.writable`, the default, the demo is read-only: visitors can look around but every Save, Upload and Delete is refused. A read-only demo has nothing to reset, so you can skip the baseline and resets entirely.

To let visitors try things, list the grants you want:

| Grant | In the settings form | Lets a demo account |
|---|---|---|
| `api.pages.create` | Create pages | create, copy and translate pages |
| `api.pages.update` | Edit pages | edit, move, reorder, publish and unpublish pages |
| `api.pages.delete` | Delete pages | delete pages |
| `api.media.upload` | Upload media | upload media and create media folders |
| `api.media.update` | Edit media details | rename media, reorder it and edit its metadata |
| `api.media.delete` | Delete media | delete media |
| `api.config.site` | Change site settings | change the site settings (`site.yaml`) |
| `api.config.plugins` | Change plugin settings | change plugin settings |
| `api.config.themes` | Change theme settings | change theme settings |

`api.pages.write`, `api.media.write` and `api.config.write` (**Everything on pages**, **Everything on media** and **Site, plugin and theme settings** in the form) are shorthand for the three grants in each group.

A demo where visitors can write and edit pages and add images, but never delete anything:

```yaml
demo:
  writable:
    - api.pages.create
    - api.pages.update
    - api.media.upload
```

Admin2 follows the grants. With **Edit pages** but not **Delete pages**, the page editor offers Save but no Delete. If a visitor does reach an action that isn't allowed, the API refuses it and Admin2 shows a warning that changes are disabled in the demo.

### 3. Prepare the starting content

Set the site up exactly as every visitor should find it: the pages, images and settings you want to show off. Sign in with your own account for this, not the demo account.

Everything in the folders a reset restores goes into the baseline as it is, so tidy up first. Remove test pages and leftover uploads, and if the demo account has already been in use, check that no visitor changes are still there (`bin/plugin api demo:status` lists them once a baseline exists).

### 4. Save the baseline

```bash
bin/plugin api demo:baseline
```

The command prints the folders it saved, such as `media, pages`, and the reset interval. Automatic resets start from this moment: the first one is due `reset_interval` minutes later. See [The baseline](#the-baseline) for what it holds and when to save it again.

### 5. Turn on automatic resets

With the default settings, resets already happen on their own: the first API request after the interval has passed starts one. For resets that run on time even when nobody is using Admin2, add the Grav scheduler to the server's crontab:

```bash
* * * * * cd /path/to/grav && bin/grav scheduler 1>> /dev/null 2>&1
```

See [Automatic resets](#automatic-resets) for how the two work together.

### 6. Check it

```bash
bin/plugin api demo:status
```

This lists what demo accounts may change, which folders a reset restores, when the baseline was saved, when the last and next resets are, and the files added, changed or removed since the baseline. It shows the first 20 files under each heading; add `--all` for every one.

Then sign in with the demo account in a private window. Admin2 shows a banner across the top: "Read-only demo" for a read-only demo, or how often changes reset and a countdown to the next reset once a baseline exists. Try an action you allowed and one you didn't, and wait for a reset to check the change is undone.

## The baseline

The baseline is the starting state every reset goes back to. It is a zip of the folders a reset restores, taken by `demo:baseline` (or `POST /demo/baseline` over the API), and kept at `user/data/api/demo/baseline.zip`. When it was saved is recorded next to it in `user/data/api/demo/state.json`.

### What is in it

Only the folders a reset restores, worked out from your settings when you save it:

| Settings | Folders saved |
|---|---|
| `api.pages.*` grants | `user/pages` |
| `api.media.*` grants | `user/pages` (page media) and `user/media` (site media) |
| `api.config.*` grants | the settings a demo account may change, from `user/config` and each environment's settings folder |
| `include_code: true` | `user/plugins` and `user/themes` |
| `extra_roots` | each folder listed |

A folder that doesn't exist on disk is left out. The baseline is not a backup of the site: accounts, `user/data`, plugins, themes and settings are only in it when the table above says so. Use Grav's own backups for the rest.

These are never in it:

- `user/data/api`, which holds API keys, the audit log and the demo's own files,
- symlinks directly inside a saved folder or one level down, such as a symlinked plugin in `user/plugins` or a symlinked page folder like `user/pages/01.home`. Resets leave them exactly as they are,
- in a settings folder, every file a demo account can't change. With only `api.config.plugins` granted, the baseline holds `user/config/plugins` and nothing else from `user/config`, so `system.yaml`, `site.yaml`, and the API plugin's own settings stay yours.

With nothing granted and neither `include_code` nor `extra_roots` set, there is nothing to save: `demo:baseline` stops with "Nothing to capture" and the demo simply stays read-only without resets.

### Saving it again

Saving a new baseline replaces the old one and restarts the reset timer. Save it again whenever any of these happens:

- **You change the demo content.** A reset puts back the baseline, so any change you make yourself to the folders it restores, pages and media included, is undone by the next reset unless you save a new baseline first.
- **You deploy an update** to the restored folders (with git, rsync or a deploy pipeline). Otherwise the next reset rolls the deploy back.
- **You change `writable`, `include_code` or `extra_roots`.** A folder that isn't in the baseline is left alone by resets, so a newly granted folder is never reset until you save again. Widening the settings grants without a new baseline is worse: the old baseline doesn't hold the newly granted settings files, so a reset can remove them.
- **You update plugins or themes** on a demo with `include_code: true`. Otherwise every reset puts the old versions back.

`demo:status` is the quickest way to check: everything under Changed, Added and Removed is what the next reset will undo.

### Updating the demo content safely

A reset can fire while you are still editing and throw your work away. To update a live demo:

1. Pause resets: turn off **Reset On Request** and **Reset On Schedule** in the API settings (`demo.reset_on_request: false`, `demo.reset_on_schedule: false`). These settings are yours, demo accounts can't change them, and resets never touch them.
2. Stop visitors from changing things while you work: disable the demo account, or run `bin/plugin api demo:reset` first to start from a clean state.
3. Make your changes with your own account.
4. Run `bin/plugin api demo:status` and check that the changes listed are yours.
5. Run `bin/plugin api demo:baseline`.
6. Turn both reset settings back on, and enable the demo account again if you disabled it.

### Keeping or moving a baseline

The baseline is a plain zip with one top-level folder per saved folder (`pages/`, `media/`, `config/`, `environments/<name>/`, `plugins/`, `themes/`, or the path of an extra folder). You can keep a copy of it as a known-good starting point. When you copy the whole site to another server, `user/data/api/demo` goes with it and the demo carries on there. Copied on its own into a fresh site, a baseline without its `state.json` counts as overdue, so the first request resets straight away.

## Resets

A reset puts every folder in the baseline back the way it was when the baseline was saved. It undoes whatever visitors did, and anything else changed in those folders since, including your own edits.

### Automatic resets

Resets run every `demo.reset_interval` minutes (30 by default) after the last reset or the last baseline. Two triggers start them, and both are on by default:

- **On request** (`demo.reset_on_request`): the first API request after the interval has passed runs the reset before it is answered. It needs no cron and works on any host. Two things to know: only API requests count, so a site where nobody is using Admin2 resets the next time someone does, and the request that triggers it waits for the reset to finish, which takes longer on a large site.
- **On schedule** (`demo.reset_on_schedule`): a Grav scheduler job checks every minute and resets once the interval has passed, so resets happen on time with nobody waiting. This needs `bin/grav scheduler` running from cron (see [step 5](#5-turn-on-automatic-resets)). The job is called `api-demo-reset`, is only registered once a baseline exists, and shows in `bin/grav scheduler -j` and on the **Scheduler** tab of Admin2's **Tools**, where it can be disabled like any other job. Its output goes to `logs/api-demo-reset.out`.

With both on, a lock makes sure only one reset runs at a time: whichever arrives second skips. Nothing resets until a baseline exists, so both triggers are harmless on a site that isn't running a demo. Turn both off to stop automatic resets and only reset by hand.

### Resetting by hand

From the command line:

```bash
bin/plugin api demo:reset
```

It waits for an automatic reset that is already running, then resets. Without a baseline it stops with an error and changes nothing.

Over the API, with a super user's credentials (a demo account is always refused, even when it is super):

```bash
curl -X POST -H "X-API-Key: grav_abc123..." https://my-site.example/api/v1/demo/reset
```

See [Reset Demo](/2/api/endpoints/demo/reset-demo). A manual reset restarts the timer, so the next automatic one is a full interval later.

### What happens during a reset

1. A safety copy of the current state of the folders is saved first (see [Safety copies](#safety-copies)).
2. Each folder is rebuilt from the baseline next to the live one, and the two are swapped with a rename. Visitors never see a half-restored folder, and if anything fails, the live folder is left as it was and the failure is written to the Grav log (`logs/grav.log`, as `api.demo: ...`).
3. What a reset never touches (`user/data/api`, symlinks, settings demo accounts can't change) is moved across from the live folder unchanged.
4. Grav's cache is cleared, so the site shows the restored content at once.
5. The timer restarts.

### Restoring more folders

By default a reset restores only what the grants let visitors change. Two options add more:

- `demo.include_code: true` (**Reset plugins and themes**) also restores `user/plugins` and `user/themes`. Use it when visitors can change something that is stored there.
- `demo.extra_roots` (**Also reset**) lists more `user://` folders. Use it for what visitors do on the site itself rather than in Admin2: form submissions, comments, a plugin's own data, or sign-ups.

```yaml
demo:
  include_code: false
  extra_roots:
    - user://data/comments
    - user://data/flex-objects
```

Be specific with extra folders, because a reset puts **everything** in them back:

- `user://data` restores every plugin's data in it, not only what visitors added. (`user/data/api` is always left out.)
- `user://accounts` restores every account, yours included, so a password you changed or an account you added after the baseline is undone by the next reset. Only use it if visitors can sign up on the site.

An `extra_roots` entry that isn't a `user://` folder, overlaps a settings folder, or sits in `user/data/api` is ignored with a warning in the Grav log.

### Safety copies

Before every reset, the current state of the folders is saved to `user/data/api/demo/safety--<date>-<time>.zip`, in case the baseline itself was wrong. `demo.keep_safety_snapshots` (5 by default) sets how many are kept; older ones are deleted. Set it to `0` to keep none.

A safety copy has the same layout as the baseline, so to roll back to one, for example after saving a baseline while visitors' changes were still in place:

1. Pause resets as in [Updating the demo content safely](#updating-the-demo-content-safely).
2. Copy the safety zip over `user/data/api/demo/baseline.zip`.
3. Run `bin/plugin api demo:reset`. It takes a new safety copy first, then restores from the one you picked.
4. Check the site, run `bin/plugin api demo:baseline` to make it the baseline properly, and turn resets back on.

## What is always refused

Some things are refused whatever `writable` says, because a visitor who could change them could switch demo mode off, take over accounts, or run code on the server:

- users, groups and invitations, the demo account's own profile, password and API keys included
- installing, updating and removing plugins and themes
- system tools: cache, scheduler, backups, webhooks, logs and the audit trail
- the demo controls themselves (baseline and reset), even though the demo account is a super user
- the system, security, media, scheduler, backups, accounts and streams settings
- the settings of the API, Admin2, Login and Email plugins
- translation overrides and machine translation

So `api.config.plugins` lets visitors change, say, the Markdown Notices or Sitemap settings, but never the Login plugin's.

Everything else that saves to the server and isn't a page, media or settings change is refused too, unless you list it in `allow_routes`: the dashboard layout, Admin2 preferences and branding, Flex Objects, report actions, plugin toolbar actions, and every plugin's own API routes.

## What demo accounts can see

Reads stay open so the demo shows the whole admin, but some are hidden:

- **Logs**, **backups** (listing, creating, downloading and deleting) and the **audit trail** are refused.
- Server paths and software in **System Info**, the cron command and server user in **Scheduler**, and scheduled job output show "(hidden in demo mode)".
- Secrets in settings, such as passwords and API keys, are masked for every account, demo or not.

A super demo account can also read the **Users** and **Groups** pages, with every account's username, full name, email address and permissions. That is part of showing the whole admin, and another reason demo mode belongs on a dedicated demo site: keep only the demo account and your own admin account there, with details you don't mind showing. To hide those pages as well, leave `super` off the demo account and don't give it `api.users.read`.

## Pages visitors edit

A public demo that lets visitors edit pages lets them put anything on those pages, and those pages are public. Two rules keep that safe:

- With `demo.escape_html` on (the default, **Show HTML as text** in the form), pages a demo account saves show any raw HTML as text, so a visitor can't add scripts, iframes or hidden links to the site. Markdown, code blocks and images work as normal. The API does this by setting `markdown.escape_markup: true` in the saved page's frontmatter, and the next reset puts the original page back.
- A demo account can never save a page that runs Twig, whatever `escape_html` is set to. If the site runs Twig in every page or in frontmatter, demo accounts can't save pages at all, and with `escape_html` on they also can't save a page that turns Markdown off.

Only pages a demo account saves are affected. Your own saves work as usual.

## Plugin routes and Flex Objects

Writes to a plugin's own API routes are refused for demo accounts by default, because the API can't know what they change. List the ones visitors should be able to use in `demo.allow_routes`, as `METHOD /path` or just `/path` (any method), below the API prefix. `*` matches anything, slashes included:

```yaml
demo:
  allow_routes:
    - 'POST /courses/*/progress'
    - '/quiz/*'
```

A route listed here passes the plugin's own permission checks for demo accounts. It can't open any of the routes in [What is always refused](#what-is-always-refused), and it can't open pages, media or settings routes either. Those only open through `writable`.

If the plugin keeps what visitors do in a folder, add that folder to `extra_roots` so resets clear it too.

Flex Objects work the same way: their API routes (`/flex-objects/...`) can be opened with `allow_routes`, with their data folder in `extra_roots`. Admin2 itself keeps Flex Objects read-only for demo accounts, so this only helps a custom frontend or app that uses the API.

## Troubleshooting

**`demo:baseline` says "Nothing to capture".** Nothing is granted in `demo.writable`, and neither `include_code` nor `extra_roots` adds a folder. That is a read-only demo, which doesn't need a baseline.

**The banner has no countdown.** No baseline has been saved yet, so no reset is due. Run `bin/plugin api demo:baseline`.

**Resets don't happen on time.** With only **Reset On Request**, a reset waits for the next API request. Add the scheduler to cron, check `api-demo-reset` is listed in `bin/grav scheduler -j` and not disabled, and look in `logs/api-demo-reset.out` and `logs/grav.log` for errors.

**My own changes keep disappearing.** They are in a folder the reset restores and were made after the baseline. Save a new baseline after changing the demo content, as in [Updating the demo content safely](#updating-the-demo-content-safely).

**A visitor's change survived a reset.** It is in a folder the baseline doesn't hold: a newly granted folder, or plugin data that needs `extra_roots`. Check "A reset restores" in `demo:status`, add what's missing, and save the baseline again.

**Visitors can't save a page they should be able to.** Check the grant is in `demo.writable`. If it is, the page runs Twig, or the site runs Twig in every page or in frontmatter, or the page turns Markdown off while `escape_html` is on. Those are refused for demo accounts on purpose.

**The demo account can't sign in.** On API plugin versions before 1.0.54, demo accounts were refused on every request. Update the API plugin.

## Settings reference

All under `demo:` in `user/config/plugins/api.yaml`:

| Setting | Default | |
|---|---|---|
| `writable` | `[]` | What demo accounts may change. Empty is a read-only demo. See [Choose what visitors may change](#2-choose-what-visitors-may-change). |
| `allow_routes` | `[]` | Plugin routes demo accounts may write to. See [Plugin routes and Flex Objects](#plugin-routes-and-flex-objects). |
| `escape_html` | `true` | Show raw HTML as text in pages demo accounts save. |
| `include_code` | `false` | Also restore `user/plugins` and `user/themes` on every reset. |
| `extra_roots` | `[]` | More `user://` folders to restore on every reset. |
| `reset_interval` | `30` | Minutes between resets. |
| `reset_on_request` | `true` | Reset on the first API request after the interval. |
| `reset_on_schedule` | `true` | Register a scheduler job that resets after the interval. |
| `keep_safety_snapshots` | `5` | Safety copies kept before resets. `0` keeps none. |

## Commands

| Command | |
|---|---|
| `bin/plugin api demo:baseline` | Save the current state of the folders a reset restores as the baseline, and restart the timer. |
| `bin/plugin api demo:status [--all]` | Show grants, reset timing and what has changed since the baseline. |
| `bin/plugin api demo:reset` | Reset to the baseline now, and restart the timer. |

The same actions are available over the API, see [Demo Mode endpoints](/2/api/endpoints/demo). Baseline and reset need a super user and always refuse demo accounts.
