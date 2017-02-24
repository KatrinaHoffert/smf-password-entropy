# SMF Password Entropy extension
A Simple Machines Forum extension for better password security by using entropy as a measurement of complexity.
Entropy being a combination of length and type of characters used. So you could get similarly secure passwords
by using more characters from the same set vs a larger set of characters (uppercase, symbols, etc).

This does not take into account how passwords might be vulnerable to a dictionary attack or simply because the
password follows known patterns (such as the common pattern of putting a number at the very end of the password).

This extension is currently in use on [the MegaGlest forum](https://forum.megaglest.org).

This is actually a very old work (from mid-2013) that I just recently thrown into a repo. Guess my 2013 self
had no discovered VCSes yet!

## Functionality
This extension modifies all password *creation* inputs. This includes on account creation, changing your password,
and resetting your password. A minimum entropy threshold is then required for the password to be accepted (replacing
the default minimum length feature). A progress bar shows the current entropy so that it's visible for users.
There's also three additional levels for "okay", "good", and "excellent" labels, simply for informing the user about
good targets for password security. These levels are all configurable.

## Folder structure
The old and new folders contain the full source files for files that were modified (from SMF 2.0). These were then
diffed and that was used to construct the actual extension files in the extension folder.

## Installing
Recommended to use the stable release. The contents of the extention folder need only to be thrown into a zip folder
for SMF to know how to use this. Possible that changes may be necessary for support with versions of SMF greater than
2.0.

## Images
![](https://raw.githubusercontent.com/KatrinaHoffert/smf-password-entropy/master/images/1.jpg)
![](https://raw.githubusercontent.com/KatrinaHoffert/smf-password-entropy/master/images/2.jpg)
![](https://raw.githubusercontent.com/KatrinaHoffert/smf-password-entropy/master/images/3.jpg)
![](https://raw.githubusercontent.com/KatrinaHoffert/smf-password-entropy/master/images/4.jpg)
![](https://raw.githubusercontent.com/KatrinaHoffert/smf-password-entropy/master/images/5.jpg)
