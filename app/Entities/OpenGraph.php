<?php
namespace Entities;

class OpenGraph {
    private $title;
    private $type;// ok
    private $description;
    private $image;
    private $url;
    private $siteName; // ok
    private $admins; // later
    
    public function getTitle(){
        return $this->title;
    }
    
    public function setTitle($title){
        $this->title = $title;
    }
    
    public function getType(){
        return $this->type;
    }
    
    public function setType($type){
        $this->type = $type;
    }
    
    public function getDescription(){
        return $this->description;
    }
    
    public function setDescription($description){
        $this->description = $description;
    }
    
    public function getImage(){
        return $this->image;
    }
    
    public function setImage($image){
        $this->image = $image;
    }
    
    public function getUrl(){
        return $this->url;
    }
    
    public function setUrl($url){
        $this->url = $url;
    }
    
    public function getSiteName(){
        return $this->siteName;
    }
    
    public function setSiteName($siteName){
        $this->siteName = $siteName;
    }
    
    public function getAdmins(){
        return $this->admins;
    }
    
    public function setAdmins($admins){
        $this->admins = $admins;
    }
}