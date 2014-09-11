<?php
  $wpsiteFollowUsAnchor = '<a href="http://www.wpsite.net/social-media-follow-us-badges">WPsite Follow Us Badges</a>';
  $polylangAnchor = '<a href="http://polylang.wordpress.com/">Polylang</a>';
?>
<div class="error">
  <p><?php
    _e( "Multilingual Follow Us Badges Activation error: Your environment doesn't meet all of the system requirements listed below.", Constants::$textDomain );
  ?></p>

  <ul class="ul-disc">
    <li><?php
      _e( "The $wpsiteFollowUsAnchor plugin must be installed and activated.", Constants::$textDomain );
    ?></li>
    
    <li><?php
      _e( "The $polylangAnchor plugin must be installed and activated.", Constants::$textDomain );
    ?></li>
  </ul>
  
</div>