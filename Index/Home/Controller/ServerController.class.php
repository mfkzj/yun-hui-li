<?php
namespace Home\Controller;
use Think\Controller;
class ServerController extends CommonController {

    public function index(){
    	$this->getShopScroll();
        $this->getWeiInfo();
        $this->title = '返利指导';
        $where = array('type' => 'GUIDE');
        $data = M('text')->where($where)->find();
        $this->content = $data['content'];
        $this->display();
    }

    public function guide(){
        $this->getShopScroll();
        $this->getWeiInfo();
        $this->title = '返利指导';
        $where = array('type' => 'GUIDE');
        $data = M('text')->where($where)->find();
        $this->content = $data['content'];
        $this->display('index');
    }

    public function problem(){
    	$this->getShopScroll();
        $this->getWeiInfo();
        $this->title = '返利指导';
        $where = array('type' => 'PROBLEM');
        $data = M('text')->where($where)->find();
        $this->content = $data['content'];
        $this->display('index');
    }

    public function advertisement(){
    	$this->getShopScroll();
        $this->getWeiInfo();
        $this->title = '返利指导';
        $where = array('type' => 'ADVERTISEMENT');
        $data = M('text')->where($where)->find();
        $this->content = $data['content'];
        $this->display('index');
    }

    public function about(){
        $this->getShopScroll();
        $this->getWeiInfo();
        $this->title = '返利指导';
        $where = array('type' => 'ABOUT');
        $data = M('text')->where($where)->find();
        $this->content = $data['content'];
        $this->display('index');
    }

    public function getShopScroll(){
    	// 取商铺幻灯片
        $where = array('type' => 'SHOP');
        $scroll_shop = M('scroll')->where($where)->order('sort')->select();
 		while(COUNT($scroll_shop)<16){
 			$scroll_shop = array_merge($scroll_shop,$scroll_shop);
 		}
 		$this->scroll_shop = $scroll_shop;
    }

    public function getWeiInfo(){
        $beian   = M('webinfo')->where(array('type' => 'BEIAN'))->find();
        $banquan = M('webinfo')->where(array('type' => 'BANQUAN'))->find();

        $this->beian   = $beian['content'];
        $this->banquan = $banquan['content'];
    }

}