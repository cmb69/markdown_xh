<?php

use Markdown\Plugin;
use Plib\Request;

function include_markdown(): void
{
    Plugin::editor()->include(Request::current())();
}

function markdown_replace(string $id, string $config = ""): string
{
    return Plugin::editor()->replace($id, $config);
}

/** @param list<string> $classes */
function init_markdown(array $classes = array(), string $config = ""): void
{
    Plugin::editor()->init($classes, $config, Request::current())();
}
