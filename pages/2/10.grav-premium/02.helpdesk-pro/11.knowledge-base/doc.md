---
title: Knowledge Base
taxonomy:
    category: docs
description: Write help articles as Grav pages, control who reads them, and follow a visitor from search to article to request.
---

# Knowledge Base

The knowledge base is made of ordinary Grav pages. Any page that uses the **Help Article** page type (the `kb-article` template) is an article: help center search finds it as soon as it is saved, the request form suggests it while people type, and staff see which articles a client read before writing in.

People search first, and when an article does not solve it, the request form picks up where the search left off, carrying what they already tried.

## Write an article

1. In Admin Next, add a page under the help center (for example `/help/account/reset-password`) and choose the **Help Article** page type.
2. Write it like any page. Its title and content are what search matches, with the title counting three times as much as the text.
3. On the page editor's **Help Center** tab, set any of:
   - **Categories**: fills the `kb_category` taxonomy. The help center shows each category as a topic card with its article count. Helpdesk Pro adds `kb_category` to `site.taxonomies` for you when your site does not list it.
   - **Project** (`kb.project`, a project slug or id): ties the article to one project. Leave it empty for articles about everything.
   - **Related Articles** (`kb.related`): routes shown first under "Related articles" at the end of the article.
   - **Only These Groups** (`kb.groups`): limits the article to signed-in people in those Grav groups.
4. Publish it.

Unpublished and non-routable pages are left out of search.

Article lists and search results show a short summary under each title: the page's own summary when it has one (the text above Grav's summary delimiter, `===` by default), otherwise the first 160 or so characters of the article's prose, with headings, code blocks and tables left out.

Lists follow the folder order of the pages (`01.change-email` before `02.reset-password`), then the title, so numbering the folders puts the most useful articles first. Numbered folders also show up in theme menus; add `visible: false` to an article's header to keep it out of them.

Articles do not have to live under the help center: a Help Article page anywhere on the site counts. Keeping them under it gives tidy addresses (`/help/billing/refunds`) and breadcrumbs.

### Who can read an article

An article follows the page's own access rules, and search shows it only to people who could open it:

| The page has | Who finds it |
|---|---|
| No `access` rules | Everyone, guests included |
| `access: { site.login: true }` | Anyone signed in |
| Other `access` rules (`site.members: true`…) | Signed-in people whose account holds one of those permissions |
| `kb.groups: [vip]` | Signed-in people in one of those groups |

Staff find every article in the desk. Every search hit is checked again before it is shown, so a stale index can never show an article to the wrong person. The same rules decide what the articles index, the category pages, their counts and an article's previous and next links show.

## Browse articles

People who would rather look than search can browse:

- **`{mount}/articles`**, the articles index: a search box, then a card for every category the visitor can read something in, with its icon, description, article count and first five articles. Articles with no category are listed under **General**, last.
- **`{mount}/articles/{category}`**, one category: a breadcrumb, its name, description and count, then its articles with their summaries, 20 to a page (`?page=2`), and "Still stuck?" at the bottom. A category that does not exist, or has nothing this visitor may read, answers "We couldn't find that topic" with a 404.
- **An article**: a breadcrumb, the title, a meta line (its topic · Updated {date} · N min read), the content, "Was this helpful? Yes / No", **Related articles** and **More in {category}**, and **Previous** and **Next** within that category.

### Topic descriptions and icons

Each topic card can carry a one-line description and an icon. Set them on the plugin's settings page under **Help Center → Topic Descriptions and Icons** (**Add Topic**, then the category, a description and an icon), or in `user/config/plugins/helpdesk-pro.yaml` under `kb.categories`, keyed by the category name or its slug:

```yaml
kb:
  categories:
    Account: { description: 'Signing in, your profile and keeping your account safe', icon: user }
    Billing: { description: 'Payments, invoices and refunds', icon: credit-card }
    Troubleshooting: { description: 'When something is slow, blank or missing', icon: wrench }
    General: { description: 'Everything else', icon: question }
```

`General` describes the articles with no category. The icons are a small line set that follows your theme's colours: `user`, `credit-card`, `wrench`, `book`, `shield`, `mail`, `settings`, `question`, `chat` and `rocket`. A topic with no icon shows the first letter of its name in a tile instead.

### Category addresses

A category's address is its slug: the `kb_category` value in lowercase ASCII letters and digits, with a dash for anything else. `Billing & Invoices` lives at `{mount}/articles/billing-invoices` and `Café` at `{mount}/articles/cafe`. Renaming a category moves its page. Two names that make the same slug (`Billing` and `billing`) are one category. A name with no letters the slug can keep (one written entirely in Cyrillic, say) gets `c-` and a short hash of the name. Articles with no category are at `{mount}/articles/general`.

If a page of your own already lives at an address the portal would answer, your page wins.

## The help center flow

This is what a visitor sees, from the search box to a request:

1. **Search.** The help center home has a search box. With JavaScript, articles appear under it as they type; pressing Search opens `{mount}/search?q=…` with the articles they may read and, when signed in, their own matching requests. [Synonyms](../search#synonyms) mean "can't sign in" finds the article that says "log in".
2. **Read.** An article shows its content, "Was this helpful? Yes / No", related articles, and more in the same category.
3. **"No" leads to the form.** Answering No replaces the question with "Still stuck? Ask us", whose button opens the request form with the visitor's last search as the summary (or the article's title) and the article as where they came from. Answering Yes says thanks. Without JavaScript the answer is a normal form post that comes back to the article.
4. **Suggestions while typing.** The request form has a "You may be looking for" box that fills with matching articles (and the person's own earlier requests) as they type. Suggested articles open in a new tab so the form is not lost. Set `portal.suggestions` to `false` to turn suggestions off.
5. **"Before writing in".** When the request is sent, the ticket keeps a copy of what came first: the searches (with how many results each found), the articles read, the Yes/No answers, the suggestions clicked, and the page the form was opened from. Staff see it in the ticket's **Before writing in** panel.

### The help center cookie

To connect a request to the searches before it, the help center sets one first-party cookie, `hd_kb`: a random 128-bit id with `SameSite=Lax` and `HttpOnly`, kept for `portal.kb_session_days` days (default 30). It holds nothing personal, and the database stores only its SHA-256. List it as a functional cookie in your privacy notice.

What the session records is deleted after `privacy.kb_events_days` days (default 90) by the daily `maintenance.prune` job. A ticket copies up to 20 events from the day before it was sent, and keeps them as long as the ticket exists. An article view counts once per session, page and hour, and so does the same answer to "Was this helpful?".

## In the desk

- The ticket's **Before writing in** panel lists what the requester did first and the articles that best match the ticket, each with **Insert link** for the reply.
- **Insert article**, beside **Attach files** in the composer, searches the knowledge base and inserts a link to an article into the reply.
- **Operations → Search** shows the index and rebuilds it (see [Search](../search)).
- The **Searches without an answer** card on [Reports](../reports) lists help center searches that found nothing.

## Portal routes

| Method | Path | What it does |
|---|---|---|
| GET | `{mount}/search` | Search results for `?q=`. A signed-in visitor who searches for a request number they may read goes straight to it. |
| GET | `{mount}/articles` | The articles index. Open to everyone. |
| GET | `{mount}/articles/{category}` | One category's articles, 20 per page (`?page=`). |
| GET | `{mount}/_suggest` | The suggestions fragment for `?q=`, or for the form's `subject` and `body`. |
| POST | `{mount}/_kb/feedback` | "Was this helpful?": `page` (the article's route), `helpful` (`1` or `0`), `back` (where to return without JavaScript). Rate limited per session. |
| POST | `{mount}/_kb/event` | A beacon for what the server cannot see: `kind=suggest_clicked` or `kind=view` for an article on a page the plugin does not render, with `page` and `q`. Rate limited per session. |

## Templates

A theme overrides any of these by shipping the same path under its own `templates/`. The text is under `ICU.PLUGIN_HELPDESK_PRO.KB_*` in `languages/en.yaml`.

| Template | What it renders |
|---|---|
| `kb-article.html.twig` | The Help Article page type: nav row, breadcrumb, title and meta line, content, "Was this helpful?", related articles, More in {category}, Previous and Next |
| `helpdesk/articles.html.twig` | The articles index |
| `helpdesk/category.html.twig` | One category's articles |
| `helpdesk/search.html.twig` | Search results |
| `helpdesk/partials/search-box.html.twig` | The portal's search control, with suggestions as you type |
| `helpdesk/partials/suggestions.html.twig` | The suggestions box on the request form, and the list `{mount}/_suggest` answers |
| `helpdesk/partials/article-feedback.html.twig` | "Was this helpful? Yes / No" and the thank-you |
| `helpdesk/partials/still-stuck.html.twig` | "Still stuck? Ask us" |
| `helpdesk/partials/kb-home.html.twig`, `kb-home-lists.html.twig` | Browse by topic, Popular articles and Browse all articles on the help center home |
| `helpdesk/partials/topic-card.html.twig` | One topic card |
| `helpdesk/partials/link-list.html.twig` | A plain list of article links |
| `helpdesk/partials/icon.html.twig` | The inline icon set |

## Twig functions

For a theme that lays out its own article pages or wants the pieces elsewhere. Every list holds only articles the viewer may read. The functions that draw markup add the portal's stylesheet and script and wrap their output in `.helpdesk`.

| Function | Returns |
|---|---|
| `helpdesk_search(options)` | The search box. Options: `placeholder`, `autofocus`, `suggest` (default `true`), `query`. |
| `helpdesk_article_feedback(page)` | "Was this helpful?" for a page (the current page when none is given). |
| `helpdesk_still_stuck(page = null, query = null)` | The "Still stuck? Ask us" block, linking to the form. |
| `helpdesk_popular_articles(limit = 6, category = null)` | The most viewed articles of the last 30 days, topped up with the newest: `{route, title, url, summary, categories, views}`. |
| `helpdesk_kb_categories()` | The categories with how many readable articles each has, most first: `{name, slug, url, count, description, icon, letter}`. |
| `helpdesk_kb_articles(category = null, limit = 20)` | Readable articles in browsing order, all or one category's (a name, a slug, or `general`): `{route, title, url, summary, categories}`. |
| `helpdesk_kb_article_nav(page = null, exclude = [], limit = 5)` | Where an article sits: `home`, `articles`, `category`, `prev`, `next`, `more`, `minutes` (reading time) and `modified`. |
| `helpdesk_related_articles(page, limit = 5)` | The page's `kb.related` routes first, then the articles most like its title. |
| `helpdesk_kb_url(name, params = {})` | The URL of a knowledge base page or endpoint: `search`, `suggest`, `feedback`, `event`, `new`, `articles` or `category` (pass `{slug: 'billing'}`). |

For example, a sidebar with every category and its articles:

```twig
<nav aria-label="Help topics">
  {% for c in helpdesk_kb_categories() %}
    <h3><a href="{{ c.url }}">{{ c.name }}</a> ({{ c.count }})</h3>
    <ul>
      {% for a in helpdesk_kb_articles(c.slug, 10) %}
        <li><a href="{{ a.url }}">{{ a.title }}</a></li>
      {% endfor %}
    </ul>
  {% endfor %}
  <a href="{{ helpdesk_kb_url('articles') }}">All articles</a>
</nav>
```

## API

| Route | Permission | What it returns |
|---|---|---|
| `GET /helpdesk-pro/tickets/{id}/context` | desk | `{already_read: [{kind, query, results, page_key, page_title, url, current_title, at}], suggested_articles: [{route, title, url, summary}]}`. `kind` is `search`, `article`, `helpful`, `not_helpful`, `suggest_clicked` or `page`. |
| `GET /helpdesk-pro/kb/suggest` | desk | Articles for `q` (`limit` up to 20): `[{route, title, url, summary, score}]` |

MCP tools: `get_ticket_context` and `suggest_articles`. Each "Was this helpful?" answer emits the internal `kb.feedback` event.

## Related

- [Search](../search)
- [Help center and portal](../help-center-and-portal)
- [Request form and guests](../request-form)
