<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    /* 主页显示 */
    public function index(){
        // 显示模板
        $this->display();
    }
}