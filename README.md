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

Copy the default configuration into the new `fos_user.yaml` file in your configuration packages:

    [yaml]
    fos_user:
        db_driver: orm # other valid values are 'mongodb' and 'couchdb'
        firewall_name: main
        user_class: App\Entity\User
        from_email:
            address: "%env(MAIL_ADDRESS)%"
            sender_name: "%env(MAIL_SENDER_NAME)%"
    
    #    registration:
    #        confirmation:
    #            enabled: true
    #    profile:
    #        form:
    #            type: Positibe\Bundle\UserBundle\Form\Type\ProfileFormType

And security configuration into your `security.yaml` config file:

    [yaml]
    parameters:
        security.lifetime: 604800 #7 días/1 semana
    
    security:
        encoders:
            FOS\UserBundle\Model\UserInterface: bcrypt
    
        role_hierarchy:
            ROLE_ADMIN:       [ROLE_ALLOWED_TO_SWITCH, ROLE_USER, ROLE_EDITOR, ROLE_MODERATOR, ROLE_AUTHOR] #By Default All Positibe Roles
            ROLE_SUPER_ADMIN: ROLE_ADMIN
    
        providers:
            fos_userbundle:
                id: fos_user.user_provider.username_email
    
        firewalls:
            main:
                pattern: ^/
                form_login:
                    provider: fos_userbundle
                    csrf_token_generator: security.csrf.token_manager
                    login_path: /security/login
                    check_path: /security/login_check
                logout:
                    path: /security/logout
                anonymous:    true
                switch_user:  true
                remember_me:
                    lifetime: "%security.lifetime%"
                    secret: "%kernel.secret%"
        access_control:
            - { path: ^/security/login$, role: IS_AUTHENTICATED_ANONYMOUSLY }
            - { path: ^/security/logout, role: ROLE_USER }
            - { path: ^/security/register, role: IS_AUTHENTICATED_ANONYMOUSLY }
            - { path: ^/security/resetting, role: IS_AUTHENTICATED_ANONYMOUSLY }
            - { path: ^/admin/, role: ROLE_ADMIN }
            
You have to implement your own User class:

    <?php
    
    namespace App\Entity;
    
    use FOS\UserBundle\Model\User as BaseUser;
    use Doctrine\ORM\Mapping as ORM;
    use Positibe\Bundle\UserBundle\Entity\Traits\UserTrait;
    use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
    
    /**
     * @ORM\Entity
     * @ORM\Table(name="app_user")
     *
     * @UniqueEntity({"username"})
     * @UniqueEntity({"email"})
     */
    class User extends BaseUser
    {
        use UserTrait;
    
        /**
         * @ORM\Id
         * @ORM\Column(type="integer")
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        protected $id;
    
        public function __construct()
        {
            parent::__construct();
        }
    }
    
Routes
------

Import your routes


