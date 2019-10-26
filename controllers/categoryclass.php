<?php
class Category{
    public $dbObj;
    public function __construct(){
        $this->dbObj = new Database();
    }

    public function displayCategories($cat){
        $query ="SELECT property.*, states.*, regions.*, users.*, category.* FROM property
        INNER JOIN states ON states.state_id = property.state_id
        INNER JOIN regions ON regions.region_id = property.region_id
        INNER JOIN users ON users.user_id = property.user_id
        INNER JOIN category ON category.cat_id = property.category_id
        WHERE property.category_id ='{$cat}' AND publish_status = 1  ";
        $result = $this->dbObj->dbconnector->query($query);
        if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
            }
            return $rows;
        }else{
            return false;
        }
    }

    public function paginateDisplayCategories($cat, $start_record, $record_per_page){
        $query ="SELECT property.*, states.*, regions.*, users.*, category.* FROM property
        INNER JOIN states ON states.state_id = property.state_id
        INNER JOIN regions ON regions.region_id = property.region_id
        INNER JOIN users ON users.user_id = property.user_id
        INNER JOIN category ON category.cat_id = property.category_id
        WHERE property.category_id ='{$cat}' AND publish_status = 1 ORDER BY refresh_status DESC 
        LIMIT $start_record, $record_per_page ";
        $result = $this->dbObj->dbconnector->query($query);
        if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
            }
            return $rows;
        }else{
            return false;
        }
    }

    public function getCategory(){
        $query ="SELECT * FROM category";
        $result = $this->dbObj->dbconnector->query($query);
        if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
            }
            return $rows;
        }else{
            return false;
        }
    }


    public function getCategoryOne(){
        $query ="SELECT property.*,  category.* FROM property
        LEFT JOIN category ON category.cat_id = property.category_id
        WHERE property.category_id = 1 AND publish_status = 1 ORDER BY RAND() LIMIT 0 ,1 ";
        $result = $this->dbObj->dbconnector->query($query);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            return $row;
        }else{
            return false;
        }
    }


    public function getCategoryTwo(){
        $query ="SELECT property.*,  category.* FROM property
        LEFT JOIN category ON category.cat_id = property.category_id
        WHERE property.category_id = 2 AND publish_status = 1 ORDER BY RAND()  LIMIT 0 ,1 ";
        $result = $this->dbObj->dbconnector->query($query);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            return $row;
        }else{
            return false;
        }
    }


    public function getCategoryThree(){
        $query ="SELECT property.*,  category.* FROM property
        LEFT JOIN category ON category.cat_id = property.category_id
        WHERE property.category_id = 3 AND publish_status = 1 ORDER BY RAND()  LIMIT 0 ,1 ";
        $result = $this->dbObj->dbconnector->query($query);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            return $row;
        }else{
            return false;
        }
    }


    public function getCategoryFour(){
        $query ="SELECT property.*,  category.* FROM property
        LEFT JOIN category ON category.cat_id = property.category_id
        WHERE property.category_id = 4 AND publish_status = 1 ORDER BY RAND()  LIMIT 0 ,1 ";
        $result = $this->dbObj->dbconnector->query($query);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            return $row;
        }else{
            return false;
        }
    }

}
?>