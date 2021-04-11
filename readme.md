# CP476 Project

Author: Ben Keunen

Date: March 24th

# Bar Down Coaching

## Introduction

Sports are a large part of Canadian and American culture, 60% of kids between the age of 3 and 17 participate in an organized sport. Every organized sport is different, but they all have a few things in common. They have players/participants, and they have coaches. For this app this is exactly what we are focusing on. We are developing this web system as a coaching toolbox app allowing for team management; storing players and their statistics; exercises and descriptions along with a visual example drawn on a whiteboard; and the lineups of the team itself. For the purpose of proving the concept and keeping things simple we focused entirely on the sport hockey which has a very well organized setup and player statistics scheme.

Another fact about this websystem is it can be run entirely in a docker container no matter what the system architecture as long as you have access to docker and docker-compose. This containerization makes it simple to transfer the app from one computer to another.

## Docker Requirements (Current Machine Setup)
- Docker
    * Version 20.10.5, build 55c4c88
    docker -v
- Docker-Compose
    * Version 1.28.5, build c4eb3a1f
    docker-compose -v

## Docker Deployment
1. Ensure Docker & Docker Compose above match,

2. Use CLI and go to project folder

3. Use Command:

    * ```docker-compose up --build -d```
<br>

4. In your web browser go to:
    * http://localhost/BarDown/
        * Username: admin
        * Password:  admin

5. If docker containers are stopped at anypoint they can be restarted with:
    
    * ```docker-compose up -d```
<br>

6. When finished with site use following command to clear all data related to it. Permanently Deletes All Data.

    * ```docker-compose down -v```
<br>


## Alternative Requirements
- XAMPP 
    * Version 3.2.4
- Apache
   * Version 2.4.46
- PHP
    * Version 8.0.0
- MySql
    * Version 10.4.17-MariaDB

## Alternative Deployment

1. Install Versions as above.

2. Copy project files to your root folder that xampp uses, ie cp476

2. Start XAMPP

   1. Start Apache

   2. Start Mysql

3. In your web browser go to:
    * http://localhost/cp476/project/src

