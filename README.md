# PsiU at UW Website
## PHP and SQL powered website with an admin panel for easy content control

Here are just some examples of how I implement a website in PHP using a MySQL db for retrieving and storing content. The website records about 200-300 unique hits a month. From a fraternity standpoint, having a sightly and maintained website has proven effective in attracting potential members. The live website can be found at: http://www.students.washington.edu/psiu

I have a demo of the current development available here: http://psiusitedemo.elasticbeanstalk.com/

Please note master branch may not be most up to date. Check other branches for more recent pushes. 

### Admin Access
The biggest feature is the simplified content editing system. In the past the website was served with static html webpages that had to be individually edited and reuploaded. The new website offers an admin portal, secured by a hardcoded user-id and password.
The admin portal is a simple html form that allows editing of most of all the content panels. This includes events for the calendar. 
*Photo Upload and Add/Remove Member features for Contact groups are incomplete.

### Twitter's Bootstrap
The website utilizes the grid layout CSS stylings provided in Twitter's Bootstrap. Additionally, the website uses Bootstrap's 'Tab', 'Collapse', and 'Carousel' javascript plugins. Several built-in CSS classes are used, and are tweaked for website-specific purposes in the bootstrap.custom.css file.

### Yearly Calendar and Events System
A website feature that was also built from scratch is the yearly calendar. The calendar automatically updates the dates for the corresponding calendar year (including leap years). This makes it easier to maintain. Any upcoming events on the calendar will be detected, and given a link from the homepage.
