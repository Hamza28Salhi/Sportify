<?php

namespace App\EventListener;

use App\Entity\User;
use App\Event\UserRegistrationEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class UserRegistrationListener implements EventSubscriberInterface
{
    private $mailer;
    private $twig;

    public function __construct(MailerInterface $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public static function getSubscribedEvents()
    {
        return [
            UserRegistrationEvent::class => 'onUserRegistration',
        ];
    }

    public function onUserRegistration(UserRegistrationEvent $event)
    {
        $user = $event->getUser();

        if (!$user->hasRole(User::ROLE_BOBO)) {
            $email = (new Email())
                ->from('noreply@example.com')
                ->to('admin@example.com')
                ->subject('New User Registration')
                ->html($this->twig->render('emails/new_user_registration.html.twig', [
                    'user' => $user,
                ]));

            $this->mailer->send($email);
        }
    }
}