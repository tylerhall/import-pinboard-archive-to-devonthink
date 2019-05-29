# Import Pinboard archives into DEVONThink as web archives

[Pinboard](https://www.pinboard.in) is a web-based bookmarking service that can optionally crawl the websites you bookmark and store a complete copy of how they appeared at that time.

Because Pinboard is a good web citizen, they allow you to request an archive of all of your bookmarks and their saved contents as a `tar.gz` file.

I recently stopped using Pinboard as my primary bookmarking service and wanted to export my data and store it somewhere in a searchable, archived format.

I already use [DEVONThink](https://www.devontechnologies.com) to archive all of my scanned documents and PDFs, so it seemed like a natural choice as it also supports just about any other file format - including macOS web archives.

The PHP script in this repo will read the contents of your Pinboard archive and generate a `.webloc` file for each bookmark. Those files can then be imported into DEVONThink as `file://` URLs pointing to the archived web content on disk. Then, DEVONThink can "crawl" those `file://` URLs and convert them into searchable web archives. Afterwards, the `.webloc` files can be deleted.

On my iMac Pro with a fast internet connection, importing 3,500+ bookmarks took about four hours. After it was finished, I had a fully searchable archive of all of my Pinboard bookmarks that can be sync'd across all my of Macs and iDevices.

Hopefully someone else will find this script useful.

## Usage

1. Request a backup of your data from Pinboard. I have 3,500 bookmarks spanning over ten years. It took 36 hours for Pinboard to email me saying the archive was ready to download. You'll be given a `.tar.gz` file (mine was about 2GB). Save it somewhere on your Mac.
2. Extract the archive. _Note: when I double-clicked the archive in Finder to open it, macOS complained that it was corrupt. Running `tar -xzvf pinboard.tar.gz` from the command line successfully extracted it._
3. The extracted archive will give you a folder named after your Pinboard account's username. Inside it, each of your bookmarks' archives are contained inside separate folders.
4. Open `ConvertPinboardArchiveToWeblocs.php` in a text editor and change the value of `$pathToPinboardArchive` to the full path of your Pinboard username's folder. For example, something like this:

    $pathToPinboardArchive = "/Users/thall/Desktop/tylerhall";

5. From a command line, run `php ConvertPinboardArchiveToWeblocs.php`. That will generate a folder called `weblocs` full of `.webloc` files for each of your bookmarks.
6. Drag all of the `.webloc` files into your DEVONThink database.
7. Select all of them in DEVONThink and choose **Data → Convert → to Web Archive** from the menu bar.
8. Wait.
9. After DEVONThink crawls and archives everything, you can optionally sort by `Kind` and re-select all of the `.webloc` files to delete them from your database.

## Feedback

I wrote this script in about fifteen minutes after nearly two hours of fiddling with various AppleScript methods that never worked. It successfully imported and converted all of my bookmarks, but it's certainly possible there are broken edge cases that I never encountered.

If you run into a bug or have a feature request, feel free to create a GitHub issue on this repo. Or you can [contact me directly](https://tyler.io/about/). Pull requests are very much welcome.
