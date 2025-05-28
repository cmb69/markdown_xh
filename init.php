<?php

use Markdown\Plugin;
use Plib\Request;

function init_markdown($classes = array(), $config = false): void
{
    Plugin::editor()->init($classes, $config, Request::current())();
}
