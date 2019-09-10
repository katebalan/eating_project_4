EA: Eating Project
======

* Production:   http://eating-project.herokuapp.com/
* Date          September 22, 2017
* Symfony:      4.3.4
* PHP:          7.1.x
* dependencies: Composer, yarn, SASS, webpack

## To install project

* ```git clone git@github.com:katebalan/eating_project_4.git```
* ```cd eating_project_4/``` - enter to project's folder
* ```composer install```

if you have some problems with cache, logs or sessions, you can use:
```chmod 777 -R var/cache var/sessions var/logs```

in web/data/ folder you can find database.

https://symfonycasts.com/screencast/symfony4-upgrade/flex#play
https://symfonycasts.com/screencast/api-platform/install
curl -X GET "http://localhost:8000/api/activities" -H "accept: application/json" | python -m json.tool
