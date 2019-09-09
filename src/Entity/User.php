<?php

namespace App\Entity;

use App\Entity\UserInfo;
use Doctrine\ORM\Mapping as ORM;

/**
 *@ORM\Entity(repositoryClass="App\Repository\UserRepository")
 *@ORM\Table(name="users")
 */

class User {

    /**
     *@ORM\Column(type="integer")
     *@ORM\Id
     *@ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *@ORM\Column(type="string")
     **/
    private $email;

    /**
     *@ORM\Column(type="string")
     **/
    private $password;

    /**
     * @ORM\OneToOne(targetEntity="Invite", mappedBy="user_invited")
     * @ORM\Column(type="string")
     *
     */
    private $invite_code;

    /**
     * @ORM\OneToOne(targetEntity="UserInfo", inversedBy="user", cascade={"remove", "persist"})
     * @ORM\JoinColumn(name="user_info_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $user_info;

    /**
     * @var ArrayCollection $invites
     * @ORM\OneToMany(targetEntity="Invite", mappedBy="user")
     **/
    private $invites = null;


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
    public function getEmail(){
        return $this->email;
    }

    /**
     *@param mixed $email
     */
    public function setEmail($email){
        $this->email = $email;
    }

    /**
     *@return mixed
     */
    public function getPassword(){
        return $this->password;
    }

    /**
     *@param mixed $password
     */
    public function setPassword($password){
        $this->password = $password;
    }

    /**
     *@return mixed
     */
    public function getInviteCode(){
        return $this->invite_code;
    }

    /**
     *@param mixed $invite_code
     */
    public function setInviteCode($invite_code){
        $this->invite_code = $invite_code;
    }

    /**
     *@return mixed
     */
    public function getUserInfo(){
        return $this->user_info;
    }

    /**
     *@param mixed $user_info
     */
    public function setUserInfo($user_info){
        $this->user_info = $user_info;
    }

    /**
     *@return mixed
     */
    public function getInvites(){
        return $this->invites;
    }

    /**
     *@param Invite $invite
     */
    public function addInvite(Invite $invite){
        $this->invites->add($invite);
    }

    /**
     * @param Invite $invite
     */
    public function inviteExists(Invite $invite)
    {
        return $this->invites->contains($invite);
    }

    /**
     *@return array
     */
    public function toArray(){
        return [
            'id' => $this->id,
            'email' => $this->email,
            'invite_code' => $this->invite_code,
            'user_info_id' => $this->user_info->getId()
        ];
    }
}