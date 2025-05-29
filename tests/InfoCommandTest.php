<?php

namespace Markdown;

use ApprovalTests\Approvals;
use PHPUnit\Framework\TestCase;
use Plib\FakeSystemChecker;
use Plib\SystemChecker;
use Plib\View;

class InfoCommandTest extends TestCase
{
    private SystemChecker $systemChecker;
    private View $view;

    public function setUp(): void
    {
        $this->systemChecker = new FakeSystemChecker();
        $this->view = new View("./views/", XH_includeVar("./languages/en.php", "plugin_tx")["markdown"]);
    }

    private function sut(): InfoCommand
    {
        return new InfoCommand("./", $this->systemChecker, $this->view);
    }

    public function testRendersPluginInfo(): void
    {
        $response = $this->sut()();
        $this->assertSame("Markdown 0.1-dev", $response->title());
        Approvals::verifyHtml($response->output());
    }
}
