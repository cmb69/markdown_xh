<?php

namespace Markdown\Model;

use Markdown\Model\Parsedown\Parsedown;
use PHPUnit\Framework\TestCase;

class MarkdownTest extends TestCase
{
    private function sut(): Markdown
    {
        return new Markdown(new Parsedown());
    }

    public function testConvertsToHtml(): void
    {
        $result = $this->sut()->toHtml("# Test");
        $this->assertSame("<h1>Test</h1>", $result);
    }
}
