# Markdown_XH

This plugin is a utility plugin for other plugins. It provides a
[conforming editor](https://wiki.cmsimple-xh.org/archiv/doku.php/plugin_interfaces#editors)
for Markdown, and a Markdown to HTML converter.

- [Requirements](#requirements)
- [Download](#download)
- [Installation](#installation)
- [Settings](#settings)
- [Usage](#usage)
  - [Editor](#editor)
- [Limitations](#limitations)
- [Troubleshooting](#troubleshooting)
- [License](#license)
- [Credits](#credits)

## Requirements

Markdown_XH is a plugin for [CMSimple_XH](https://cmsimple-xh.org/).
It requires CMSimple_XH ≥ 1.7.0, and PHP ≥ 7.4.0 with the DOM extension.
Markdown_XH also requires [Plib_XH](https://github.com/cmb69/plib_xh) ≥ 1.10;
if that is not already installed (see `Settings` → `Info`),
get the [lastest release](https://github.com/cmb69/plib_xh/releases/latest),
and install it.

## Download

The [lastest release](https://github.com/cmb69/markdown_xh/releases/latest)
is available for download on Github.

## Installation

The installation is done as with many other CMSimple_XH plugins.

1. Backup the data on your server.
1. Unzip the distribution on your computer.
1. Upload the whole folder `markdown/` to your server into
   the `plugins/` folder of CMSimple_XH.
1. Set write permissions to the subfolders `css/`, and
   `languages/`.
1. Move the file `plugins/markdown/filebrowser/internal.php` to
   `plugins/filebrowser/editorhooks/markdown/script.php` so that the internal
   filebrowser can be used from the editor.
1. Check under `Plugins` → `Markdown` in the back-end of the website,
   if all requirements are fulfilled.

## Settings

The configuration of the plugin is done as with many other
CMSimple_XH plugins in the back-end of the Website. Select
`Plugins` → `Markdown`.

Localization is done under `Language`. You can translate the
character strings to your own language if there is no appropriate
language file available, or customize them according to your
needs.

The look of Markdown_XH can be customized under `Stylesheet`.

## Usage

To convert Markdown to HTML, you just need to call

    \Markdown\Plugin::markdown()->toHtml($markdown)

No additional set up is necessary, since all components are automatically loaded.

### Editor

Instead of having users to type in Markdown in a simple textarea, you can offer them
the bundled Markdown editor.  This is basically done like for other conforming editors,
but you want to call the functions directly instead of using the general editor
functions of CMSimple_XH.  So instead of

    include_editor();
    editor_replace(…);
    init_editor(…);

call

    include_markdown();
    markdown_replace(…);
    init_markdown(…);


Note that no configuration is supported (yet), so just omit the respective
arguments.

## Limitations

There is no support for filebrowsers other than the internal filebrowser of
CMSimple_XH.

## Troubleshooting

Report bugs and ask for support either on
[Github](https://github.com/cmb69/markdown_xh/issues)
or in the [CMSimple_XH Forum](https://cmsimpleforum.com/).

## License

Markdown_XH is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Markdown_XH is distributed in the hope that it will be useful,
but *without any warranty*; without even the implied warranty of
*merchantibility* or *fitness for a particular purpose*. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Markdown_XH.  If not, see <https://www.gnu.org/licenses/>.

Copyright © Christoph M. Becker

## Credits

The plugin is powered by [Parsedown](https://parsedown.org/) and
[TinyMDE](https://jefago.github.io/tiny-markdown-editor/).
Many thanks for providing these awesome tools under the MIT license!

The plugin icon is designed by
[Markdown icons created by brajaomar_j - Flaticon](https://www.flaticon.com/free-icons/markdown).
Many thanks for making this icon available for free.

Many thanks to the community at the
[CMSimple_XH Forum](https://www.cmsimpleforum.com/) for tips, suggestions
and testing.

And last but not least many thanks to [Peter Harteg](httsp://www.harteg.dk),
the “father” of CMSimple,
and all developers of [CMSimple_XH](https://www.cmsimple-xh.org)
without whom this amazing CMS would not exist.
