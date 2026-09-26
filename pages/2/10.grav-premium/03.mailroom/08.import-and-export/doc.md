---
title: Import and Export
taxonomy:
    category: docs
description: Bring a contact list in from another tool with column mapping, a preview and a dry run, the rules every row goes through, import:csv on the command line, and exporting subscribers as CSV.
---

# Import and Export

A site that can bring its audience in can take it out again. This page covers importing a CSV from another tool, in the admin or on the command line, and exporting the subscriber list. Both need `mailroom.manage`.

## Import a contact list

Open **Subscribers** and press **Import** ("Import a contact list").

1. **Choose a CSV file**: a comma or semicolon separated file with a header row. Exports from EmailOctopus arrive as a ZIP; unzip it first.
2. **Which column is which.** Pick a field above each column: **Email address**, **Full name**, **First name**, **Last name**, **Tags**, **Status**, **Subscribed date** or **Language**, or **Ignore this column**. A file Mailroom recognises (an EmailOctopus export) arrives with the columns already matched, and headings that plainly name a field (`email`, `E-mail`, `Email address`, `Name`, `First name`, `Surname`, `Tags`, `Status`, `Language` and the like) are picked for you. One column must be the email address, and each field can come from one column only.
3. **What the first rows become.** The first twenty rows, read exactly as the import would read them. A row it would refuse says why.
4. **Where it goes:**
   - **Add them to**: a list, or **No list, subscribers only**.
   - **Ask everybody to confirm**: leave this off for an export from another tool, since those people confirmed there. Turn it on only for a list you are not sure about; everybody is then imported waiting to confirm and emailed a confirmation.
   - **Tag everybody in this file**: optional, and worth doing, since it is how you find this batch again.
   - **Where did these people agree?**: optional, such as "Signed up on the old site, 2019 to 2024". Kept in each person's consent history as how they came to be on the list. Left empty, the file's name is kept instead.
5. Read the dry run above the button: "Running it now would add N new, find N already here, skip N and leave N suppressed", with the reasons. It counts again when you change the list.
6. Press **Start the import**.

The import is queued and runs on the worker, so a big file does not need the browser left open. The screen shows its progress ("N of N rows"), and **Past imports** keeps every run with its file, list and counts. The uploaded file is deleted as soon as its import finishes; a file whose import never ran is swept after **Keep Uploaded Files For** (`import.keep_days`, 30 days, on the **Signup** tab).

> [!NOTE]
> Imports need the worker. A site with no job queue running says "This site has no job queue running, so an import cannot be started." See [Jobs and cron](../jobs-and-cron).

## What happens to each row

| Row | What happens | Counted as |
|---|---|---|
| No address, or one that is not an address | Skipped | Skipped |
| The same address earlier in the file | Skipped | Skipped |
| Status `pending` (never confirmed at the old tool) | Skipped, whatever **Ask everybody to confirm** says | Skipped |
| Status `unsubscribed` | The address is suppressed (reason **Added by hand**, note `import: {file}`), and a known subscriber is taken off every list | Suppressed |
| An address that bounced or complained here before, or is suppressed | Nothing is written | Suppressed |
| Somebody who left the list, or every list, themselves | Nothing is written | Skipped |
| Anybody else | A subscriber, joined to the list, with source **Imported** and the file name | New, or Already here |

Status words are read loosely: `unsubscribed`, `unsub`, `opted out`, `cleaned` and `removed` all mean unsubscribed; `pending`, `unconfirmed` and `awaiting confirmation` mean pending; anything else is subscribed.

An import never downgrades anybody: somebody already subscribed stays subscribed, and a membership they already hold keeps how they joined. Each row is written on its own, so an import that stops partway leaves the rows it reached; running the same file again changes nothing the first run already did.

## Import on the command line

For a file already on the server, `import:csv` runs the same importer in the foreground and prints what it did:

```bash
bin/plugin mailroom import:csv contacts.csv --dry-run
bin/plugin mailroom import:csv contacts.csv --list=newsletter --tag=october-import --basis="Signed up on the old site"
bin/plugin mailroom import:csv export.csv --preset=emailoctopus
bin/plugin mailroom import:csv contacts.csv --map email="Email address" --map name="Full name"
```

| Option | What it does |
|---|---|
| `--list` | The code of the list everybody joins. Default: the default list. |
| `--preset` | Read the file as another tool's export: `emailoctopus`. |
| `--map field=column` | A column mapping, repeatable. Fields: `email`, `name`, `first_name`, `last_name`, `tags`, `status`, `subscribed_at`, `language`. |
| `--tag` | A tag put on everybody in the file. |
| `--basis` | Where these people agreed, kept in each consent history. Default: the file name. |
| `--as-confirmed` | Treat everybody as already confirmed. This is the default. |
| `--ask-to-confirm` | Import everybody as waiting to confirm and email each a confirmation. |
| `--dry-run` | Read the file and report, writing nothing at all. |

It prints the file, preset, list, consent and basis first, then the counts (rows read, new, already here, skipped, suppressed) and the reasons. The run is kept under **Past imports** like one from the admin.

## Export

**Export CSV** above the Subscribers table downloads the people the current filters match. The same file from the command line:

```bash
bin/plugin mailroom export:csv --file=subscribers.csv
bin/plugin mailroom export:csv --status=subscribed --list=newsletter > newsletter.csv
bin/plugin mailroom export:csv --status=subscribed | wc -l
```

| Option | What it does |
|---|---|
| `--file` | Where to write. Standard output when not given. |
| `--status` | `pending`, `subscribed`, `unsubscribed`, `bounced` or `complained` |
| `--source` | `form`, `import`, `api`, `admin` or `automation` |
| `--list` | Only people on this list, by code |
| `--tag` | Only people carrying this tag, by code |
| `--search` | Only addresses or names containing this |

The file has ten columns: `email`, `name`, `status`, `lists`, `tags`, `source`, `consent_at`, `confirmed_at`, `unsubscribed_at`, `language`. It starts with a byte order mark so spreadsheets read it as UTF-8, and it is streamed a line at a time, so a large list exports on the same server that serves the site.

For everything held about one person, including their consent history, use **Export their data** on their page instead (see [Privacy](../privacy#data-export-for-one-person)).

## Related

- [Subscribers](../subscribers)
- [Double opt-in and consent](../double-opt-in-and-consent)
- [CLI](../cli)
