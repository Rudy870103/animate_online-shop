<?php
date_default_timezone_set("Asia/Taipei");
session_start();
class DB{
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=onlineshop";
    protected $pdo;
    protected $table;

    public function __construct($table)
    {
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,'root','');
    }

    private function a2s($array){
        foreach($array as $key => $val){
            $tmp[]="`$key`='$val'";
        }
        return $tmp;
    }

    private function sql_all($sql,$array,$other){
        if(isset($this->table) && !empty($this->table)){
            if(is_array($array)){
                if(!empty($array)){
                    $tmp=$this->a2s($array);
                    $sql .= " where " . join(" && ",$tmp);
                }
            }else{
                $sql .= " $array";
            }
            $sql .= $other;
        }
        return $sql;
    } 

    private function math($math,$col,$array='',$other=''){
        $sql="select $math(`$col`) from `$this->table` ";
        $sql=$this->sql_all($sql,$array,$other);
        return $this->pdo->query($sql)->fetchColumn();
    }

    function sum($col='',$where='',$other=''){
        return $this->math('sum',$col,$where,$other);
    }

    function max($col='',$where='',$other=''){
        return $this->math('max',$col,$where,$other);
    }

    function min($col='',$where='',$other=''){
        return $this->math('min',$col,$where,$other);
    }

    function all($where='',$other=''){
        $sql="select * from `$this->table` ";
        $sql=$this->sql_all($sql,$where,$other);
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function count($where='',$other=''){
        $sql="select count(*) from `$this->table` ";
        $sql=$this->sql_all($sql,$where,$other);
        return $this->pdo->query($sql)->fetchColumn();
    }

    function find($id){
        $sql="select * from `$this->table` ";
        if(is_array($id)){
            $tmp=$this->a2s($id);
            $sql .= " where " . join(" && ",$tmp);
        }else if(is_numeric($id)){
            $sql .= " where `id`='$id'";
        }
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    function del($id){
        $sql="delete from `$this->table` ";
        if(is_array($id)){
            $tmp=$this->a2s($id);
            $sql .= " where " . join(" && ",$tmp);
        }else if(is_numeric($id)){
            $sql .= " where `id`='$id'";
        }
        return $this->pdo->exec($sql);
    }

    function save($array){
        if(isset($array['id'])){
            $sql="update `$this->table` set ";
            if(!empty($array)){
                $tmp=$this->a2s($array);
            }
            $sql .= join(",",$tmp);
            $sql .= " where `id`='{$array['id']}'";
        }else{
            $sql="insert into `$this->table` ";
            $cols="(`" . join("`,`",array_keys($array)) . "`)";
            $vals="('" . join("','",$array) . "')";
            $sql .= $cols . "values" . $vals;
        }
        return $this->pdo->exec($sql);
    }

    function q($sql){
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}

function to($url){
    header("location:$url");
}

$Member=new DB('member');
$Carousel=new DB('carousel');
$Type=new DB('type');
$Product=new DB('product');
$Orders=new DB('orders');
