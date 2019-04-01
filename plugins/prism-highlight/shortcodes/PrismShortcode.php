<?php
namespace Grav\Plugin\Shortcodes;

use Grav\Common\Data\Data;
use Grav\Common\Utils;
use Thunder\Shortcode\Shortcode\ProcessedShortcode;

class PrismShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getRawHandlers()->add('prism', function(ProcessedShortcode $sc) {

            $config = new Data($this->config->get('plugins.prism-highlight'));

            $content = $sc->getContent();
            $classes = $sc->getParameter('classes', $this->getBbCode($sc)) ?: 'language-text';
            $highlight_lines = $sc->getParameter('highlight');

            $enable_line_numbers = (bool) Utils::contains($classes, 'line-numbers') ?: $config->get('plugins.line-numbers');
            $enable_command_line = (bool) Utils::contains($classes, 'command-line') ?: $config->get('plugins.command-line');

            $ln_start = $sc->getParameter('ln-start');
            $cl_prompt = $sc->getParameter('cl-prompt', $config->get('plugins.command-line-prompt'));
            $cl_output = $sc->getParameter('cl-output');

            $output = $this->twig->processTemplate('shortcodes/prism-highlight.html.twig', [
                'content' => trim($content),
                'classes' => $classes,
                'enable_line_numbers' => $enable_line_numbers,
                'enable_command_line' => $enable_command_line,
                'cl_prompt' => $cl_prompt,
                'cl_output' => $cl_output,
                'ln_start' => $ln_start,
                'highlight_lines' => $highlight_lines,
            ]);

            return $output;
        });
    }
}
