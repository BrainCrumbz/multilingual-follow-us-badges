
<!-- Translate -->

<tr>
  <th>
    <label><?php _e( 'Translate', Constants::$textDomain ); ?></label>
    <td>
      <input id="<?php echo $viewBag['fieldId'] ?>" name="<?php echo $viewBag['fieldId'] ?>" type="checkbox" <?php echo ( $viewBag['doTranslate'] ? 'checked="checked"' : '' ); ?> ><br/>
      <em><label><?php _e( 'Translate button according to page or post language', Constants::$textDomain ); ?></label></em>
    </td>
  </th>
</tr>