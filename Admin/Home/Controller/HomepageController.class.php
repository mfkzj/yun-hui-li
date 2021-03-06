<?php
/**
 *  AUTHOR:CMB
 *  DATE:2015/9/24
 *  FUNCTION:首页模块（后台）
 */
namespace Home\Controller;
use Think\Controller;
class HomepageController extends CommonController {
	
    /* 主页显示 */
    public function index(){
        // 取首页幻灯片
        $where = array('type' => 'INDEX');
        $this->scroll = M('scroll')->where($where)->order('sort')->select();
        
        // 男士服装封面图片
        $data = M('picture')->where(array('type' => 'MANCLOTH'))->find();
        $this->man_cloth_picture = $data['pic_adr'];

        // 女士服装封面图片
        $data = M('picture')->where(array('type' => 'WOMANCLOTH'))->find();
        $this->woman_cloth_picture = $data['pic_adr'];

        // 鞋类封面图片
        $data = M('picture')->where(array('type' => 'SHOE'))->find();
        $this->shoe_picture = $data['pic_adr'];

        // 显示模板
        $this->display();
    }

    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////    分割线     //////////////////////////////
    ///////////////////////////////////////////////////////////////////////////

    /* 添加首页幻灯片界面 */
    public function add(){
        // 显示模板
    	$this->display();
    }

    /* 添加首页幻灯片处理 */
    public function add_handle(){
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
        $where = array('type' => 'INDEX');
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
            'type'         => 'INDEX',
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
            $this->success('添加成功',U('Homepage/index'));
        }
    }

    /* 修改首页幻灯片界面 */
    public function alter(){
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

    /* 修改首页幻灯片处理 */
    public function alter_handle(){
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
                $this->success('修改成功',U('Homepage/index'));
            }else{
                echo "删除文件错误";
            }
        }else{
           M('scroll')->data($data)->save();
            $this->success('修改成功',U('Homepage/index')); 
        }      
    }

    /* 删除左幻灯片处理*/
    public function delete_handle(){
        // 获取参数
        $id           = $_GET['id'];
        // 获取当前处理的数据
        $current_data = M('scroll')->find($id);
        $filename     = $_SERVER['DOCUMENT_ROOT']. __ROOT__ . $current_data['pic_adr'];
        // 获取排在当前数据后面的元素
        $data         = M('scroll')->where("sort > %d AND type = '%s'",$current_data['sort'],'INDEX')->select();
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

        /* 排序左幻灯片处理*/
    public function sort_handle(){
        // 获取参数
        $id   = $_GET['id'];
        $type = $_GET['type'];
        // 判断
        $where   = array('type' => 'INDEX');
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
        $where   = array('sort' => $c2_sort , 'type' => 'INDEX');
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

    /* 修改男士服装展示界面 */
    public function alter_man_cloth_picture(){
        // 数据读取
        $where = array('type' => 'MANCLOTH');
        $this->picture = M('picture')->where($where)->find();
        // 显示模板
        $this->display();
    }

    /* 修改男士服装展示处理 */
    public function alter_man_cloth_picture_handle(){
        // 输入限制
        if($_POST['img'] == 0 ){
            $this->error("请选择图片上传");
        }
        // 获取参数
        $id       = $_POST['id'];
        // 获取当前处理的数据
        $where    = array('type' => 'MANCLOTH');
        $data     = M('picture')->where($where)->find();
        $filename = $_SERVER['DOCUMENT_ROOT']. __ROOT__ . $data['pic_adr'];
        // 图片上传
        $pic_adr  = $this->uploadImage();
        if($pic_adr == -1){
            echo '图片上传错误';die;
        }
        $loginname = $_SESSION['loginname'];
        // 构造数据
        $data = array(
            'id'           => $id,
            'pic_adr'      => $pic_adr,
            'controller'   => $_SESSION['loginname'],
            'created_time' => Date('Y-m-d H:i:s')
        );
        if($this->deleteFile($filename) == 1)
        {
            M('picture')->data($data)->save();
            $this->success('修改成功',U('Homepage/index'));
        }else{
            echo "文件删除错误";
        }  
    }

    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////    分割线     //////////////////////////////
    ///////////////////////////////////////////////////////////////////////////

    /* 修改女士服装展示界面 */
    public function alter_woman_cloth_picture(){
        // 数据读取
        $where = array('type' => 'WOMANCLOTH');
        $this->picture = M('picture')->where($where)->find();
        // 显示模板
        $this->display();
    }

    /* 修改女士服装展示处理 */
    public function alter_woman_cloth_picture_handle(){
        // 输入限制
        if($_POST['img'] == 0 ){
            $this->error("请选择图片上传");
        }
        // 获取参数
        $id       = $_POST['id'];
        // 获取当前处理的数据
        $where    = array('type' => 'WOMANCLOTH');
        $data     = M('picture')->where($where)->find();
        $filename = $_SERVER['DOCUMENT_ROOT']. __ROOT__ . $data['pic_adr'];
        // 图片上传
        $pic_adr  = $this->uploadImage();
        if($pic_adr == -1){
            echo '图片上传错误';die;
        }
        $loginname = $_SESSION['loginname'];
        // 构造数据
        $data = array(
            'id'           => $id,
            'pic_adr'      => $pic_adr,
            'controller'   => $_SESSION['loginname'],
            'created_time' => Date('Y-m-d H:i:s')
        );
        if($this->deleteFile($filename) == 1)
        {
            M('picture')->data($data)->save();
            $this->success('修改成功',U('Homepage/index'));
        }else{
            echo "文件删除错误";
        }  
    }

    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////    分割线     //////////////////////////////
    ///////////////////////////////////////////////////////////////////////////

    /* 修改鞋类展示界面 */
    public function alter_shoe_picture(){
        // 数据读取
        $where = array('type' => 'SHOE');
        $this->picture = M('picture')->where($where)->find();
        // 显示模板
        $this->display();
    }

    /* 修改鞋类展示处理 */
    public function alter_shoe_picture_handle(){
        // 输入限制
        if($_POST['img'] == 0 ){
            $this->error("请选择图片上传");
        }
        // 获取参数
        $id       = $_POST['id'];
        // 获取当前处理的数据
        $where    = array('type' => 'SHOE');
        $data     = M('picture')->where($where)->find();
        $filename = $_SERVER['DOCUMENT_ROOT']. __ROOT__ . $data['pic_adr'];
        // 图片上传
        $pic_adr  = $this->uploadImage();
        if($pic_adr == -1){
            echo '图片上传错误';die;
        }
        $loginname = $_SESSION['loginname'];
        // 构造数据
        $data = array(
            'id'           => $id,
            'pic_adr'      => $pic_adr,
            'controller'   => $_SESSION['loginname'],
            'created_time' => Date('Y-m-d H:i:s')
        );
        if($this->deleteFile($filename) == 1)
        {
            M('picture')->data($data)->save();
            $this->success('修改成功',U('Homepage/index'));
        }else{
            echo "文件删除错误";
        }  
    }
}