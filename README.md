# Welcome to my First Backend made in Laravel

<details>
  <summary>Content 📝</summary>
  <ol>
    <li><a href="#objective">Objective</a></li>
    <li><a href="#about-the-project">About the project</a></li>
    <li><a href="#stack">Stack</a></li>
    <li><a href="#diagram">Diagram</a></li>
    <li><a href="#installation">Installation</a></li>
    <li><a href="#endpoints">Endpoints</a></li>
    <li><a href="#known-bugs">known bugs</a></li>
    <li><a href="#licence">Licence</a></li>
    <li><a href="#development">Development</a></li>
    <li><a href="#thanks">Thanks</a></li>
    <li><a href="#contact">Contact</a></li>
  </ol>
</details>

## Objective
The project requires an API connected to a database with at least one relation "One to Many" and "Many to Many". The API should be functional.
It has to be made with Laravel.

## About the project
<p>The project goal is to learn how to use Laravel and makes a database similar to Discord that has Games and Parties.</p>
<p>I am very happy with the result obtained in this project and everything I have learned along the way.</p>
Trough this API you can manage the next Endpoints:

- Welcome Test.
- Register User.
- Login User.
- Update Profile. 
- Get My Profile.
- Logout.
- Create a Message.
- Get my Messages.
- Get All Users with Admin, It´s blocked with User.
- Delete Message with Admin.
- Delete your Messages with User.
- Delete User with Admin, It´s blocked with User, also you can´t Delete Yourself or other Admin.
- Get User Details By Id Admin.
- Update Message By Id Admin, the UserId doesn´t change only the Message.
- Update Your Message By Id User.
- Get Message By Party Id.
- Create New Party Admin.
- Get Details Party Id.
- Join Party Body User.
- Leave Party ID User.
- New Game Admin.
- Update Game Admin.
- Get All Games.
- Get All Messages Admin.
- Destroy Game By Id.


## Stack
Used tech:
<div align="center">

<img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" /> 
<img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" />  
<img src="https://img.shields.io/badge/Docker-2CA5E0?style=for-the-badge&logo=docker&logoColor=white"/> 
<img src="https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white"/> 
<img src="https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white" /> 

</div>


## Diagram
![image](https://user-images.githubusercontent.com/122753448/231727808-01dad8f5-a588-4866-a6f7-59820a883f1f.png)


## Installation
This is my Collection for Postman, you can download with all the EndPoints.
[LaravelPostmanCollection.zip](https://github.com/AlvaroBernabe/-aba-geekshubs-fsd-val-Project6---Laravel/files/11221029/LaravelPostmanCollection.zip)

1. Clone repository in terminal or bash / or download manually the repo.
git clone https://github.com/AlvaroBernabe/-aba-geekshubs-fsd-val-Project6---Laravel.git
2. Install dependencies.
composer install
3. Connect repo with database, through env file.
Rename the .env.example to .env and configure the env file to match your Docker config.
4. ``` $ Execute migrations ``` 
php artisan migrate
5. ``` $ Execute seeders ``` 
php artisan db:seed
6. ``` $ php artisan serve ``` 
7. You are ready to play with Docker or Thunder Client.

## Endpoints
<details>
<summary>Endpoints</summary>


    - WELCOME
            GET http://127.0.0.1:8000/api/welcome
 ![1-Welcome](https://user-images.githubusercontent.com/122753448/231732749-4e953af9-eb04-4899-b37e-464d4e93d585.png)


    - REGISTER
            POST http://127.0.0.1:8000/api/register
<img width="361" alt="2- Register User" src="https://user-images.githubusercontent.com/122753448/231733129-c6231cb0-7051-4024-9e9e-0f52e97c006c.png">


    - LOGIN
            POST http://127.0.0.1:8000/api/login
<img width="340" alt="3- Login User" src="https://user-images.githubusercontent.com/122753448/231733512-74317628-4665-438e-a442-5f0bf0ffe2d5.png">


    - UPDATE PROFILE
            PUT http://127.0.0.1:8000/api/profile/update
<img width="314" alt="4-Update Profile" src="https://user-images.githubusercontent.com/122753448/231733701-80a739ee-c13e-452e-ad0f-ca0a8c5db889.png">


    - GET MY PROFILE
            GET http://127.0.0.1:8000/api/profile
<img width="582" alt="5- Get My Profile" src="https://user-images.githubusercontent.com/122753448/231733990-17be1bf1-8a8f-4aad-bb64-9548171f4bca.png">


    - LOGOUT
            POST  http://127.0.0.1:8000/api/logout
<img width="592" alt="6 - Logout" src="https://user-images.githubusercontent.com/122753448/231734231-7d595769-d7e2-4152-8f1d-55f9b775571f.png">


    - CREATE MESSAGE
            POST  http://127.0.0.1:8000/api/comments/create
<img width="414" alt="7- Create Message" src="https://user-images.githubusercontent.com/122753448/231734321-2220e4f7-583c-47da-9d8a-7c9cf448bfab.png">


    - SEE OWN MESSAGE
            GET  http://127.0.0.1:8000/api/mycomments/view
<img width="605" alt="8- Get My Message" src="https://user-images.githubusercontent.com/122753448/231738158-90f43283-81e2-49f6-bbb9-9549cd162f3f.png">


    - GET ALL USERS 
            GET  http://127.0.0.1:8000/api/users/all
<img width="605" alt="8- Get All Users" src="https://user-images.githubusercontent.com/122753448/231738254-e3dd3ed2-d764-489f-80ae-cb4d5b60abbb.gif">


    - DELETE MESSAGE BY ID ADMIN 
            DELETE  http://127.0.0.1:8000/api/comments/destroy/2
<img width="605" alt="8- Delete Message Id" src="https://user-images.githubusercontent.com/122753448/231738842-29ddbe6c-d240-4db0-b967-f045769b010e.gif">


    - DELETE MESSAGE BY ID USER
            DELETE  http://127.0.0.1:8000/api/mycomments/destroy/23
<img width="605" alt="8- Delete Message Id" src="https://user-images.githubusercontent.com/122753448/231739142-96526f64-32cb-4a59-ac3d-79be2947771f.gif">


    - DELETE USER  BY ADMIN
            DELETE  http://127.0.0.1:8000/api/users/all/destroy/1
<img width="605" alt="8- Delete User Id" src="https://user-images.githubusercontent.com/122753448/231740099-81ddf5e6-8cda-45fb-b694-2bf823d57aee.gif">


    - GET USER DETAILS BY ID ADMIN
            GET  http://127.0.0.1:8000/api/users/all/details/2
<img width="328" alt="13- Get User Details by Id Admin" src="https://user-images.githubusercontent.com/122753448/231740550-bf58ce10-115b-47c5-a27a-63c200a64a9e.png">


    - UPDATE MESSAGE BY ID ADMIN
            PUT  http://127.0.0.1:8000/api/comments/update/2
<img width="439" alt="14-Update Message by Id Admin" src="https://user-images.githubusercontent.com/122753448/231740958-8d32e2fa-2618-4675-868e-4bbd3382cee2.png">


    - UPDATE MESSAGE BY ID USER
            PUT  http://127.0.0.1:8000/api/mycomments/update/20
<img width="450" alt="8- Update Message Id" src="https://user-images.githubusercontent.com/122753448/231741508-b52fa41c-26e0-45d6-8a00-e959a1c6bf8f.gif">


    - GET MESSAGE BY PARTY ID
            GET  http://127.0.0.1:8000/api/comments/party/3
<img width="418" alt="16-Get Message by Party IDpng" src="https://user-images.githubusercontent.com/122753448/231742380-559d4f7b-fa64-4c7d-930b-c12d9f0f55d4.png">


    - CREATE PARTY ADMIN
            POST  http://127.0.0.1:8000/api/party/create
<img width="326" alt="17-Create Party Admin" src="https://user-images.githubusercontent.com/122753448/231742553-93be038e-a3ca-4a6d-833f-37f03edf49b6.png">


    - GET PARTY BY ID
            GET  http://127.0.0.1:8000/api/party/view/2
<img width="292" alt="18-Get Party Id" src="https://user-images.githubusercontent.com/122753448/231742674-3e724d5e-8ccd-47a8-8ef4-fcd22cbf6c05.png">


    - JOIN PARTY BY BODY
            POST  http://127.0.0.1:8000/api/party/join/
<img width="335" alt="19-Join Party By Body" src="https://user-images.githubusercontent.com/122753448/231742828-61f93c36-4aac-4fae-9d23-bd820ba42095.png">


    - LEAVE PARTY BY ID
            DELETE  http://127.0.0.1:8000/api/party/leave/8
<img width="420" alt="19-Join Party By Body" src="https://user-images.githubusercontent.com/122753448/231743214-e6f03ad2-0bcf-46df-9b26-6bceb0944cb5.gif">


    - NEW GAME ADMIN
            POST  http://127.0.0.1:8000/api/game/create
<img width="322" alt="21-New Game Admin" src="https://user-images.githubusercontent.com/122753448/231743512-cfa1ee67-cf72-4384-a921-fd6f5efeb433.png">


    - UPDATE GAME ADMIN
            PUT  http://127.0.0.1:8000/api/game/update/7
<img width="320" alt="22- Update Game Admin" src="https://user-images.githubusercontent.com/122753448/231743649-fc0681e3-f9ba-4dfb-88c1-f83407fd8bde.png">


    - GET ALL GAMES
            GET  http://127.0.0.1:8000/api/games/all
<img width="302" alt="23 - Get All Games" src="https://user-images.githubusercontent.com/122753448/231744058-75d746a5-97f2-4626-971e-9568d57ba246.png">


    - GET ALL MESSAGES ADMIN
            GET  http://127.0.0.1:8000/api/comments/all
<img width="420" alt="22- Update Game Admin" src="https://user-images.githubusercontent.com/122753448/231744242-133c8449-a79f-4b6c-b740-24cfad80fc13.gif">


    - DELETE GAME BY ID ADMIN
            DELETE  http://127.0.0.1:8000/api/game/4
 <img width="420" alt="22- Update Game Admin" src="https://user-images.githubusercontent.com/122753448/231744698-8dd280fa-3126-4633-b5a8-9a0098b1001f.gif">     


</details>

## Known bugs:

<p> - There are a few gif in the readme with improvement to be made.</p>
<p> - In a few controllers the Success and Error Message are incorrect.</p>
<p> - There are some Functions that can be improve to show instead of ID the names that they belongs to.</p>
<p> - There is probably more but i need to make the final project next and need to concentrate in that, Good Luck Have Fun to All :)</p>

## Licence

This project it's under licence of Álvaro Bernabé Alonso, you are free to do whatever You feel like with it.

## Development
You are Free to send me suggestion to improve the project, i always appreciate that.
``` js
 thisApp.belongsTo.Alvaro

 Developed by: alvarito10109
```  


## Thanks:
Thanks to all my colleagues who are charming and wonderful people and the teachers´s:

- *Dani*  
<a href="https://github.com/datata" target="_blank"><img src="https://img.shields.io/badge/github-24292F?style=for-the-badge&logo=github&logoColor=white" target="_blank"></a> 

- *Jose*  
<a href="https://github.com/Dave86dev" target="_blank"><img src="https://img.shields.io/badge/github-24292F?style=for-the-badge&logo=github&logoColor=white" target="_blank"></a> 

- **David**  
<a href="https://www.github.com/userGithub/" target="_blank"><img src="https://img.shields.io/badge/github-24292F?style=for-the-badge&logo=github&logoColor=red" target="_blank"></a>

- ***Mara***  
<a href="https://www.github.com/userGithub/" target="_blank"><img src="https://img.shields.io/badge/github-24292F?style=for-the-badge&logo=github&logoColor=green" target="_blank"></a> 


## Contact
You can find me:
<a href = "mailto:alvaro101093@gmail.com"><img src="https://img.shields.io/badge/Gmail-C6362C?style=for-the-badge&logo=gmail&logoColor=white" target="_blank"></a>
<a href="https://www.linkedin.com/in/álvaro-bernabé-alonso-6514a999/" target="_blank"><img src="https://img.shields.io/badge/-LinkedIn-%230077B5?style=for-the-badge&logo=linkedin&logoColor=white" target="_blank"></a>

</p>

