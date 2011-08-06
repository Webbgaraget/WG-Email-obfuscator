<?php
require_once('email-obfuscator.php');

$prefix = false;
$email_obfuscator = new WGEmailObfuscator( ( isset($_GET['prefix']) ? $_GET['prefix'] : false ) );

header("Content-type: text/javascript");
?>

var Webbgaraget = Webbgaraget || {};

Webbgaraget.EmailObfuscator = Webbgaraget.EmailObfuscator || function($)
{
	$(window).ready(function()
	{
		<?php foreach( $email_obfuscator->replacements as $original => $replacement ): ?>
			$('body').html($('body').html().replace(/<?php echo $email_obfuscator->build_nonce( $replacement ); ?>/g, '<?php echo $original; ?>'));
		<?php endforeach; ?>
	});
};

Webbgaraget.EmailObfuscator(jQuery);