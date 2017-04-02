PositibeUserBundle
==================

This bundle provide an abstract for FOSUserBundle with some Positibe integration.

Installation
------------

To install the bundle just add the dependent bundles:

    php composer.phar require positibe/user-bundle

Next, be sure to enable the bundles in your application kernel:

    <?php
    // app/AppKernel.php
    public function registerBundles()
    {
        return array(
            // ...
            new FOS\UserBundle\FOSUserBundle(),
            new Positibe\Bundle\UserBundle\PositibeUserBundle(),
            // ...
        );
    }

Configuration
-------------

Import all necessary configurations to your app/config/config.yml the basic configuration.
    # app/config/config.yml
    imports:
        - { resource: '@PositibeUserBundle/Resources/config/config.yml'}

There are some abstraction for secutiry configuration:

    # app/config/security.yml
    imports:
    - { resource: '@PositibeUserBundle/Resources/config/security.yml'}

    security:
        role_hierarchy:

        access_control:
            - { path: ^/login$, role: IS_AUTHENTICATED_ANONYMOUSLY }
            - { path: ^/register, role: IS_AUTHENTICATED_ANONYMOUSLY }
            - { path: ^/resetting, role: IS_AUTHENTICATED_ANONYMOUSLY }
            - { path: ^/admin/, role: ROLE_ADMIN }