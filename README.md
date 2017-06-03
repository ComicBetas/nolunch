ComicBetas
=============

#### Software:
- Mac OS X Sierra (http://www.apple.com/)
- GitHub.app (https://github.com/)
- A TextEditor: TextMate (http://macromates.com/), TextWrangler (http://www.barebones.com/products/textwrangler/), BBEdit (http://www.barebones.com/products/bbedit/) or just VI (advanced)
- A FTP client: Cyberduck (http://cyberduck.io/?l=en), FileZilla (https://filezilla-project.org/), or just via Terminal (advanced)
- Terminal (https://github.com/0nn0/terminal-mac-cheatsheet/wiki/Terminal-Cheatsheet-for-Mac-(-basics-))
- MAMP (http://www.mamp.info/en/)

#### Hardware/Other:
- Mac (http://www.apple.com/)
- Apache (http://httpd.apache.org/)
- MySQL (http://www.mysql.com/)
- PHP (http://www.php.net/)
- SASS (http://sass-lang.com/)
- HTML (http://w3schools.com)

#### Setup:
##### Open GitHub.app
1. Select "File>New Repository" (Command-N)
2. Give it the Name "ComicBetas"
3. Click, "Create Repository," button
4. Click, "Settings:" the fourth icon on the left in the Grey bar of the main window.
5. Make sure the, "Primary remote Repository (origin)"," feild says the following:
    https://github.com/ComicBetas/Initial.git
6. Click, "Update Remote," button.

##### Open Terminal
1. Go to you're local storage area
    $ cd /ComicBetas/Initial/
2. Install SASS
    $ sudo gem install sass

#### To Pull:
##### Open GitHub.app
1. Select "Repository Synchronize" (Command-S)
2. If you get a conflict you'll see 
```html
<<<<<<< HEAD
your changes
=======
Your Changes
>>>>>>> FETCH_HEAD
```
    It's up to you to decide which is right

#### To Change:
##### CSS:
1. Edit style.scss
2. Open Terminal
```
$ cd /ComicBetas/Initial/assets/scss
$ sass style.scss ../css/custom.css --style=compressed
```
The second line is generating custom.css, see <http://sass-lang.com/> for additional addons

#### To Commit:
##### Open GitHub.app
1. Go to the changes item
2. Type a descriptive summary
3. Check the boxes of the items you'd like to include
4. Click the "Commit" button

#### To Push:
##### Open GitHub.app
1. Press "Sync Branch" (Command-S)