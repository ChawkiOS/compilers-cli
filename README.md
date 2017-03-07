# compilers-cli
This is a command line application (CLI) used to interact with the compilers project.  It reads a project from a json file and compile the project using the compilers web service.

## Compiling an application, execute this query:
This example would compile the given authenticated.json recipe into the /tmp/build directory.
```
//pattern:
php ./bin/irestful compile url source output

//example:
php ./bin/irestful compile http://127.0.0.1:8080 ./src/iRESTful/CompilersCli/Tests/Tests/recipes/CRUD/authenticated.json /tmp/build
```


## Watching 1 application:
This example would watch 1 application for modifications.  If modifications are made to the application, it will re-compile it directory in the ./build directory.
```
//pattern:
php ./bin/irestful watch url sources output

//example:
php ./bin/irestful watch http://127.0.0.1:8080 ./src/iRESTful/CompilersCli/Tests/Tests/recipes/CRUD/authenticated.json ./build
```

## Watching multiple applications:
This example would watch 2 applications for modifications.  If modifications are made to one of the applications, it will re-compile it in the ./build directory.
```
//pattern:
php ./bin/irestful watch url sources output

//example:
php ./bin/irestful watch http://127.0.0.1:8080 ./src/iRESTful/CompilersCli/Tests/Tests/recipes/CRUD/authenticated.json,./src/iRESTful/CompilersCli/Tests/Tests/recipes/Custom/authenticated.json ./build
```

//build:
clear; php ./bin/irestful build http://127.0.0.1:8080 ./src/iRESTful/CompilersCli/Tests/Tests/recipes/CRUD/authenticated.json,./src/iRESTful/CompilersCli/Tests/Tests/recipes/Custom/authenticated.json ./build

//test:
clear; php ./bin/irestful test http://127.0.0.1:8080 ./build
