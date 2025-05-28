<?php

use Plib\View;

if (!defined("CMSIMPLE_XH_VERSION")) {http_response_code(403); exit;}

/**
 * @var View $this
 * @var string $script
 * @var string $url
 */
?>

<dialog class="markdown_modal" data-url="<?=$this->esc($url)?>">
  <p class="markdown_buttons">
    <button type="button">close</button>
  </p>
  <div>
    <iframe src="about:blank"></iframe>
  <div>
</dialog>
<script src="<?=$this->esc($script)?>"></script>
