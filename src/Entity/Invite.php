<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 *@ORM\Entity
 *@ORM\Table(name="invites")
 */

class Invite {

    /**
     *@ORM\Column(type="integer")
     *@ORM\Id
     *@ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *@ORM\Column(type="string")
     **/
    private $code;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="invites")
     * @ORM\JoinColumn(onDelete="CASCADE")
     **/
    private $user;


    /**
     *@return mixed
     */
    public function getId(){
        return $this->id;
    }

    /**
     *@param mixed $id
     */
    public function setId($id){
        $this->id = $id;
    }

    /**
     *@return mixed
     */
    public function getCode(){
        return $this->code;
    }

    /**
     *@param mixed $code
     */
    public function setCode($code){
        $this->code = $code;
    }

    /**
     *@return mixed
     */
    public function getUser(){
        return $this->user;
    }

    /**
     *@param mixed $user
     */
    public function setUser($user){
        $this->user = $user;
    }

    /**
     *@return array
     */
    public function toArray(){
        return [
            'id' => $this->id,
            'code' => $this->code,
            'user' => $this->user
        ];
    }
}