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
        return random_int(1, 100);
    }

}