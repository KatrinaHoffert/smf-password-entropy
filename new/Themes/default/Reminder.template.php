<?php
/**
 * Simple Machines Forum (SMF)
 *
 * @package SMF
 * @author Simple Machines
 * @copyright 2011 Simple Machines
 * @license http://www.simplemachines.org/about/smf/license.php BSD
 *
 * @version 2.0
 */

function template_main()
{
	global $context, $settings, $options, $txt, $scripturl;

	echo '
	<br />
	<form action="', $scripturl, '?action=reminder;sa=picktype" method="post" accept-charset="', $context['character_set'], '">
		<div class="tborder login">
			<div class="cat_bar">
				<h3 class="catbg">', $txt['authentication_reminder'], '</h3>
			</div>
			<span class="upperframe"><span></span></span>
			<div class="roundframe">
				<p class="smalltext centertext">', $txt['password_reminder_desc'], '</p>
				<dl>
					<dt>', $txt['user_email'], ':</dt>
					<dd><input type="text" name="user" size="30" class="input_text" /></dd>
				</dl>
				<p class="centertext"><input type="submit" value="', $txt['reminder_continue'], '" class="button_submit" /></p>
			</div>
			<span class="lowerframe"><span></span></span>
		</div>
		<input type="hidden" name="', $context['session_var'], '" value="', $context['session_id'], '" />
	</form>';
}

function template_reminder_pick()
{
	global $context, $settings, $options, $txt, $scripturl;

	echo '
	<br />
	<form action="', $scripturl, '?action=reminder;sa=picktype" method="post" accept-charset="', $context['character_set'], '">
		<div class="tborder login">
			<div class="cat_bar">
				<h3 class="catbg">', $txt['authentication_reminder'], '</h3>
			</div>
			<span class="upperframe"><span></span></span>
			<div class="roundframe">
				<p><strong>', $txt['authentication_options'], ':</strong></p>
				<p>
					<input type="radio" name="reminder_type" id="reminder_type_email" value="email" checked="checked" class="input_radio" /></dt>
					<label for="reminder_type_email">', $txt['authentication_' . $context['account_type'] . '_email'], '</label></dd>
				</p>
				<p>
					<input type="radio" name="reminder_type" id="reminder_type_secret" value="secret" class="input_radio" />
					<label for="reminder_type_secret">', $txt['authentication_' . $context['account_type'] . '_secret'], '</label>
				</p>
				<p class="centertext"><input type="submit" value="', $txt['reminder_continue'], '" class="button_submit" /></p>
			</div>
			<span class="lowerframe"><span></span></span>
		</div>
		<input type="hidden" name="uid" value="', $context['current_member']['id'], '" />
		<input type="hidden" name="', $context['session_var'], '" value="', $context['session_id'], '" />
	</form>';
}

function template_sent()
{
	global $context, $settings, $options, $txt, $scripturl;

	echo '
		<br />
		<div class="tborder login" id="reminder_sent">
			<div class="cat_bar">
				<h3 class="catbg">' . $context['page_title'] . '</h3>
			</div>
			<p class="information">' . $context['description'] . '</p>
		</div>';
}

function template_set_password()
{
	global $context, $settings, $options, $txt, $scripturl, $modSettings;

	echo '
	<script type="text/javascript" src="', $settings['default_theme_url'], '/scripts/register.js"></script>
	<br />
	<form action="', $scripturl, '?action=reminder;sa=setpassword2" name="reminder_form" id="reminder_form" method="post" accept-charset="', $context['character_set'], '">
		<div class="tborder login">
			<div class="cat_bar">
				<h3 class="catbg">', $context['page_title'], '</h3>
			</div>
			<span class="upperframe"><span></span></span>
			<div class="roundframe">
				<dl>
					<dt>', $txt['choose_pass'], ': </dt>
					<dd>
						<input type="password" name="passwrd1" id="smf_autov_pwmain" size="22" class="input_password" />
						<span id="smf_autov_pwmain_div" style="display: none;">
							<img id="smf_autov_pwmain_img" src="', $settings['images_url'], '/icons/field_invalid.gif" alt="*" />
						</span>
					</dd>
					<dt>', $txt['verify_pass'], ': </dt>
					<dd>
						<input type="password" name="passwrd2" id="smf_autov_pwverify" size="22" class="input_password" />
						<span id="smf_autov_pwverify_div" style="display: none;">
							<img id="smf_autov_pwverify_img" src="', $settings['images_url'], '/icons/field_invalid.gif" alt="*" />
						</span>
					</dd>';
if ($modSettings['password_strength'] == 3)
{
	echo '
					<dt><strong>', $txt['password_entropy_strength'], ':</strong></dt>
					<dd>
						<div id="entropyBackground"><div id="entropyValue"></div></div><br /><span id="entropyDescription">', $txt['password_entropy_no_pass'], '</span>
					</dd>
				<script>
				// Remove images
				document.getElementById(\'smf_autov_pwmain_img\').style.display = \'none\';
				document.getElementById(\'smf_autov_pwverify_img\').style.display = \'none\';
				
				var passwordField = document.getElementById(\'smf_autov_pwmain\');
				var entropyValue = document.getElementById(\'entropyValue\');
				var entropyDescription = document.getElementById(\'entropyDescription\');
				var lastPassword;
				
				// Calculate entropy on key release or key press
				passwordField.onkeyup = function()
				{
					CalculateEntropy();
				}
				passwordField.onkeydown = function()
				{
					CalculateEntropy();
				}
				
				function CalculateEntropy()
				{
					var uppercase = 0;
					var lowercase = 0;
					var numbers = 0;
					var symbols = 0;
					var other = 0;
					var characterSet = 0;

					// Loop through each letter
					for(var i = 0; i < passwordField.value.length; i++)
					{
						// Count the number of letters of each type
						if(passwordField.value[i].match(/[A-Z]/) != null) // There is at least one uppercase character
						{
							uppercase++;
						}
						else if(passwordField.value[i].match(/[a-z]/) != null) // There is at least one lowercase character
						{
							lowercase++;
						}
						else if(passwordField.value[i].match(/[0-9]/) != null) // There is at least one number
						{
							numbers++;
						}
						else if(passwordField.value[i].match(/[`~!@#\$%\^&\*\(\)\[\]\{\};:"\'\|\\\,<\.>\/\?\-_\+=]/) != null) // There is at least one symbol
						{
							symbols++;
						}
						else // There is at least one other character (non alphanumeral or simple symbol)
						{
							other++;
						}
					}

					// If a member of the character set appeared, increase the net character 
					// set size based on the number of characters in the set
					if(uppercase)
					{
						characterSet += 26; // ABCDEFGHIJKLMNOPQRSTUVWXYZ
					}
					if(lowercase)
					{
						characterSet += 26; // abcdefghijklmnopqrstuvwxyz
					}
					if(numbers)
					{
						characterSet += 10; // 0123456789
					}
					if(symbols)
					{
						characterSet += 32; // `~!@#$%^&*()-_+={}[]|\;:"\'<>,.?/
					}
					if(other)
					{
						characterSet += 128; // Other stuff; an arbritarty value to give these foreign characters weight
					}

					// The entropy equals [Password Length]Log_2[Character set size]
					// Because JavaScript lacks a base 2 operator (natural log of base e only), we
					// divide the natural log by the natural log of 2, which solves for a logarithm
					// in base 2.
					var entropy = Math.floor(passwordField.value.length * Math.log(characterSet) / Math.log(2));
					if(isNaN(entropy))
					{
						entropy = 0;
					}
					entropyValue.style.width = entropy * 2 + \'px\'; // Set the progress bar
					entropyDescription.innerHTML = entropy + \'', $txt['password_entropy_bits'], '\'; // First part of the description

					if(entropy < ', (isset($modSettings['password_entropy_threshold']) ? $modSettings['password_entropy_threshold'] : 45), ') // Lower threshold
					{
						entropyDescription.innerHTML += \'', $txt['password_entropy_weak'], '\'
						entropyDescription.style.color = \'red\';
						entropyValue.style.backgroundColor = \'red\';
					}
					else if(entropy < ', (isset($modSettings['password_entropy_okay']) ? $modSettings['password_entropy_okay'] : 55), ') // Okay
					{
						entropyDescription.innerHTML += \'', $txt['password_entropy_okay'], '\'
						entropyDescription.style.color = \'green\';
						entropyValue.style.backgroundColor = \'green\';
					}
					else if(entropy < ', (isset($modSettings['password_entropy_good']) ? $modSettings['password_entropy_good'] : 55), ') // Good
					{
						entropyDescription.innerHTML += \'', $txt['password_entropy_good'], '\'
						entropyDescription.style.color = \'green\';
						entropyValue.style.backgroundColor = \'green\';
					}
					else if(entropy < ', (isset($modSettings['password_entropy_great']) ? $modSettings['password_entropy_great'] : 90), ') // Great
					{
						entropyDescription.innerHTML += \'', $txt['password_entropy_great'], '\'
						entropyDescription.style.color = \'green\';
						entropyValue.style.backgroundColor = \'green\';
					}
					else // Best
					{
						entropyDescription.innerHTML += \'', $txt['password_entropy_excellent'], '\'
						entropyDescription.style.color = \'green\';
						entropyValue.style.backgroundColor = \'green\';
					}
				}
					
				// Checks if we should re-evaluate the timer-based checking
				function timerEntropyTest()
				{
					// Only check if the password has changed
					if(lastPassword != passwordField.value)
					{
						lastPassword = passwordField.value;
						CalculateEntropy();
					}
				}
				
				// Timer for catching other methods of inserting passwords (password managers, copy paste, etc)
				setInterval(timerEntropyTest, 1000);
				</script>';
}
echo '
				</dl>
				<p class="align_center"><input type="submit" value="', $txt['save'], '" class="button_submit" /></p>
			</div>
			<span class="lowerframe"><span></span></span>
		</div>
		<input type="hidden" name="code" value="', $context['code'], '" />
		<input type="hidden" name="u" value="', $context['memID'], '" />
		<input type="hidden" name="', $context['session_var'], '" value="', $context['session_id'], '" />
	</form>
	<script type="text/javascript"><!-- // --><![CDATA[
	var regTextStrings = {
		"password_short": "', $txt['registration_password_short'], '",
		"password_reserved": "', $txt['registration_password_reserved'], '",
		"password_numbercase": "', $txt['registration_password_numbercase'], '",
		"password_no_match": "', $txt['registration_password_no_match'], '",
		"password_valid": "', $txt['registration_password_valid'], '"
	};
	var verificationHandle = new smfRegister("reminder_form", ', empty($modSettings['password_strength']) ? 0 : $modSettings['password_strength'], ', regTextStrings);
// ]]></script>';
}

function template_ask()
{
	global $context, $settings, $options, $txt, $scripturl, $modSettings;

	echo '
	<script type="text/javascript" src="', $settings['default_theme_url'], '/scripts/register.js"></script>
	<br />
	<form action="', $scripturl, '?action=reminder;sa=secret2" method="post" accept-charset="', $context['character_set'], '" name="creator" id="creator">
		<div class="tborder login">
			<div class="cat_bar">
				<h3 class="catbg">', $txt['authentication_reminder'], '</h3>
			</div>
			<span class="upperframe"><span></span></span>
			<div class="roundframe">
				<p class="smalltext">', $context['account_type'] == 'password' ? $txt['enter_new_password'] : $txt['openid_secret_reminder'], '</p>
				<dl>
					<dt>', $txt['secret_question'], ':</dt>
					<dd>', $context['secret_question'], '</dd>
					<dt>', $txt['secret_answer'], ':</dt>
					<dd><input type="text" name="secret_answer" size="22" class="input_text" /></dd>';

	if ($context['account_type'] == 'password')
		echo '
					<dt>', $txt['choose_pass'], ': </dt>
					<dd>
						<input type="password" name="passwrd1" id="smf_autov_pwmain" size="22" class="input_password" />
						<span id="smf_autov_pwmain_div" style="display: none;">
							<img id="smf_autov_pwmain_img" src="', $settings['images_url'], '/icons/field_invalid.gif" alt="*" />
						</span>
					</dd>
					<dt>', $txt['verify_pass'], ': </dt>
					<dd>
						<input type="password" name="passwrd2" id="smf_autov_pwverify" size="22" class="input_password" />
						<span id="smf_autov_pwverify_div" style="display: none;">
							<img id="smf_autov_pwverify_img" src="', $settings['images_url'], '/icons/field_valid.gif" alt="*" />
						</span>
					</dd>';

	echo '
				</dl>
				<p class="align_center"><input type="submit" value="', $txt['save'], '" class="button_submit" /></p>
			</div>
			<span class="lowerframe"><span></span></span>
		</div>
		<input type="hidden" name="uid" value="', $context['remind_user'], '" />
		<input type="hidden" name="', $context['session_var'], '" value="', $context['session_id'], '" />
	</form>';

	if ($context['account_type'] == 'password')
		echo '
<script type="text/javascript"><!-- // --><![CDATA[
	var regTextStrings = {
		"password_short": "', $txt['registration_password_short'], '",
		"password_reserved": "', $txt['registration_password_reserved'], '",
		"password_numbercase": "', $txt['registration_password_numbercase'], '",
		"password_no_match": "', $txt['registration_password_no_match'], '",
		"password_valid": "', $txt['registration_password_valid'], '"
	};
	var verificationHandle = new smfRegister("creator", ', empty($modSettings['password_strength']) ? 0 : $modSettings['password_strength'], ', regTextStrings);
// ]]></script>';

}

?>