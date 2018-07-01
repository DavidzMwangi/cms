<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 6/29/2018
 * Time: 8:04 PM
 */
class SideBar{
    private $page;
    public function __construct()
    {
//        $this->page=$page;
    }

    public function changeView($page)
    {
        $this->page=$page;
        switch ($page){
            case 1:{
                $this->dashboard();
            }
            case 2:{
                $this->version();
            }
            default:{

            }
        }
    }
    public function dashboard()
    {
        return require_once 'content.php';
    }
    public function version(){
        return  require_once 'save_milk.php';
    }
}