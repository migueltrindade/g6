<?php
// $Id: simplenews-newsletter-footer.tpl.php,v 1.1.2.4 2009/01/02 11:59:33 sutharsan Exp $

/**
 * @file
 * Default theme implementation to format the simplenews newsletter footer.
 * 
 * Copy this file in your theme directory to create a custom themed footer.
 * Rename it to simplenews-newsletter-footer--<tid>.tpl.php to override it for a 
 * newsletter using the newsletter term's id.
 *
 * Available variables:
 * - $node: newsletter node object
 * - $language: language object
 * - $key: email key [node|test]
 * - $format: newsletter format [plain|html]
 * - $unsubscribe_text: unsubscribe text
 * - $test_message: test message warning message
 *
 * Available tokens:
 * - !confirm_unsubscribe_url: unsubscribe url to be used as link
 * for more tokens: see simplenews_mail_tokens()
 *
 * @see template_preprocess_simplenews_newsletter_footer()
 */
?>
</td>
  </tr>
  <tr>
    <td><div style="margin:20px auto; width:580px;">
        <hr>
        <p><strong>ATEN&Ccedil;&Atilde;O:</strong>&nbsp;Caso voc&ecirc; esteja com problemas para acessar os links do e-mail, selecione e cole o caminho abaixo no seu browser:&nbsp;<a href="!newsletter_url" target="_blank">!newsletter_url</a></p>
        <hr>
        <p>- Por favor, n&atilde;o responda esse e-mail.&nbsp;<br />
        <p>- Caso queira entrar em contato com a Grade6&nbsp;<a href="http://www.grade.com.br/contato">clique aqui</a> </p>
        <p>- A Grade6 &eacute; contra o&nbsp;&quot;spam&quot;. Enviamos este e-mail apenas &agrave;s pessoas que efetuaram o cadastro em nosso site. Para cancelar sua inscri&ccedil;&atilde;o acesse <a href="!confirm_unsubscribe_url">!confirm_unsubscribe_url</a> e confirme a remo&ccedil;&atilde;o</p>
      </div></td>
  </tr>
</table>
<?php if ($key == 'test'): ?>
- - - <?php print $test_message ?> - - -
<?php endif ?>