<?php
/**
 * This file is part of the PositibeLabs Projects.
 *
 * (c) Pedro Carlos Abreu <pcabreus@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Positibe\Bundle\UserBundle\Entity\Traits;

/**
 * Class UserTrait
 * @package Positibe\Bundle\UserBundle\Entity\Traits
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
trait UserTrait
{
    protected $username;
    protected $roles;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=TRUE)
     */
    protected $name;
    /**
     * @var string
     *
     * @ORM\Column(name="is_super_admin", type="boolean", nullable=TRUE)
     */
    protected $isSuperAdmin;

    /**
     * @var Object
     */
    protected $avatar;

    public function __toString()
    {
        return $this->name ?: $this->username;
    }

    public function addRole($role)
    {
        if ($role === 'ROLE_SUPER_ADMIN') {
            $this->isSuperAdmin = true;
        }

        parent::addRole($role);
    }

    public function getRoles()
    {
        $roles = parent::getRoles();
        if ($this->isSuperAdmin) {
            $roles[] = 'ROLE_SUPER_ADMIN';
        }

        return $roles;
    }


    /**
     * @return Object
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param Object $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function isSuperAdmin()
    {
        return $this->isSuperAdmin;
    }

    /**
     * @param string $isSuperAdmin
     */
    public function setIsSuperAdmin($isSuperAdmin)
    {
        $this->isSuperAdmin = $isSuperAdmin;
    }

}