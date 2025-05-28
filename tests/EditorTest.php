<?php

namespace Markdown;

use ApprovalTests\Approvals;
use PHPUnit\Framework\TestCase;
use Plib\FakeRequest;
use Plib\View;

class EditorTest extends TestCase
{
    private View $view;

    protected function setUp(): void
    {
        $this->view = new View("./views/", XH_includeVar("./languages/en.php", "plugin_tx")["markdown"]);
    }

    private function sut(): Editor
    {
        return new Editor("./", "./plugins/markdown/", $this->view);
    }

    public function testInitRendersHjs(): void
    {
        $request = new FakeRequest();
        $response = $this->sut()->init([], false, $request);
        Approvals::verifyHtml($response->hjs());
    }

    public function testInitRenderBjs(): void
    {
        $request = new FakeRequest();
        $response = $this->sut()->init([], false, $request);
        Approvals::verifyHtml($response->bjs());
    }
}
