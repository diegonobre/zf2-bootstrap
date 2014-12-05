zf2-bootstrap
=============

Bootstrap for Zend Framework 2 using some useful modules

Introduction
------------
ZF2 Bootstrap Modules is web application tutorial built on Zend Framework 2 and uses
the ZF2 MVC layer and module system. This simple application is an extention to
the skeleton application provided by Zend Technologies and includes some useful
modules found on GitHub.

Modules Included
----------------
	`Big-Sticky-Notes` - created by [bigemployee](https://github.com/bigemployee/Big-Sticky-Notes)
	`Bootstrap-Form-Builder` - created by [minikomi](https://github.com/minikomi/Bootstrap-Form-Builder)

Installation
------------

Using Composer (recommended)
----------------------------
Clone the repository and manually invoke `composer` using the shipped
`composer.phar`:

    cd my/project/dir
    git://github.com/diegonobre/zf2-bootstrap.git
    cd zf2-bootstrap
    php composer.phar self-update
    php composer.phar install

(The `self-update` directive is to ensure you have an up-to-date `composer.phar`
available.)

Virtual Host
------------
Afterwards, set up a virtual host to point to the public/ directory of the
project and you should be ready to go!
