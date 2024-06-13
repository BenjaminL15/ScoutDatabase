# Scout Database

The purpose of this database was to create a website where administrators, advisors, or leaders of scouts could view existing scouts, awards, and volunteers while also allowing them to add new scouts (with details such as rank, birthday, parent info), add new volunteers (volunteer information and associating them as merit badge counselors or parents of scouts), and also tracking/marking attendance for meetings that scouts did or did not attend. This website was created to help users stay on track of their scouts while also planning based on the different queries that appear to the users.

## Table of Contents
- [Installation](#installation)
- [Usage](#usage)
- [Screenshots](#screenshots)
- [Contributing](#contributing)
- [License](#license)

## Installation

1. **IDE and Extenstions**
    - Visual Studio Code is recommended for the IDE of use in order to open the project and test for yourself (only if the extensions are available to you).
    - Extensions: These are the following extensions needed in order to open the project and also view the table if necessary
        - **[SQLite Viewer - Florian Klampfer](https://marketplace.visualstudio.com/items?itemName=qwtel.sqlite-viewer)**: Used to view the tables within the DatabaseCreator.db file 
        - **[PHP Server - Brapifra](https://marketplace.visualstudio.com/items?itemName=brapifra.phpserver)**: Used to view the php files (more information on this later on)

2. **XAMPP Installation & Setup**
    - In order to view the servers, you need XAMPP which is a PHP development environment that we used to open and create our database.
        - **[XAMPP - Apache Friends](https://www.apachefriends.org/)**: It should redirect you and automatically download the program onto your computer. 
            - [Installation Guide Video](https://www.youtube.com/watch?v=VCHXCusltqI&ab_channel=GeekyScript): If you prefer a video guide, you can watch this installation guide on YouTube for a step-by-step process.
    - After downloading and setting XAMPP, you must setup the environment variables in order to run the PHP path that is in this project. 
        1. First, find the pathway to your PHP file within the file explorer. To do this, go to your local disk (main storage drive), navigate to the xampp folder, and find the php folder and copy the path that leads to that folder.
        ![PHP Path File Explorer](screenshots/path.png)