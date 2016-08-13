For general documentation on the use of skins, see https://www.mediawiki.org/wiki/Special:MyLanguage/Help:Skins

Download and extract the file(s) in a directory called "Dgraph" in your skins/ folder. Note that a base file in the root folder is no longer required in MediaWiki.

Add the following code at the bottom of your "LocalSettings.php"

wfLoadSkin( 'Dgraph' );

$wgDefaultSkin = "dgraph";



