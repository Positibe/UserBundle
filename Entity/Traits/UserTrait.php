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

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=TRUE)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="sign", type="text", nullable=TRUE)
     */
    protected $sign;
    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=TRUE)
     */
    protected $url;
    /**
     * @var Object
     *
     *
     */
    protected $avatar;

    public function __toString()
    {
        return $this->name ?: $this->username;
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
    public function getSign()
    {
        return $this->sign;
    }

    /**
     * @param string $sign
     */
    public function setSign($sign)
    {
        $this->sign = $sign;
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
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
}