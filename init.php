<?php

use Markdown\Plugin;
use Plib\Request;

/** @param list<string> $classes */
function init_markdown(array $classes = array(), string $config = ""): void
{
    Plugin::editor()->init($classes, $config, Request::current())();
}
