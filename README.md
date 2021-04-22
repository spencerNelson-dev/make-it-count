# Make it Count!
#### For all your string counting needs!

[Link to hosted app](https://sn-count.herokuapp.com/)

## For Local Depoloyment
I used Docker to set up my local environment.
Included in the repository is the docker-compose.yml file which creates two images:
* web (running nginx)
* php (7.4)

To run locally, you'll need to create a nginx.conf file and place it in the /etc/nginx/nginx.conf directory.

Here is an example of what might be included in you nginx.conf file
```conf
server {
    listen 80 default_server;
    root /app/public;
}
```

Then simply run:
```
docker-compose up
```
in the directory with the docker-compose.yaml

## Project Requirements
The project was made with the following requirements in mind:
* The Web Technologies of: HTML, CSS, Javascript, and PHP **MUST** be used in some form
* The user **MUST** be able to input the string of characters
* The logic for counting the number of characters in the string **MUST** be done using PHP
* The function for counting the number of occurrences of a character in the string MUST be manually built.
  * Built in PHP functions such as: strlen(), substr_count(), count_chars() CANNOT be used.
* The results of how many characters were found **MUST** be displayed to the user
* Results **MUST** be displayed in two different formats:
  * A dashboard visualization of your choosing (Bar chart, line chart, etc…). You may use any library or framework to create the dashboard visualization.
  * A simple count of all the characters
* The user **MUST** have the option to specify a single character to exclude from the count

## Added Features
* Added option to seperate alphabet count by case. 
  * By default it will count 'A' and 'a' as A unless the box is checked to do otherwise
* Added option to add Special characters to the count
  * This will add another table with spaces, numbers, punctuation, and other characters (!@#$%) ect.
  * Not all characters are supported in the count
    * (e.g. any ASCII 0-13 or >126 are not counted)
* Deployed to the Web

## Future Additions
I would like to include the following:
* Unit Tests
* Additional form validation (like a maximum count)
* Move all form validation to JavaScript, and have the php handle only good data.
  * Better Seperation of Concerns

## Known Issues
* ~~If the screen goes smaller than 460px, the tables get cut off~~
  * ~~Fix would include media queries in css~~
* Some other characters also get counted as spaces
* Will only count ASCII 32-126 (not really an issue but still a limitation)
