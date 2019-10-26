<?php
require_once ('configuration/db_config.php');
class SearchCategory{
    public $dbObj;
    public function __construct(){
     
     $this->dbObj =  new Database;
    }
    public function categorySearch($search){
        $searchQ = " SELECT category.*, property.* from property 
        INNER JOIN category on category.cat_id = property.category_id
         WHERE category.name LIKE '%$search%' OR category.cat_id LIKE '%$search%'
         OR property.title LIKE '%$search%' OR property.description LIKE '%$search%' AND publish_status =1
         GROUP BY category.cat_id";
         $result = $this->dbObj->dbconnector->query($searchQ);
         if($this->dbObj->dbconnector->affected_rows >0){
             $rows = $result->fetch_all(MYSQLI_ASSOC);
             $jSonObj = json_encode($rows);
         }elseif($this->dbObj->dbconnector->affected_rows == 0){
             $jSonObj = "{query: Not found}";
         }else{
             echo " Error ". $this->dbObj->dbconnector->error;
         }
         return $jSonObj;
    }
    // Above is for ajax


    public function filteredBackEnd(){
        $sql = " SELECT property.*, regions.*, states.* FROM property
         INNER JOIN regions ON regions.region_id = property.region_id
         INNER JOIN states ON states.state_id = property.state_id  ";
        $cat_id = (($_POST['cat'] != '')?checkInput($_POST['cat']):"");
        $region_id = (($_POST['region'] != '')?checkInput($_POST['region']):"");
       
        if($cat_id == '' && $region_id == ''){
            $sql .= " WHERE  publish_status = 1";
        }elseif($cat_id != '' && $region_id ==''){
            $sql .= " WHERE property.category_id = '{$cat_id}' AND publish_status = 1";
        }elseif($region_id !='' && $cat_id ==''){
            $sql .= " WHERE property.region_id = '{$region_id}' AND publish_status = 1";
        }elseif($region_id !='' && $cat_id !=''){
            $sql .= " WHERE property.category_id = '{$cat_id}' 
            AND property.region_id = '{$region_id}' AND publish_status = 1  ";
        }
        $price_sort = (($_POST['price_sort'] != '')?checkInput($_POST['price_sort']):"");
        $min_price = (($_POST['min_price'] != '')?checkInput($_POST['min_price']):"");
        $max_price = (($_POST['max_price'] != '')?checkInput($_POST['max_price']):"");
        $purpose = (($_POST['purpose'] != '')?checkInput($_POST['purpose']):"");
        if($min_price !=''){
            $sql .= " AND price >= '{$min_price}'";
        }
        if($max_price !=''){
            $sql .= " AND price <= '{$max_price}'";
        }
        if($purpose == "rent"){
            $sql.= " AND purpose = 'rent' ";
        }
        if($purpose == "sale"){
            $sql.= " AND purpose = 'sale' ";
        }
        if($price_sort == "low" ){
            $sql .= " ORDER BY price ";
        }
        if($price_sort == "high" ){
            $sql .= " ORDER BY price DESC ";
        }
        $result = $this->dbObj->dbconnector->query($sql);
        if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
            }
            return $rows;
        }else{
            return false;
        }
    }
    public function searchByLocation($search, $region){
        $sql = "SELECT property.*, regions.*, states.* FROM property 
        INNER JOIN regions ON regions.region_id = property.region_id
        INNER JOIN states ON states.state_id  = property.state_id
        WHERE (property.title LIKE '%$search%'  
        OR property.description LIKE '%$search%'OR property.price LIKE '%$search%')
        AND publish_status = 1 AND property.region_id = '{$region}' ";
        $queryResult = $this->dbObj->dbconnector->query($sql);
        $rowsResult = $queryResult->num_rows;
        if($rowsResult > 0){
            while($row = $queryResult->fetch_assoc()){
                $rows[] = $row;
            }
            
            return $rows;
        }else{
            return false;
        }
    }

    public function paginateSearchByLocation($search, $region,$startRecord, $recordPerPage){
        $sql = "SELECT property.*, regions.*, states.* FROM property 
        INNER JOIN regions ON regions.region_id = property.region_id
        INNER JOIN states ON states.state_id  = property.state_id
        WHERE (property.title LIKE '%$search%'  
        OR property.description LIKE '%$search%'OR property.price LIKE '%$search%')
        AND publish_status = 1 AND property.region_id = '{$region}' 
        ORDER BY refresh_status DESC LIMIT $startRecord,$recordPerPage ";
        $queryResult = $this->dbObj->dbconnector->query($sql);
        $rowsResult = $queryResult->num_rows;
        if($rowsResult > 0){
            while($row = $queryResult->fetch_assoc()){
                $rows[] = $row;
            }
            
            return $rows;
        }else{
            return false;
        }
    }

    public function postSearchByLocation($search, $region){
        $sql = "SELECT property.*, regions.*, states.* FROM property 
        INNER JOIN regions ON regions.region_id = property.region_id
        INNER JOIN states ON states.state_id  = property.state_id
        WHERE (property.title LIKE '%$search%'  
        OR property.description LIKE '%$search%'OR property.price LIKE '%$search%')
        AND publish_status = 1 AND property.region_id = '{$region}' ";
        $queryResult = $this->dbObj->dbconnector->query($sql);
        $rowsResult = $queryResult->num_rows;
        if($rowsResult > 0){
           header("Location: locationsearch.php?search=".$search."&region=".$region);
        }else{
            return false;
        }
    }
}
?>