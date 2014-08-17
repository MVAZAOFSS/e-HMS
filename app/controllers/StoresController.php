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

}
