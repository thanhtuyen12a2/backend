<?php

namespace backend\models;

use Aabc;
use aabc\base\Model;
use aabc\data\ActiveDataProvider;
// use backend\models\Sanpham;


class Sanpham_235Search extends Sanpham
{
    
     public function rules()
    {
        return [
            [['sp_id','sp_view','sp_idnguoitao','sp_idnguoiupdate','sp_id_ncc','sp_id_thuonghieu','sp_gia','sp_giakhuyenmai','sp_soluong','sp_soluongfake','sp_soluotmua'], 'integer'],

            [['sp_type','sp_conhang','sp_tensp','sp_masp','sp_linkseo','sp_images','sp_status','sp_recycle', 'sp_ngaytao','sp_ngayupdate'], 'safe'],

            [[Sanpham::sp_gia],'safe'],
        ];
    }

    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    
    public function search($params) //GET
    //public function search() //POST
    {        
        $query = (Sanpham::M)::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            // 'sort' => [
            //     'attributes' => [
            //           'sp_gia',
            //         ]
            //     ],
        ]);

        $dataProvider->setSort([
            'attributes' => [
                Sanpham::sp_id => [
                    'asc' => ['sp_id' =>SORT_ASC ],
                    'desc' => ['sp_id' => SORT_DESC],
                    'default' => SORT_ASC
                ],                
                Sanpham::sp_gia => [
                    'asc' => ['sp_gia' =>SORT_ASC ],
                    'desc' => ['sp_gia' => SORT_DESC],
                    'default' => SORT_ASC
                ],   
                Sanpham::sp_tensp => [
                    'asc' => ['sp_tensp' =>SORT_ASC ],
                    'desc' => ['sp_tensp' => SORT_DESC],
                    'default' => SORT_ASC
                ],     
                Sanpham::sp_masp => [
                    'asc' => ['sp_masp' =>SORT_ASC ],
                    'desc' => ['sp_masp' => SORT_DESC],
                    'default' => SORT_ASC
                ], 
                Sanpham::sp_status => [
                    'asc' => ['sp_status' =>SORT_ASC ],
                    'desc' => ['sp_status' => SORT_DESC],
                    'default' => SORT_ASC
                ],   
                Sanpham::sp_conhang => [
                    'asc' => ['sp_conhang' =>SORT_ASC ],
                    'desc' => ['sp_conhang' => SORT_DESC],
                    'default' => SORT_ASC
                ],     
                
                     
            ]
        ]);

        $this->load($params); //GET
        //$this->load(Aabc::$app->request->post()); //POST

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
       
        $query->andFilterWhere([
            'sp_id' => $this->sp_id,
            'sp_view' => $this->sp_view,
            'sp_ngaytao' => $this->sp_ngaytao,
            'sp_ngayupdate' => $this->sp_ngayupdate,
            'sp_idnguoitao' => $this->sp_idnguoitao,
            'sp_idnguoiupdate' => $this->sp_idnguoiupdate,
            'sp_id_ncc' => $this->sp_id_ncc,
            
            // Sanpham::sp_id_nhomsanpham => $this->sp_id_nhomsanpham,
            'sp_gia' => $this->sp_gia,
            'sp_giakhuyenmai' => $this->sp_giakhuyenmai,
            'sp_soluong' => $this->sp_soluong,
            'sp_soluongfake' => $this->sp_soluongfake,
            // Sanpham::sp_id_khohang => $this->sp_id_khohang,
            // Sanpham::sp_id_baohanh => $this->sp_id_baohanh,
            // Sanpham::sp_id_giaohang => $this->sp_id_giaohang,
            'sp_soluotmua' => $this->sp_soluotmua,
        ]);


       
         $query->andFilterWhere(['like','sp_tensp', $this->sp_tensp])

            ->andFilterWhere(['like','sp_type', $this->sp_type])
            // ->andFilterWhere(['like'','sp_tensp, Aabc::$app->request->get('sp_ten_ma')])

            
            ->andFilterWhere(['like','sp_linkseo', $this->sp_linkseo])
            
            ->andFilterWhere(['like','sp_images', $this->sp_images])
            ->andFilterWhere(['like','sp_status', $this->sp_status])
            ->andFilterWhere(['like','sp_recycle', $this->sp_recycle]);    





            if(Aabc::$app->request->get('sp_ten_ma')){            
                $mang = array('or');                
                $st = addslashes(urldecode(Aabc::$app->request->get('sp_ten_ma')));
                $st = str_replace ( "%25", "",$st);
                array_push($mang,"`sp_tensp` LIKE '%". $st ."%'");
                array_push($mang,"`sp_masp` LIKE '%". $st ."%'");
                $query->andFilterWhere($mang);
            }

          

            //Tìm thương hiệu, Quan hệ(Sản phẩm -n 1- Thương hiệu)
            if(Aabc::$app->request->get(Sanpham::sp_id_thuonghieu)){            
                $mang = array('or');
                foreach (Aabc::$app->request->get(Sanpham::sp_id_thuonghieu) as $key => $id) {                                   
                    // $id = mysqli_real_escape_string($id);
                    $id = (string)(int)$id;
                    $id = addslashes($id);
                    array_push($mang,"`sp_id_thuonghieu` = '".$id."'");
                    if(!$id) $mang = null;
                }           
                if($mang) $query->andFilterWhere($mang);
            }
            


            //Nếu có tìm theo Danhmuc,  Quan hệ(Sản phẩm - n  n - Danh mục)
            $truyvan = $this->danhmuc(Aabc::$app->request->get(Aabc::$app->_danhmuc->dm_id));
            if($truyvan) $query->andFilterWhere($truyvan);

            $truyvan = $this->danhmuc(Aabc::$app->request->get(Aabc::$app->_danhmuc->dm_id.'_cm'));
            if($truyvan) $query->andFilterWhere($truyvan);

            $truyvan = $this->danhmuc(Aabc::$app->request->get(Aabc::$app->_danhmuc->dm_id.'_dm'));
            if($truyvan) $query->andFilterWhere($truyvan);


        return $dataProvider;
    }




    protected function danhmuc($data){
        if($data){
            $mang = array('IN');
            $mangsanpham = array();
            $dem = 0;                
            foreach ($data as $key => $id) {                                                       
                $id = (string)(int)$id;
                $id = addslashes($id);  
                if($id != 0){
                    $dem += 1;
                    $_Danhmuc = Aabc::$app->_model->Danhmuc;
                    $danhmuc = $_Danhmuc::findOne($id);                    
                    $sanpham = $danhmuc->getSpdmIdSps()->all();
                    foreach ($sanpham as $keysanpham => $valuesanpham) {                       
                        array_push($mangsanpham, $valuesanpham[Sanpham::sp_id]);
                    }
                }
            }  
            if(count($mangsanpham) > 0){
                array_push($mang,Sanpham::sp_id);
                array_push($mang,$mangsanpham); 
                return ($mang);
                // $query->andFilterWhere($mang);
            }else{
                if($dem > 0){
                    //Xử lý nếu không tìm thấy sản phẩm nào kết nối với danh mục này
                    $mang = array('=');
                    array_push($mang,Sanpham::sp_id);
                    array_push($mang,'0');   
                    return ($mang);                
                    // $query->andFilterWhere($mang);
                }
            }
            return '';
            // print_r($mangsanpham);die;  
        }
    }
}

