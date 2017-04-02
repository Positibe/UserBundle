<?php
/**
 * This file is part of the PositibeLabs Projects.
 *
 * (c) Pedro Carlos Abreu <pcabreus@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Positibe\Bundle\UserBundle\Entity;

use Positibe\Bundle\MediaBundle\Entity\Media;
use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * Interface UserInterface
 * @package Positibe\Bundle\UserBundle\Entity
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
interface UserInterface extends ResourceInterface
{
    /** @return Media */
    public function getAvatar();

    /** @param Media $avatar */
    public function setAvatar($avatar);

    /** @return string */
    public function getSign();

    /** @param string $sign */
    public function setSign($sign);

    /** @return string */
    public function getName();

    /** @param string $name */
    public function setName($name);
}