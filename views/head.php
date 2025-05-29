<?php

use Plib\View;

if (!defined("CMSIMPLE_XH_VERSION")) {http_response_code(403); exit;}

/**
 * @var View $this
 * @var string $css
 * @var string $script
 */
?>

<link rel="stylesheet" href="<?=$this->esc($css)?>">
<script src="<?=$this->esc($script)?>"></script>
