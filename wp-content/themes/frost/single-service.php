<?php include 'header.php'; 
global $tp_options;
?>
<div class="">
<?php
while(have_posts()) : the_post();
the_content();
endwhile;
?>
</div>
<?php include 'footer.php'; ?>