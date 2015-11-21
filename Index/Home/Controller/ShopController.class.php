<?php
namespace Home\Controller;
use Think\Controller;
class ShopController extends CommonController {
    public function index(){
    	echo '无法进入';die;
    }

    public function mancloth(){
    	$type = "MANCLOTH";
    	$this->getShopScroll();
    	$this->getProductionScroll();
    	$this->getProduction($type);
        $this->getWeiInfo();
    	$this->title = '男士';
    	$this->display();
    }

    public function womancloth(){
    	$type = "WOMANCLOTH";
    	$this->getShopScroll();
    	$this->getProductionScroll();
    	$this->getProduction($type);
        $this->getWeiInfo();
    	$this->title = '女士';
    	$this->display();
    }

    public function shoe(){
    	$type = "SHOE";
    	$this->getShopScroll();
    	$this->getProductionScroll();
    	$this->getProduction($type);
        $this->getWeiInfo();
    	$this->title = '鞋子';
    	$this->display();
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

    public function getProductionScroll(){
    	// 取首页幻灯片
        $where = array('type' => 'PRODUCTION');
        $this->scroll_production = M('scroll')->where($where)->order('sort')->select();
    }

    public function getProduction($type){
    	// 条件
    	$where = array('type' => $type);
        // 获得当前页数
        $pageNumber  = $_GET['p'];
        if($pageNumber == "") $pageNumber = 0;
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $production  = M('shop')->where($where)->order('sort')->page($pageNumber,C('分页'))->select();
        // 查询满足要求的总记录数
        $count       = M('shop')->where($where)->count();

		$perPage = $count / C('分页');

        // 数据映射
        $this->production = $production;
        $this->count      = $count;
        $this->perPage    = $perPage;

    }

    public function getWeiInfo(){
        $beian   = M('webinfo')->where(array('type' => 'BEIAN'))->find();
        $banquan = M('webinfo')->where(array('type' => 'BANQUAN'))->find();

        $this->beian   = $beian['content'];
        $this->banquan = $banquan['content'];
    }
}