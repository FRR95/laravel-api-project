### Laravel Backend web LFG  🎮 🕹️
![BD](public/images/banner.webp)


### Index 📚

<details>
  <summary> Content 📝</summary>
  <ol>
    <li><a href="#about-the-project">About the project</a></li>
    <li><a href="#local-installation">Local installation</a></li>
    <li><a href="#stack">Stack</a></li>
    <li><a href="#database-diagram">Database Design</a></li>
    <li><a href="#endpoints">Endpoints</a></li>
    <li><a href="#Future-features">Future features</a></li>
    <li><a href="#authors">Authors</a></li>
  </ol>
</details>

### About the project 
<p>The first team project proposed by GeeksHubs Academy in the PHP and Laravel section aims to develop a Looking For Group web application to improve and promote social interaction among employees of a company. Users will be able to register, log in, and also create or search for groups for each video game to play after work. In addition to all this, they will be able to manage their profile, including details such as their Steam username, and log out whenever they want.</p>

### Local installation 
1. Clone the repository
  `$ composer install`
2. Migraciones
    `$ php artisan migrate`
3. Seeders
    `$ php artisan db:seed`



### Stack 
Technologies used:
<div align="center">
<a href="https://www.mysql.com/">
    <img src= "https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white"/>
</a>
<a href="https://www.php.net/">
    <img src= "https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white"/>
</a>
<a href="https://laravel.com/">
    <img src= "https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white"/>
</a>
<a href="https://getcomposer.org/">
    <img src= "https://img.shields.io/badge/Composer-885630?style=for-the-badge&logo=Composer&logoColor=white"/>
</a>
  <a href="https://git-scm.com/">
    <img src="https://img.shields.io/badge/GIT-E44C30?style=for-the-badge&logo=git&logoColor=white"/>
</a>
  <a href="https://www.postman.com/">
    <img src="https://img.shields.io/badge/Postman-FF6C37?style=for-the-badge&logo=Postman&logoColor=white"/>
</a>
</div>

### Database Design 

![BD](public/images/Captura.PNG)

### Endpoints 
<details>
- Users

    - Register:

            POST http://localhost:8000/api/register
        body:
        ``` json
            {
                "name": "Javi",
                "email": "javi@javi.com",
                "password": "1234"
            }
        ```


    - Log in

            POST http://localhost:8000/api/login 
        body:
        ``` json
            {
                "email": "javi@javi.com",
                "password": "1234"
            }
        ```
- Games
    - GET: get all games
    http://localhost:8000/api/games

    - POST: create game
    http://localhost:8000/api/games

    - PUT: update game by Id
    http://localhost:8000/api/games/{id}

    - DELETE: delete game by Id
    http://localhost:8000/api/games/{id}

- Rooms
    - GET: get all rooms
    http://localhost:8000/api/rooms 

    - POST: createe new room
    http://localhost:8000/api/rooms 

    - PUT: update room
    http://localhost:8000/api/rooms/{id}

    - DELETE: delete room
    http://localhost:8000/api/rooms/{id}

- User Rooms
    - GET: get all users rooms
    http://localhost:8000/api/userroom/{id}

    - POST: create user room
    http://localhost:8000/api/userroom

    - DELETE: delete user room by Id
    http://localhost:8000/api/userroom/{id}

- Messages
   - POST: create message
    http://localhost:8000/api/message

  - GET: get all messages from room by id
    http://localhost:8000/api/messages/room/{id}

  - PUT: update message by Id
    http://localhost:8000/api/messages/{id}
 
  - DELETE: delete message by Id
    http://localhost:8000/api/messages/{id}
 

</details>

### Future features 

 ✅Events and tournaments
 ✅Achievement System



### Authors 
Javi 😼

<a href="https://github.com/Javi-Gallego" target="_blank"><img src="https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white" target="_blank"></a>
</p>
<p>
Jesus 😸

<a href="https://github.com/JesusMatinezClavel" target="_blank"><img src="https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white" target="_blank"></a>
</p>
<p>
Fran 🙀

<a href="https://github.com/FRR95" target="_blank"><img src="https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white" target="_blank"></a>
</p>
<p>
Paula 😿

<a href="https://github.com/almela09" target="_blank"><img src="https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white" target="_blank"></a>
</p>
<p>






