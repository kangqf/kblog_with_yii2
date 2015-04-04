<?php

namespace frontend\controllers;

class TiebaController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $kw = '重庆邮电大学吧';
        $data=array(
            '_client_id=wappc_1396611108603_817',
            '_client_type=2',
            '_client_version=5.7.0',
            '_phone_imei=642b43b58d21b7a5814e1fd41b08e2a6',
            'from=tieba',
            "kw={$kw}",
            'pn=1',
            'q_type=2',
            'rn=30',
            'with_group=1');
        $data=implode('&', $data).'&sign='.md5(implode('', $data).'tiebaclient!!!');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://c.tieba.baidu.com/c/f/frs/page');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array ('Content-Type: application/x-www-form-urlencoded'));
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $re = json_decode(curl_exec($ch),true);
        curl_close($ch);
        return $this->render('index',['re' => $re]);
    }
    public function delete()
    {
        $bduss = '';//吧务的BDUSS
        $kw = '';//目标贴吧
        $keywords = '减肥|那么问题来了|瘦身|淘宝';//关键词 格式 关键词1|关键词2|关键词3|关键词4|关键词5|关键词6......
        $forum = get_forum();
        $fid = $forum['forum']['id'];
        foreach($forum['thread_list'] as $thread){
            if(check_ad($thread['title'])){
                if(del_thread($kw,$fid,$thread['tid'])) {echo "删除帖子：{$thread['tid']}
成功<br />"; }else{ echo "删除帖子：{$thread['tid']}失败<br />";}
                break ;
            }elseif($thread['abstract']){
                if(check_ad($thread['abstract'][0]['text'])){if(del_thread($kw,$fid,$thread
                ['tid'])) {echo "删除帖子：{$thread['tid']}成功<br />"; }else{ echo "删除帖子：{$thread
['tid']}失败<br />";}}
            }
        }
    }


    public function get_forum(){
        global $kw;
        $data=array(
            '_client_id=wappc_1396611108603_817',
            '_client_type=2',
            '_client_version=5.7.0',
            '_phone_imei=642b43b58d21b7a5814e1fd41b08e2a6',
            'from=tieba',
            "kw={$kw}",
            'pn=1',
            'q_type=2',
            'rn=30',
            'with_group=1');
        $data=implode('&', $data).'&sign='.md5(implode('', $data).'tiebaclient!!!');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://c.tieba.baidu.com/c/f/frs/page');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array ('Content-Type: application/x-www-form-urlencoded'));
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $re = json_decode(curl_exec($ch),true);
        curl_close($ch);
        return $re;
    }
    public function get_tbs(){
        global $bduss;
        $re=json_decode(fetch('http://tieba.baidu.com/dc/common/tbs','BDUSS='.$bduss),true);
        return $re['tbs'];
    }
    public function fetch($url,$cookie=null,$postdata=null){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        if (!is_null($postdata)) curl_setopt($ch, CURLOPT_POSTFIELDS,$postdata);
        if (!is_null($cookie)) curl_setopt($ch, CURLOPT_COOKIE,$cookie);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $re = curl_exec($ch);
        curl_close($ch);
        return $re;
    }
    public function check_ad($content){
        global $keywords;
        $preg = '/'.addslashes($keywords).'/i';
        $res = preg_match($preg,$content);
        return $res;
    }
    public function del_thread($kw,$fid,$tid){
        global $bduss;
        $data = 'commit_fr=pb&ie=utf-8&tbs='.get_tbs()."&kw={$kw}&fid={$fid}&tid={$tid}";
        $re = json_decode(fetch('http://tieba.baidu.com/f/commit/thread/delete','BDUSS='.$bduss,$data),true);
        return $re['no']==0;
    }

}
