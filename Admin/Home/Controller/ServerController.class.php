<?php
namespace Home\Controller;
use Think\Controller;
class ServerController extends CommonController {

    public function index(){
    	
    }

    public function guide(){
        $where = array('type' => 'GUIDE');
    	$this->data = M('text')->where($where)->find();
    	$this->display();
    }

    public function alter_guide(){
        $id = $_GET['id'];
        $this->data = M('text')->find($id);
        $this->display();
    }

    public function alter_guide_handle(){
        // 获取POST数据
        $id      = $_POST['id'];
        $content = $_POST['content'];
        // 构造数据
        $data = array(
            'id'           => $id,
            'content'      => $content,
            'controller'   => $_SESSION['loginname'],
            'created_time' => Date('Y-m-d H:i:s')
        );
        // 数据更新
        if(!M('text')->data($data)->save())
        {
            echo 'text表更新数据出错';die;
        }else{
            $this->success('修改成功',U('Server/guide'));
        }
    }

    public function problem(){
    	$where = array('type' => 'PROBLEM');
        $this->data = M('text')->where($where)->find();
        $this->display();
    }

    public function alter_problem(){
        $id = $_GET['id'];
        $this->data = M('text')->find($id);
        $this->display();
    }

    public function alter_problem_handle(){
        // 获取POST数据
        $id      = $_POST['id'];
        $content = $_POST['content'];
        // 构造数据
        $data = array(
            'id'           => $id,
            'content'      => $content,
            'controller'   => $_SESSION['loginname'],
            'created_time' => Date('Y-m-d H:i:s')
        );
        // 数据更新
        if(!M('text')->data($data)->save())
        {
            echo 'text表更新数据出错';die;
        }else{
            $this->success('修改成功',U('Server/problem'));
        }
    }

    public function advertisement(){
    	$where = array('type' => 'ADVERTISEMENT');
        $this->data = M('text')->where($where)->find();
        $this->display();
    }

    public function alter_advertisement(){
        $id = $_GET['id'];
        $this->data = M('text')->find($id);
        $this->display();
    }

    public function alter_advertisement_handle(){
        // 获取POST数据
        $id      = $_POST['id'];
        $content = $_POST['content'];
        // 构造数据
        $data = array(
            'id'           => $id,
            'content'      => $content,
            'controller'   => $_SESSION['loginname'],
            'created_time' => Date('Y-m-d H:i:s')
        );
        // 数据更新
        if(!M('text')->data($data)->save())
        {
            echo 'text表更新数据出错';die;
        }else{
            $this->success('修改成功',U('Server/advertisement'));
        }
    }

    public function about(){
        $where = array('type' => 'ABOUT');
        $this->data = M('text')->where($where)->find();
        $this->display();
    }

    public function alter_about(){
        $id = $_GET['id'];
        $this->data = M('text')->find($id);
        $this->display();
    }

    public function alter_about_handle(){
        // 获取POST数据
        $id      = $_POST['id'];
        $content = $_POST['content'];
        // 构造数据
        $data = array(
            'id'           => $id,
            'content'      => $content,
            'controller'   => $_SESSION['loginname'],
            'created_time' => Date('Y-m-d H:i:s')
        );
        // 数据更新
        if(!M('text')->data($data)->save())
        {
            echo 'text表更新数据出错';die;
        }else{
            $this->success('修改成功',U('Server/about'));
        }
    }

}