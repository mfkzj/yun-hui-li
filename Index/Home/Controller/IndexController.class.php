<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    public function index(){
    	// 取商铺幻灯片
        $where = array('type' => 'SHOP');
        $scroll_shop = M('scroll')->where($where)->order('sort')->select();
 		while(COUNT($scroll_shop)<12){
 			$scroll_shop = array_merge($scroll_shop,$scroll_shop);
 		}
 		$this->scroll_shop = $scroll_shop;

        // 取首页幻灯片
        $where = array('type' => 'INDEX');
        $this->scroll_index = M('scroll')->where($where)->order('sort')->select();
        
        // 男士服装封面图片
        $data = M('picture')->where(array('type' => 'MANCLOTH'))->find();
        $this->man_cloth_picture = $data['pic_adr'];

        // 女士服装封面图片
        $data = M('picture')->where(array('type' => 'WOMANCLOTH'))->find();
        $this->woman_cloth_picture = $data['pic_adr'];

        // 鞋类封面图片
        $data = M('picture')->where(array('type' => 'SHOE'))->find();
        $this->shoe_picture = $data['pic_adr'];

        // 取QQ
        $where = array('type' => 'QQ');
        $this->QQ = M('webinfo')->where($where)->find();
    

        $this->display();
    }
}