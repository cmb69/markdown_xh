<?php

/**
 * Copyright (c) Christoph M. Becker
 *
 * This file is part of Markdown_XH.
 *
 * Markdown_XH is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Markdown_XH is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Markdown_XH.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Markdown;

use Markdown\Model\Markdown;
use Markdown\Model\Parsedown\Parsedown;
use Plib\SystemChecker;
use Plib\View;

class Plugin
{
    public const VERSION = "0.1";

    private static ?Editor $editor = null;

    public static function editor(): Editor
    {
        global $pth;
        if (self::$editor === null) {
            self::$editor = new Editor(
                $pth["folder"]["base"],
                $pth["folder"]["plugins"],
                self::view()
            );
        }
        return self::$editor;
    }

    public static function infoCommand(): InfoCommand
    {
        global $pth;
        return new InfoCommand(
            $pth["folder"]["plugins"] . "markdown/",
            new SystemChecker(),
            self::view()
        );
    }

    public static function markdown(): Markdown
    {
        return new Markdown(new Parsedown());
    }

    private static function view(): View
    {
        global $pth, $plugin_tx;
        return new View($pth["folder"]["plugins"] . "markdown/views/", $plugin_tx["markdown"]);
    }
}
