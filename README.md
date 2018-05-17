# API-test

1. GIT CLONE;
2. cd API-test;
3. edit file .env 
    DB_DATABASE=test_api
    DB_USERNAME=root
    DB_PASSWORD=
4. Run command php artisan serve.
Use PostMan test api:
-localhost:8000/api/auth/register
  +method: post.
  +params: name. email, password, tel, address
-localhost:8000/api/auth/login
  +method: post.
  +params: email, password
-localohst:8000/api/get-user
  +method: get,
  +params: token (generate when login)
-localhost:8000/api/edit-user
  +method: post
  +params: token (generate when login), name, password, tel, address
-localhost:8000/api/logout
  +method: get
  +params: token
    
