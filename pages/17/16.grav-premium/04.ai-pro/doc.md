---
title: AI Pro
description: Configure unified AI workflows inside Grav
taxonomy:
    category: docs
---

# AI Pro

> [!IMPORTANT]
> Premium products require the free [License Manager](../license-manager) plugin. Install it and add your product license before installing this product.

## Requirements

AI Pro targets **Grav 1.7+** and the latest **Grav Admin** plugin. Ensure your server can reach the API endpoints of any AI providers you plan to use.

## Installation

Install or update via GPM just like any other premium plugin. The command below assumes you have already linked your Grav Premium license to the site.

```
$ bin/gpm install ai-pro
```

You can also install AI Pro from the **Admin → Plugins** screen. Once enabled, the plugin adds a navigation entry and assistant controls inside the Admin.

## Quick Start

1. Navigate to **Plugins → AI Pro** inside the Admin panel.  
2. Set AI Pro to `enabled` and choose your **default provider**.  
3. Paste API credentials for the providers you want to activate.  
4. Save the configuration and click **Test Provider** to verify connectivity.  
5. Open any page in Admin—the floating AI Assistant is available for instant prompts and content automation.

## Configuring Providers

AI Pro ships with built-in support for **OpenAI**, **Claude**, and **Gemini**, plus any providers registered through extensions such as **AI Pro – DeepSeek**. Each section exposes:

- `enabled`: turn the provider on or off without deleting credentials.  
- `api_key`: your access token or secret.  
- `endpoint`: override the default API base URL when targeting regional endpoints or compatible gateways.  
- `model`: pick the default model to use for chat and completions.  
- `max_tokens`, `timeout`, and `temperature`: tune generation limits and response style.  

### Testing Providers

Use the **Test Provider** button next to any configuration group or run:

```
$ bin/plugin ai-pro validate --provider=openai
```

The command verifies credentials, network access, and the ability to list models.

## Assistant Experience

When `assistant.enabled` is true, AI Pro injects a floating Assistant button into the Admin UI. You can:

- Trigger **quick prompts** defined under `prompts.*`.  
- Save and reload conversations per user.  
- Stream responses as they arrive, ideal for longer completions.  
- Insert answers directly into page fields or copy them to the clipboard.

Toggle `assistant.site_wide` when you want the assistant on every Admin page, or limit it to content editing views.

## Background Processing & Chunking

Long-running tasks such as content rewrites can run in the background. The `processing` section offers:

- `method`: choose `sync` for immediate responses or `background` to queue work.  
- `chunk_size`: automatically split large prompts into manageable requests.  
- Retry controls to recover from transient API failures.

These settings also apply when AI Pro powers other plugins like **AI Translate**, keeping behaviour consistent across the stack.

## Caching & Cost Controls

Set `response.cache_enabled` to reuse identical requests for a configurable `cache_ttl`. AI Pro tracks input/output token counts when providers expose them, allowing you to estimate costs or enforce limits with `estimate_cost` hooks.

## Command Line Usage

AI Pro ships with multiple CLI subcommands under `bin/plugin ai-pro`:

- `validate` - validate a specific provider.
- `chat` – fire one-off prompts against any configured provider.
- `models` – inspect provider model lists, optionally refreshing caches.
- `process` – run queued background jobs (used for async processing).
- `completion` – output shell completion scripts for Bash/Zsh/Fish.

### Chat Command

```bash
# Prompt via argument or --prompt
bin/plugin ai-pro chat "Summarize the latest release notes"

# Override provider/model and stream output
bin/plugin ai-pro chat \
  --provider=anthropic \
  --model=claude-3-haiku-20240307 \
  --system="You are a concise technical writer." \
  --stream --show-usage
```

Important flags include `--provider`, `--model`, `--system`, `--context`, `--temperature`, `--max-tokens`, repeatable `--option key=value`, `--format text|json`, and `--show-usage`. Prompts can also be piped from STDIN (`echo "..." | bin/plugin ai-pro chat`).

### Model Discovery

```bash
# List models for every enabled provider
bin/plugin ai-pro models

# Refresh the cache and return JSON for OpenAI
bin/plugin ai-pro models --provider=openai --refresh --json
```

### Background Task Runner

```bash
bin/plugin ai-pro process --task-id=abc123
```

Use this command when debugging asynchronous workflows or when configuring supervisors to execute queued tasks outside the web request cycle.

Combine these tools with cron or deployment scripts to automate documentation updates, changelogs, digests, or batch rewrites.

## Extending AI Pro

Register custom providers by creating a companion plugin and listening to the `onAIProvidersRegister` event.

```php
<?php
namespace Grav\Plugin\AIProMyProvider;

use Grav\Common\Plugin;
use Grav\Plugin\AIPro\Providers\Registry;

class AIProMyProviderPlugin extends Plugin
{
    public static function getSubscribedEvents(): array
    {
        return [
            'onAIProvidersRegister' => ['onAIProvidersRegister', 0],
        ];
    }

    public function onAIProvidersRegister(Registry $providers): void
    {
        $providers->register('my-provider', MyProvider::class);
    }
}
```

Extend `AbstractProvider` to implement the required methods (`initialize()`, `buildRequest()`, `parseResponse()`, `getEndpoint()`, `getHeaders()`) and AI Pro will expose your provider across the Admin assistant, background processor, and CLI.

### Sample: Build a Plugin That Uses AI Pro

The example below shows a lightweight plugin that generates AI-powered summaries whenever an editor saves a page. It retrieves the AI Pro service from Grav's container, sends a chat request, and stores the result in frontmatter.

```php
<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use Grav\Common\Page\Page;
use Grav\Plugin\AIPro\AIProService;

class PageSummaryPlugin extends Plugin
{
    public static function getSubscribedEvents(): array
    {
        return [
            'onAdminSave' => ['onAdminSave', 0],
        ];
    }

    public function onAdminSave(): void
    {
        /** @var Page $page */
        $page = $this->grav['page'] ?? null;
        if (!$page instanceof Page) {
            return;
        }

        /** @var AIProService|null $ai */
        $ai = $this->grav['ai-pro'] ?? null;
        if (!$ai instanceof AIProService) {
            return; // AI Pro not available
        }

        $request = [
            'messages' => [
                ['role' => 'system', 'content' => 'You summarize Grav CMS pages.'],
                ['role' => 'user', 'content' => sprintf(
                    "Summarize this page in 2 sentences:\n\nTitle: %s\n\nContent:\n%s",
                    $page->title(),
                    strip_tags($page->rawMarkdown())
                )],
            ],
            'max_tokens' => 200,
        ];

        $response = $ai->chat($request); // Uses default provider
        $summary = $response->getContent();

        if ($summary !== '') {
            $header = $page->header();
            $header->ai_summary = $summary;
            $page->header($header);
        }
    }
}
```

From here you can expose the stored summary in Twig, or hook other events to trigger rewrites, keyword extraction, or background jobs. AI Pro handles provider selection, chunking, and caching so your plugin can focus on the experience.

## Working with AI Translate

Choose `provider: ai-pro:<name>` inside **AI Translate** to reuse AI Pro credentials, caching, and background jobs. This gives editors one centralized configuration, whether they are translating content or generating summaries.

## Troubleshooting

- **Assistant button missing** → Ensure AI Pro is enabled and the Admin theme is up to date. Clear caches with `bin/grav clear-cache`.  
- **Provider validation fails** → Double-check API keys, network firewalls, and that the selected model is available to your account.  
- **Background tasks not running** → Verify Grav Scheduler or cron jobs if you offload processing outside real-time usage.  
- **Rate limit or quota errors** → Use AI Pro's caching and chunking options to reduce duplicate calls or switch to a provider with higher throughput.

Need help? Open an issue using the link at the top of this page so the team can diagnose provider-specific questions.
