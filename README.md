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
            
You have to implement your own User class:

    <?php
    
    namespace AppBundle\Entity;
    
    use Doctrine\Common\Collections\ArrayCollection;
    use FOS\UserBundle\Model\User as BaseUser;
    use Doctrine\ORM\Mapping as ORM;
    use Positibe\Bundle\UserBundle\Entity\Traits\UserTrait;
    use Positibe\Bundle\UserBundle\Entity\UserInterface;
    use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
    
    /**
     * @ORM\Entity
     * @ORM\Table(name="app_user")
     *
     * @UniqueEntity({"username"})
     * @UniqueEntity({"email"})
     */
    class User extends BaseUser implements UserInterface
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