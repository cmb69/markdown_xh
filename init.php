<?php

function init_markdown($classes = array(), $config = false)
{
    global $hjs, $bjs, $pth;
    $hjs .= '<link rel="stylesheet" href="https://unpkg.com/tiny-markdown-editor/dist/tiny-mde.min.css">'
        . '<script src="https://unpkg.com/tiny-markdown-editor/dist/tiny-mde.min.js"></script>';
    $bjs .= '<script>' . markdown_filebrowser() . '</script>'
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

function markdown_filebrowser(): string
{
    if (!XH_ADM) {
        return "";
    }
    $url = CMSIMPLE_BASE . "?&filebrowser=editorbrowser&editor=markdown&prefix=" . CMSIMPLE_BASE . "&type";
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
