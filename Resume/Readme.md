This project repository include the following files:
### 1. index.html
The main HTML document. Contains links to all of the CSS and JS resources needed to render the resume.

### 2. JS files
Contains helper code needed to format the resume and build the map. It also has a few function shells for additional functionality. This folder also contain The jQuery library.

### 3. CSS files
Contains all of the CSS needed to style the page.

### 4. PHP files

### 5. Images

The resume has four distinct sections: 
Work, Education, Project and Header with biographical information. 


The resume page looks like:

![final_project](https://user-images.githubusercontent.com/19959305/39408990-7ac6a2f8-4bfc-11e8-960d-26fb03c3f99a.png)



#### *What I have done:*

1. Build four JSONS and store them in MongoDB. Insert all JSON in MongoDB collection.
Downloaded latest version of PHP Drivers. 
Then unzip the archive and put php_mongo.dll in your PHP extension directory ("ext" by default) and added the following line to your php.ini file −

    **extension = php_mongo.dll**

2. Accessed and iterated through each Database tables and appended its information to index.html in the correct section.

3. Here’s an example of some code that would add the location of one of my companies (work locations) to the page:

      **var formattedLocation = HTMLworkLocation.replace("%data%", work.jobs[job].location);**
      
      **$(".work-entry:last").append(formattedLocation);**

4. The resume includes an interactive map.

5. All of the code for adding elements to the resume is written within functions. 
And all of the functions are encapsulated within the same objects containing my resume data. For instance, the functions for appending work experience elements to the page are found within the same object containing data about my work experience.

6. Google API's are used.

7. A login or signup page before one see the resume pagehas been created. One may use theor previous work during code challenges for this module.
