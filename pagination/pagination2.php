<?php
class pagination{
    public function pagination_display($data){
        if(isset($data['pagination_url']) && !empty($data['pagination_url'])){
            $pagination_url = checkInput($data['pagination_url']);
        }else{
            echo "No url found for this";
            return false;
        }
        if(isset($data['total_records']) && !empty($data['total_records'])){
            $total_records = $data['total_records'];
        }else{
            echo "No record found for this";
            return false;
        }
        if(isset($data['records_per_page']) && !empty($data['records_per_page'])){
            $records_per_page = $data['records_per_page'];
        }else{
             echo "No page found for this";
            return false;
        }
        $total_pages = $this->total_pages($data);
       if(isset($_GET['pg'])){
           $current_page = checkInput(preg_replace('#[^0-9]#', '',$_GET['pg']));
       }else{
           $current_page ='';
       }
       if($current_page == '' || $current_page < 1 || $current_page  >$total_pages ){
           $current_page =1;
           $start_record = 0;
       }else{
           $start_record = ($current_page * $records_per_page)-$records_per_page;
       }
       $this->pagination_controls($current_page, $total_pages, $pagination_url);

     }
    private function total_pages($data){
        $total_records = $data['total_records'];
        $records_per_page = $data['records_per_page'];
        $total_pages = ceil($total_records/$records_per_page);
        return $total_pages;
    }
    private function pagination_controls($current_page, $total_pages, $pagination_url){
        $previous = $current_page-1;
        $next = $current_page + 1;
        $start_page = 1;
        
        // For the search page
        if($current_page >= 2){
            echo '<a href = "'.$pagination_url.'?pg='.$previous.'" class="btn">Previous </a> &nbsp';
        }
        if($current_page <= $total_pages && $current_page > $start_page +2 ){
            $start_page = $current_page -2;
        }
        if($current_page <= $total_pages && $current_page <= $start_page +2){
            $end_page = $current_page + 2;
        }else{
            $end_page = $total_pages;
        }
        if($current_page < 1){
            $current_page = 1;
        } 
        for($start_page; $start_page <= $end_page; $start_page++){
            if($start_page >= $total_pages +1){
                break;
            }
            if($current_page == $start_page){
                echo "<span class = 'btn active' ><b>".$start_page."</b></span> &nbsp";
            }else{
                echo '<a href = "'.$pagination_url.'?pg='.$start_page.'" class="btn">'.$start_page.' </a> &nbsp';
            }
        }
        if($current_page < $total_pages){
            echo "<a href = '".$pagination_url."?pg=".$next."' class='btn'>Next</a>";

        }
        if($current_page == $total_pages){
           $current_page = $total_pages;
           echo "<button>End of records</button>";
        }
        
    }
    public function start_record($data){
        if(isset($_GET['pg'])){
            $current_page = $_GET['pg'];
        }else{
            $current_page= '';
        }
        $total_pages = $this->total_pages($data); 
        if(isset($data['records_per_page']) && !empty($data['records_per_page'])){
            $records_per_page = $data['records_per_page'];
        }else{
             echo "No record found for this";
        }
        if($current_page == ''|| $current_page < 1 || $current_page > $total_pages){
            $start_record = 0;
            return $start_record;
        }else{
            $start_record = ($current_page -1) * $records_per_page;
            return $start_record;
        }
    }

}
?>