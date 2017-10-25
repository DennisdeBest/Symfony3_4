<?php


namespace RC\CustomerBundle\EventSubscriber;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use RC\UserBundle\Entity\User;
use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;

class RegistrationSubscriber implements EventSubscriberInterface
{
    /**
     * Returns the events to which this class has subscribed.
     *
     * Return format:
     *     array(
     *         array('event' => 'the-event-name', 'method' => 'onEventName', 'class' => 'some-class', 'format' => 'json'),
     *         array(...),
     *     )
     *
     * The class may be omitted if the class wants to subscribe to events of all classes.
     * Same goes for the format key.
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'rc.customer.pre_create' => [
                ['generatePassword', 10],
            ],
        ];
    }

    public function generatePassword(ResourceControllerEvent $event)
    {
        /** @var User $customer */
        $customer = $event->getSubject();
        $password = 'change'; //TODO generate real password

        $customer->setPlainPassword($password);
    }
}