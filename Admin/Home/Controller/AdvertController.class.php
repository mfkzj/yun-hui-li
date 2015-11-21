<?php
/**
 *  AUTHOR:CMB
 *  DATE:2015/9/27
 *  FUNCTION:广告模块（后台）
 */
namespace Home\Controller;
use Think\Controller;
class AdvertController extends CommonController {
	
    /* 主页显示 */
    public function index(){
        // 取商店广告幻灯片
        $where = array('type' => 'SHOP');
        $this->shop = M('scroll')->where($where)->order('sort')->select();

        // 取商品广告幻灯片
        $where = array('type' => 'PRODUCTION');
        $this->production = M('scroll')->where($where)->order('sort')->select();

        // 显示模板
        $this->display();
    }

    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////    分割线     //////////////////////////////
    ///////////////////////////////////////////////////////////////////////////

    /* 添加商品广告幻灯片界面 */
    public function add_production(){
        // 显示模板
    	$this->display();
    }

    /* 添加商品广告幻灯片处理 */
    public function add_production_handle(){
        // 输入限制
        if($_POST['img'] == 0 ){
            $this->error("请选择图片上传");
        }
        // 输入限制
        if($_POST['url'] == ""){
            $this->error("请选择链接地址");
        }
        // 图片上传
        $pic_adr = $this->uploadImage();
        if($pic_adr == -1){
            echo '图片上传错误';
            die;
        }
        // 获取操作者
        $loginname = $_SESSION['loginname'];
        // 读取所有数据，为了排序
        $where = array('type' => 'PRODUCTION');
        $dataRead = M('scroll')->where($where)->select();
        if($_POST['optionsRadios'] == C('TOP')){
            // 置顶
            $sort = $this->sortGetTop($dataRead,'scroll');
        }else{
            // 非置顶
            $sort = $this->sortGetBottom($dataRead);
        }
        $url = $_POST['url'];
        // 构造数据
        $data = array(
            'pic_adr'      => $pic_adr,
            'type'         => 'PRODUCTION',
            'sort'         => $sort,
            'url'          => $url,
            'controller'   => $_SESSION['loginname'],
            'created_time' => Date('Y-m-d H:i:s')
        );
        // 数据插入
        if(!M('scroll')->add($data))
        {
            echo 'scroll表插入数据错误';die;
        }else{
            $this->success('添加成功',U('Advert/index'));
        }
    }

    /* 修改商品广告幻灯片界面 */
    public function alter_production(){
        // 获取参数
        $id            = $_GET['id'];
        // 获取当前处理的数据
        $data          = M('scroll')->find($id);
        $this->id      = $id;
        $this->pic_adr = $data['pic_adr'];
        $this->url     = $data['url'];
        // 显示模板
        $this->display();
    }

    /* 修改商品广告幻灯片处理 */
    public function alter_production_handle(){
        // 输入限制
        if($_POST['url'] == ""){
            $this->error("请选择链接地址");
        }
        // 获取参数
        $id            = $_POST['id'];
        // 获取当前处理的数据
        $data          = M('scroll')->find($id);
        if($_POST['img'] == 1){
            $filename      = $_SERVER['DOCUMENT_ROOT']. __ROOT__ . $data['pic_adr'];
            // 图片上传
            $pic_adr = $this->uploadImage();
            if($pic_adr == -1){
                echo '图片上传错误';
                die;
            }
        }else{
            $pic_adr = $data['pic_adr'];
        }
        // 获取操作者
        $loginname = $_SESSION['loginname'];
        $url = $_POST['url'];
        // 构造数据
        $data = array(
            'id'           => $id,
            'pic_adr'      => $pic_adr,
            'url'          => $url,
            'controller'   => $_SESSION['loginname'],
            'created_time' => Date('Y-m-d H:i:s')
        );
        if($_POST['img'] == 1){
            // 判断删除文件是否成功
            if($this->deleteFile($filename) == 1)
            {
                M('scroll')->data($data)->save();
                $this->success('修改成功',U('Advert/index'));
            }else{
                echo "删除文件错误";
            }
        }else{
           M('scroll')->data($data)->save();
            $this->success('修改成功',U('Advert/index')); 
        }   
    }

    /* 删除商品广告幻灯片处理*/
    public function delete_production_handle(){
        // 获取参数
        $id           = $_GET['id'];
        // 获取当前处理的数据
        $current_data = M('scroll')->find($id);
        $filename     = $_SERVER['DOCUMENT_ROOT']. __ROOT__ . $current_data['pic_adr'];
        // 获取排在当前数据后面的元素
        $data         = M('scroll')->where("sort > %d AND type = '%s'",$current_data['sort'],'PRODUCTION')->select();
        for($i=0;$i<COUNT($data);$i++){
            $data[$i]['sort'] -= 1;
            M('scroll')->data($data[$i])->save();
        } 
        // 判断删除文件是否成功   
        if($this->deleteFile($filename) == 1)
        {
            M('scroll')->delete($id);
            $this->success('删除成功');
        }else{
            echo "删除文件错误";
        }          
    }

    /* 排序商品广告幻灯片处理*/
    public function sort_production_handle(){
        // 获取参数
        $id   = $_GET['id'];
        $type = $_GET['type'];
        // 判断
        $where   = array('type' => 'PRODUCTION');
        $num = M('scroll')->where($where)->count();
        if($num <= 1){
            $this->error('排序失败，数量不足');
        }
        // 获取当前处理的数据
        $c1_data = M('scroll')->find($id);
        $c1_sort = $c1_data['sort'];
        // 获取要对换的数据
        if($type == 'up'){
            $c2_sort = $c1_sort-1;
        }else{
            $c2_sort = $c1_sort+1;
        }
        $where   = array('sort' => $c2_sort , 'type' => 'PRODUCTION');
        $c2_data = M('scroll')->where($where)->find();
        // 排序对换
        $c1_data['sort'] = $c2_sort;
        $c2_data['sort'] = $c1_sort;
        M('scroll')->data($c1_data)->save();
        M('scroll')->data($c2_data)->save();
        $this->success('排序成功');
    }

    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////    分割线     //////////////////////////////
    ///////////////////////////////////////////////////////////////////////////

    /* 添加店铺广告幻灯片界面 */
    public function add_shop(){
        // 显示模板
        $this->display();
    }

    /* 添加店铺广告幻灯片处理 */
    public function add_shop_handle(){
        // 输入限制
        if($_POST['img'] == 0 ){
            $this->error("请选择图片上传");
        }
        // 图片上传
        $pic_adr = $this->uploadImage();
        if($pic_adr == -1){
            echo '图片上传错误';
            die;
        }
        // 获取操作者
        $loginname = $_SESSION['loginname'];
        // 读取所有数据，为了排序
        $where = array('type' => 'SHOP');
        $dataRead = M('scroll')->where($where)->select();
        if($_POST['optionsRadios'] == C('TOP')){
            // 置顶
            $sort = $this->sortGetTop($dataRead,'scroll');
        }else{
            // 非置顶
            $sort = $this->sortGetBottom($dataRead);
        }
        // 构造数据
        $data = array(
            'pic_adr'      => $pic_adr,
            'type'         => 'SHOP',
            'sort'         => $sort,
            'controller'   => $_SESSION['loginname'],
            'created_time' => Date('Y-m-d H:i:s')
        );
        // 数据插入
        if(!M('scroll')->add($data))
        {
            echo 'scroll表插入数据错误';die;
        }else{
            $this->success('添加成功',U('Advert/index'));
        }
    }

    /* 修改店铺广告幻灯片界面 */
    public function alter_shop(){
        // 获取参数
        $id            = $_GET['id'];
        // 获取当前处理的数据
        $data          = M('scroll')->find($id);
        $this->id      = $id;
        $this->pic_adr = $data['pic_adr'];
        // 显示模板
        $this->display();
    }

    /* 修改店铺广告幻灯片处理 */
    public function alter_shop_handle(){
        // 输入限制
        if($_POST['img'] == 0 ){
            $this->error("请选择图片上传");
        }
        // 获取参数
        $id            = $_POST['id'];
        // 获取当前处理的数据
        $data          = M('scroll')->find($id);
        $filename      = $_SERVER['DOCUMENT_ROOT']. __ROOT__ . $data['pic_adr'];
        // 图片上传
        $pic_adr = $this->uploadImage();
        if($pic_adr == -1){
            echo '图片上传错误';
            die;
        }
        // 获取操作者
        $loginname = $_SESSION['loginname'];
        // 构造数据
        $data = array(
            'id'           => $id,
            'pic_adr'      => $pic_adr,
            'controller'   => $_SESSION['loginname'],
            'created_time' => Date('Y-m-d H:i:s')
        );
        // 判断删除文件是否成功
        if($this->deleteFile($filename) == 1)
        {
            M('scroll')->data($data)->save();
            $this->success('修改成功',U('Advert/index'));
        }else{
            echo "删除文件错误";
        }   
    }

    /* 删除店铺广告幻灯片处理*/
    public function delete_shop_handle(){
        // 获取参数
        $id           = $_GET['id'];
        // 获取当前处理的数据
        $current_data = M('scroll')->find($id);
        $filename     = $_SERVER['DOCUMENT_ROOT']. __ROOT__ . $current_data['pic_adr'];
        // 获取排在当前数据后面的元素
        $data         = M('scroll')->where("sort > %d AND type = '%s'",$current_data['sort'],'SHOP')->select();
        for($i=0;$i<COUNT($data);$i++){
            $data[$i]['sort'] -= 1;
            M('scroll')->data($data[$i])->save();
        } 
        // 判断删除文件是否成功   
        if($this->deleteFile($filename) == 1)
        {
            M('scroll')->delete($id);
            $this->success('删除成功');
        }else{
            echo "删除文件错误";
        }          
    }

    /* 排序店铺广告幻灯片处理*/
    public function sort_shop_handle(){
        // 获取参数
        $id   = $_GET['id'];
        $type = $_GET['type'];
        // 判断
        $where   = array('type' => 'SHOP');
        $num = M('scroll')->where($where)->count();
        if($num <= 1){
            $this->error('排序失败，数量不足');
        }
        // 获取当前处理的数据
        $c1_data = M('scroll')->find($id);
        $c1_sort = $c1_data['sort'];
        // 获取要对换的数据
        if($type == 'up'){
            $c2_sort = $c1_sort-1;
        }else{
            $c2_sort = $c1_sort+1;
        }
        $where   = array('sort' => $c2_sort , 'type' => 'SHOP');
        $c2_data = M('scroll')->where($where)->find();
        // 排序对换
        $c1_data['sort'] = $c2_sort;
        $c2_data['sort'] = $c1_sort;
        M('scroll')->data($c1_data)->save();
        M('scroll')->data($c2_data)->save();
        $this->success('排序成功');
    }

}