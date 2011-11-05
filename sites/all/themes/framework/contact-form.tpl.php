
<div id="contact_form">
  <div class="info"><?php print $cf_intro_message; ?></div>
  <div class="form">
    <table>
      <tr>
        <td colspan="2"><?php print $cf_cid; ?></td>
      </tr>
      <tr>
        <td><?php print $cf_nome; ?></td>
        <td><?php print $cf_email; ?></td>
      </tr>
      <tr>
        <td><?php print $cf_fone; ?></td>
        <td><?php print $cf_empresa; ?></td>
      </tr>
      <tr>
        <td colspan="2" class="assunto"><?php print $cf_assunto; ?></td>
      </tr>
       <tr>
        <td colspan="2" class="mensagem"><?php print $cf_mensagem; ?></td>
      </tr>
       <tr>
        <td colspan="2"><?php print $cf_copia; ?></td>
      </tr>
       <tr>
        <td colspan="2"><?php print $cf_enviar; ?></td>
      </tr>
    </table>
  </div>
</div>
<div style="display:none;"> <?php print drupal_render($form); ?> </div>
