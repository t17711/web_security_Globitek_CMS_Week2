# Project 2 - Globitek Input/Output Sanitization

Time spent: > *X> * hours spent in total

## User Stories

The following > *required> * functionality is completed:

- [x] Staff CMS for Users, Salespeople, States, Territories.
    * index.php 
    > * in users/index.php shows list of users.
        >    * has option to edit, show each user.
        >    * has option to add new user.
    > * in Salespeople/index.php shows list of Salesperson.
        >    * has option to edit, show each Salesperson.
        >    * has option to add new Salesperson.
     > * in states/index.php shows list of states in Canada and US.
        >    * States are seperated by country.
        >    * has option to edit, show each States.
        >    * has options to add new States for each country.
     > * in territories/index.php redirects to states/show.php?id=x where x is the id of the state that territory belongs to.
    
    * show.php 
    > * I used user id from HTTP GET to identify user, state, territory and salesperson and extract the info to display.
    > * All show page has option to edit.
    > * in users/show.php it shows name, username and email of user.
    > * in salesperson/show.php it shows name, username and email of salesperson.
    > * in states/show.php it shows name, Abbreviation code  and country Id.
        >    * It also lists all the territories in the state.
        >    * it has option to add a new territory, edit the listed territories.
    > * in territories/show.php it shows name, state id, and position.
    
    * edit.php
    > * Edit php for all has a form that submits by post, and if submission is succesfully validated and updated to database it redirects to show.php.
    > * new.php
    > * similar to edit it has form with required values.

- [x] Validations
    > * I validated email can only have numbers, letters, symbols(. _ -) and has to have only one @. 
    > * name can have any characters.
    > * name is 2 to 255 characters, username is 8 to 255.
    > * Country code is 2 letter.
    > * phone number has to have 9 numbers, it can be (123)456789, 123456789, 123-456-789, (123)-456-789 format
    > * User, sales person. state, territories, country id has to be integer number greater than 0.
    > * Username must be unique, I have set it unique in DB.
    > * State code should be unique, I did this in php.

- [x] Sanitization
    * input sanatization
    > * URL query sanitize
        > * I validated that for all show and edit pages the id from get is number and that id exists
        > * I validated that all get values are set, if not i redirect the page to index.php
    > * POST sanatize
        > * For each input string I applied mysqli_real_escape_string function to prevent syntax error
        > * Then put the result inside " " to prevent sub query execution
    * form text inputs  sanitize
        > * for each output string i applied htmlspecialchars to prevent script injection stuff

- [x] Penetration Testing
    * I did the test as directed

The following advanced user stories are optional:

- [x] On "public/staff/territories/show.php", instead of displaying an integer value for territories.state_id, display the name of the state.
- [x] Validate the uniqueness of users.username, both when a user is created and when a user is updated, using db 

## Video Walkthrough

Here's a walkthrough of implemented user stories:

<img src='http://i.imgur.com/link/to/your/gif/file.gif' title='Video Walkthrough' width='' alt='Video Walkthrough' /> *

GIF created with [LiceCap](http://www.cockos.com/licecap/).

## Notes

Describe any challenges encountered while building the app.

## License

    Copyright [yyyy] [name of copyright owner]

    Licensed under the Apache License, Version 2.0 (the "License");
    you may not use this file except in compliance with the License.
    You may obtain a copy of the License at

        http://www.apache.org/licenses/LICENSE-2.0

    Unless required by applicable law or agreed to in writing, software
    distributed under the License is distributed on an "AS IS" BASIS,
    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
    See the License for the specific language governing permissions and
    limitations under the License.
