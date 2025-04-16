# ACCESS SERVER
access as if on cluster using sukem-number and corresponding password (sukem password, not database password)

# ADD WEBPAGE
	- create newpage.php or newpage.html (based on intended usage) in preferred editor (for entirely new websites create index.php first)
	- to create consistent layout, add stylesheet "cssstyles.css"
	- for pages containing any kind of query from database add "establishment of database connection" via config.php
	- add desired contents of page to the main section
	- end with the image-wrapper and footer section to create footer (remember to close all matching brackets)
	- when finished, move file into htdocs on the server; be mindful where you put the file to avoid confusion when interlinking with other files

# CHANGE CONTENTS OF EXISTING PAGE
	- look at webadress to determine which file to change (e.g. https://www.metmicdb.uni-kiel.de/index.html -> file to change is index.htl)
	- search file to edit in htdocs on the server and change desired sections
	- save file and reload webpage to see changes
	- check pages that are linked to the edited page for changes

# ADD TABLES TO EXISTING DATABASE
	- go to https://dbadm.rz.uni-kiel.de/mysql/ and enter log in credentials
	- navigate to SQL-tab (next to the paper scroll)
	- use as usual SQL (CREATE TABLE etc.)

# CREATE NEW DATABASE
	- go to https://dbadm.rz.uni-kiel.de/mysql/ and enter log in credentials
        - navigate to SQL-tab (next to the paper scroll)
        - use as usual SQL (CREATE DATABASE etc.)
	- careful: when using multiple databases at once, be careful of which database to use in which PHP-script -> multible configs!


# TIPS/BEST PRACTICES/REMINDERS
	- always open html sections with <html> and close them with </html> (for php <?php and ?>)
	- use and create templates as much as possible since many codes are transferrable
	- keep track of how which pages are interlinked to each other
	- edit designs as little as possible at once to avoid rapid changes
	- link each page with at least one other to be able to access them
	- add visualisation of errors, otherwise there are only silent errors
