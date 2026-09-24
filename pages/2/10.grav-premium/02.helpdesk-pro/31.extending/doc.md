---
title: Extending
taxonomy:
    category: docs
description: For developers - the Grav events, domain events, services and registries add-ons use to build on Helpdesk Pro.
---

# Extending

Add-ons extend Helpdesk Pro through Grav events, domain events and a few registries. This page is for PHP developers building a plugin on top of Helpdesk Pro. Helpdesk Pro's own custom fields, organizations, SLA and ratings are built on these same seams, so they are worked examples in the plugin's `classes/`.

Add-on tables are named `helpdesk_<addon>_*` and live in the same SQLite file. Never write to the `helpdesk_*` tables directly: the activity log, the events and the access checks would all miss it.

## Events at a glance

| Grav event | Fired | Use it to |
|---|---|---|
| `onHelpdeskRegisterMigrations` | Once per request, before the container is built | Add your migrations directory |
| `onHelpdeskRegisterJobs` | When the job handler registry is built | Register job handlers |
| `onHelpdeskRegisterSinks` | When the event sink chain is built | Receive every domain event in-process |
| `onHelpdeskWorkerTick` | Once per worker pass | Book your recurring work |
| `onHelpdeskEvent` | Once per domain event, after commit | React to any change |
| `onHelpdeskIntake` | Before a ticket is created | Enrich or refuse a new ticket |
| `onHelpdeskTicketSerialize` | For every ticket the API returns | Add data under `extra` |
| `onHelpdeskMailBuild` | For every email, before it is rendered | Change an email's variables or headers |
| `onHelpdeskRegisterPersonData` | When merging, erasing or summarizing a person | Reach your own person columns |
| `onHelpdeskRulesRegister` | The first time rules are needed in a request | Add triggers, conditions and actions |
| `onHelpdeskNotificationChannels` | The first time channel types are needed | Add a channel type |
| `onHelpdeskReports` | Each time a report is built | Add report cards |

## Start-up events

### `onHelpdeskRegisterMigrations`

Fired with `['paths' => []]`. Append your migrations directory. Directories run after the plugin's own, in the order added; a missing directory is logged and skipped. Migration files follow grav-db-kit's format: `NNNN_snake_name.php` returning an anonymous class that implements the kit's `Migration`, with idempotent steps. Refer to kit classes through Helpdesk Pro's prefixed names (`Grav\Plugin\HelpdeskPro\Vendor\TrilbyMedia\GravDbKit\…`). `bin/plugin helpdesk-pro migrate` applies them.

### `onHelpdeskRegisterJobs`

Fired with `['registry' => JobHandlerRegistry]`. Register handlers with `$event['registry']->register('myaddon.sync', $handler)`. Types match `^[a-z0-9][a-z0-9._-]*$`; Helpdesk Pro's own types are registered first and cannot be taken over. A handler implements the kit's `JobHandler` (`handle(array $payload): void`), throws to fail and retry, and must be idempotent.

### `onHelpdeskRegisterSinks`

Fired with `['sinks' => []]`. Append objects implementing the kit's `EventSink` (`emit(string $event, array $payload): void`) to receive every domain event after its transaction commits. A sink that throws is logged and the others still run.

### `onHelpdeskWorkerTick`

Fired once per `bin/plugin helpdesk-pro work` pass, after Helpdesk Pro's own housekeeping, with `['queue' => JobQueue, 'now' => int]`. The place to book an add-on's recurring work.

## Domain events

Every change Helpdesk Pro makes is announced as a domain event after it has been saved. Search indexing, notifications, live updates and add-ons all listen to the same stream.

### `onHelpdeskEvent`

A Grav event fired once per domain event, after the database transaction has committed, with `['name' => 'ticket.created', 'payload' => [...]]`:

```php
public static function getSubscribedEvents(): array
{
    return ['onHelpdeskEvent' => ['onHelpdeskEvent', 0]];
}

public function onHelpdeskEvent(Event $event): void
{
    if ($event['name'] === 'ticket.status_changed' && $event['payload']['to_category'] === 'resolved') {
        // ...
    }
}
```

A listener that throws is logged and never undoes the change.

### Payloads

Every payload carries:

| Field | Meaning |
|---|---|
| `ticket_id` | The ticket (null for events not about one ticket) |
| `project_id` | The ticket's project after the change |
| `actor_id` | The person who made the change; the Helpdesk system person (id 1) for automation; null for a guest |
| `visibility` | `public` or `internal`. An `internal` event must never reach a client, and add-ons must respect that too. |
| `at` | When, in epoch seconds |

Events that describe an activity row also carry its `activity_id`. Payloads are flat ids and values, never message bodies: fetch content through the services, which check access. New fields may be added; fields are never renamed within a major version.

| Event | Extra fields | Visibility |
|---|---|---|
| `ticket.created` | `requester_id`, `assignee_id`, `created_by_id`, `channel`, `triage_state`, `kind`, `priority`, `first_message_id`, `mentioned_person_ids`, `activity_id`, `extra` | public |
| `ticket.updated` | `changes`: field to `[before, after]` for `subject`, `priority`, `kind`, `visibility_scope`, `labels` | internal |
| `ticket.status_changed` | `from_status_id`, `to_status_id`, `from_category`, `to_category`, `activity_id` | public when it enters or leaves `resolved` or `closed`; internal otherwise |
| `ticket.assigned` | `from_assignee_id`, `to_assignee_id`, `activity_id` | internal |
| `ticket.moved` | `from_project_id`, `to_project_id`, `activity_id` | internal |
| `ticket.triaged` | `decision` (`accept`, `duplicate`, `decline`), `duplicate_of_id`, `notify`, `reason`, `followed_original`, `reason_public`, `requester_id`, `decision_id`, `activity_id` | public for decline and duplicate, internal for accept |
| `ticket.merged` | `into_ticket_id`, `into_project_id`, `moved_messages`, `widened`, `activity_id` | public |
| `ticket.deleted` | `permanent`, `activity_id` | internal |
| `ticket.restored` | `activity_id` | internal |
| `ticket.rated` | `rating_id`, `round`, `rating`, `previous_rating`, `staff_id`, `has_comment`, `comment_changed`, `source` (`email` or `portal`), `activity_id` when the rating changed | internal |
| `ticket.fields_changed` | `changes` (key to `[before, after]`), `field_keys`, `activity_id`. Emitted once for client-visible fields and once for internal ones. | public for public and readonly fields; internal otherwise |
| `ticket.sla_warning` | `target`, `due_at`, `policy_id`, `assignee_id`, `late`, `retroactive`, `via` (`sla`) | internal |
| `ticket.sla_breached` | The same; `late` is true for a breach found after the ticket was answered or resolved | internal |
| `ticket.person_merged` | `from_person_id`, `into_person_id`, `activity_id`; once per ticket | internal |
| `ticket.person_erased` | `person_id`, `mode`, `activity_id`; once per ticket | internal |
| `ticket.organization_changed` | `from_organization_id`, `to_organization_id`, `activity_id` | internal |
| `message.created` | `message_id`, `author_id`, `author_kind`, `source`, `mentioned_person_ids`, `status_after_category` | The message's own |
| `message.updated` | `message_id`, `mentioned_person_ids` (newly mentioned only), `activity_id` | The message's own |
| `message.deleted` | `message_id`, `activity_id` | The message's own |
| `participant.added` | `person_id`, `role` (`requester`, `cc`, `watcher`), `reason` | internal |
| `participant.removed` | `person_id`, `role`, `reason` | internal |
| `attachment.added` | `attachment_id`, `message_id` | The message's own |
| `organization.created` | `organization_id`, `name`, `domains`, `share_tickets` | internal |
| `organization.updated` | `organization_id`, `name`, `changes`, `domains`, `share_tickets` | internal |
| `organization.deleted` | `organization_id`, `name` | internal |
| `organization.member_added` | `organization_id`, `person_id`, `via` (`staff` or `domain`), `from_organization_id` | internal |
| `organization.member_removed` | `organization_id`, `person_id`, `via` | internal |
| `kb.feedback` | `page_key`, `helpful`, `session_hash` (no ticket) | internal |
| `inbound.rejected` | `inbound_id`, `reason` (no ticket) | internal |

A ticket's first message is part of `ticket.created`; there is no separate `message.created` for it. When one action changes several things, each gets its own event, in order: a staff reply that also sets a status emits `message.created` and then `ticket.status_changed`.

- Every event of one bulk edit carries `bulk_id` and `bulk_count`.
- Every event a rule's actions cause carries `via: rules` and `rule_id` (0 for the auto-close). Rules never react to these, and an add-on can use them to tell a rule's change from a person's.

## Change tickets from an add-on

The container is `Grav\Plugin\HelpdeskPro\HelpdeskPro::instance()`. Every write takes an `Actor`, runs in one transaction, records its activity and emits its events after commit; reads go through the access policy.

- `actorResolver()->resolveUser($gravUser)` turns a Grav account into an `Actor`. `Actor::system('myaddon')` acts as the Helpdesk system person with your label on the activity. `Actor::system('myaddon')->withDetail(['rule' => 'Nightly cleanup'])` stores a detail beside it.
- `tickets()`: `get`, `list` (with a `TicketFilter`), `create`, `apply($ticketId, TicketChange, $actor)` for any field change, `delete`, `restore`.
- `messages()`: `reply`, `note`, `thread`, `timeline`, `edit`, `delete`.
- `intake()`: new tickets from the portal, the guest form and email.
- `accessPolicy()`: `canReadTicket`, `canReadMessage`, `canWriteTicket`, `readableTicketsSql` for your own queries, `audienceFor` for fan-out.
- `people()`, `projects()`, `statuses()`, `labels()`, `participants()`, `fields()`, `organizations()` for the rest.

```php
use Grav\Plugin\HelpdeskPro\Domain\TicketChange;
use Grav\Plugin\HelpdeskPro\HelpdeskPro;

HelpdeskPro::instance()->tickets()->apply($ticketId, TicketChange::fromArray(['status_id' => 5]), $actor);
```

For custom field values, `fields()->serialize($actor, $ticket)` gives the values an actor may see and `fields()->setValues($actor, $ticketId, ['plan' => 'gold'])` changes them with the same checks, activity and events as the desk.

## New tickets: `onHelpdeskIntake`

Fired before a ticket is created, from every channel, with `['draft' => TicketDraft, 'actor' => Actor, 'channel' => 'web']`. A listener may change the draft in place (add labels, set the priority, fill `extra`) or refuse the ticket by throwing `Grav\Plugin\HelpdeskPro\Exception\DomainValidationException` with a message the person will see. Whatever a listener changes is checked again before the ticket is written. What listeners add to `extra` travels on the `ticket.created` event.

## Ticket payloads: `onHelpdeskTicketSerialize`

Fires for every ticket the API returns, with `ticket` (the raw row), `extra` (the array to fill), `actor` (the caller) and `staff` (whether the caller gets the staff view). A listener decides for itself what a client may see:

```php
public function onHelpdeskTicketSerialize(Event $event): void
{
    $extra = $event['extra'];
    $extra['sla_due'] = $this->slaDue((int)$event['ticket']['id']);
    $event['extra'] = $extra;
}
```

## Email

`onHelpdeskMailBuild` fires for every email before it is rendered, with `template`, `vars`, `headers`, `audience` (`client` or `staff`), `ticket_id` (or null for a digest) and `person_id` (the recipient, or null). A listener may change `vars` or `headers` and hand them back; `Message-ID` cannot be changed.

The check that keeps notes out of client email runs after the listeners, so an add-on cannot push note content into client mail. `vars.brand` is filled before listeners run, so a listener can swap in another logo or colour for one project's email.

A new email template extends `emails/helpdesk/partials/layout.html.twig` (see [Outbound email](../outbound-email#override-email-templates)).

## Inbound email

An add-on that receives email some other way can feed it through the same pipeline:

```php
use Grav\Plugin\Email\Providers\Inbound\InboundMessage;
use Grav\Plugin\HelpdeskPro\HelpdeskPro;

$stored = HelpdeskPro::instance()->inboundStore()->storeMessage(InboundMessage::fromMime($raw, 'myaddon'), 'myaddon');
$stored->inboundId; // the inbound log row
$stored->duplicate; // true when this email was received before
```

Check `Grav\Plugin\HelpdeskPro\Inbound\InboundSupport::available()` first: it is false with an Email plugin older than 5.3.0. Listen for `inbound.rejected` to hear about refused mail.

The reply cleanup is usable on its own. `(new ReplyStripper())->strip($textPart, $htmlPart, $providerStrippedText, $subject, $inlineImages)` returns the Markdown to store (`text`), whether anything was cut (`stripped`), the rule that cut (`cutAt`), the `signature`, and the `quoteOnly`, `keptFull` and `forwarded` flags. `HtmlToMarkdown::convert($html)` turns email HTML into Markdown on its own.

## Search

- `clientSearch()->search($actor, $text)` finds what a client or guest may read; `staffSearch()->search($actor, $text)` what an agent may, with notes; `similarTickets()->for($ticketId, $actor)`. Every hit is checked against the access policy.
- `search()->markDirty($ticketId)` reindexes a ticket at the end of the request, for an add-on that changes a ticket's text outside the core services.
- `useEmbeddingProvider($provider)` hands in your own `EmbeddingProviderInterface` for semantic search.

## Live updates in your own screens

A desk panel or view, or a script on a portal page, can follow the same live frames Helpdesk Pro's own screens use. Listen for the `helpdesk:live` event on `window`, whose `detail` is the frame (`{e, t, m, at}`, ids only), and refetch what you show through the API or the page. The desk opens one live connection per tab; do not open another. See [Live updates](../live-updates#how-it-works).

A screen can take part in the desk's keyboard shortcuts: the desk sends an `hd-shortcut` event (with `detail.action`, such as `next`, `open` or `assign-me`) to the screen's element first, and a screen that handles it calls `preventDefault()`.

## People and erasure

Merging two people and erasing one have to reach every table with a person column, including yours. Implement `Grav\Plugin\HelpdeskPro\Service\People\PersonData` and register it:

```php
public static function getSubscribedEvents(): array
{
    return ['onHelpdeskRegisterPersonData' => ['onHelpdeskRegisterPersonData', 0]];
}

public function onHelpdeskRegisterPersonData(Event $event): void
{
    $areas = $event['areas'];
    $areas[] = new MyAddonPersonData(HelpdeskPro::instance()->connection());
    $event['areas'] = $areas;
}
```

An implementation has four methods:

- `name()`: a short name for reports (`myaddon`).
- `holdings(int $personId): array`: what you keep about the person, as label => row count, for the privacy summary.
- `merge(int $fromId, int $intoId, int $now): int`: point your rows at the kept person; drop a row that would collide with one they already have.
- `erase(ErasureRun $run): int`: remove or scrub what you keep, in `$run->mode` (`anonymize` or `delete_content`); `$run->email` is the address they had.

Both run inside Helpdesk Pro's transaction: never commit, send mail or delete files yourself (count a file you let go in `$run->releasedBlobs` and leave it to `attachments.gc`), make every step idempotent, and skip a table that is not there. `Service\People\TablePersonData` has helpers for all of that. A legal hold is checked before your `erase()` is ever called.

## Rules: triggers, conditions and actions

Rules read their triggers, conditions and actions from a registry. Helpdesk Pro fills it, then fires `onHelpdeskRulesRegister` with `['registry' => RuleRegistry]`. The rule editor, the API catalog and the dry run pick up what you add. The first registration of a key wins, so prefix yours (`billing.plan`).

```php
use Grav\Plugin\HelpdeskPro\Rules\{ActionType, ConditionField, RuleSubject, TriggerType};
use Grav\Plugin\HelpdeskPro\Exception\DomainValidationException;
use Grav\Plugin\HelpdeskPro\Security\Actor;

public function onHelpdeskRulesRegister(Event $event): void
{
    $registry = $event['registry'];

    // A condition: the customer's billing plan. The editor draws a select with these options.
    $registry->addCondition(new ConditionField('billing.plan', 'Billing plan', ['in', 'not_in', 'is_empty'], 'select',
        fn (RuleSubject $s) => $s->remember('billing', fn () => $this->billing->forTicket($s->ticketId()))['plan'] ?? null,
        [['value' => 'gold', 'label' => 'Gold'], ['value' => 'free', 'label' => 'Free']],
        words: ['is_empty' => 'has none'],
        phrases: ['is_empty' => 'the customer has no plan']));

    // A trigger: one of your own domain events, emitted through the event sink.
    $registry->addTrigger(new TriggerType('billing.invoice_overdue', 'An invoice is overdue',
        fn (string $event, array $payload) => $event === 'billing.invoice_overdue'));

    // An action: check the value when the rule is saved, say what it would do, do it.
    $registry->addAction(new ActionType('webhook', 'Call a webhook', 'text',
        fn (mixed $value) => ['value' => filter_var($value, FILTER_VALIDATE_URL) ?: throw new DomainValidationException('Give a URL')],
        fn (array $action) => 'Call ' . $action['value'],
        fn (array $action, RuleSubject $s, Actor $actor) => $this->webhooks->post($action['value'], $s->ticketId()),
    ));
}
```

- A **condition** reads the ticket through `RuleSubject`: `ticket`, `event`, `payload`, `labelIds()`, `requester()`, `message()`, and `remember($name, $loader)` to load your data once for all rules. The input kind (`text`, `tags`, `number`, `date`, `checkbox`, `select`, or a core one such as `labels`) tells the editor what to draw. Optional named arguments: `options` (may be a closure), `words`, `phrases`, `normalize` and `unavailable`.
- **Conditions that come and go with your data** go through `$registry->addConditionSource(fn () => [...ConditionField])`, asked whenever a field is looked up.
- A **trigger** tests a domain event's name and payload. Your event reaches rules when you emit it through `HelpdeskPro::instance()->domainEvents()->record(...)` with a `ticket_id`.
- An **action** runs as `Actor::system('rules')` with the rule's `rule_id` and `rule` in `$actor->detail`. Change tickets through `tickets()->apply()`; anything it causes carries `via: rules` and never triggers rules. Throw to fail: the error is shown on the rule, and the next rule runs.

## Notification channel types

Add a channel type (Microsoft Teams, Mattermost, a pager service) through `onHelpdeskNotificationChannels`, fired with `['channels' => []]`. It appears in Automation → Channels, its fields drawn in the editor, stored, masked and delivered like the core ones:

```php
use Grav\Plugin\HelpdeskPro\Channels\ChannelMessage;

public function onHelpdeskNotificationChannels(Event $event): void
{
    $channels = $event['channels'];
    $channels[] = [
        'id' => 'teams',
        'label' => 'Microsoft Teams',
        'description' => 'Posts to a Teams channel through a workflow webhook.',
        'fields' => [
            ['name' => 'url', 'label' => 'Workflow URL', 'kind' => 'url', 'required' => true],
        ],
        'build' => static fn (ChannelMessage $m, array $settings): array => ['body' => [
            'type' => 'message',
            'attachments' => [[
                'contentType' => 'application/vnd.microsoft.card.adaptive',
                'content' => [
                    'type' => 'AdaptiveCard', 'version' => '1.4',
                    'body' => [['type' => 'TextBlock', 'text' => $m->title, 'weight' => 'Bolder']],
                    'actions' => [['type' => 'Action.OpenUrl', 'title' => 'Open', 'url' => $m->url()]],
                ],
            ]],
        ]],
    ];
    $event['channels'] = $channels;
}
```

| Key | What it is |
|---|---|
| `id` | Lowercase letters, digits, `-` and `_`, 2 to 32 characters. The first registration wins. |
| `label`, `description` | What the type picker shows. |
| `fields` | What the editor asks for: `{name, label, kind, required, help, placeholder}`. `kind` is `url` (treated as a secret), `secret`, `text` or `addresses`. A `url` or `secret` value is never returned by the API and may be typed as `env:NAME`. |
| `build` | `fn (ChannelMessage $message, array $settings)`, returning a `Channels\HttpPayload` or `['body' => array|string, 'headers' => [...]]`. An array body is sent as JSON. |
| `endpoint` | Optional: `fn (array $settings): string`, where to `POST`; the `url` field when absent. |
| `signs` | Optional: `true` adds `X-Grav-Signature` whenever the channel's `secret` field is set. |

`ChannelMessage` is everything a builder may print: `title`, `ticket`, `fields()`, `details`, `excerpt`, `url()`, `ticketRef()`, `eventLabel()`, `event`, `siteName`, `deskUrl`, `occurredAt`, `test`, `deliveryId` and `toArray()`. It has no field for a note, an internal custom field or the activity log. Retries, pausing, dedupe and **Send a test message** work for your type without any code of yours. If your add-on is disabled later, its channels are marked **Broken** and can only be deleted.

## Report cards

Add cards to the Reports screen through `onHelpdeskReports`, fired with `reports` (a list to append to), `actor`, `period` (with `start`, `end`, `fromDate`, `toDate`, `timezone` and `days`), `scope` and `context` (`desk`, or `tools` for Admin Next's Reports page, which draws facts and tables only):

```php
public function onHelpdeskReports(Event $event): void
{
    [$where, $params] = $event['scope']->where('t');
    $hours = (float)HelpdeskPro::instance()->connection()->fetchValue(
        "SELECT COALESCE(SUM(e.minutes), 0) / 60.0 FROM helpdesk_myaddon_time_entries e
         JOIN helpdesk_tickets t ON t.id = e.ticket_id
         WHERE {$where} AND e.created_at >= ? AND e.created_at < ?",
        [...$params, $event['period']->start, $event['period']->end]
    );
    $reports = $event['reports'];
    $reports[] = [
        'id' => 'myaddon.hours',
        'title' => 'Hours logged',
        'position' => 55,
        'facts' => [['label' => 'Hours', 'value' => $hours]],
    ];
    $event['reports'] = $reports;
}
```

`$event['scope']->where('t')` gives a `WHERE` fragment over a `helpdesk_tickets t` alias with the report's filters and the viewer's project access already in it.

| Key | What it is |
|---|---|
| `id` | Required. Lowercase letters, digits, `.`, `_` and `-`, up to 64 characters; prefix it with your add-on's name. Helpdesk Pro's own ids are taken. |
| `title` | Required. Plain text. |
| `facts` | A list of `{label, value, format?, tone?, hint?}` |
| `columns`, `rows` | A table. The desk offers it as CSV. |
| `series` | A chart: `{kind: line or bar, x: [labels], sets: [{label, values}], format?}`. Left off Admin Next's Reports page. |
| `empty` | Why there is nothing to show: `{title, hint?, action?: {label, route}}` |
| `note` | A line under the card |
| `wide` | `true` to take a whole row |
| `position` | Order on the screen, lower first. Helpdesk Pro's own cards use 10 to 130; the default is 100. |
| `provider` | Your add-on's name (default `addon`) |

A card has exactly one of `facts`, `columns` with `rows`, `series` or `empty`. `format` is `number`, `percent`, `duration` (seconds) or `text`; `tone` is `ok`, `warn`, `bad`, `info` or `muted`. Values are always shown as text, never as HTML. A card that does not follow the contract is left out, and its id is listed in the API answer's `skipped`.

## Related

- [REST API](../rest-api)
- [Rules and automations](../rules-and-automations)
- [Notification channels](../notification-channels)
- [Reports](../reports)
