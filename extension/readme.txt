[center][size=14pt][b]Password complexity (entropy) requirement mod[/b][/size]
by [url=http://www.simplemachines.org/community/index.php?action=profile;u=268244]The Omega[/url][/center]

[size=14pt][b]License:[/b][/size]
This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

A copy of the GNU General Public License can be obtained at [url]http://www.gnu.org/licenses/[/url].

[size=14pt][b]Requirements:[/b][/size]
Simple Machines Forum version 2.0 or later. The mod uses CSS3 to format rounded edges to a progress bar, but CSS3 support is not required and custom styles may be used. To enable the mod, go to Configuration > Security and Moderation > General and in the "Required strength for user passwords" field, change to "entropic". Note that you need to change this field back if the mod is uninstalled.

[size=14pt][b]The basics:[/b][/size]
This mod allows you to change the password requirement to set a "complexity" requirement (entropy). This helps ensure your users will be using a secure password that cannot be easily brute forced. For an example of password entropy and its usefulness, see [url=http://xkcd.com/936/]this xkcd comic[/url]. Note that the formula used to calculate bits of entropy differs.

[size=14pt][b]The workings:[/b][/size]
This mod uses a simple calculation of password strength: [password length]log[size of character set] (where log is a base 2 logarithm). For example, the (very insecure) password "password" has a complexity of [8]log[26] = 37 (the character size is 26 because we're using all lowercase letters and there are 26 possible choices). On the other hand, if there was at least one capital letter, say "Password", then the complexity becomes [8]log[52] = 45 (26 lowercase and 26 uppercase possibilities). The appearance of numbers would increase the character set by +10, symbols would increase the character set by +32 (number of symbols on a standard American keyboard), and other characters (such as foreign characters) increase the character set by +128 (an arbitrary large number due to the rarity of other symbols in passwords). You can test password strength on [url=http://mike-hoffert.com/sandbox/password.html]this page[/url].

Once the bits of entropy have been calculated, the password must meet a threshold (defaults to 50). If the threshold is not met, the password is considered too weak and will not be accepted. Beyond that are four levels (labeled "okay", "good", "great", and "excellent" for English) which are entirely for show on the password strength bar. They do not restrict the password from being used, but are meant to show that just meeting the threshold alone does not mean much for security.

The parsing is done server side. The client side password strength bar is purely for show. Thus, this mod will work on users who have JavaScript disabled, although they'll have no way to see if their password is strong enough prior to submission.

[size=14pt][b]The defaults:[/b][/size]
By default, the password must meet a threshold of 50 bits of entropy. Thus, the previous example, "password", at 37 bits would be too weak. I have not, at the time, implemented a feature to disallow common words because the 25 most common passwords are all too weak by the default threshold. The four levels default to up to 55, 75, 90, and over. So a password with a strength of 70 bits would be considered "good". A password with a strength of 95 bits, on the other hand, would be considered "excellent".

The defaults are made so-as to not be too obtrusive to users. If you wish to enforce a higher level of security, consider increasing the values. This can be done in the Configuration > Modification Settings > Miscellaneous menu.

[size=14pt][b]Disclaimer:[/b][/size]
This is a reasonably basic password complexity algorithm. Password length and a variance of characters are valued. However, it does not guarentee that one password is necessarily more secure than another. Consider it an estimate. While it was written to support foreign characters, the algorithm also assumes that anyone attempting to brute force the password would first try the standard Latin alphabet and Arabic numbering.

[size=14pt][b]Future improvements:[/b][/size]
It is not currently clear what features this mod will adopt in the future. If you like the mod or have ideas to improve it, please feel free to leave feedback. All feedback is welcome. Possible future expansions include treating common words as weaker, improving the algorithm, and allowing more user customization.

[size=14pt][b]Compatibility:[/b][/size]
I tried to modify as few locations as possible. Thus, the mod should be compatible with all mods that do not modify the password parsing process. Since this mod does not prevent the useage of the other levels of password parsing, it should even by compatible with mods that do modify the password process with some minor tweaking and/or manual installation. If there are mod conflicts, please contact me with information on the conflict. A manual install can also be attempted.

[size=14pt][b]Change log[/b][/size]
[code]Version 1.4:
-Now includes a timer-based check if the password has changed, which captures passwords inserted
 by pasting with context menus and password managers

Version 1.3:
-Simple repetition and series are checked for and disallowed

Version 1.2:
-The password reset dialog now has a password strength bar
-The initial message for when no password is entered or when JS is disabled is friendlier

Version 1.1:
-Fixed bug where backslashes were being considered "other characters" instead of symbols
-Fixed bug where passwords of just enough complexity were being denied
-Moved inline CSS to external file
-Added password strength bar to profile "change password" area
-Changed default colour of password strength bar to lighter tone

Version 1.0:
-Initial version
[/code]