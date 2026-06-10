---
title: AI Translate
description: Build multilingual workflows inside Grav Admin
taxonomy:
    category: docs
---

# AI Translate

> [!IMPORTANT]
> Premium products require the free [License Manager](../license-manager) plugin. Install it and add your product license before installing this product.

## Requirements

AI Translate targets **Grav 1.7+** together with the latest **Grav Admin** plugin.  
When using AI Pro providers, ensure the **AI Pro plugin is installed, enabled, and able to reach your upstream AI API endpoints**.

## Installation

Install or update the plugin like any other Grav Premium package. The examples below assume your license is already linked to the site.

```bash
$ bin/gpm install ai-translate
```

You can also install AI Translate from **Admin → Plugins**. Once enabled, the plugin loads assets only for authorized Admin users, keeping the front end untouched.

## Quick Start

1. Open **Admin → Plugins → AI Translate**.  
2. Choose your **primary provider** (`deepl` or any `ai-pro:<name>`).  
3. Paste credentials (DeepL API key or AI Pro API keys).  
4. Save the configuration and use **Test Provider** in the AI Pro panel (when applicable).  
5. Edit any page—the translation icon appears next to compatible fields immediately.

## Providers & Credentials

### DeepL

DeepL is available out of the box. Provide your API key, choose **Free** or **Pro**, and optionally adjust formality and formatting rules. The plugin keeps calls inside DeepL’s 128 KB request limit by chunking large texts automatically.

### Google Translate

To use Google Translate, you must set up a project in the Google Cloud Platform (GCP) and enable the specific API service.

1. **Create a Project**: Go to the [Google Cloud Console](https://console.cloud.google.com/) and create a new project (or select an existing one).
2. **Enable Billing**: Ensure a billing account is linked to your project. The Cloud Translation API requires billing to be enabled, even if you stay within the free tier limits.
3. **Enable the API**:
   - Navigate to **APIs & Services > Library**.
   - Search for **"Cloud Translation API"**.
   - Click on the result (ensure it says "Cloud Translation API" and not just "Translation API" or "AutoML").
   - Click **Enable**.
4. **Create Credentials**:
   - Navigate to **APIs & Services > Credentials**.
   - Click **+ CREATE CREDENTIALS** and select **API key**.
   - Copy the generated API key.
5. **Restrict Key (Recommended)**:
   - Edit the API key you just created.
   - Under **API restrictions**, select **Restrict key**.
   - From the dropdown, select **Cloud Translation API**.
   - Click **Save**.

```yaml
google:
  api_key: 'your-google-api-key'
  format: text  # or 'html'
```

### AI Pro Providers

When AI Pro is present, AI Translate can reuse **any registered provider** (OpenAI, Claude, Gemini, DeepSeek, or custom drivers).  
Select `ai-pro:<provider>` as the provider, optionally set a **model override**, and AI Translate forwards translation prompts through AI Pro’s `chat` pipeline so you inherit streaming, retries, and background processing.

### Switching Providers in the Admin

Authorized users see the **Translation Tuner** slide-out panel. It calls `/admin/ai-translate-ajax` to list DeepL plus every AI Pro provider, and it can ask AI Pro for live model lists via the `ai-pro.getModels` task. Changes are saved immediately to `user/config/plugins/ai-translate.yaml`.

## Admin Workflow

- **Inline Buttons** – Translation controls appear on text, textarea, and editor fields defined in `ui.enabled_field_types`.  
- **Manual Mode** – Set `ui.manual_mode: true` to require `translatable: true` in blueprints.  
- **Preview Mode** – Enable `ui.show_preview` to show side-by-side translated output before committing.  
- **Exclusion Rules** – Provide CSS selectors in `ui.exclusion_rules` to skip metadata or routes automatically.  
- **Permission-Aware** – Only users with `admin.super` or `admin.ai-translate` see buttons or AJAX routes.

Translations fire through an AJAX POST to `/admin/ai-translate-ajax`. Security relies on the Admin nonce plus explicit permission checks inside `AiTranslatePlugin::handleAjaxTranslate()`.

## Chunking & Large Pages

Both providers use the shared **TranslationChunker**:

- Splits text on sentence boundaries with optional overlap (`chunking.overlap_size`) to preserve context.  
- Respects formatting when `chunking.preserve_formatting` is true.  
- Applies conservative 50 KB limits for AI models to stay within token budgets.  
- Reassembles the result while allowing minor overlap to maintain flow.

Tweak chunk sizes under `plugins.ai-translate.chunking`. Oversized content falls back to chunked translation automatically; shorter inputs use a single request.

## Caching Strategy

`classes/Providers/AbstractProvider` handles a two-tier cache:

- **In-memory cache** avoids re-translating the same field during a single request.  
- **Grav cache** persists translations keyed by text, languages, and provider.  
- Configure cache lifetime via `cache.lifetime`; disable entirely with `cache.enabled: false`.

Caching reduces API costs dramatically when editors re-open drafts or when batch jobs rerun.

## Language Detection

Call the `detect-language` task or AJAX endpoint to classify source language.  
- DeepL uses its native detection API.  
- AI Pro builds a minimal prompt (`Detect the language…`) and enforces ISO 639-1 validation on the response.  

Detected codes feed back into the field UI so users can confirm before translating.

## CLI & Automation

AI Translate reuses Grav’s Admin task system. Trigger translations, provider refreshes, or language detection from your own controllers or CLI scripts by posting to `/admin` with `task=ai-translate.translate` or `task=ai-translate.detect-language`.  
Combine this with **Scheduler** or custom plugins to translate entire collections after deployment.

For deeper automation, instantiate the `TranslationManager` in your own plugin or task:

```php
use Grav\Plugin\AiTranslate\TranslationManager;

/** @var \Grav\Common\Grav $grav */
$translator = new TranslationManager($grav, $grav['config']);
$translated = $translator->translate($original, 'fr');
```

The manager automatically picks the configured provider, enforces permissions, and throws informative exceptions when providers lack credentials.

## Configuration Reference

Copy `user/plugins/ai-translate/ai-translate.yaml` to `user/config/plugins/ai-translate.yaml` before editing. Key options include:

- `provider` – `deepl` or `ai-pro:<name>`.  
- `deepl.*` – API key, formality, and formatting controls.  
- `ai_pro.model` – Optional model override; leave empty for provider defaults.  
- `ai_pro.custom_prompt` – Template with `{text}`, `{target_lang}`, `{source_lang}` placeholders.  
- `ui.*` – Field types, manual mode, preview, icons, tooltips, exclusion rules.  
- `languages.auto_detect` – Toggle automatic detection and fallback source language.  
- `cache.*` and `chunking.*` – Performance tuning knobs.  

Blueprints use `data-options@` calls to fetch live AI Pro provider lists, model arrays, and language selections, keeping the Admin UI synchronized with runtime capabilities.

## Working With AI Pro

- AI Translate checks for AI Pro availability on plugin initialization and sets `ai_translate.ai_pro_available` in Grav’s container.  
- Provider registration uses AI Pro’s **event-driven registry**, so third-party packages (e.g. AI Pro – DeepSeek) appear automatically.  
- When AI Pro is missing or disabled, AI Translate gracefully falls back to DeepL without surfacing AI-specific UI.

## Permissions

`permissions.yaml` registers `admin.ai-translate`. Grant it to editors who should translate content without full super-admin rights. AJAX handlers and assets verify the permission before rendering controls or processing requests.

## Troubleshooting

- **Buttons missing** → Check permissions, ensure plugin enabled, clear cache (`bin/grav clear-cache`).  
- **Unauthorized AJAX** → Missing or expired Admin nonce; re-open the Admin page.  
- **Empty translations** → Verify provider credentials. For AI Pro, check the selected model supports translation and review logs in `logs/grav.log`.  
- **Large page fails** → Adjust `chunking.max_chunk_size`, ensure target provider supports long prompts, or enable DeepL for documents.  
- **Model list empty** → Ensure AI Pro has permissions to list models for the provider; use `bin/plugin ai-pro models --provider=<name>`.

## Best Practices

- Keep frequently used languages enabled in **System → Languages** for better defaults.  
- Use **manual mode** for technical blueprints so only designated fields can be translated.  
- Encourage editors to run **preview mode** for high-value pages before saving changes.  
- Reuse AI Pro’s **caching and background processing** when translating large collections or scripted jobs.

Need help? Open an issue using the link above and share logs (`logs/grav.log`) plus the provider/model you were using.
