<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Website\Twig;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\Autolink\UrlAutolinkParser;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\ExternalLink\ExternalLinkExtension;
use League\CommonMark\Extension\Strikethrough\StrikethroughExtension;
use League\CommonMark\MarkdownConverter;
use League\CommonMark\Util\HtmlFilter;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Renders the descriptions of schema.org, written in Markdown.
 */
final class MarkdownExtension extends AbstractExtension
{
    private readonly MarkdownConverter $markdownConverter;

    public function __construct()
    {
        $environment = new Environment([
            'allow_unsafe_links' => true,
            'external_link' => [
                'nofollow' => 'external',
                'noopener' => 'external',
                'noreferrer' => 'external',
            ],
            'html_input' => HtmlFilter::ALLOW,
            'max_nesting_level' => 1000,
            'renderer' => [
                'block_separator' => "\n",
                'inner_separator' => "\n",
                'soft_break' => "\n",
            ],
        ]);
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new StrikethroughExtension());
        $environment->addExtension(new ExternalLinkExtension());
        $environment->addInlineParser(new UrlAutolinkParser());

        $this->markdownConverter = new MarkdownConverter($environment);
    }

    #[\Override]
    public function getFilters(): array
    {
        return [
            new TwigFilter('renderMarkdown', $this->renderMarkdown(...), ['pre_escape' => 'html', 'is_safe' => ['html']]),
        ];
    }

    private function renderMarkdown(string $markdown): string
    {
        $html = (string) $this->markdownConverter->convert(str_replace('\n', "\n", $markdown));

        // schema.org links its own terms as [[Term]]
        return preg_replace('/\[\[([a-zA-Z0-9]+)\]\]/', '<a href="https://schema.org/$1" target="_blank" rel="noopener noreferer nofollow">$1</a>', $html) ?? $html;
    }
}
