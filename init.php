<?php

use Markdown\Plugin;
use Plib\Request;

function include_markdown(): void
{
    Plugin::editor()->include(Request::current())();
}

/** @param list<string> $classes */
function init_markdown(array $classes = array(), string $config = ""): void
{
    Plugin::editor()->init($classes, $config, Request::current())();
}
