# compilers-cli
This is a command line application (CLI) used to interact with the compilers project.  It is used to compile, watch, build and push applications. 

## Compiling an application, execute this query:
This example would compile the given authenticated.json recipe into the /tmp/build directory.
```
//pattern:
php ./bin/irestful compile url source output

//example:
php ./bin/irestful compile http://127.0.0.1:8080 ./src/iRESTful/CompilersCli/Tests/Tests/recipes/CRUD/authenticated.json /tmp/build
```


## Watching applications:
This example would watch all applications, saved in the ./src directory or its sub-directories.  If modifications are made to one of the applications, it will re-compile it in the ./build directory.
```
//pattern:
php ./bin/irestful watch url source output

//example:
php ./bin/irestful watch http://127.0.0.1:8080 ./src ./build
```


## Building applications:
This example compiles all application contained in the ./src folder into the ./build folder, then build all its Docker images.
```
//pattern:
php ./bin/irestful build url source output

//example:
php ./bin/irestful build http://127.0.0.1:8080 ./src ./build
```

## Pushing docker images:
This example scans the ./src folder and creates a list of docker commands to push the built images into the docker registry.  You can then copy-paste the commands you want to push the image in your registry.

```
//pattern:
php ./bin/irestful push source

//example:
php ./bin/irestful push ./src
```
