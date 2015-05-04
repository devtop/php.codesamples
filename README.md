# php.codesamples
Some interesting code samples made by Tobias Ranft 2015.

## Maybe you want to hire me?
Have a look at my [CV](http://ranft.biz/cv/cv_en.php). 
And don't hesitate to contact me for any kind of request.

## What's already done?
### Tiny Framework
It's just some compoments I needed to publish this as a php application site.
For more information see the [details](https://github.com/devtop/php.codesamples/tree/master/src/Standard)

### Fizz Buzz
The litte finger excercise every coder knows. 
The goal is to count, but leave out some numbers.
My [solution](https://github.com/devtop/php.codesamples/blob/master/view/tasks/fizzbuzz.phtml) 
the [OOP way](https://github.com/devtop/php.codesamples/blob/master/src/Task/FizzBuzz/Number.php).

Not serious to solve it in OOP, but it was on my bucket list. 

## How to install?
### Checkout the repository
```
$ git clone git@github.com:devtop/php.codesamples.git
```
### Setup apache
You'll need to have installed apache2 and php>=5.4 .
```
<VirtualHost *:80>
    ServerName php.codesamples
    DocumentRoot /your/path/to/the/project/php.codesamples
    SetEnv APPLICATION_ENV "development"
    
    <Directory /your/path/to/the/project/php.codesamples/public>
        DirectoryIndex index.php
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

mod_rewrite has to be activated.
```
$ sudo a2enmod rewrite
```

### Run it in docker 
```
$ ./setup/build.docker.sh
$ ./setup/run.docker.sh
```

Then you can get projects result at http://localhost:81/ .

## What's coming soon?
### Open Tasks
* Route Match Object
* Unhandled edgecases in router
* Using Prophecy for mocking
* Config objects
* OOP Dispatcher
* Application runner
* 404 error site
* Multiple URL for one route

### Roadmap
* Coffeebar
* Prime numbers with regex
* Sequence Problem

## Where is the source?
Source code can be found on [github.com](https://github.com/devtop/php.codesamples)