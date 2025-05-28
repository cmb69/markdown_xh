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

class Editor
{
    /** @param list<string> $classes */
    public function init(array $classes = array(), bool $config = false): void
    {
        global $hjs, $bjs, $pth;
        $hjs .= '<link rel="stylesheet" href="https://unpkg.com/tiny-markdown-editor/dist/tiny-mde.min.css">'
            . '<script src="https://unpkg.com/tiny-markdown-editor/dist/tiny-mde.min.js"></script>';
        $bjs .= '<script>' . $this->filebrowser() . '</script>'
            . "<script src=\"{$pth["folder"]["plugins"]}markdown/markdown.js\"></script>"
            . <<<'EOS'
                <dialog class="markdown_modal">
                <p class="markdown_buttons"><button type="button" onclick='this.parentElement.parentElement.close()'>close</button></p>
                <div>
                <iframe src="about:blank"></iframe>
                <div>
                </dialog>
                EOS;
    }

    private function filebrowser(): string
    {
        if (!XH_ADM) { // @phpstan-ignore-line
            return "";
        }
        $url = CMSIMPLE_BASE . "?&filebrowser=editorbrowser&editor=markdown&prefix=" . CMSIMPLE_BASE . "&type"; // @phpstan-ignore-line
        return <<<EOS
            markdown_filebrowser = function(type) {
                const dialog = document.querySelector("dialog.markdown_modal");
                const iframe = dialog.querySelector("iframe");
                iframe.src = "$url=" + type;
                dialog.showModal();
                const buttons = dialog.querySelector(".markdown_buttons");
                iframe.width = dialog.clientWidth - 10;
                iframe.height = dialog.clientHeight - buttons.clientHeight - 10;
            }
        EOS;
    }
}
