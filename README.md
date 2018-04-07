-# GitHubUsers
- A RESTful API to retrieve a resource about a github account.

urls:
- /api/users/USER
    - Example: http://localhost/api/users/testeZepp

- /api/users/USER/repos
    - Example: http://localhost/api/users/testeZepp/repos

-  Dependencies
    - Docker
    - Composer
    - Winpty (if you are using windows)

 - How To use
    - Clone the project ( git clone http://github.com/zzzep/GitHubUser
    - In docker config: share the drive you are using
    - Open the path with command line
    - Open docker folder
    - Run "docker-compose up --build"
    - Run "winpty docker exec -it gfechio_github_api bash"
    - open the project folder in docker 
    -- "cd /var/www/html/GitHubUsers"
    - Copy the ".env.example" to ".env" 
    -- "cp .env.example .env"
    - Intall project with composer 
    --"php composer.phar install ; php composer.phar update"
    - Generate laravel key 
    -- "php artisan key:generate"
