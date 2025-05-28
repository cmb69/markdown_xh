<?php

namespace Markdown;

use PHPUnit\Framework\TestCase;

class PluginTest extends TestCase
{
    protected function setUp(): void
    {
        global $pth, $plugin_tx;
        $pth = ["folder" => ["plugins" => ""]];
        $plugin_tx = ["markdown" => []];
    }

    public function testMakesEditor(): void
    {
        $this->assertInstanceOf(Editor::class, Plugin::editor());
    }
}
