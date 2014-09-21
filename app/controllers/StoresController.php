<?php
class StoresController extends BaseController{

	public function create(){
		return View::make('stores.create');
	}


	public function report(){
		return View::make('stores.report');
	}

	public function store(){
		$inputs = Input::all();
		
		$n = Goods::where('goods', $inputs['goods'])->count();
		if($n == 0){
			Goods::create($inputs);
			return View::make('stores.create')->with('msg', 'Successfully added');
		}else{
			return View::make('stores.create')->with('emsg', 'Already exists !');
		}
		
	}

	public function process_add(){
		$s      = Input::get('s');
		$decode = json_decode($s, true);
		$id     = 1;
		foreach ($decode['data'] as $key => $value) {
			$res = Goods::where('id', $id)->first();
			$t   = $res->tno;
			$gd  = Goods::find($id);
			$gd->tno = (integer)$t + $value;
			$gd->save();

			$info = GoodsInfo::create(array(
					"gId"=>$id,
					"added"=>$value,
					"date"=>date("Y-m-d")
			));

			$id++;
		}
	}

	public function process_reduce(){
		$s      = Input::get('s');
		$decode = json_decode($s, true);
		$id     = 1;
		foreach ($decode['data'] as $key => $value) {
			$res = Goods::where('id', $id)->first();
			$t   = $res->tno;
			$gd  = Goods::find($id);
			$gd->tno = (integer)$t - $value;
			$gd->save();

			$info = GoodsInfo::create(array(
					"gId"=>$id,
					"used"=>$value,
					"date"=>date("Y-m-d")
			));

			$id++;
		}
	}

	public function manage(){
		return View::make('stores.manage');
	}
    function reportSearchAction($date){
       $data['date']=$date;
        $res=DB::table('storegoodsinfo')->select('*')
            ->join('storegoodstotal','storegoodstotal.id','=','storegoodsinfo.gId')
            ->where('storegoodsinfo.date','LIKE','%'.$date.'%')
            ->get();
           $data['res']=$res;
       return View::make('stores.getAllSearchResult',$data);
    }
    function totalUsedProduct($date){
        $res=DB::table('storegoodsinfo')->select('*')
            ->join('storegoodstotal','storegoodstotal.id','=','storegoodsinfo.gId')
            ->where('storegoodsinfo.date','LIKE','%'.$date.'%')
            ->get(array(
                'used',
               DB::raw('SUM(used) AS used')
            ));
        if($res){
        foreach($res as $row){
            if($row->gId==1){
            $data_array=array(
                'used'=>$row->used
            );
            }elseif($row->gId==2){
                $data_array=array(
                    'used1'=>$row->used
                );
            }elseif($row->gId==3){
                $data_array=array(
                    'used2'=>$row->used
                );
            }
        }
        return $data_array;
        }else{
            $data_array=array(
                'used'=>'',
                'used1'=>'',
                'used2'=>''
            );
         return $data_array;
        }

    }
    function totalAddedProduct($date){
        $res=DB::table('storegoodsinfo')->select('*')
            ->join('storegoodstotal','storegoodstotal.id','=','storegoodsinfo.gId')
            ->where('storegoodsinfo.date','LIKE','%'.$date.'%')
            ->get(array(
                'added',
                DB::raw('SUM(added) AS added')
            ));
        if($res){
            foreach($res as $row){
                if($row->gId==1){
                    $data_array=array(
                        'added'=>$row->added
                    );
                }elseif($row->gId==2){
                    $data_array=array(
                        'added1'=>$row->added
                    );
                }elseif($row->gId==3){
                    $data_array=array(
                        'added'=>$row->added
                    );
                }
            }
            return $data_array;
        }else{
            $data_array=array(
                'added'=>'',
                'added1'=>'',
                'added2'=>''
            );
            return $data_array;
        }
    }

}
