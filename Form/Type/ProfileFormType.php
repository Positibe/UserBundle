<?php
/**
 * This file is part of the PositibeLabs Projects.
 *
 * (c) Pedro Carlos Abreu <pcabreus@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Positibe\Bundle\UserBundle\Form\Type;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Positibe\Bundle\MediaBundle\Form\Type\ImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as FOSProfileFormType;

/**
 * Class ProfileFormType
 * @package Positibe\Bundle\UserBundle\Form\Type
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
class ProfileFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Nombre(s) y apellidos:'])
            ->add('sign', CKEditorType::class, ['label' => 'Firma:', 'config_name' => 'simple'])
            ->add('avatar', ImageType::class, array('label' => 'Avatar:'));
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return FOSProfileFormType::class;
    }

}