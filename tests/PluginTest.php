<?php

namespace Markdown;

use Markdown\Model\Markdown;
use PHPUnit\Framework\TestCase;

class PluginTest extends TestCase
{
    protected function setUp(): void
    {
        global $pth, $plugin_tx;
        $pth = ["folder" => ["base" => "", "plugins" => ""]];
        $plugin_tx = ["markdown" => []];
    }

    public function testMakesEditor(): void
    {
        $this->assertInstanceOf(Editor::class, Plugin::editor());
    }

    public function testMakesInfoCommand(): void
    {
        $this->assertInstanceOf(InfoCommand::class, Plugin::infoCommand());
    }

    public function testMakesMarkdown(): void
    {
        $this->assertInstanceOf(Markdown::class, Plugin::markdown());
    }
}
