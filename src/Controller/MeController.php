<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class MeController extends AbstractController
{
    /**
     * @param Security $security
     */
    public function __construct(private Security $security) {}

    /**
     * Return the user informations
     * @return UserInterface|null
     */
    public function __invoke() : UserInterface|null
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find(
            $this->security->getUser()->getId()
        );
        return $user;
    }
}
