<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 *@ORM\Entity
 *@ORM\Table(name="user_info")
 */

class UserInfo {

    /**
     *@ORM\Column(type="integer")
     *@ORM\Id
     *@ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *@ORM\Column(type="string")
     **/
    private $name;

    /**
     *@ORM\Column(type="string")
     **/
    private $description;

    /**
     *@ORM\Column(type="string")
     **/
    private $photos;

    /**
     * @ORM\OneToOne(targetEntity="User", mappedBy="user_info")
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
    public function getName(){
        return $this->name;
    }

    /**
     *@param mixed $name
     */
    public function setName($name){
        $this->name = $name;
    }

    /**
     *@return mixed
     */
    public function getDescription(){
        return $this->description;
    }

    /**
     *@param mixed $description
     */
    public function setDescription($description){
        $this->description = $description;
    }

    /**
     *@return mixed
     */
    public function getPhotos(){
        return $this->photos;
    }

    /**
     *@param mixed $photo
     */
    public function addPhoto($photo){
        $this->photos->add($photo);
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

    public function toArray(){
        return [
            'id' => $this->id,
            'description' => $this->description,
            'user' => $this->user
        ];
    }
}