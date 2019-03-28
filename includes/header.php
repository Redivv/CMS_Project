<?php
function create_header(string $title,string $subtitle) : void{ ?>
<h1 class="page-header">
    <?php echo $title ?>
    <small><?php echo $subtitle; ?></small>
</h1>
<?php } ?>
