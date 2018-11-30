<?php
/**
 * This file is part of the PositibeLabs Projects.
 *
 * (c) Pedro Carlos Abreu <pcabreus@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Positibe\Bundle\UserBundle\Mailer;

use FOS\UserBundle\Mailer\MailerInterface;
use FOS\UserBundle\Model\UserInterface;
use Positibe\Bundle\MailingBundle\Sender\SenderInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


/**
 * Class PositibeStandardMailer
 * @package Positibe\Bundle\UserBundle\Mailer
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
class PositibeStandardMailer implements MailerInterface
{
    protected $sender;
    protected $router;
    protected $templateConfirmation;
    protected $templateResetting;

    public function __construct(UrlGeneratorInterface $router, SenderInterface $sender)
    {
        $this->sender = $sender;
        $this->router = $router;
        $this->templateConfirmation = 'registration-confirmation';
        $this->templateConfirmation = 'resetting';
    }


    /**
     * Send an email to a user to confirm the account creation.
     *
     * @param UserInterface $user
     */
    public function sendConfirmationEmailMessage(UserInterface $user)
    {
        $url = $this->router->generate(
            'fos_user_registration_confirm',
            array('token' => $user->getConfirmationToken()),
            UrlGeneratorInterface::ABSOLUTE_URL
        );

        $context = array(
            'user' => $user,
            'confirmationUrl' => $url,
        );

        $this->sender->send(
            $this->templateConfirmation,
            [$user->getEmail()],
            $context
        );
    }

    /**
     * Send an email to a user to confirm the password reset.
     *
     * @param UserInterface $user
     */
    public function sendResettingEmailMessage(UserInterface $user)
    {
        $url = $this->router->generate(
            'fos_user_resetting_reset',
            array('token' => $user->getConfirmationToken()),
            UrlGeneratorInterface::ABSOLUTE_URL
        );

        $context = array(
            'user' => $user,
            'confirmationUrl' => $url,
        );
        $this->sender->send(
            $this->templateResetting,
            [$user->getEmail()],
            $context
        );
    }

}