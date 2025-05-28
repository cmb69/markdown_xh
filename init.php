<?php

use Markdown\Plugin;
use Plib\Request;

function init_markdown($classes = array(), $config = false)
{
    Plugin::editor()->init($classes, $config, Request::current());
}
