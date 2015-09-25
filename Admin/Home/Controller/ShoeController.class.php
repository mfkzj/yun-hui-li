<?php
/**
 *  AUTHOR:CMB
 *  DATE:2015/9/26
 *  FUNCTION:鞋类模块（后台）
 */
namespace Home\Controller;
use Think\Controller;
class ShoeController extends CommonController {
	
    /* 主页显示 */
    public function index(){
        // 分类
        $this->classification = M('classification')->where(array('type' => 'SHOE'))->order('sort')->select();

        // 显示模板
        $this->display();
    }

    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////    分割线     //////////////////////////////
    ///////////////////////////////////////////////////////////////////////////

    /* 添加分类界面 */
    public function add_classification(){
        // 显示模板
        $this->display();
    }

    /* 添加分类处理 */
    public function add_classification_handle(){
        // 获取id
        $id        = $_POST['id'];
        // 获取名称
        $name      = $_POST['name'];
        // 输入判断
        if($name == ""){
            $this->error('请输入分类名称');
        }
        // 获取操作者
        $loginname = $_SESSION['loginname'];
        // 读取所有数据，为了排序
        $where     = array('type' => 'SHOE');
        $dataRead  = M('classification')->where($where)->select();
        if($_POST['optionsRadios'] == C('TOP')){
            // 置顶
            $sort = $this->sortGetTop($dataRead,'classification');
        }else{
            // 非置顶
            $sort = $this->sortGetBottom($dataRead);
        }
        // 构造数据
        $data = array(
            'id'           => $id,
            'name'         => $name,
            'type'         => 'SHOE',
            'sort'         => $sort,
            'controller'   => $loginname,
            'created_time' => Date('Y-m-d H:i:s')
        );
        // 数据插入
        if(!M('classification')->add($data))
        {
            echo 'classification表插入数据出错';die;
        }else{
            $this->success('添加成功',U('Shoe/index'));
        }
    }

    /* 修改分类界面 */
    public function alter_classification(){
        // 获取参数
        $id             = $_GET['id'];
        // 获取当前处理的数据
        $data           = M('classification')->find($id);
        $this->id       = $id;
        $this->name     = $data['name'];
        // 显示模板
        $this->display();
    }

    /* 修改分类处理 */
    public function alter_classification_handle(){
        // 获取id
        $id        = $_POST['id'];
        // 获取名称
        $name      = $_POST['name'];
        // 输入判断
        if($name == ""){
            $this->error('请输入分类名称');
        }
        // 获取当前处理的数据
        $data      = M('classification')->find($id);
        // 获取操作者
        $loginname = $_SESSION['loginname'];
        // 构造数据
        $data = array(
            'id'           => $id,
            'name'         => $name,
            'controller'   => $loginname,
            'created_time' => Date('Y-m-d H:i:s')
        );
        if(!M('classification')->data($data)->save()){
            echo 'classification表更新数据出错';die;
        }else{
            $this->success('修改成功',U('Shoe/index'));
        }
    }

    /* 删除分类处理 */
    public function delete_classification_handle(){
        // 获取参数
        $id           = $_GET['id'];
        // 获取当前处理的数据
        $current_data = M('classification')->find($id);
        // 获取排在当前数据后面的元素
        $data         = M('classification')->where("sort > %d AND type = '%s'",$current_data['sort'],'SHOE')->select();
        for($i=0;$i<COUNT($data);$i++){
            $data[$i]['sort']-=1;
            M('classification')->data($data[$i])->save();
        }
        // 删除文件并修改数据库    
        if(!M('classification')->delete($id))
        {
            echo 'classification表删除数据出错';die;
        }else{
            $this->success('删除成功',U('Shoe/index'));
        }
    }

    /* 排序分类处理 */
    public function sort_classification_handle(){
        // 获取参数
        $id   = $_GET['id'];
        $type = $_GET['type'];
        // 判断
        $where   = array('type' => 'SHOE');
        $num = M('classification')->where($where)->count();
        if($num <= 1){
            $this->error('排序失败，数量不足');
        }
        // 获取当前处理的数据
        $c1_data = M('classification')->find($id);
        $c1_sort = $c1_data['sort'];
        // 获取要对换的数据
        if($type == 'up'){
            $c2_sort = $c1_sort-1;
        }else{
            $c2_sort = $c1_sort+1;
        }
        $where   = array('sort' => $c2_sort,'type' => 'SHOE');
        $c2_data = M('classification')->where($where)->find();
        // 排序对换
        $c1_data['sort'] = $c2_sort;
        $c2_data['sort'] = $c1_sort;
        M('classification')->data($c1_data)->save();
        M('classification')->data($c2_data)->save();
        $this->success('排序成功');
    }

    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////    分割线     //////////////////////////////
    ///////////////////////////////////////////////////////////////////////////

}