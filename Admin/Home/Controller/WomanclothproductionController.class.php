<?php
/**
 *  AUTHOR:CMB
 *  DATE:2015/10/1
 *  FUNCTION:女士服装商品推荐（后台）
 */
namespace Home\Controller;
use Think\Controller;
class WomanclothproductionController extends CommonController {
	
    /* 主页显示 */
    public function index(){

        // 条件
        $where       = array('type' => 'WOMANCLOTH');
        // 获得当前页数
        $pageNumber  = $_GET['p'];
        if($pageNumber == "") $pageNumber = 0;
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $production  = M('production')->where($where)->order('sort')->page($pageNumber,C('分页'))->select();
        // 查询满足要求的总记录数
        $count       = M('production')->where($where)->count();
        // 实例化分页类 传入总记录数和每页显示的记录数
        $page        = new \Think\Page($count,C('分页'));
        // 分页显示输出
        $show        = $page->show();
        for($i=0;$i<COUNT($production);$i++)
        {
            if($classification = M('classification')->find($production[$i]['classify_id']))
            {
                $production[$i]['classification'] = $classification['name'];
            }
        }
        // 数据映射
        $this->production = $production;
        $this->page       = $show;
        $this->count      = $count;

        // 显示模板
        $this->display();
    }

    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////    分割线     //////////////////////////////
    ///////////////////////////////////////////////////////////////////////////

    /* 添加店铺推荐界面 */
    public function add(){
        // 分类
        $this->classification = M('classification')->where(array('type' => 'WOMANCLOTH'))->order('sort')->select();
        // 显示模板
        $this->display();
    }

    /* 添加店铺推荐处理 */
    public function add_handle(){
        // 获取URL
        $url            = $_POST['url'];
        // 获取姓名
        $name           = $_POST['name'];
        // 获取原价
        $price_original = $_POST['price_original'];
        // 获取折后价
        $price_now      = $_POST['price_now'];
        // 获取返利
        $rebate         = $_POST['rebate'];
        // 获取商品分类id
        $classify_id     = $_POST['classify_id'];
        // 获取封面URL
        $cover          = $_POST['img'];
        // 输入判断
        if($url == ""){
            $this->error('请输入店铺网址');
        }
        if($name == ""){
            $this->error('请输入店铺名称');
        }
        if($price_original == ""){
            $this->error('请输入原价');
        }
        if($classify_id == ""){
            $this->error('请选择分类');
        }
        if($price_now == ""){
            $this->error('请输入折后价');
        }
        if($rebate == ""){
            $this->error('请输入返利');
        }
        if($cover == ""){
            $this->error("请选择图片上传");
        }
        // 获取操作者
        $loginname = $_SESSION['loginname'];
        // 添加分类
        $where = array('type' => 'WOMANCLOTH');
        // 读取所有数据，为了排序
        $dataRead  = M('production')->where($where)->select();
        if($_POST['optionsRadios'] == C('TOP')){
            // 置顶
            $sort = $this->sortGetTop($dataRead,'production');
        }else{
            // 非置顶
            $sort = $this->sortGetBottom($dataRead);
        }
        // 构造数据
        $data = array(
            'name'            => $name,
            'url'             => $url,
            'price_original' => $price_original,
            'price_now'      => $price_now,
            'cover'           => $cover,
            'rebate'          => $rebate,
            'type'            => 'WOMANCLOTH',
            'sort'            => $sort,
            'classify_id'      => $classify_id,
            'click'           => 0,
            'controller'      => $loginname,
            'created_time'    => Date('Y-m-d H:i:s')
        );
        // 数据插入
        if(!M('production')->add($data))
        {
            echo 'production表插入数据出错';die;
        }else{
            $this->success('添加成功',U('Womanclothproduction/index'));
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
        $this->data     = M('production')->find($id);
        // 分类
        $this->classification = M('classification')->where(array('type' => 'WOMANCLOTH'))->order('sort')->select();
        // 显示模板
        $this->display();
    }

    /* 修改店铺推荐处理 */
    public function alter_handle(){
        // 获取id
        $id             = $_POST['id'];
        // 获取URL
        $url            = $_POST['url'];
        // 获取姓名
        $name           = $_POST['name'];
        // 获取原价
        $price_original = $_POST['price_original'];
        // 获取折后价
        $price_now      = $_POST['price_now'];
        // 获取返利
        $rebate         = $_POST['rebate'];
        // 获取封面URL
        $cover          = $_POST['img'];
        // 获取商品分类id
        $classify_id     = $_POST['classify_id'];
        // 输入判断
        if($url == ""){
            $this->error('请输入店铺网址');
        }
        if($name == ""){
            $this->error('请输入店铺名称');
        }
        if($price_original == ""){
            $this->error('请输入原价');
        }
        if($price_now == ""){
            $this->error('请输入折后价');
        }
        if($rebate == ""){
            $this->error('请输入返利');
        }
        if($cover == ""){
            $this->error("请选择图片上传");
        }
        if($classify_id == ""){
            $this->error('请选择分类');
        }
        // 获取操作者
        $loginname = $_SESSION['loginname'];
        // 构造数据
        $data = array(
            'id'             =>$id,
            'name'           => $name,
            'url'            => $url,
            'price_original' => $price_original,
            'price_now'      => $price_now,
            'cover'          => $cover,
            'rebate'         => $rebate,
            'classify_id'      => $classify_id,
            'controller'     => $loginname,
            'created_time'   => Date('Y-m-d H:i:s')
        );
        // 数据插入
        if(!M('production')->data($data)->save())
        {
            echo 'production表更新数据出错';die;
        }else{
            $this->success('添加成功',U('Womanclothproduction/index'));
        }
    }

    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////    分割线     //////////////////////////////
    ///////////////////////////////////////////////////////////////////////////

    /* 删除店铺推荐处理 */
    public function delete_handle(){
        p($_GET);die;
        // 获取参数
        $id           = $_GET['id'];
        // 获取当前处理的数据
        $current_data = M('production')->find($id);
        // 获取排在当前数据后面的元素
        $data         = M('production')->where("sort > %d AND type = '%s'",$current_data['sort'],'WOMANCLOTH')->select();
        for($i=0;$i<COUNT($data);$i++){
            $data[$i]['sort']-=1;
            M('production')->data($data[$i])->save();
        }
        // 删除文件并修改数据库    
        if(!M('production')->delete($id))
        {
            echo 'production表删除数据出错';die;
        }else{
            $this->success('删除成功');
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
        $where   = array('type' => 'WOMANCLOTH');
        $num = M('production')->where($where)->count();
        if($num <= 1){
            $this->error('排序失败，数量不足');
        }
        // 获取当前处理的数据
        $c1_data = M('production')->find($id);
        $c1_sort = $c1_data['sort'];
        // 获取要对换的数据
        if($type == 'up'){
            $c2_sort = $c1_sort-1;
        }else{
            $c2_sort = $c1_sort+1;
        }
        $where   = array('sort' => $c2_sort,'type' => 'WOMANCLOTH');
        $c2_data = M('production')->where($where)->find();
        // 排序对换
        $c1_data['sort'] = $c2_sort;
        $c2_data['sort'] = $c1_sort;
        M('production')->data($c1_data)->save();
        M('production')->data($c2_data)->save();
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
        $data = M('production')->find($id);
        // 转义
        $jsonReturn = $this->replaceLineAndSpace($data['url']);
        // 数据返回
        $this->ajaxReturn($jsonReturn);
    }

    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////    分割线     //////////////////////////////
    ///////////////////////////////////////////////////////////////////////////

    // 捉取
    public function catchMessage(){
        $url = $_POST['url'];
        //$this->ajaxReturn($url);die;
        //$url = "https://item.taobao.com/item.htm?spm=a230r.1.14.46.k57W5S&id=521663556614&ns=1&abbucket=5#detail";
        //$url = 'https://detail.tmall.com/item.htm?spm=a1z10.3-b.w4011-10961037485.64.l1BymF&id=520804472548&rn=651d9189a868d28b9e13b1cb66049f48&abbucket=17';
        //$url = 'http://ai.taobao.com/auction/edetail.htm?e=uU01NGCllt66k0Or%2B%2BH4tANULZis6JU%2B5O1HRCRsNECLltG5xFicOdXrTUTgh9sMDPIwxrc30rhw6fJG2k8K5sKmWXC6ot6MvyB%2FRJgozRc0VWbiumzFlG3abJM7sDg2FTAfAg1tgNTC4lasV4OWOg%3D%3D&ptype=100010&from=basic&clk1=e95086a74bdf4d5b9ab5e4583f35c82d&upsid=e95086a74bdf4d5b9ab5e4583f35c82d';
        $this->get_taobao_item_id($url);
    }


    // 解析淘宝
    function taobao($url){
        $html = file_get_html($url);
        foreach($html->find('h3.tb-main-title') as $e)
            $title = iconv('GB2312', 'UTF-8', $e->innertext);

        foreach($html->find('em.tb-rmb-num') as $e)
            $price_now = iconv('GB2312', 'UTF-8', $e->innertext);

        foreach($html->find('div.tb-s50') as $key => $e)
            foreach($e->children as  $d)
            {
                $pattern ='<img.*?data-src="//(.*?)">';
                preg_match($pattern,$d->innertext,$matches);
                $c = str_replace('50','400',$matches[1]);
                $images[$key] = $c;
            }

        $json = array(
            'title'          => $this->trimall($title),
            'price_original' => $price_original,
            'price_now'      => $price_now,
            'images'         => $images
        );

        $this->ajaxReturn($json);
    }

    // 解析爱淘宝
    function aitaobao($url){
        $html = file_get_html($url);
        foreach($html->find('h3.item-title') as $e)
            $title =  $e->children(0)->innertext;

        foreach($html->find('div.price-ori') as $e)
            $c = str_replace('￥','',$e->children(1)->innertext);
            $price_original = $c;

        foreach($html->find('div.price') as $e)
            $price_now =  $e->children(1)->children(0)->innertext;

        foreach($html->find('img.img-slide-small') as $key => $e)
        {
            $pattern ='<img.*?src="http://(.*?)">';
            preg_match($pattern,$e->outertext,$matches);
            $c = str_replace('60','400',$matches[1]);
            $images[$key] = $c;
        }

        $json = array(
            'title'          => $this->trimall($title),
            'price_original' => $price_original,
            'price_now'      => $price_now,
            'images'         => $images
        );

        $this->ajaxReturn($json);
    }

    // 解析天猫
    function tmall($url){
        $html = file_get_html($url);
        foreach($html->find('div.tb-detail-hd') as $e)
            $title = iconv('GB2312', 'UTF-8', $e->children(0)->innertext);

        foreach($html->find('div.tm-fcs-panel') as $e)
            //价格用js获取

        foreach($html->find('ul#J_UlThumb') as $e)
        {
            foreach($e->children as $key => $d)
            {
                $pattern ='<img.*?src="//(.*?)">';
                preg_match($pattern,$d->innertext,$matches);
                $c = str_replace('60','400',$matches[1]);
                $images[$key] =  $c;
                //echo $d->outertext . '<br>';
            }
        }

        $json = array(
            'title'          => $this->trimall($title),
            'price_original' => $price_original,
            'price_now'      => $price_now,
            'images'         => $images
        );

        $this->ajaxReturn($json);
    }

    // 分类和获取id
    function get_taobao_item_id($url){
        // 解析url
        $urls=parse_url( $url );
        // 提取url，得到商品id
        // 一淘商品
        if ($urls['host'] == 'detail.etao.com') {
            $url_array = explode('.',$urls['path']);
            $id = ltrim($url_array[0],'/');
            //echo 'etao';
        // 普通淘宝商品
        } else if ($urls['host'] == 'item.taobao.com') {
            parse_str($urls['query'],$url_array);
            $id = @$url_array['id'] ? $url_array['id'] : "" ;
            //echo 'taobao';
            $this->taobao($url);
        // 爱淘宝商品
        } else if ($urls['host'] == 'ai.taobao.com') {
            parse_str($urls['query'],$url_array);
            $id = @$url_array['id'] ? $url_array['id'] : "" ;
            //echo 'aitaobao';
            $this->aitaobao($url);
        // 天猫商品
        } else if ($urls['host'] == 'detail.tmall.com') {
            parse_str($urls['query'],$url_array);
            $id = @$url_array['id'] ? $url_array['id'] : "" ;
            //echo 'tmall';
            $this->tmall($url);
        // 非法商品
        }else{
            echo 'else';
            return false;
        }
        return $id;
    }

    function trimall($str)//删除空格
    {
        $qian=array(" ","　","\t","\n","\r");$hou=array("","","","","");
        return str_replace($qian,$hou,$str);    
    }


}