<?php

/**
 * Init Google Analytics
 *
 * @package    pixelytics
 * @subpackage pixelytics/admin
 * @since 1.2.3
 */


$web_property_id = get_option('web_property_id');
?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $web_property_id ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-166258076-1');
</script>

<?php
?>
