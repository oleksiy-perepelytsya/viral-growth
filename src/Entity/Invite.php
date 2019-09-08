<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 *@ORM\Entity(repositoryClass="App\Repository\InviteRepository")
 *@ORM\Table(name="invites")
 */

class Invite {

    const STATUS_ACTIVE = 'active';
    const STATUS_USED = 'used';

    const ALLOWED_STATUSES = [
        self::STATUS_ACTIVE,
        self::STATUS_USED
    ];

    /**
     *@ORM\Column(type="integer")
     *@ORM\Id
     *@ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *@ORM\OneToOne(targetEntity="User", inversedBy="invite_code")
     *@ORM\JoinColumn(name="code", referencedColumnName="invite_code")
     *@ORM\Column(type="string")
     **/
    private $code;

    /**
     *@ORM\Column(type="string")
     **/
    private $status;

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
    public function getStatus(){
        return $this->status;
    }

    /**
     *@param mixed $status
     */
    public function setStatus($status){
        $this->status = $status;
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
            'status' => $this->status
        ];
    }
}