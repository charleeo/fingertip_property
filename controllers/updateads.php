<?php
class UpdateAds{
    public $dbObj;
    public function __construct(){
        $this->dbObj = new Database;
    }
    public function updateGeneralInformation($title, $decription, $purpose, $price, $propertyId){
        $this->title =$title;
        $this->site = $decription;
        $this->purpose = $purpose;
        $this->price =$price;

        $sql = "UPDATE property SET title = '$title', `description` = '$decription', purpose = '$purpose', price = '$price'
        WHERE id = '$propertyId' ";
        $updated = $this->dbObj->dbconnector->query($sql);
        if($updated === true){
            return true;
        }else{
            echo "Error ".$this->dbObj->dbconnector->error;
        }
    }

    public function updateContactInformation($phone, $site, $city,$address, $region_id, $state_id, $propertyId){
        $this->phone =$phone;
        $this->site = $site;
        $this->city = $city;
        $this->address =$address;
        $this->state_id =$state_id;
        $this->region_id =$region_id;

        $sql = "UPDATE contact SET phone = '$phone', site = '$site', address = '$address', city = '$city'
        WHERE contact.property_id = '$propertyId' ";
        $updated = $this->dbObj->dbconnector->query($sql);
        if($updated === true){
            $sql ="UPDATE property SET state_id = '$state_id',region_id = '$region_id' WHERE id = '$propertyId' ";
            $update = $this->dbObj->dbconnector->query($sql);
            if($update === true){
                return true;
            }else{
                echo "Error ".$this->dbObj->dbconnector->error;
            }
        }else{
            echo "Error ".$this->dbObj->dbconnector->error;
        }
    }

    public function updateCategoryOneC($rooms, $bath, $toilets,$land, $age, $facility, $propertyId){
        $this->rooms =$rooms;
        $this->bath = $bath;
        $this->toilets = $toilets;
        $this->land =$land;
        $this->facility =$facility;
        $this->age =$age;

        $sql = "UPDATE houses SET rooms = '$rooms', bathrooms = '$bath',
         toilets = '$toilets', land = '$land', age ='$age', facility ='$facility'
        WHERE houses.property_id = '$propertyId' ";
        $updated = $this->dbObj->dbconnector->query($sql);
        if($updated === true){
                return true;
            }else{
                echo "Error ".$this->dbObj->dbconnector->error;
        }
    }
}
