<?php

namespace App\Security;

use App\Entity\Task;
use App\Entity\User;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class TaskVoter extends Voter
{
    
    
    const VIEW = 'TASK_VIEW';
    const DELETE = 'TASK_DELETE';

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, mixed $subject): bool
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, [self::VIEW, self::DELETE])) {
            return false;
        }

        // only vote on `Post` objects
        if (!$subject instanceof Task) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        //Utilisateur connecté
        if (!$user instanceof UserInterface) {
            // the user must be logged in; if not, deny access
            return false;
        }

        //Utilisateur Role Admin
        if ($this->security->isGranted('ROLE_ADMIN')) {
            return true;
        }


        /** @var Task $subject */

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($user, $subject); // :)
                break;
            case self::DELETE:
                return $this->canDelete($user, $subject);
                break; 
        }

        return false;
        // you know $subject is a Post object, thanks to `supports()`
        // /** @var Task $task */
        // $task = $subject;

        // return match($attribute) {
        //     self::EDIT => $this->canEdit($task, $user),
        //     self::DELETE => $this->canDelete($task, $user),
        //     default => throw new \LogicException('This code should not be reached!')
        // };
    }

    private function canView(Task $task, UserInterface $user): bool
    {
        // if they can edit, they can view
        if ($this->canEdit($task, $user)) {
            return true;
        }
        // return $user === 

        // the Post object could have, for example, a method `isPrivate()`
        return !$task->isPrivate();
    }

    private function canDelete(Task $task, UserInterface $user): bool
    {
        // this assumes that the Post object has a `getOwner()` method
        return $user === $task->getUser();
    }
}