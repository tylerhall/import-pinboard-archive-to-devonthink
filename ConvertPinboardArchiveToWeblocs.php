<?PHP
	$pathToPinboardArchive = "/Users/thall/_tmp/tylerhall/";

	// !!! NOTHING MORE TO EDIT BELOW THIS LINE !!!

	$weblocTemplate = '{ URL = "{{URL}}"; }';
	mkdir("weblocs");
	$pathToPinboardArchive = rtrim($pathToPinboardArchive, '/') . '/';

	$folders = scandir($pathToPinboardArchive);
	foreach($folders as $slug) {
		if(strlen($slug) < 3) { // Skip nonsense filenames
			continue;
		}

		$manifestFileName = $pathToPinboardArchive . $slug . "/__manifest.txt";
		if(file_exists($manifestFileName)) {
			$dict = json_decode(file_get_contents($manifestFileName));
			if($dict !== false) {
				$fileURL = "file://" . $pathToPinboardArchive . $slug . "/" . $dict->filename;
				$webloc = str_replace("{{URL}}", $fileURL, $weblocTemplate);
				file_put_contents("weblocs/$slug.webloc", $webloc);
				$date = touch("weblocs/$slug.webloc", $dict->crawled_at);
				echo "Creating .webloc file for: $fileURL \n";
			} else {
				echo "ERROR: Could not parse contents of $manifestFileName\n";
			}
		}
	}
