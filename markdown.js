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

const textarea = document.querySelector('.xh-editor');
const button = document.createElement('button');
button.textContent = "Save";
textarea.form.appendChild(button);
const toolbar = document.createElement("div");
textarea.before(toolbar);
const element = document.createElement("div");
element.style.height = textarea.style.height;
element.style["overflow-y"] = "scroll";
element.style.border = "1px solid #ccc";
textarea.before(element);
const tinyMDE = new TinyMDE.Editor({
    textarea: textarea,
    element: element
});
let selection1;
let selection2;
let type;
var commandBar = new TinyMDE.CommandBar({
    element: toolbar,
    editor: tinyMDE,
    commands: [
        'bold',
        'italic',
        'strikethrough',
        '|',
        'code',
        '|',
        'h1', 'h2',
        '|',
        'ul', 'ol',
        '|',
        'blockquote',
        'hr',
        '|',
        {
            name: 'insertLink', 
            action: editor => {
                selection1 = editor.getSelection(true);
                selection2 = editor.getSelection();
                type = "link";
                markdown_filebrowser("downloads");
            }
        },
        {
            name: 'insertImage', 
            action: editor => {
                selection1 = editor.getSelection(true);
                selection2 = editor.getSelection();
                type = "image";
                markdown_filebrowser("images");
            }
        },
    ],
});

function setLink(url) {
    console.log(type);
    if (selection1 && selection2) {
        tinyMDE.setSelection(selection2, selection1);
        selection1 = selection2 = undefined;
    }
    if (type === "link") {
        tinyMDE.wrapSelection('[', `](${url})`);
    } else if (type === "image") {
        tinyMDE.wrapSelection('![', `](${url})`);
    }
    tinyMDE.fireChange();
    const dialog = document.querySelector("dialog.markdown_modal");
    dialog.close();
    dialog.querySelector("iframe").src = "about:blank";
}
