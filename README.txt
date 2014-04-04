To run the php from a local server you'll need an apache service and SQL.
Our group installed XAMPP for this purpose. Alternatives are LAMP and WAMP.


Here's instructions on running the disce webapp with XAMPP:

Installing and running XAMPP
1 - download XAMPP from http://www.apachefriends.org/index.html
2 - install XAMPP
3 - run XAMPP Control Panel, this should be listed in Start -> Programs
4 - start Apache and MySQL services, you will now have a local server and database active

Creating project folder:
5 - create a folder within C:/xampp/htdocs, for instruction purposes we'll call it disce
6 - drag project files into new folder, project files are now all contained within C:/xampp/htdocs/disce

Importing database:
7 - enter the url "localhost/phpmyadmin/" into your web browser and search
8 - create new table called disce
9 - select the disce database
10 - open import tab
11 - import project file "disce.sql"

Running webpage:
12 - go to the url "localhost/disce/canvas.php"

