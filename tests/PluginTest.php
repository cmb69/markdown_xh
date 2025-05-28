<?php

namespace Markdown;

use PHPUnit\Framework\TestCase;

class PluginTest extends TestCase
{
    public function testMakesEditor(): void
    {
        $this->assertInstanceOf(Editor::class, Plugin::editor());
    }
}
