# PsiU at UW Website
## PHP and SQL powered website with an admin panel for easy content control

Here are just some examples of how I implement a website in PHP using a MySQL db for retrieving and storing content. The website records about 200-300 unique hits a month. From a fraternity standpoint, having a sightly and maintained website has proven effective in attracting potential members. The live website can be found at: http://www.students.washington.edu/psiu

Note all sensitive data has been removed (such as database credentials). The layout directory has intentionally been left empty.

Note that some of the code relies on assets and files that are not present in the repo. This is because the repo is not intended to fully recreate the live website. It is maintained separately and demonstrates how the PHP/SQL generates the live site. It also provides insight on how the admin panel works, since the live website does not offer a demo account to preview the admin panel.

### Bootstrap Grid Layout
The website utilizes the grid layout CSS stylings provided in Twitter's Bootstrap.

### Yearly Calendar and Events System
A website feature that was also built from scratch is the yearly calendar. The calendar automatically updates the dates for the corresponding calendar year (including leap years). This makes it easier to maintain. Any upcoming events on the calendar will be detected, and given a link from the homepage.

### Admin Access
The biggest feature is the simplified content editing system. In the past the website was served with static html webpages that had to be individually edited and reuploaded. The new website offers an admin portal, secured by a hardcoded user-id and password.
The admin portal is a simple html form that allows editing of most of all the content panels. This includes events for the calendar. 
*Photo Upload and Adding/Removing features for Contact groups are incomplete.

### Next Up
Work on the website took place from Sep 2013 to Jan 2014. After fundamental features were deemed functional, I put the project to the side
to focus on other endeavors. The next step is a major refactoring of code to eliminate the redundancy currently in the project. Once the code is cleaned,
we will decide if current features need restructuring or if new features can begin to be rolled in.