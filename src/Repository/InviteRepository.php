<?php

namespace App\Repository;

use App\Entity\Invite;
use Doctrine\ORM\EntityRepository;


class InviteRepository extends EntityRepository
{
    /**
     * @param Invite $invite
     * @return int
     */
    public function generateCode(Invite $invite){
        $salt = getenv('INVITE_SALT');
        return md5(uniqid($invite->getId(), true) . $salt);
    }

}