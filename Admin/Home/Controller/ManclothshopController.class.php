<?php
/**
 *  AUTHOR:CMB
 *  DATE:2015/9/27
 *  FUNCTION:男士服装店铺推荐（后台）
 */
namespace Home\Controller;
use Think\Controller;
class ManclothshopController extends CommonController {
	
    /* 主页显示 */
    public function index(){

        // 条件
        $where = array('type' => 'MANCLOTH');
        // 获得当前页数
        $pageNumber = $_GET['p'];
        if($pageNumber == "") $pageNumber = 0;
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $shop    = M('shop')->where($where)->order('sort')->page($pageNumber,C('分页'))->select();
        // 查询满足要求的总记录数
        $count   = M('shop')->where($where)->count();
        // 实例化分页类 传入总记录数和每页显示的记录数
        $page          = new \Think\Page($count,C('分页'));
        // 分页显示输出
        $show          = $page->show();
        // 数据映射
        $this->shop    = $shop;
        $this->page    = $show;
        $this->count   = $count;

        // 显示模板
        $this->display();
    }

    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////    分割线     //////////////////////////////
    ///////////////////////////////////////////////////////////////////////////

    /* 添加店铺推荐界面 */
    public function add(){
        // 显示模板
        $this->display();
    }

    /* 添加店铺推荐处理 */
    public function add_handle(){
        // 获取姓名
        $name      = $_POST['name'];
        // 获取职称
        $url       = $_POST['url'];
        // 输入判断
        if($name == ""){
            $this->error('请输入店铺名称');
        }
        if($url == ""){
            $this->error('请输入店铺网址');
        }
        if($_POST['img'] == 0 ){
            $this->error("请选择图片上传");
        }
        // 文件上传判断,获取文件路径
        $pic_adr = $this->uploadImage();
        if($pic_adr == -1){
            echo '图片上传错误';die;
        }
        // 获取操作者
        $loginname = $_SESSION['loginname'];
        // 添加分类
        $where = array('type' => 'MANCLOTH');
        // 读取所有数据，为了排序
        $dataRead  = M('shop')->where($where)->select();
        if($_POST['optionsRadios'] == C('TOP')){
            // 置顶
            $sort = $this->sortGetTop($dataRead,'shop');
        }else{
            // 非置顶
            $sort = $this->sortGetBottom($dataRead);
        }
        // 构造数据
        $data = array(
            'name'         => $name,
            'url'          => $url,
            'pic_adr'      => $pic_adr,
            'type'         => 'MANCLOTH',
            'sort'         => $sort,
            'click'        => 0,
            'controller'   => $loginname,
            'created_time' => Date('Y-m-d H:i:s')
        );
        // 数据插入
        if(!M('shop')->add($data))
        {
            echo 'shop表插入数据出错';die;
        }else{
            $this->success('添加成功',U('Manclothshop/index'));
        }
    }

    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////    分割线     //////////////////////////////
    ///////////////////////////////////////////////////////////////////////////

    /* 修改店铺推荐界面 */
    public function alter(){
        // 获取参数
        $id             = $_GET['id'];
        // 获取当前处理的数据
        $data           = M('shop')->find($id);
        $this->id       = $id;
        $this->name     = $data['name'];
        $this->url      = $data['url'];
        $this->pic_adr  = $data['pic_adr'];
        // 显示模板
        $this->display();
    }

    /* 修改店铺推荐处理 */
    public function alter_handle(){
        // 获取id
        $id   = $_POST['id'];
        // 获取姓名
        $name = $_POST['name'];
        // 获取职称
        $url  = $_POST['url'];
        // 输入判断
        if($name == ""){
            $this->error('请输入导师姓名');
        }
        if($url == ""){
            $this->error('请输入链接');
        }
        // 获取当前处理的数据
        $data      = M('shop')->find($id);
        $filename  = $_SERVER['DOCUMENT_ROOT']. __ROOT__ . $data['pic_adr'];
        // 是否为新上传图片
        if(!$_POST['img'] == 0 ){
            // 文件上传判断,获取文件路径
            $pic_adr = $this->uploadImage();
            if($pic_adr == -1){
                echo '图片上传错误';die;
            }
        }else{
            $pic_adr = $data['pic_adr'];
        }
        // 获取操作者
        $loginname = $_SESSION['loginname'];
        // 构造数据
        $data = array(
            'id'           => $id,
            'name'         => $name,
            'url'          => $url,
            'pic_adr'      => $pic_adr,
            'controller'   => $loginname,
            'created_time' => Date('Y-m-d H:i:s')
        );
        // 是否为新上传图片
        if($_POST['img'] == 1)
        {
            // 判断删除文件
            if($this->deleteFile($filename) == 1)
            {
                if(!M('shop')->data($data)->save()){
                    echo 'shop表更新数据出错';die;
                }else{
                    $this->success('修改成功',U('Manclothshop/index'));
                }
            }else{
                echo "删除文件错误";
            }
        }else{
            if(!M('shop')->data($data)->save()){
                echo 'shop表更新数据出错';die;
            }else{
                $this->success('修改成功',U('Manclothshop/index'));
            }
        }
    }

    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////    分割线     //////////////////////////////
    ///////////////////////////////////////////////////////////////////////////

    /* 删除店铺推荐处理 */
    public function delete_handle(){
        // 获取参数
        $id           = $_GET['id'];
        // 获取当前处理的数据
        $current_data = M('shop')->find($id);
        $filename     = $_SERVER['DOCUMENT_ROOT']. __ROOT__ . $current_data['pic_adr'];
        // 获取排在当前数据后面的元素
        $data         = M('shop')->where("sort > %d AND type = '%s'",$current_data['sort'],'MANCLOTH')->select();
        for($i=0;$i<COUNT($data);$i++){
            $data[$i]['sort']-=1;
            M('shop')->data($data[$i])->save();
        }
        // 删除文件并修改数据库    
        if($this->deleteFile($filename) == 1)
        {
            M('shop')->delete($id);
            $this->success('删除成功');
        }else{
            echo "删除文件错误";
        }
    }

    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////    分割线     //////////////////////////////
    ///////////////////////////////////////////////////////////////////////////

    /* 排序分类处理 */
    public function sort_handle(){
        // 获取参数
        $id   = $_GET['id'];
        $type = $_GET['type'];
        // 判断
        $where   = array('type' => 'MANCLOTH');
        $num = M('shop')->where($where)->count();
        if($num <= 1){
            $this->error('排序失败，数量不足');
        }
        // 获取当前处理的数据
        $c1_data = M('shop')->find($id);
        $c1_sort = $c1_data['sort'];
        // 获取要对换的数据
        if($type == 'up'){
            $c2_sort = $c1_sort-1;
        }else{
            $c2_sort = $c1_sort+1;
        }
        $where   = array('sort' => $c2_sort,'type' => 'MANCLOTH');
        $c2_data = M('shop')->where($where)->find();
        // 排序对换
        $c1_data['sort'] = $c2_sort;
        $c2_data['sort'] = $c1_sort;
        M('shop')->data($c1_data)->save();
        M('shop')->data($c2_data)->save();
        $this->success('排序成功');
    }

    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////    分割线     //////////////////////////////
    ///////////////////////////////////////////////////////////////////////////

    /* JSON获得答案 */
    public function get_url(){
        // 获取参数
        $id   = $_GET['id'];
        // 查找数据
        $data = M('shop')->find($id);
        // 转义
        $jsonReturn = $this->replaceLineAndSpace($data['url']);
        // 数据返回
        $this->ajaxReturn($jsonReturn);
    }
}