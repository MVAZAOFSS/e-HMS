<?php
class ReportsController extends BaseController{
public function rooms(){
                return View::make('reports.rooms');
        }

        public function postlaundry(){
                $inputs = Input::all();

                $rf     = $inputs['rf'];
                $ro     = $inputs['ro'];
                $rms    = $inputs['lau'];
                $ri     = $inputs['ri'];

                //return $rf . " " . $ro . " " . $lau . " " . $ri;

                if($rf == "daily"){
                        $date = $inputs['date'];
                        if($ro == "Guest"){
                                if($rms == "all"){
                                        if($ri == "Table"){
                                                //$n = Guest::whereRaw('arrival_date <= ? or departure_date >= ?', array($date, $date))->count();
                                                $n   = Glist::where('date', $date)->count();
                                                if($n == 0){
                                                        return View::make('reports.laundryreport')->with('error', 'No data found on ' . $date);
                                                }else{
                                                        //$reports = Guest::whereRaw('arrival_date <= ? or departure_date >= ?', array($date, $date))->get();
                                                        $reports   = Glist::where('date', $date)->get();
                                                        return View::make('reports.laundryreport', compact('reports'))->with('date', $date)->with('rms', $rms);
                                                }
                                        }else{
                                                //obj.gtitle,obj.gsubtitle,obj.xAxisData,obj.yAxisTitle,obj.yAxisData,obj.gname,obj.chartType
                                                $reports    = Guest::whereRaw('arrival_date <= ? and departure_date >= ?', array($date, $date))->get();
                                                $xAxisArr   = array();
                                                foreach ($reports as $r) {
                                                        $xAxisArr[] = Room::find($r->room_number)->name;
                                                }
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of {$rms} Guests on {$date}";
                                                $gsubtitle  = "Total number of {$rms} guests: {$c}";
                                                $xAxisData  = array_keys(array_count_values($xAxisArr));
                                                $yAxisTitle = "Guest number";
                                                $yAxisData  = array_values(array_count_values($xAxisArr));
                                                $gname      = "Rooms ";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);

                                        }
                                }else if($rms == 1){
                                        if($ri == "Table"){
                                                //$n = Guest::whereRaw('arrival_date <= ? and departure_date >= ? and reservation_number != ""', array($date, $date))->count();
                                                $n   = Hotellogs::where('date', $date)->count();
                                                if($n == 0){
                                                        return View::make('reports.laundryreportreport')->with('error', 'No data found on ' . $date);
                                                }else{
                                                        //$reports = Guest::whereRaw('arrival_date <= ? and departure_date >= ? and reservation_number != ""', array($date, $date))->get();
                                                        $reports   = Hotellogs::where('date', $date)->get();
                                                        return View::make('reports.laundryreportreport', compact('reports'))->with('date', $date)->with('rms', $rms);
                                                }
                                        }else{

                                                //obj.gtitle,obj.gsubtitle,obj.xAxisData,obj.yAxisTitle,obj.yAxisData,obj.gname,obj.chartType
                                                $reports    = Guest::whereRaw('arrival_date <= ? and departure_date >= ? and reservation_number != ""', array($date, $date))->get();
                                                $xAxisArr   = array();
                                                foreach ($reports as $r) {
                                                        $xAxisArr[] = Room::find($r->room_number)->name;
                                                }
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of {$rms} Guests on {$date}";
                                                $gsubtitle  = "Total number of {$rms} guests: {$c}";
                                                $xAxisData  = array_keys(array_count_values($xAxisArr));
                                                $yAxisTitle = "Guest number";
                                                $yAxisData  = array_values(array_count_values($xAxisArr));
                                                $gname      = "Rooms ";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);

                                        }
                                }else if($rms == 2){
                                        if($ri == "Table"){
                                                //$n = Guest::whereRaw('arrival_date <= ? and departure_date >= ? and checked = "yes"', array($date, $date))->count();
                                                $n   = Hotellogs::where('date', $date)->count();
                                                if($n == 0){
                                                        return View::make('reports.laundryreport')->with('error', 'No data found on ' . $date);
                                                }else{
                                                        //$reports = Guest::whereRaw('arrival_date <= ? and departure_date >= ? and checked = "yes"', array($date, $date))->get();
                                                        $reports   = Hotellogs::where('date', $date)->get();
                                                        return View::make('reports.laundryreport', compact('reports'))->with('date', $date)->with('rms', $rms);
                                                }
                                        }else{
                                                //obj.gtitle,obj.gsubtitle,obj.xAxisData,obj.yAxisTitle,obj.yAxisData,obj.gname,obj.chartType
                                                $reports    = Guest::whereRaw('arrival_date <= ? and departure_date >= ? and checked = "yes"', array($date, $date))->get();
                                                $xAxisArr   = array();
                                                foreach ($reports as $r) {
                                                        $xAxisArr[] = Room::find($r->room_number)->name;
                                                }
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of {$rms} Guests on {$date}";
                                                $gsubtitle  = "Total number of {$rms} guests: {$c}";
                                                $xAxisData  = array_keys(array_count_values($xAxisArr));
                                                $yAxisTitle = "Guest number";
                                                $yAxisData  = array_values(array_count_values($xAxisArr));
                                                $gname      = "Rooms ";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);

                                        }
                                }else if($rms == 3){
                                        if($ri == "Table"){
                                                //$n = Guest::whereRaw('arrival_date <= ? and departure_date >= ? and checked = "yes"', array($date, $date))->count();
                                                $n   = Hotellogs::where('date', $date)->count();
                                                if($n == 0){
                                                        return View::make('reports.laundryreport')->with('error', 'No data found on ' . $date);
                                                }else{
                                                        //$reports = Guest::whereRaw('arrival_date <= ? and departure_date >= ? and checked = "yes"', array($date, $date))->get();
                                                        $reports   = Hotellogs::where('date', $date)->get();
                                                        return View::make('reports.laundryreport', compact('reports'))->with('date', $date)->with('rms', $rms);
                                                }
                                        }else{
                                                //obj.gtitle,obj.gsubtitle,obj.xAxisData,obj.yAxisTitle,obj.yAxisData,obj.gname,obj.chartType
                                                $reports    = Guest::whereRaw('arrival_date <= ? and departure_date >= ? and checked = "yes"', array($date, $date))->get();
                                                $xAxisArr   = array();
                                                foreach ($reports as $r) {
                                                        $xAxisArr[] = Room::find($r->room_number)->name;
                                                }
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of {$rms} Guests on {$date}";
                                                $gsubtitle  = "Total number of {$rms} guests: {$c}";
                                                $xAxisData  = array_keys(array_count_values($xAxisArr));
                                                $yAxisTitle = "Guest number";
                                                $yAxisData  = array_values(array_count_values($xAxisArr));
                                                $gname      = "Rooms ";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);

                                        }
                                }
                        }else{
                        if($rms == "all"){
                                        if($ri == "Table"){
                                                //$n = Guest::whereRaw('arrival_date <= ? or departure_date >= ?', array($date, $date))->count();
                                                $n   = Hotellogs::where('date', $date)->count();
                                                if($n == 0){
                                                        return View::make('reports.roomsreportincome')->with('error', 'No data found on ' . $date);
                                                }else{
                                                        //$reports = Guest::whereRaw('arrival_date <= ? or departure_date >= ?', array($date, $date))->get();
                                                        $reports  = Hotellogs::where('date', $date)->get();
                                                        return View::make('reports.roomsreportincome', compact('reports'))->with('date', $date)->with('rms', $rms);
                                                }
                                        }else{
                                                //obj.gtitle,obj.gsubtitle,obj.xAxisData,obj.yAxisTitle,obj.yAxisData,obj.gname,obj.chartType
                                                $reports    = Guest::whereRaw('arrival_date <= ? and departure_date >= ?', array($date, $date))->get();
                                                $xAxisArr   = array();
                                                foreach ($reports as $r) {
                                                        $xAxisArr[] = Room::find($r->room_number)->name;
                                                        $xAxisArr1[] = Room::find($r->room_number)->cost;
                                                }
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of {$rms} Guests on {$date}";
                                                $gsubtitle  = "Total number of {$rms} guests: {$c}";
                                                $xAxisData  = array_keys(array_count_values($xAxisArr));
                                                $yAxisTitle = "Guest number";
                                                $yAxisData  = array_keys(array_count_values($xAxisArr1));
                                                $gname      = "Rooms ";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);

                                        }
                                }else if($rms == 1){
                                        if($ri == "Table"){
                                                //$n = Guest::whereRaw('arrival_date <= ? and departure_date >= ? and reservation_number != ""', array($date, $date))->count();
                                                $n   = Hotellogs::where('date', $date)->count();
                                                if($n == 0){
                                                        return View::make('reports.roomsreportincome')->with('error', 'No data found on ' . $date);
                                                }else{
                                                        //$reports = Guest::whereRaw('arrival_date <= ? and departure_date >= ? and reservation_number != ""', array($date, $date))->get();
                                                        $reports   = Hotellogs::where('date', $date)->get();
                                                        return View::make('reports.roomsreportincome', compact('reports'))->with('date', $date)->with('rms', $rms);
                                                }
                                        }else{

                                                //obj.gtitle,obj.gsubtitle,obj.xAxisData,obj.yAxisTitle,obj.yAxisData,obj.gname,obj.chartType
                                                $reports    = Guest::whereRaw('arrival_date <= ? and departure_date >= ? and reservation_number != ""', array($date, $date))->get();
                                                $xAxisArr   = array();
                                                foreach ($reports as $r) {
                                                        $xAxisArr[] = Room::find($r->room_number)->name;
                                                        $xAxisArr[] = Room::find($r->room_number)->name;
                                                }
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of {$rms} Guests on {$date}";
                                                $gsubtitle  = "Total number of {$rms} guests: {$c}";
                                                $xAxisData  = array_keys(array_count_values($xAxisArr));
                                                $yAxisTitle = "Guest number";
                                                $yAxisData  = array_values(array_count_values($xAxisArr));
                                                $gname      = "Rooms ";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);

                                        }
                                }else if($rms == 2){
                                        if($ri == "Table"){
                                                //$n = Guest::whereRaw('arrival_date <= ? and departure_date >= ? and checked = "yes"', array($date, $date))->count();
                                                $n   = Hotellogs::where('date', $date)->count();
                                                if($n == 0){
                                                        return View::make('reports.roomsreportincome')->with('error', 'No data found on ' . $date);
                                                }else{
                                                        //$reports = Guest::whereRaw('arrival_date <= ? and departure_date >= ? and checked = "yes"', array($date, $date))->get();
                                                        $reports   = Hotellogs::where('date', $date)->get();
                                                        return View::make('reports.roomsreportincome', compact('reports'))->with('date', $date)->with('rms', $rms);
                                                }
                                        }else{
                                                //obj.gtitle,obj.gsubtitle,obj.xAxisData,obj.yAxisTitle,obj.yAxisData,obj.gname,obj.chartType
                                                $reports    = Guest::whereRaw('arrival_date <= ? and departure_date >= ? and checked = "yes"', array($date, $date))->get();
                                                $xAxisArr   = array();
                                                foreach ($reports as $r) {
                                                        $xAxisArr[] = Room::find($r->room_number)->name;
                                                }
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of {$rms} Guests on {$date}";
                                                $gsubtitle  = "Total number of {$rms} guests: {$c}";
                                                $xAxisData  = array_keys(array_count_values($xAxisArr));
                                                $yAxisTitle = "Guest number";
                                                $yAxisData  = array_values(array_count_values($xAxisArr));
                                                $gname      = "Rooms ";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);

                                        }
                                }else if($rms == 3){
                                        if($ri == "Table"){
                                                //$n = Guest::whereRaw('arrival_date <= ? and departure_date >= ? and checked = "yes"', array($date, $date))->count();
                                                $n   = Hotellogs::where('date', $date)->count();
                                                if($n == 0){
                                                        return View::make('reports.laundryreport')->with('error', 'No data found on ' . $date);
                                                }else{
                                                        //$reports = Guest::whereRaw('arrival_date <= ? and departure_date >= ? and checked = "yes"', array($date, $date))->get();
                                                        $reports   = Hotellogs::where('date', $date)->get();
                                                        return View::make('reports.laundryreport', compact('reports'))->with('date', $date)->with('rms', $rms);
                                                }
                                        }else{
                                                //obj.gtitle,obj.gsubtitle,obj.xAxisData,obj.yAxisTitle,obj.yAxisData,obj.gname,obj.chartType
                                                $reports    = Guest::whereRaw('arrival_date <= ? and departure_date >= ? and checked = "yes"', array($date, $date))->get();
                                                $xAxisArr   = array();
                                                foreach ($reports as $r) {
                                                        $xAxisArr[] = Room::find($r->room_number)->name;
                                                }
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of {$rms} Guests on {$date}";
                                                $gsubtitle  = "Total number of {$rms} guests: {$c}";
                                                $xAxisData  = array_keys(array_count_values($xAxisArr));
                                                $yAxisTitle = "Guest number";
                                                $yAxisData  = array_values(array_count_values($xAxisArr));
                                                $gname      = "Rooms ";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);

                                        }
                                }
                        }	

                }else if($rf == "weekly"){
                        $start = $inputs['start'];
                        $end   = $inputs['end'];
                        if($ro == "Guest"){
                                if($rms == "all"){
                                        if($ri == "Table"){
                                                //$n = Guest::whereRaw('arrival_date <= ? or departure_date <= ?', array($start, $end))->count();
                                                $n   = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->count();
                                                if($n == 0){
                                                        return View::make('reports.laundryreport')->with('error', 'No data found from ' . $start . " to " . $end);
                                                }else{
                                                        $reports = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->get();
                                                        return View::make('reports.laundryreport', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms);
                                                }
                                        }else{
                                                //obj.gtitle,obj.gsubtitle,obj.xAxisData,obj.yAxisTitle,obj.yAxisData,obj.gname,obj.chartType
                                                $reports    = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of {$rms} Guests from {$start} to {$end}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Guests number";
                                                $yAxisData  = Guest::generateGuestsNo($start,$end);
                                                $gname      = "Total Number of Guests ";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);
                                        }
                                }else if($rms == "reserved"){
                                        if($ri == "Table"){

                                                //$n = Guest::whereRaw('arrival_date <= ? or departure_date <= ? and reservation_number != ""', array($start, $end))->count();
                                                $n   = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->count();
                                                if($n == 0){
                                                        return View::make('reports.laundryreport')->with('error', 'No data found from ' . $start . " to " . $end);
                                                }else{
                                                        $reports =  Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->get();
                                                        return View::make('reports.laundryreport', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms);
                                                }

                                        }else{
                                                //obj.gtitle,obj.gsubtitle,obj.xAxisData,obj.yAxisTitle,obj.yAxisData,obj.gname,obj.chartType
                                                $reports    = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of {$rms} Guests from {$start} to {$end}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Guests number";
                                                $yAxisData  = Guest::guestsRI($start, $end, $rms);
                                                $gname      = "Total Number of Guests ";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);
                                        }
                                }else if($rms == "paid"){
                                        if($ri == "Table"){

                                                //$n = Guest::whereRaw('arrival_date <= ? or departure_date <= ? and checked = "yes"', array($start, $end))->count();
                                                $n   = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->count();
                                                if($n == 0){
                                                        return View::make('reports.laundryreport')->with('error', 'No data found from ' . $start . " to " . $end);
                                                }else{
                                                        $reports = $n   = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->get();
                                                        return View::make('reports.laundryreport', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms);
                                                }


                                        }else{
                                                $reports    = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of {$rms} Guests from {$start} to {$end}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Guests number";
                                                $yAxisData  = Guest::guestsRI($start, $end, $rms);
                                                $gname      = "Total Number of Guests ";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);						

                                        }
                                }
                        }else{
                                if($rms == "all"){
                                        if($ri == "Table"){
                                                //$n = Guest::whereRaw('arrival_date <= ? or departure_date <= ?', array($start, $end))->count();
                                                $n   = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->count();
                                                if($n == 0){
                                                        return View::make('reports.laundryreportreportincome')->with('error', 'No data found from ' . $start . " to " . $end);
                                                }else{
                                                        //$reports = Guest::whereRaw('arrival_date <= ? or departure_date <=  ?', array($start, $end))->get();
                                                        $reports   = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->get();
                                                        return View::make('reports.laundryreportincome', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms);
                                                }
                                        }else{
                                                $reports    = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of income of {$rms} Guests from {$start} to {$end}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Total income";
                                                $yAxisData  = Guest::generateGuestsNoIncome($start,$end);
                                                $gname      = "Income";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);
                                        }
                                }else if($rms == "reserved"){
                                        if($ri == "Table"){
                                                $n = Guest::whereRaw('arrival_date <= ? or departure_date <= ? and reservation_number != ""', array($start, $end))->count();
                                                if($n == 0){
                                                        return View::make('reports.laundryreportincome')->with('error', 'No data found from ' . $start . " to " . $end);
                                                }else{
                                                        $reports = Guest::whereRaw('arrival_date <= ? or departure_date <=  ? and reservation_number != ""', array($start, $end))->get();
                                                        return View::make('reports.laundryreportincome', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms);
                                                }
                                        }else{
                                                $reports    = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of income of {$rms} Guests from {$start} to {$end}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Total income";
                                                $yAxisData  = Guest::guestsRIIncome($start,$end,$rms);
                                                $gname      = "Income";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);
                                        }
                                }else if($rms == "paid"){
                                        if($ri == "Table"){
                                                $n = Guest::whereRaw('arrival_date <= ? or departure_date <= ? and checked = "yes"', array($start, $end))->count();
                                                if($n == 0){
                                                        return View::make('reports.laundryreportincome')->with('error', 'No data found from ' . $start . " to " . $end);
                                                }else{
                                                        $reports = Guest::whereRaw('arrival_date <= ? or departure_date <=  ? and checked = "yes"', array($start, $end))->get();
                                                        return View::make('reports.laundryreportincome', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms);
                                                }
                                        }else{
                                                $reports    = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of income of {$rms} Guests from {$start} to {$end}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Total income";
                                                $yAxisData  = Guest::guestsRIIncome($start,$end,$rms);
                                                $gname      = "Income";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);
                                        }
                                }
                        }
                }else if($rf == "monthly"){
                        $month  = $inputs['month'];
                        $mYear  = $inputs['mYear'];

                        $start  = $mYear . "-" . Guest::getMonth($month) . "-" . "01";
                        $end    = $mYear . "-" . Guest::getNextMonth($month) . "-" . "01";


                        if($ro == "Guest"){
                                if($rms == "all"){
                                        if($ri == "Table"){
                                                $n   = Hotellogs::whereRaw('date >=? and date < ?', array($start, $end))->count();

                                                if($n == 0){
                                                        return View::make('reports.roomsreport')->with('error', 'No data found from in '. $month . ' ,' . $mYear);
                                                }else{
                                                        $reports = Hotellogs::whereRaw('date >=? and date < ?', array($start, $end))->distinct()->get();

                                                        return View::make('reports.roomsreport', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms)->with('month', $month)->with('mYear', $mYear);
                                                }						
                                        }else{
                                                $reports    = Hotellogs::whereRaw('date >=? and date < ?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of {$rms} Guests in {$month}, {$mYear}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Guests number";
                                                $yAxisData  = Guest::generateGuestsNo($start,$end);
                                                $gname      = "Total Number of Guests ";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);						

                                        }
                                }else if($rms == "reserved"){
                                        if($ri == "Table"){
                                                $n   = Hotellogs::whereRaw('date >=? and date < ?', array($start, $end))->count();

                                                if($n == 0){
                                                        return View::make('reports.roomsreport')->with('error', 'No data found from in '. $month . ' ,' . $mYear);
                                                }else{
                                                        $reports = Hotellogs::whereRaw('date >=? and date < ?', array($start, $end))->distinct()->get();

                                                        return View::make('reports.roomsreport', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms)->with('month', $month)->with('mYear', $mYear);
                                                }
                                        }else{

                                                $reports    = Hotellogs::whereRaw('date >=? and date < ?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of {$rms} Guests in {$month}, {$mYear}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Guests number";
                                                $yAxisData  = Guest::guestsRI($start,$end,$rms);
                                                $gname      = "Total Number of Guests ";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);	

                                        }
                                }else if($rms == "paid"){
                                        if($ri == "Table"){
                                                $n   = Hotellogs::whereRaw('date >=? and date < ?', array($start, $end))->count();

                                                if($n == 0){
                                                        return View::make('reports.roomsreport')->with('error', 'No data found from in '. $month . ' ,' . $mYear);
                                                }else{
                                                        $reports = Hotellogs::whereRaw('date >=? and date < ?', array($start, $end))->distinct()->get();

                                                        return View::make('reports.roomsreport', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms)->with('month', $month)->with('mYear', $mYear);
                                                }
                                        }else{
                                                $reports    = Hotellogs::whereRaw('date >=? and date < ?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of {$rms} Guests in {$month}, {$mYear}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Guests number";
                                                $yAxisData  = Guest::guestsRI($start,$end,$rms);
                                                $gname      = "Total Number of Guests ";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);	
                                        }
                                }
                        }else{
                                if($rms == "all"){
                                        if($ri == "Table"){
                                                $n   = Hotellogs::whereRaw('date >=? and date < ?', array($start, $end))->count();

                                                if($n == 0){
                                                        return View::make('reports.roomsreportincome')->with('error', 'No data found from in '. $month . ' ,' . $mYear);
                                                }else{
                                                        $reports = Hotellogs::whereRaw('date >=? and date < ?', array($start, $end))->distinct()->get();

                                                        return View::make('reports.roomsreportincome', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms)->with('month', $month)->with('mYear', $mYear);
                                                }	
                                        }else{
                                                $reports    = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of income of {$rms} Guests from {$start} to {$end}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Total income";
                                                $yAxisData  = Guest::generateGuestsNoIncome($start,$end);
                                                $gname      = "Income";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);
                                        }
                                }else if($rms == "reserved"){
                                        if($ri == "Table"){
                                                $n   = Hotellogs::whereRaw('date >=? and date < ?', array($start, $end))->count();

                                                if($n == 0){
                                                        return View::make('reports.roomsreportincome')->with('error', 'No data found from in '. $month . ' ,' . $mYear);
                                                }else{
                                                        $reports = Hotellogs::whereRaw('date >=? and date < ?', array($start, $end))->distinct()->get();

                                                        return View::make('reports.roomsreportincome', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms)->with('month', $month)->with('mYear', $mYear);
                                                }
                                        }else{
                                                $reports    = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of income of {$rms} Guests from {$start} to {$end}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Total income";
                                                $yAxisData  = Guest::guestsRIIncome($start,$end,$rms);
                                                $gname      = "Income";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);
                                        }
                                }else if($rms == "paid"){
                                        if($ri == "Table"){
                                                $n   = Hotellogs::whereRaw('date >=? and date < ?', array($start, $end))->count();

                                                if($n == 0){
                                                        return View::make('reports.roomsreportincome')->with('error', 'No data found from in '. $month . ' ,' . $mYear);
                                                }else{
                                                        $reports = Hotellogs::whereRaw('date >=? and date < ?', array($start, $end))->distinct()->get();

                                                        return View::make('reports.roomsreportincome', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms)->with('month', $month)->with('mYear', $mYear);
                                                }
                                        }else{
                                                $reports    = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of income of {$rms} Guests from {$start} to {$end}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Total income";
                                                $yAxisData  = Guest::guestsRIIncome($start,$end,$rms);
                                                $gname      = "Income";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);
                                        }
                                }
                        }

                }else if($rf == "yearly"){
                        $year = $inputs['yr'];

                        $start  = $year . "-01-" . "01";
                        $end    = $year . "-12-" . "31";

                        if($ro == "Guest"){
                                if($rms == "all"){
                                        if($ri == "Table"){
                                                $n   = Hotellogs::whereRaw('date >=? and date <= ?', array($start, $end))->count();

                                                if($n == 0){
                                                        return View::make('reports.roomsreport')->with('error', 'No data found from in year '.$year);
                                                }else{
                                                        $reports = Hotellogs::whereRaw('date >=? and date <= ?', array($start, $end))->distinct()->get();

                                                        return View::make('reports.roomsreport', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms)->with('year', $year);
                                                }						
                                        }else{
                                                $reports    = Hotellogs::whereRaw('date >=? and date <= ?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of {$rms} Guests in year {$year}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Guests number";
                                                $yAxisData  = Guest::generateGuestsNo($start,$end);
                                                $gname      = "Total Number of Guests ";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);						

                                        }
                                }else if($rms == "reserved"){
                                        if($ri == "Table"){
                                                $n   = Hotellogs::whereRaw('date >=? and date < ?', array($start, $end))->count();

                                                if($n == 0){
                                                        return View::make('reports.roomsreport')->with('error', 'No data found from in '. $year);
                                                }else{
                                                        $reports = Hotellogs::whereRaw('date >=? and date <= ?', array($start, $end))->distinct()->get();

                                                        return View::make('reports.roomsreport', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms)->with('year', $year);
                                                }
                                        }else{

                                                $reports    = Hotellogs::whereRaw('date >=? and date <= ?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of {$rms} Guests in  {$year}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Guests number";
                                                $yAxisData  = Guest::guestsRI($start,$end,$rms);
                                                $gname      = "Total Number of Guests ";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);	

                                        }
                                }else if($rms == "paid"){
                                        if($ri == "Table"){
                                                $n   = Hotellogs::whereRaw('date >=? and date <= ?', array($start, $end))->count();

                                                if($n == 0){
                                                        return View::make('reports.roomsreport')->with('error', 'No data found from in '. $year);
                                                }else{
                                                        $reports = Hotellogs::whereRaw('date >=? and date <= ?', array($start, $end))->distinct()->get();

                                                        return View::make('reports.roomsreport', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms)->with('year', $year);
                                                }
                                        }else{
                                                $reports    = Hotellogs::whereRaw('date >=? and date <= ?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of {$rms} Guests in  {$year}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Guests number";
                                                $yAxisData  = Guest::guestsRI($start,$end,$rms);
                                                $gname      = "Total Number of Guests ";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);	
                                        }
                                }
                        }else{
                                if($rms == "all"){
                                        if($ri == "Table"){
                                                $n   = Hotellogs::whereRaw('date >=? and date <= ?', array($start, $end))->count();

                                                if($n == 0){
                                                        return View::make('reports.roomsreportincome')->with('error', 'No data found from in '. $year);
                                                }else{
                                                        $reports = Hotellogs::whereRaw('date >=? and date <= ?', array($start, $end))->distinct()->get();

                                                        return View::make('reports.roomsreportincome', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms)->with('year', $year);
                                                }	
                                        }else{
                                                $reports    = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of income of {$rms} Guests from {$start} to {$end}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Total income";
                                                $yAxisData  = Guest::generateGuestsNoIncome($start,$end);
                                                $gname      = "Income";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);
                                        }
                                }else if($rms == "reserved"){
                                        if($ri == "Table"){
                                                $n   = Hotellogs::whereRaw('date >=? and date <= ?', array($start, $end))->count();

                                                if($n == 0){
                                                        return View::make('reports.roomsreportincome')->with('error', 'No data found from in '. $year);
                                                }else{
                                                        $reports = Hotellogs::whereRaw('date >=? and date <= ?', array($start, $end))->distinct()->get();

                                                        return View::make('reports.roomsreportincome', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms)->with('year', $year);
                                                }
                                        }else{
                                                $reports    = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of income of {$rms} Guests from {$start} to {$end}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Total income";
                                                $yAxisData  = Guest::guestsRIIncome($start,$end,$rms);
                                                $gname      = "Income";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);
                                        }
                                }else if($rms == "paid"){
                                        if($ri == "Table"){
                                                $n   = Hotellogs::whereRaw('date >=? and date <= ?', array($start, $end))->count();

                                                if($n == 0){
                                                        return View::make('reports.roomsreportincome')->with('error', 'No data found from in '.  $year);
                                                }else{
                                                        $reports = Hotellogs::whereRaw('date >=? and date <= ?', array($start, $end))->distinct()->get();

                                                        return View::make('reports.roomsreportincome', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms)->with('year', $year);
                                                }
                                        }else{
                                                $reports    = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of income of {$rms} Guests from {$start} to {$end}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Total income";
                                                $yAxisData  = Guest::guestsRIIncome($start,$end,$rms);
                                                $gname      = "Income";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);
                                        }
                                }
                        }


                }


        }

        public function postrooms(){
                $inputs = Input::all();

                $rf     = $inputs['rf'];
                $ro     = $inputs['ro'];
                $rms    = $inputs['rms'];
                $ri     = $inputs['ri'];

                //return $rf . " " . $ro . " " . $rms . " " . $ri;

                if($rf == "daily"){
                        $date = $inputs['date'];
                        if($ro == "Guest"){
                                if($rms == "all"){
                                        if($ri == "Table"){
                                                //$n = Guest::whereRaw('arrival_date <= ? or departure_date >= ?', array($date, $date))->count();
                                                $n   = Hotellogs::where('date', $date)->count();
                                                if($n == 0){
                                                        return View::make('reports.roomsreport')->with('error', 'No data found on ' . $date);
                                                }else{
                                                        //$reports = Guest::whereRaw('arrival_date <= ? or departure_date >= ?', array($date, $date))->get();
                                                        $reports   = Hotellogs::where('date', $date)->get();
                                                        return View::make('reports.roomsreport', compact('reports'))->with('date', $date)->with('rms', $rms);
                                                }
                                        }else{
                                                //obj.gtitle,obj.gsubtitle,obj.xAxisData,obj.yAxisTitle,obj.yAxisData,obj.gname,obj.chartType
                                                $reports    = Guest::whereRaw('arrival_date <= ? and departure_date >= ?', array($date, $date))->get();
                                                $xAxisArr   = array();
                                                foreach ($reports as $r) {
                                                        $xAxisArr[] = Room::find($r->room_number)->name;
                                                }
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of {$rms} Guests on {$date}";
                                                $gsubtitle  = "Total number of {$rms} guests: {$c}";
                                                $xAxisData  = array_keys(array_count_values($xAxisArr));
                                                $yAxisTitle = "Guest number";
                                                $yAxisData  = array_values(array_count_values($xAxisArr));
                                                $gname      = "Rooms ";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);

                                        }
                                }else if($rms == "reserved"){
                                        if($ri == "Table"){
                                                //$n = Guest::whereRaw('arrival_date <= ? and departure_date >= ? and reservation_number != ""', array($date, $date))->count();
                                                $n   = Hotellogs::where('date', $date)->count();
                                                if($n == 0){
                                                        return View::make('reports.roomsreport')->with('error', 'No data found on ' . $date);
                                                }else{
                                                        //$reports = Guest::whereRaw('arrival_date <= ? and departure_date >= ? and reservation_number != ""', array($date, $date))->get();
                                                        $reports   = Hotellogs::where('date', $date)->get();
                                                        return View::make('reports.roomsreport', compact('reports'))->with('date', $date)->with('rms', $rms);
                                                }
                                        }else{

                                                //obj.gtitle,obj.gsubtitle,obj.xAxisData,obj.yAxisTitle,obj.yAxisData,obj.gname,obj.chartType
                                                $reports    = Guest::whereRaw('arrival_date <= ? and departure_date >= ? and reservation_number != ""', array($date, $date))->get();
                                                $xAxisArr   = array();
                                                foreach ($reports as $r) {
                                                        $xAxisArr[] = Room::find($r->room_number)->name;
                                                }
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of {$rms} Guests on {$date}";
                                                $gsubtitle  = "Total number of {$rms} guests: {$c}";
                                                $xAxisData  = array_keys(array_count_values($xAxisArr));
                                                $yAxisTitle = "Guest number";
                                                $yAxisData  = array_values(array_count_values($xAxisArr));
                                                $gname      = "Rooms ";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);

                                        }
                                }else if($rms == "paid"){
                                        if($ri == "Table"){
                                                //$n = Guest::whereRaw('arrival_date <= ? and departure_date >= ? and checked = "yes"', array($date, $date))->count();
                                                $n   = Hotellogs::where('date', $date)->count();
                                                if($n == 0){
                                                        return View::make('reports.roomsreport')->with('error', 'No data found on ' . $date);
                                                }else{
                                                        //$reports = Guest::whereRaw('arrival_date <= ? and departure_date >= ? and checked = "yes"', array($date, $date))->get();
                                                        $reports   = Hotellogs::where('date', $date)->get();
                                                        return View::make('reports.roomsreport', compact('reports'))->with('date', $date)->with('rms', $rms);
                                                }
                                        }else{
                                                //obj.gtitle,obj.gsubtitle,obj.xAxisData,obj.yAxisTitle,obj.yAxisData,obj.gname,obj.chartType
                                                $reports    = Guest::whereRaw('arrival_date <= ? and departure_date >= ? and checked = "yes"', array($date, $date))->get();
                                                $xAxisArr   = array();
                                                foreach ($reports as $r) {
                                                        $xAxisArr[] = Room::find($r->room_number)->name;
                                                }
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of {$rms} Guests on {$date}";
                                                $gsubtitle  = "Total number of {$rms} guests: {$c}";
                                                $xAxisData  = array_keys(array_count_values($xAxisArr));
                                                $yAxisTitle = "Guest number";
                                                $yAxisData  = array_values(array_count_values($xAxisArr));
                                                $gname      = "Rooms ";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);

                                        }
                                }
                        }else{
                        if($rms == "all"){
                                        if($ri == "Table"){
                                                //$n = Guest::whereRaw('arrival_date <= ? or departure_date >= ?', array($date, $date))->count();
                                                $n   = Hotellogs::where('date', $date)->count();
                                                if($n == 0){
                                                        return View::make('reports.roomsreportincome')->with('error', 'No data found on ' . $date);
                                                }else{
                                                        //$reports = Guest::whereRaw('arrival_date <= ? or departure_date >= ?', array($date, $date))->get();
                                                        $reports  = Hotellogs::where('date', $date)->get();
                                                        return View::make('reports.roomsreportincome', compact('reports'))->with('date', $date)->with('rms', $rms);
                                                }
                                        }else{
                                                //obj.gtitle,obj.gsubtitle,obj.xAxisData,obj.yAxisTitle,obj.yAxisData,obj.gname,obj.chartType
                                                $reports    = Guest::whereRaw('arrival_date <= ? and departure_date >= ?', array($date, $date))->get();
                                                $xAxisArr   = array();
                                                foreach ($reports as $r) {
                                                        $xAxisArr[] = Room::find($r->room_number)->name;
                                                        $xAxisArr1[] = Room::find($r->room_number)->cost;
                                                }
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of {$rms} Guests on {$date}";
                                                $gsubtitle  = "Total number of {$rms} guests: {$c}";
                                                $xAxisData  = array_keys(array_count_values($xAxisArr));
                                                $yAxisTitle = "Guest number";
                                                $yAxisData  = array_keys(array_count_values($xAxisArr1));
                                                $gname      = "Rooms ";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);

                                        }
                                }else if($rms == "reserved"){
                                        if($ri == "Table"){
                                                //$n = Guest::whereRaw('arrival_date <= ? and departure_date >= ? and reservation_number != ""', array($date, $date))->count();
                                                $n   = Hotellogs::where('date', $date)->count();
                                                if($n == 0){
                                                        return View::make('reports.roomsreportincome')->with('error', 'No data found on ' . $date);
                                                }else{
                                                        //$reports = Guest::whereRaw('arrival_date <= ? and departure_date >= ? and reservation_number != ""', array($date, $date))->get();
                                                        $reports   = Hotellogs::where('date', $date)->get();
                                                        return View::make('reports.roomsreportincome', compact('reports'))->with('date', $date)->with('rms', $rms);
                                                }
                                        }else{

                                                //obj.gtitle,obj.gsubtitle,obj.xAxisData,obj.yAxisTitle,obj.yAxisData,obj.gname,obj.chartType
                                                $reports    = Guest::whereRaw('arrival_date <= ? and departure_date >= ? and reservation_number != ""', array($date, $date))->get();
                                                $xAxisArr   = array();
                                                foreach ($reports as $r) {
                                                        $xAxisArr[] = Room::find($r->room_number)->name;
                                                        $xAxisArr[] = Room::find($r->room_number)->name;
                                                }
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of {$rms} Guests on {$date}";
                                                $gsubtitle  = "Total number of {$rms} guests: {$c}";
                                                $xAxisData  = array_keys(array_count_values($xAxisArr));
                                                $yAxisTitle = "Guest number";
                                                $yAxisData  = array_values(array_count_values($xAxisArr));
                                                $gname      = "Rooms ";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);

                                        }
                                }else if($rms == "paid"){
                                        if($ri == "Table"){
                                                //$n = Guest::whereRaw('arrival_date <= ? and departure_date >= ? and checked = "yes"', array($date, $date))->count();
                                                $n   = Hotellogs::where('date', $date)->count();
                                                if($n == 0){
                                                        return View::make('reports.roomsreportincome')->with('error', 'No data found on ' . $date);
                                                }else{
                                                        //$reports = Guest::whereRaw('arrival_date <= ? and departure_date >= ? and checked = "yes"', array($date, $date))->get();
                                                        $reports   = Hotellogs::where('date', $date)->get();
                                                        return View::make('reports.roomsreportincome', compact('reports'))->with('date', $date)->with('rms', $rms);
                                                }
                                        }else{
                                                //obj.gtitle,obj.gsubtitle,obj.xAxisData,obj.yAxisTitle,obj.yAxisData,obj.gname,obj.chartType
                                                $reports    = Guest::whereRaw('arrival_date <= ? and departure_date >= ? and checked = "yes"', array($date, $date))->get();
                                                $xAxisArr   = array();
                                                foreach ($reports as $r) {
                                                        $xAxisArr[] = Room::find($r->room_number)->name;
                                                }
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of {$rms} Guests on {$date}";
                                                $gsubtitle  = "Total number of {$rms} guests: {$c}";
                                                $xAxisData  = array_keys(array_count_values($xAxisArr));
                                                $yAxisTitle = "Guest number";
                                                $yAxisData  = array_values(array_count_values($xAxisArr));
                                                $gname      = "Rooms ";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);

                                        }
                                }
                        }	

                }else if($rf == "weekly"){
                        $start = $inputs['start'];
                        $end   = $inputs['end'];
                        if($ro == "Guest"){
                                if($rms == "all"){
                                        if($ri == "Table"){
                                                //$n = Guest::whereRaw('arrival_date <= ? or departure_date <= ?', array($start, $end))->count();
                                                $n   = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->count();
                                                if($n == 0){
                                                        return View::make('reports.roomsreport')->with('error', 'No data found from ' . $start . " to " . $end);
                                                }else{
                                                        $reports = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->get();
                                                        return View::make('reports.roomsreport', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms);
                                                }
                                        }else{
                                                //obj.gtitle,obj.gsubtitle,obj.xAxisData,obj.yAxisTitle,obj.yAxisData,obj.gname,obj.chartType
                                                $reports    = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of {$rms} Guests from {$start} to {$end}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Guests number";
                                                $yAxisData  = Guest::generateGuestsNo($start,$end);
                                                $gname      = "Total Number of Guests ";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);
                                        }
                                }else if($rms == "reserved"){
                                        if($ri == "Table"){

                                                //$n = Guest::whereRaw('arrival_date <= ? or departure_date <= ? and reservation_number != ""', array($start, $end))->count();
                                                $n   = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->count();
                                                if($n == 0){
                                                        return View::make('reports.roomsreport')->with('error', 'No data found from ' . $start . " to " . $end);
                                                }else{
                                                        $reports =  Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->get();
                                                        return View::make('reports.roomsreport', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms);
                                                }

                                        }else{
                                                //obj.gtitle,obj.gsubtitle,obj.xAxisData,obj.yAxisTitle,obj.yAxisData,obj.gname,obj.chartType
                                                $reports    = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of {$rms} Guests from {$start} to {$end}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Guests number";
                                                $yAxisData  = Guest::guestsRI($start, $end, $rms);
                                                $gname      = "Total Number of Guests ";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);
                                        }
                                }else if($rms == "paid"){
                                        if($ri == "Table"){

                                                //$n = Guest::whereRaw('arrival_date <= ? or departure_date <= ? and checked = "yes"', array($start, $end))->count();
                                                $n   = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->count();
                                                if($n == 0){
                                                        return View::make('reports.roomsreport')->with('error', 'No data found from ' . $start . " to " . $end);
                                                }else{
                                                        $reports = $n   = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->get();
                                                        return View::make('reports.roomsreport', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms);
                                                }


                                        }else{
                                                $reports    = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of {$rms} Guests from {$start} to {$end}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Guests number";
                                                $yAxisData  = Guest::guestsRI($start, $end, $rms);
                                                $gname      = "Total Number of Guests ";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);						

                                        }
                                }
                        }else{
                                if($rms == "all"){
                                        if($ri == "Table"){
                                                //$n = Guest::whereRaw('arrival_date <= ? or departure_date <= ?', array($start, $end))->count();
                                                $n   = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->count();
                                                if($n == 0){
                                                        return View::make('reports.roomsreportincome')->with('error', 'No data found from ' . $start . " to " . $end);
                                                }else{
                                                        //$reports = Guest::whereRaw('arrival_date <= ? or departure_date <=  ?', array($start, $end))->get();
                                                        $reports   = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->get();
                                                        return View::make('reports.roomsreportincome', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms);
                                                }
                                        }else{
                                                $reports    = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of income of {$rms} Guests from {$start} to {$end}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Total income";
                                                $yAxisData  = Guest::generateGuestsNoIncome($start,$end);
                                                $gname      = "Income";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);
                                        }
                                }else if($rms == "reserved"){
                                        if($ri == "Table"){
                                                $n = Guest::whereRaw('arrival_date <= ? or departure_date <= ? and reservation_number != ""', array($start, $end))->count();
                                                if($n == 0){
                                                        return View::make('reports.roomsreportincome')->with('error', 'No data found from ' . $start . " to " . $end);
                                                }else{
                                                        $reports = Guest::whereRaw('arrival_date <= ? or departure_date <=  ? and reservation_number != ""', array($start, $end))->get();
                                                        return View::make('reports.roomsreportincome', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms);
                                                }
                                        }else{
                                                $reports    = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of income of {$rms} Guests from {$start} to {$end}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Total income";
                                                $yAxisData  = Guest::guestsRIIncome($start,$end,$rms);
                                                $gname      = "Income";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);
                                        }
                                }else if($rms == "paid"){
                                        if($ri == "Table"){
                                                $n = Guest::whereRaw('arrival_date <= ? or departure_date <= ? and checked = "yes"', array($start, $end))->count();
                                                if($n == 0){
                                                        return View::make('reports.roomsreportincome')->with('error', 'No data found from ' . $start . " to " . $end);
                                                }else{
                                                        $reports = Guest::whereRaw('arrival_date <= ? or departure_date <=  ? and checked = "yes"', array($start, $end))->get();
                                                        return View::make('reports.roomsreportincome', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms);
                                                }
                                        }else{
                                                $reports    = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of income of {$rms} Guests from {$start} to {$end}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Total income";
                                                $yAxisData  = Guest::guestsRIIncome($start,$end,$rms);
                                                $gname      = "Income";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);
                                        }
                                }
                        }
                }else if($rf == "monthly"){
                        $month  = $inputs['month'];
                        $mYear  = $inputs['mYear'];

                        $start  = $mYear . "-" . Guest::getMonth($month) . "-" . "01";
                        $end    = $mYear . "-" . Guest::getNextMonth($month) . "-" . "01";


                        if($ro == "Guest"){
                                if($rms == "all"){
                                        if($ri == "Table"){
                                                $n   = Hotellogs::whereRaw('date >=? and date < ?', array($start, $end))->count();

                                                if($n == 0){
                                                        return View::make('reports.roomsreport')->with('error', 'No data found from in '. $month . ' ,' . $mYear);
                                                }else{
                                                        $reports = Hotellogs::whereRaw('date >=? and date < ?', array($start, $end))->distinct()->get();

                                                        return View::make('reports.roomsreport', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms)->with('month', $month)->with('mYear', $mYear);
                                                }						
                                        }else{
                                                $reports    = Hotellogs::whereRaw('date >=? and date < ?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of {$rms} Guests in {$month}, {$mYear}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Guests number";
                                                $yAxisData  = Guest::generateGuestsNo($start,$end);
                                                $gname      = "Total Number of Guests ";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);						

                                        }
                                }else if($rms == "reserved"){
                                        if($ri == "Table"){
                                                $n   = Hotellogs::whereRaw('date >=? and date < ?', array($start, $end))->count();

                                                if($n == 0){
                                                        return View::make('reports.roomsreport')->with('error', 'No data found from in '. $month . ' ,' . $mYear);
                                                }else{
                                                        $reports = Hotellogs::whereRaw('date >=? and date < ?', array($start, $end))->distinct()->get();

                                                        return View::make('reports.roomsreport', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms)->with('month', $month)->with('mYear', $mYear);
                                                }
                                        }else{

                                                $reports    = Hotellogs::whereRaw('date >=? and date < ?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of {$rms} Guests in {$month}, {$mYear}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Guests number";
                                                $yAxisData  = Guest::guestsRI($start,$end,$rms);
                                                $gname      = "Total Number of Guests ";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);	

                                        }
                                }else if($rms == "paid"){
                                        if($ri == "Table"){
                                                $n   = Hotellogs::whereRaw('date >=? and date < ?', array($start, $end))->count();

                                                if($n == 0){
                                                        return View::make('reports.roomsreport')->with('error', 'No data found from in '. $month . ' ,' . $mYear);
                                                }else{
                                                        $reports = Hotellogs::whereRaw('date >=? and date < ?', array($start, $end))->distinct()->get();

                                                        return View::make('reports.roomsreport', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms)->with('month', $month)->with('mYear', $mYear);
                                                }
                                        }else{
                                                $reports    = Hotellogs::whereRaw('date >=? and date < ?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of {$rms} Guests in {$month}, {$mYear}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Guests number";
                                                $yAxisData  = Guest::guestsRI($start,$end,$rms);
                                                $gname      = "Total Number of Guests ";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);	
                                        }
                                }
                        }else{
                                if($rms == "all"){
                                        if($ri == "Table"){
                                                $n   = Hotellogs::whereRaw('date >=? and date < ?', array($start, $end))->count();

                                                if($n == 0){
                                                        return View::make('reports.roomsreportincome')->with('error', 'No data found from in '. $month . ' ,' . $mYear);
                                                }else{
                                                        $reports = Hotellogs::whereRaw('date >=? and date < ?', array($start, $end))->distinct()->get();

                                                        return View::make('reports.roomsreportincome', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms)->with('month', $month)->with('mYear', $mYear);
                                                }	
                                        }else{
                                                $reports    = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of income of {$rms} Guests from {$start} to {$end}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Total income";
                                                $yAxisData  = Guest::generateGuestsNoIncome($start,$end);
                                                $gname      = "Income";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);
                                        }
                                }else if($rms == "reserved"){
                                        if($ri == "Table"){
                                                $n   = Hotellogs::whereRaw('date >=? and date < ?', array($start, $end))->count();

                                                if($n == 0){
                                                        return View::make('reports.roomsreportincome')->with('error', 'No data found from in '. $month . ' ,' . $mYear);
                                                }else{
                                                        $reports = Hotellogs::whereRaw('date >=? and date < ?', array($start, $end))->distinct()->get();

                                                        return View::make('reports.roomsreportincome', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms)->with('month', $month)->with('mYear', $mYear);
                                                }
                                        }else{
                                                $reports    = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of income of {$rms} Guests from {$start} to {$end}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Total income";
                                                $yAxisData  = Guest::guestsRIIncome($start,$end,$rms);
                                                $gname      = "Income";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);
                                        }
                                }else if($rms == "paid"){
                                        if($ri == "Table"){
                                                $n   = Hotellogs::whereRaw('date >=? and date < ?', array($start, $end))->count();

                                                if($n == 0){
                                                        return View::make('reports.roomsreportincome')->with('error', 'No data found from in '. $month . ' ,' . $mYear);
                                                }else{
                                                        $reports = Hotellogs::whereRaw('date >=? and date < ?', array($start, $end))->distinct()->get();

                                                        return View::make('reports.roomsreportincome', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms)->with('month', $month)->with('mYear', $mYear);
                                                }
                                        }else{
                                                $reports    = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of income of {$rms} Guests from {$start} to {$end}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Total income";
                                                $yAxisData  = Guest::guestsRIIncome($start,$end,$rms);
                                                $gname      = "Income";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);
                                        }
                                }
                        }

                }else if($rf == "yearly"){
                        $year = $inputs['yr'];

                        $start  = $year . "-01-" . "01";
                        $end    = $year . "-12-" . "31";

                        if($ro == "Guest"){
                                if($rms == "all"){
                                        if($ri == "Table"){
                                                $n   = Hotellogs::whereRaw('date >=? and date <= ?', array($start, $end))->count();

                                                if($n == 0){
                                                        return View::make('reports.roomsreport')->with('error', 'No data found from in year '.$year);
                                                }else{
                                                        $reports = Hotellogs::whereRaw('date >=? and date <= ?', array($start, $end))->distinct()->get();

                                                        return View::make('reports.roomsreport', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms)->with('year', $year);
                                                }						
                                        }else{
                                                $reports    = Hotellogs::whereRaw('date >=? and date <= ?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of {$rms} Guests in year {$year}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Guests number";
                                                $yAxisData  = Guest::generateGuestsNo($start,$end);
                                                $gname      = "Total Number of Guests ";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);						

                                        }
                                }else if($rms == "reserved"){
                                        if($ri == "Table"){
                                                $n   = Hotellogs::whereRaw('date >=? and date < ?', array($start, $end))->count();

                                                if($n == 0){
                                                        return View::make('reports.roomsreport')->with('error', 'No data found from in '. $year);
                                                }else{
                                                        $reports = Hotellogs::whereRaw('date >=? and date <= ?', array($start, $end))->distinct()->get();

                                                        return View::make('reports.roomsreport', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms)->with('year', $year);
                                                }
                                        }else{

                                                $reports    = Hotellogs::whereRaw('date >=? and date <= ?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of {$rms} Guests in  {$year}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Guests number";
                                                $yAxisData  = Guest::guestsRI($start,$end,$rms);
                                                $gname      = "Total Number of Guests ";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);	

                                        }
                                }else if($rms == "paid"){
                                        if($ri == "Table"){
                                                $n   = Hotellogs::whereRaw('date >=? and date <= ?', array($start, $end))->count();

                                                if($n == 0){
                                                        return View::make('reports.roomsreport')->with('error', 'No data found from in '. $year);
                                                }else{
                                                        $reports = Hotellogs::whereRaw('date >=? and date <= ?', array($start, $end))->distinct()->get();

                                                        return View::make('reports.roomsreport', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms)->with('year', $year);
                                                }
                                        }else{
                                                $reports    = Hotellogs::whereRaw('date >=? and date <= ?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of {$rms} Guests in  {$year}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Guests number";
                                                $yAxisData  = Guest::guestsRI($start,$end,$rms);
                                                $gname      = "Total Number of Guests ";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);	
                                        }
                                }
                        }else{
                                if($rms == "all"){
                                        if($ri == "Table"){
                                                $n   = Hotellogs::whereRaw('date >=? and date <= ?', array($start, $end))->count();

                                                if($n == 0){
                                                        return View::make('reports.roomsreportincome')->with('error', 'No data found from in '. $year);
                                                }else{
                                                        $reports = Hotellogs::whereRaw('date >=? and date <= ?', array($start, $end))->distinct()->get();

                                                        return View::make('reports.roomsreportincome', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms)->with('year', $year);
                                                }	
                                        }else{
                                                $reports    = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of income of {$rms} Guests from {$start} to {$end}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Total income";
                                                $yAxisData  = Guest::generateGuestsNoIncome($start,$end);
                                                $gname      = "Income";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);
                                        }
                                }else if($rms == "reserved"){
                                        if($ri == "Table"){
                                                $n   = Hotellogs::whereRaw('date >=? and date <= ?', array($start, $end))->count();

                                                if($n == 0){
                                                        return View::make('reports.roomsreportincome')->with('error', 'No data found from in '. $year);
                                                }else{
                                                        $reports = Hotellogs::whereRaw('date >=? and date <= ?', array($start, $end))->distinct()->get();

                                                        return View::make('reports.roomsreportincome', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms)->with('year', $year);
                                                }
                                        }else{
                                                $reports    = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of income of {$rms} Guests from {$start} to {$end}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Total income";
                                                $yAxisData  = Guest::guestsRIIncome($start,$end,$rms);
                                                $gname      = "Income";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);
                                        }
                                }else if($rms == "paid"){
                                        if($ri == "Table"){
                                                $n   = Hotellogs::whereRaw('date >=? and date <= ?', array($start, $end))->count();

                                                if($n == 0){
                                                        return View::make('reports.roomsreportincome')->with('error', 'No data found from in '.  $year);
                                                }else{
                                                        $reports = Hotellogs::whereRaw('date >=? and date <= ?', array($start, $end))->distinct()->get();

                                                        return View::make('reports.roomsreportincome', compact('reports'))->with('start', $start)->with('end', $end)->with('rms', $rms)->with('year', $year);
                                                }
                                        }else{
                                                $reports    = Hotellogs::whereRaw('date >=? and date <=?', array($start, $end))->get();
                                                $xAxisArr   = Guest::generateDays($start,$end);
                                                //setup goes down
                                                $c          = count(array_count_values($xAxisArr));
                                                $gtitle     = "Report of income of {$rms} Guests from {$start} to {$end}";
                                                $gsubtitle  = "";
                                                $xAxisData  = $xAxisArr;
                                                $yAxisTitle = "Total income";
                                                $yAxisData  = Guest::guestsRIIncome($start,$end,$rms);
                                                $gname      = "Income";
                                                $chart      = strtolower($ri); 

                                                $dataArr = array(
                                                                                "gtitle"    =>$gtitle,
                                                                                "gsubtitle" =>$gsubtitle,
                                                                                "xAxisData" =>$xAxisData,
                                                                                "yAxisData"	=>$yAxisData,
                                                                                "yAxisTitle"=>$yAxisTitle,
                                                                                "gname"		=>$gname,
                                                                                "chartType" =>$chart
                                                                                );
                                                return json_encode($dataArr);
                                        }
                                }
                        }


                }
        }

        public function restaurant(){
                return View::make('reports.restaurant');
        }

        public function postrestaurant(){
                $inputs = Input::all();

                $rf     = $inputs['rf'];
                $ro     = $inputs['ro'];
                $rests  = $inputs['rests'];
                $ri     = $inputs['ri'];
                $svrt   = $inputs['svrt'];

                if($rf == "daily"){
                        $date   = $inputs['date'];
                        if($ro == "Guest"){
                                if($ri == "Table"){
                                        if($rests == "all"){
                                                if($svrt == "all"){
                                                        $n = Bill::where('date', $date)->count();
                                                        if($n == 0){
                                                                return View::make('reports.restaurantreport')->with('error', 'No data found in ' . $date);
                                                        }else{
                                                                $results = Bill::where('date', $date)->get();
                                                                $reports = array();
                                                                foreach ($results as $result) {
                                                                        $reports[] = $result->id;	
                                                                }
                                                                //return print_r($reports);
                                                                //$reports   = array_keys(array_count_values($reports)); 
                                                                return View::make('reports.restaurantreport', compact('reports'))->with('rests', $rests)->with('date', $date);
                                                        }
                                                }else if($svrt == 1){
                                                        $n = Bill::whereRaw('date = ? and servicetime = ? ', array($date, $svrt))->count();
                                                        if($n == 0){
                                                                return View::make('reports.restaurantreport')->with('error', 'No data found in ' . $date);
                                                        }else{
                                                                $results = Bill::whereRaw('date = ? and servicetime = ? ', array($date, $svrt))->get();
                                                                $reports = array();
                                                                foreach ($results as $result) {
                                                                        $reports[] = $result->id;	
                                                                }
                                                                //return print_r($reports);
                                                                //$reports   = array_keys(array_count_values($reports)); 
                                                                return View::make('reports.restaurantreport', compact('reports'))->with('rests', $rests)->with('date', $date);
                                                        }
                                                }else if($svrt == 2){
                                                        $n = Bill::whereRaw('date = ? and servicetime = ? ', array($date, $svrt))->count();
                                                        if($n == 0){
                                                                return View::make('reports.restaurantreport')->with('error', 'No data found in ' . $date);
                                                        }else{
                                                                $results = Bill::whereRaw('date = ? and servicetime = ? ', array($date, $svrt))->get();
                                                                $reports = array();
                                                                foreach ($results as $result) {
                                                                        $reports[] = $result->id;	
                                                                }
                                                                //return print_r($reports);
                                                                //$reports   = array_keys(array_count_values($reports)); 
                                                                return View::make('reports.restaurantreport', compact('reports'))->with('rests', $rests)->with('date', $date);
                                                        }
                                                }else if($svrt == 3){
                                                        $n = Bill::whereRaw('date = ? and servicetime = ? ', array($date, $svrt))->count();
                                                        if($n == 0){
                                                                return View::make('reports.restaurantreport')->with('error', 'No data found in ' . $date);
                                                        }else{
                                                                $results = Bill::whereRaw('date = ? and servicetime = ? ', array($date, $svrt))->get();
                                                                $reports = array();
                                                                foreach ($results as $result) {
                                                                        $reports[] = $result->id;	
                                                                }
                                                                //return print_r($reports);
                                                                //$reports   = array_keys(array_count_values($reports)); 
                                                                return View::make('reports.restaurantreport', compact('reports'))->with('rests', $rests)->with('date', $date);
                                                        }
                                                }else if($svrt == 4){
                                                        $n = Bill::whereRaw('date = ? and servicetime = ? ', array($date, $svrt))->count();
                                                        if($n == 0){
                                                                return View::make('reports.restaurantreport')->with('error', 'No data found in ' . $date);
                                                        }else{
                                                                $results = Bill::whereRaw('date = ? and servicetime = ? ', array($date, $svrt))->get();
                                                                $reports = array();
                                                                foreach ($results as $result) {
                                                                        $reports[] = $result->id;	
                                                                }
                                                                //return print_r($reports);
                                                                //$reports   = array_keys(array_count_values($reports)); 
                                                                return View::make('reports.restaurantreport', compact('reports'))->with('rests', $rests)->with('date', $date);
                                                        }
                                                }else if($svrt == 5){
                                                        $n = Bill::whereRaw('date = ? and servicetime = ? ', array($date, $svrt))->count();
                                                        if($n == 0){
                                                                return View::make('reports.restaurantreport')->with('error', 'No data found in ' . $date);
                                                        }else{
                                                                $results = Bill::whereRaw('date = ? and servicetime = ? ', array($date, $svrt))->get();
                                                                $reports = array();
                                                                foreach ($results as $result) {
                                                                        $reports[] = $result->id;	
                                                                }
                                                                //return print_r($reports);
                                                                //$reports   = array_keys(array_count_values($reports)); 
                                                                return View::make('reports.restaurantreport', compact('reports'))->with('rests', $rests)->with('date', $date);
                                                        }
                                                }
                                        }else if($rests == "credit"){
                                                if($svrt == "all"){
                                                        $n = Bill::whereRaw('date = ? and paymentmode = ?', array($date, "mkopo"))->count();
                                                        if($n == 0){
                                                                return View::make('reports.restaurantreport')->with('error', 'No data found in ' . $date);
                                                        }else{
                                                                $results = Bill::whereRaw('date = ? and paymentmode = ?', array($date, "mkopo"))->get();
                                                                $reports = array();
                                                                foreach ($results as $result) {
                                                                        $reports[] = $result->id;	
                                                                }
                                                                //return print_r($reports);
                                                                //$reports   = array_keys(array_count_values($reports)); 
                                                                return View::make('reports.restaurantreport', compact('reports'))->with('rests', $rests)->with('date', $date);
                                                        }
                                                }else if($svrt == 1){
                                                        $n = Bill::whereRaw('date = ? and servicetime = ? and paymentmode = ?', array($date, $svrt, "mkopo"))->count();
                                                        if($n == 0){
                                                                return View::make('reports.restaurantreport')->with('error', 'No data found in ' . $date);
                                                        }else{
                                                                $results = Bill::whereRaw('date = ? and servicetime = ? and paymentmode = ?', array($date, $svrt, "mkopo"))->get();
                                                                $reports = array();
                                                                foreach ($results as $result) {
                                                                        $reports[] = $result->id;	
                                                                }
                                                                //return print_r($reports);
                                                                //$reports   = array_keys(array_count_values($reports)); 
                                                                return View::make('reports.restaurantreport', compact('reports'))->with('rests', $rests)->with('date', $date);
                                                        }
                                                }else if($svrt == 2){
                                                        $n = Bill::whereRaw('date = ? and servicetime = ? and paymentmode = ?', array($date, $svrt, "mkopo"))->count();
                                                        if($n == 0){
                                                                return View::make('reports.restaurantreport')->with('error', 'No data found in ' . $date);
                                                        }else{
                                                                $results = Bill::whereRaw('date = ? and servicetime = ? and paymentmode = ?', array($date, $svrt, "mkopo"))->get();
                                                                $reports = array();
                                                                foreach ($results as $result) {
                                                                        $reports[] = $result->id;	
                                                                }
                                                                //return print_r($reports);
                                                                //$reports   = array_keys(array_count_values($reports)); 
                                                                return View::make('reports.restaurantreport', compact('reports'))->with('rests', $rests)->with('date', $date);
                                                        }
                                                }else if($svrt == 3){
                                                        $n = Bill::whereRaw('date = ? and servicetime = ? and paymentmode = ?', array($date, $svrt, "mkopo"))->count();
                                                        if($n == 0){
                                                                return View::make('reports.restaurantreport')->with('error', 'No data found in ' . $date);
                                                        }else{
                                                                $results = Bill::whereRaw('date = ? and servicetime = ? and paymentmode = ?', array($date, $svrt, "mkopo"))->get();
                                                                $reports = array();
                                                                foreach ($results as $result) {
                                                                        $reports[] = $result->id;	
                                                                }
                                                                //return print_r($reports);
                                                                //$reports   = array_keys(array_count_values($reports)); 
                                                                return View::make('reports.restaurantreport', compact('reports'))->with('rests', $rests)->with('date', $date);
                                                        }
                                                }else if($svrt == 4){
                                                        $n = Bill::whereRaw('date = ? and servicetime = ? and paymentmode = ?', array($date, $svrt, "mkopo"))->count();
                                                        if($n == 0){
                                                                return View::make('reports.restaurantreport')->with('error', 'No data found in ' . $date);
                                                        }else{
                                                                $results = Bill::whereRaw('date = ? and servicetime = ? and paymentmode = ?', array($date, $svrt, "mkopo"))->get();
                                                                $reports = array();
                                                                foreach ($results as $result) {
                                                                        $reports[] = $result->id;	
                                                                }
                                                                //return print_r($reports);
                                                                //$reports   = array_keys(array_count_values($reports)); 
                                                                return View::make('reports.restaurantreport', compact('reports'))->with('rests', $rests)->with('date', $date);
                                                        }
                                                }else if($svrt == 5){
                                                        $n = Bill::whereRaw('date = ? and servicetime = ? and paymentmode = ?', array($date, $svrt, "mkopo"))->count();
                                                        if($n == 0){
                                                                return View::make('reports.restaurantreport')->with('error', 'No data found in ' . $date);
                                                        }else{
                                                                $results = Bill::whereRaw('date = ? and servicetime = ? and paymentmode = ?', array($date, $svrt, "mkopo"))->get();
                                                                $reports = array();
                                                                foreach ($results as $result) {
                                                                        $reports[] = $result->id;	
                                                                }
                                                                //return print_r($reports);
                                                                //$reports   = array_keys(array_count_values($reports)); 
                                                                return View::make('reports.restaurantreport', compact('reports'))->with('rests', $rests)->with('date', $date);
                                                        }
                                                }
                                        }else if($rests == "cash"){
                                                if($svrt == "all"){
                                                        $n = Bill::whereRaw('date = ? and paymentmode = ?', array($date, "cash"))->count();
                                                        if($n == 0){
                                                                return View::make('reports.restaurantreport')->with('error', 'No data found in ' . $date);
                                                        }else{
                                                                $results = Bill::whereRaw('date = ? and paymentmode = ?', array($date, "cash"))->get();
                                                                $reports = array();
                                                                foreach ($results as $result) {
                                                                        $reports[] = $result->id;	
                                                                }
                                                                //return print_r($reports);
                                                                //$reports   = array_keys(array_count_values($reports)); 
                                                                return View::make('reports.restaurantreport', compact('reports'))->with('rests', $rests)->with('date', $date);
                                                        }
                                                }else if($svrt == 1){
                                                        $n = Bill::whereRaw('date = ? and servicetime = ? and paymentmode = ?', array($date, $svrt, "cash"))->count();
                                                        if($n == 0){
                                                                return View::make('reports.restaurantreport')->with('error', 'No data found in ' . $date);
                                                        }else{
                                                                $results = Bill::whereRaw('date = ? and servicetime = ? and paymentmode = ?', array($date, $svrt, "cash"))->get();
                                                                $reports = array();
                                                                foreach ($results as $result) {
                                                                        $reports[] = $result->id;	
                                                                }
                                                                //return print_r($reports);
                                                                //$reports   = array_keys(array_count_values($reports)); 
                                                                return View::make('reports.restaurantreport', compact('reports'))->with('rests', $rests)->with('date', $date);
                                                        }
                                                }else if($svrt == 2){
                                                        $n = Bill::whereRaw('date = ? and servicetime = ? and paymentmode = ?', array($date, $svrt, "cash"))->count();
                                                        if($n == 0){
                                                                return View::make('reports.restaurantreport')->with('error', 'No data found in ' . $date);
                                                        }else{
                                                                $results = Bill::whereRaw('date = ? and servicetime = ? and paymentmode = ?', array($date, $svrt, "cash"))->get();
                                                                $reports = array();
                                                                foreach ($results as $result) {
                                                                        $reports[] = $result->id;	
                                                                }
                                                                //return print_r($reports);
                                                                //$reports   = array_keys(array_count_values($reports)); 
                                                                return View::make('reports.restaurantreport', compact('reports'))->with('rests', $rests)->with('date', $date);
                                                        }
                                                }else if($svrt == 3){
                                                        $n = Bill::whereRaw('date = ? and servicetime = ? and paymentmode = ?', array($date, $svrt, "cash"))->count();
                                                        if($n == 0){
                                                                return View::make('reports.restaurantreport')->with('error', 'No data found in ' . $date);
                                                        }else{
                                                                $results = Bill::whereRaw('date = ? and servicetime = ? and paymentmode = ?', array($date, $svrt, "mkopo"))->get();
                                                                $reports = array();
                                                                foreach ($results as $result) {
                                                                        $reports[] = $result->id;	
                                                                }
                                                                //return print_r($reports);
                                                                //$reports   = array_keys(array_count_values($reports)); 
                                                                return View::make('reports.restaurantreport', compact('reports'))->with('rests', $rests)->with('date', $date);
                                                        }
                                                }else if($svrt == 4){
                                                        $n = Bill::whereRaw('date = ? and servicetime = ? and paymentmode = ?', array($date, $svrt, "cash"))->count();
                                                        if($n == 0){
                                                                return View::make('reports.restaurantreport')->with('error', 'No data found in ' . $date);
                                                        }else{
                                                                $results = Bill::whereRaw('date = ? and servicetime = ? and paymentmode = ?', array($date, $svrt, "cash"))->get();
                                                                $reports = array();
                                                                foreach ($results as $result) {
                                                                        $reports[] = $result->id;	
                                                                }
                                                                //return print_r($reports);
                                                                //$reports   = array_keys(array_count_values($reports)); 
                                                                return View::make('reports.restaurantreport', compact('reports'))->with('rests', $rests)->with('date', $date);
                                                        }
                                                }else if($svrt == 5){
                                                        $n = Bill::whereRaw('date = ? and servicetime = ? and paymentmode = ?', array($date, $svrt, "cash"))->count();
                                                        if($n == 0){
                                                                return View::make('reports.restaurantreport')->with('error', 'No data found in ' . $date);
                                                        }else{
                                                                $results = Bill::whereRaw('date = ? and servicetime = ? and paymentmode = ?', array($date, $svrt, "cash"))->get();
                                                                $reports = array();
                                                                foreach ($results as $result) {
                                                                        $reports[] = $result->id;	
                                                                }
                                                                //return print_r($reports);
                                                                //$reports   = array_keys(array_count_values($reports)); 
                                                                return View::make('reports.restaurantreport', compact('reports'))->with('rests', $rests)->with('date', $date);
                                                        }
                                                }
                                        }
                                }
                        }else if($ro == "noneguest"){
                                if($ri == "Table"){
                                                if($rests == "credit"){
                                                        if($svrt == "all"){
                                                                $n = FoodSales::where('date', $date)->count();
                                                                if($n == 0){
                                                                        return View::make('reports.restaurantreport')->with('error', 'No data found in ' . $date);
                                                                }else{
                                                                        $results = FoodSales::where('date', $date)->get();
                                                                        $reports = array();
                                                                        foreach ($results as $result) {
                                                                                $reports[] = $result->id;	
                                                                        }
                                                                        //return print_r($reports);
                                                                        //$reports   = array_keys(array_count_values($reports)); 
                                                                        return View::make('reports.restaurantreport', compact('reports'))->with('rests', $rests)->with('date', $date);
                                                                }
                                                        }else if($svrt == 1){
                                                                $n = FoodSales::whereRaw('date = ? and service = ? ', array($date, $svrt))->count();
                                                                if($n == 0){
                                                                        return View::make('reports.restaurantreport')->with('error', 'No data found in ' . $date);
                                                                }else{
                                                                        $results = FoodSales::whereRaw('date = ? and service = ? ', array($date, $svrt))->get();
                                                                        $reports = array();
                                                                        foreach ($results as $result) {
                                                                                $reports[] = $result->id;	
                                                                        }
                                                                        //return print_r($reports);
                                                                        //$reports   = array_keys(array_count_values($reports)); 
                                                                        return View::make('reports.restaurantreport', compact('reports'))->with('rests', $rests)->with('date', $date);
                                                                }
                                                        }else if($svrt == 2){
                                                                $n = FoodSales::whereRaw('date = ? and service = ? ', array($date, $svrt))->count();
                                                                if($n == 0){
                                                                        return View::make('reports.restaurantreport')->with('error', 'No data found in ' . $date);
                                                                }else{
                                                                        $results = FoodSales::whereRaw('date = ? and service = ? ', array($date, $svrt))->get();
                                                                        $reports = array();
                                                                        foreach ($results as $result) {
                                                                                $reports[] = $result->id;	
                                                                        }
                                                                        //return print_r($reports);
                                                                        //$reports   = array_keys(array_count_values($reports)); 
                                                                        return View::make('reports.restaurantreport', compact('reports'))->with('rests', $rests)->with('date', $date);
                                                                }
                                                        }else if($svrt == 3){
                                                                $n = FoodSales::whereRaw('date = ? and service = ? ', array($date, $svrt))->count();
                                                                if($n == 0){
                                                                        return View::make('reports.restaurantreport')->with('error', 'No data found in ' . $date);
                                                                }else{
                                                                        $results = FoodSales::whereRaw('date = ? and service = ? ', array($date, $svrt))->get();
                                                                        $reports = array();
                                                                        foreach ($results as $result) {
                                                                                $reports[] = $result->id;	
                                                                        }
                                                                        //return print_r($reports);
                                                                        //$reports   = array_keys(array_count_values($reports)); 
                                                                        return View::make('reports.restaurantreport', compact('reports'))->with('rests', $rests)->with('date', $date);
                                                                }
                                                        }else if($svrt == 4){
                                                                $n = FoodSales::whereRaw('date = ? and service = ? ', array($date, $svrt))->count();
                                                                if($n == 0){
                                                                        return View::make('reports.restaurantreport')->with('error', 'No data found in ' . $date);
                                                                }else{
                                                                        $results = FoodSales::whereRaw('date = ? and service = ? ', array($date, $svrt))->get();
                                                                        $reports = array();
                                                                        foreach ($results as $result) {
                                                                                $reports[] = $result->id;	
                                                                        }
                                                                        //return print_r($reports);
                                                                        //$reports   = array_keys(array_count_values($reports)); 
                                                                        return View::make('reports.restaurantreport', compact('reports'))->with('rests', $rests)->with('date', $date);
                                                                }
                                                        }else if($svrt == 5){
                                                                $n = FoodSales::whereRaw('date = ? and service = ? ', array($date, $svrt))->count();
                                                                if($n == 0){
                                                                        return View::make('reports.restaurantreport')->with('error', 'No data found in ' . $date);
                                                                }else{
                                                                        $results = FoodSales::whereRaw('date = ? and service = ? ', array($date, $svrt))->get();
                                                                        $reports = array();
                                                                        foreach ($results as $result) {
                                                                                $reports[] = $result->id;	
                                                                        }
                                                                        //return print_r($reports);
                                                                        //$reports   = array_keys(array_count_values($reports)); 
                                                                        return View::make('reports.restaurantreport', compact('reports'))->with('rests', $rests)->with('date', $date);
                                                                }
                                                        }
                                                }
                                }
                        }else if($ro == "income"){
                                if($ri == "Table"){
                                        if($rests == "all"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }else if($rests == "credit"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }else if($rests == "cash"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }
                                }
                        }else if($ro == "noneguestincome"){
                                if($ri == "Table"){
                                        if($rests == "all"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }else if($rests == "credit"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }else if($rests == "cash"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }
                                }
                        }
                }else if($rf == "weekly"){
                        if($ro == "Guest"){
                                if($ri == "Table"){
                                        if($rests == "all"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }else if($rests == "credit"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }else if($rests == "cash"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }
                                }else{
                                        //graph reports goes here ...
                                }
                        }else if($ro == "noneguest"){
                                if($ri == "Table"){
                                        if($rests == "all"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }else if($rests == "credit"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }else if($rests == "cash"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }
                                }else{
                                        //graph reports goes here ...
                                }
                        }else if($ro == "income"){
                                if($ri == "Table"){
                                        if($rests == "all"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }else if($rests == "credit"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }else if($rests == "cash"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }
                                }else{
                                        //graph reports goes here ...
                                }
                        }else if($ro == "noneguestincome"){
                                if($ri == "Table"){
                                        if($rests == "all"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }else if($rests == "credit"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }else if($rests == "cash"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }
                                }else{
                                        //graph reports goes here ...
                                }
                        }
                }else if($rf == "monthly"){
                        if($ro == "Guest"){
                                if($ri == "Table"){
                                        if($rests == "all"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }else if($rests == "credit"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }else if($rests == "cash"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }
                                }else{
                                        //graph reports goes here ...
                                }
                        }else if($ro == "noneguest"){
                                if($ri == "Table"){
                                        if($rests == "all"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }else if($rests == "credit"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }else if($rests == "cash"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }
                                }else{
                                        //graph reports goes here ...
                                }
                        }else if($ro == "income"){
                                if($ri == "Table"){
                                        if($rests == "all"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }else if($rests == "credit"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }else if($rests == "cash"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }
                                }else{
                                        //graph reports goes here ...
                                }
                        }else if($ro == "noneguestincome"){
                                if($ri == "Table"){
                                        if($rests == "all"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }else if($rests == "credit"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }else if($rests == "cash"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }
                                }else{
                                        //graph reports goes here ...
                                }
                        }
                }else if($rf == "yearly"){
                        if($ro == "Guest"){
                                if($ri == "Table"){
                                        if($rests == "all"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }else if($rests == "credit"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }else if($rests == "cash"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }
                                }else{
                                        //graph reports goes here ...
                                }
                        }else if($ro == "noneguest"){
                                if($ri == "Table"){
                                        if($rests == "all"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }else if($rests == "credit"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }else if($rests == "cash"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }
                                }else{
                                        //graph reports goes here ...
                                }
                        }else if($ro == "income"){
                                if($ri == "Table"){
                                        if($rests == "all"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }else if($rests == "credit"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }else if($rests == "cash"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }
                                }else{
                                        //graph reports goes here ...
                                }
                        }else if($ro == "noneguestincome"){
                                if($ri == "Table"){
                                        if($rests == "all"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }else if($rests == "credit"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }else if($rests == "cash"){
                                                if($svrt == "all"){

                                                }else if($svrt == 1){

                                                }else if($svrt == 2){

                                                }else if($svrt == 3){

                                                }else if($svrt == 4){

                                                }else if($svrt == 5){

                                                }
                                        }
                                }else{
                                        //graph reports goes here ...
                                }
                        }			
                }


        }

        public function bar(){
                return View::make('reports.bar');
        }

        function barreport_display($guest,$rest,$serv,$date){
            if($guest=='Guest'&& $rest=='all'&& $serv=='all'){
                $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
            }elseif ($guest=='Guest'&& $rest=='cash'&& $serv=='all') {
                $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('paymentmode','cash')
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
            
        }elseif($guest=='Guest'&& $rest=='credit'&& $serv=='all'){
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('paymentmode','credit')
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&& $rest=='all'&& $serv==1) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',1)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='all'&&$serv==2) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='all'&&$serv==3) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='all'&&$serv==4) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='all'&&$serv==5) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==1) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==2) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==3) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==4) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==5) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==1) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==2) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==3) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==4) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==5) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='noneguest'&&$rest=='credit'&&$serv=='all') {
            $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->where('date',$date)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsales',$data);
        }elseif ($guest=='noneguest'&&$rest=='credit'&&$serv==1) {
            $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->where('date',$date)
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsalesd',$data);
        }elseif ($guest=='noneguest'&&$rest=='credit'&&$serv==2) {
            $res=DB::table('drinksales')->select('*')
                    ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->where('date',$date)
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsalesd',$data);
        }elseif ($guest=='noneguest'&&$rest=='credit'&&$serv==3) {
            $res=DB::table('drinksales')->select('*')
                    ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->where('date',$date)
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsalesd',$data);
        }elseif ($guest=='noneguest'&&$rest=='credit'&&$serv==4) {
            $res=DB::table('drinksales')->select('*')
                    ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->where('date',$date)
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsalesd',$data);
        }elseif ($guest=='noneguest'&&$rest=='credit'&&$serv==5) {
            $res=DB::table('drinksales')->select('*')
                    ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->where('date',$date)
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsalesd',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv=='all') {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==1) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==2) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==3) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==4) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==5) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv=='all') {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('paymentmode',$rest)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==1) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==2) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==3) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==4) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==5) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv=='all') {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('paymentmode',$rest)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==1) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==2) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==3) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==4) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==5) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date',$date)
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='credit'&&$serv=='all') {
            $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->where('date',$date)
                        ->get(array(
                            '*',
                            DB::raw('SUM(bars.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='credit'&&$serv==1) {
            $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->where('date',$date)
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(bars.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='credit'&&$serv==2) {
             $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->where('date',$date)
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(bars.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='credit'&&$serv==3) {
             $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->where('date',$date)
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(bars.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='credit'&&$serv==4) {
             $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->where('date',$date)
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(bars.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='credit'&&$serv==5) {
             $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->where('date',$date)
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(bars.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }
        }
        function barreport_weekly_display($guest,$rest,$serv,$start_date,$end_date){
           if($guest=='Guest'&& $rest=='all'&& $serv=='all'){
                $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
            }elseif ($guest=='Guest'&& $rest=='cash'&& $serv=='all') {
                $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('paymentmode','cash')
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
            
        }elseif($guest=='Guest'&& $rest=='credit'&& $serv=='all'){
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('paymentmode','credit')
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&& $rest=='all'&& $serv==1) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',1)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='all'&&$serv==2) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='all'&&$serv==3) {
           $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='all'&&$serv==4) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='all'&&$serv==5) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==1) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==2) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==3) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==4) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==5) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==1) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==2) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==3) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==4) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==5) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='noneguest'&&$rest=='credit'&&$serv=='all') {
            $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksale.drink')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsalesd',$data);
        }elseif ($guest=='noneguest'&&$rest=='credit'&&$serv==1) {
            $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksale.drink')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsalesd',$data);
        }elseif ($guest=='noneguest'&&$rest=='credit'&&$serv==2) {
            $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksale.drink')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsalesd',$data);
        }elseif ($guest=='noneguest'&&$rest=='credit'&&$serv==3) {
            $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksale.drink')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsalesd',$data);
        }elseif ($guest=='noneguest'&&$rest=='credit'&&$serv==4) {
            $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksale.drink')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsalesd',$data);
        }elseif ($guest=='noneguest'&&$rest=='credit'&&$serv==5) {
            $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksale.drink')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsalesd',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv=='all') {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==1) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==2) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==3) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==4) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==5) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv=='all') {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('paymentmode',$rest)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==1) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==2) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==3) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==4) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==5) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv=='all') {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                       ->whereBetween('date',array($start_date,$end_date))
                        ->where('paymentmode',$rest)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==1) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==2) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==3) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==4) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==5) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='credit'&&$serv=='all') {
            $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->get(array(
                            '*',
                            DB::raw('SUM(bars.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='credit'&&$serv==1) {
             $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->whereBetween('date',array($start_date,$end_date))
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(bars.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='credit'&&$serv==2) {
             $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->whereBetween('date',array($start_date,$end_date))
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(bars.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='credit'&&$serv==3) {
             $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->whereBetween('date',array($start_date,$end_date))
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(bars.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='credit'&&$serv==4) {
             $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->whereBetween('date',array($start_date,$end_date))
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(bars.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='credit'&&$serv==5) {
             $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->whereBetween('date',array($start_date,$end_date))
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(bars.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }
        }
        function barreport_monthly_display($guest,$rest,$serv,$month,$year){
            if($guest=='Guest'&& $rest=='all'&& $serv=='all'){
                $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
            }elseif ($guest=='Guest'&& $rest=='cash'&& $serv=='all') {
                $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode','cash')
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
            
        }elseif($guest=='Guest'&& $rest=='credit'&& $serv=='all'){
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode','credit')
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&& $rest=='all'&& $serv==1) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',1)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='all'&&$serv==2) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='all'&&$serv==3) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='all'&&$serv==4) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='all'&&$serv==5) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==1) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==2) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==3) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==4) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==5) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==1) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==2) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==3) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                       ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==4) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==5) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='noneguest'&&$rest=='credit'&&$serv=='all') {
            $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsalesd',$data);
        }elseif ($guest=='noneguest'&&$rest=='credit'&&$serv==1) {
            $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsalesd',$data);
        }elseif ($guest=='noneguest'&&$rest=='credit'&&$serv==2) {
            $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsalesd',$data);
        }elseif ($guest=='noneguest'&&$rest=='credit'&&$serv==3) {
            $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                       ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsalesd',$data);
        }elseif ($guest=='noneguest'&&$rest=='credit'&&$serv==4) {
            $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsalesd',$data);
        }elseif ($guest=='noneguest'&&$rest=='credit'&&$serv==5) {
            $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsalesd',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv=='all') {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==1) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==2) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==3) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                       ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==4) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==5) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv=='all') {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==1) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==2) {
           $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                       ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==3) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==4) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==5) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv=='all') {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                       ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==1) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                       ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==2) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==3) {
           $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==4) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                       ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==5) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='credit'&&$serv=='all') {
            $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->get(array(
                            '*',
                            DB::raw('SUM(bars.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='credit'&&$serv==1) {
             $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(bars.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='credit'&&$serv==2) {
             $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(bars.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='credit'&&$serv==3) {
             $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(bars.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='credit'&&$serv==4) {
             $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(bars.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='credit'&&$serv==5) {
             $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(bars.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }
        }
        function barreport_year_display($guest,$rest,$serv,$year){
            if($guest=='Guest'&& $rest=='all'&& $serv=='all'){
                $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
            }elseif ($guest=='Guest'&& $rest=='cash'&& $serv=='all') {
                $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode','cash')
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
            
        }elseif($guest=='Guest'&& $rest=='credit'&& $serv=='all'){
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode','credit')
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&& $rest=='all'&& $serv==1) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',1)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='all'&&$serv==2) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='all'&&$serv==3) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='all'&&$serv==4) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='all'&&$serv==5) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==1) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==2) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==3) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==4) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==5) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==1) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==2) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==3) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                       ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==4) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==5) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportd',$data);
        }elseif ($guest=='noneguest'&&$rest=='credit'&&$serv=='all') {
            $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->where('date','LIKE','%'.$year.'%')
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsalesd',$data);
        }elseif ($guest=='noneguest'&&$rest=='credit'&&$serv==1) {
            $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsalesd',$data);
        }elseif ($guest=='noneguest'&&$rest=='credit'&&$serv==2) {
            $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsalesd',$data);
        }elseif ($guest=='noneguest'&&$rest=='credit'&&$serv==3) {
            $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                       ->where('date','LIKE','%'.$year.'%')
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsalesd',$data);
        }elseif ($guest=='noneguest'&&$rest=='credit'&&$serv==4) {
            $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsalesd',$data);
        }elseif ($guest=='noneguest'&&$rest=='credit'&&$serv==5) {
            $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsalesd',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv=='all') {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==1) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==2) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==3) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                       ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==4) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==5) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv=='all') {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==1) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==2) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                       ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==3) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==4) {
           $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==5) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv=='all') {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                       ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==1) {
           $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                       ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==2) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==3) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==4) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                       ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==5) {
            $res=DB::table('barbills')->select('*')
                        ->join('guests','guests.id', '=' ,'barbills.guestid')
                       ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(barbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='credit'&&$serv=='all') {
            $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                       ->where('date','LIKE','%'.$year.'%')
                        ->get(array(
                            '*',
                            DB::raw('SUM(bars.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='credit'&&$serv==1) {
            $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->where('date','LIKE','%'.$year.'%')
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(bars.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='credit'&&$serv==2) {
            $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->where('date','LIKE','%'.$year.'%')
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(bars.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='credit'&&$serv==3) {
            $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                       ->where('date','LIKE','%'.$year.'%')
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(bars.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='credit'&&$serv==4) {
            $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->where('date','LIKE','%'.$year.'%')
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(bars.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='credit'&&$serv==5) {
            $res=DB::table('drinksales')->select('*')
                        ->join('bars','bars.name', '=' ,'drinksales.drink')
                        ->where('date','LIKE','%'.$year.'%')
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(bars.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcostd',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcostd',$data);
        }
            
        }
        public function laundry(){
                return View::make('reports.laundry');
        }
        function laundry_day($guest,$laud,$date){
            if($guest=='Guest'&& $laud=='all'){
                $res=DB::table('laundrylist')->select('*')
                        ->join('guests','guests.id','=','laundrylist.gid')
                        ->where('laundrylist.date',$date)
                        ->get();
                $data['laud']=$res;
                return View::make('reports.laundryreport',$data);
            }elseif($guest=='Guest'&& $laud==1){
                $res=DB::table('laundrylists')->select('*')
                        ->join('laundrylist','laundrylist.gid','=','laundrylists.gid')
                        ->where('laundrylists.date',$date)
                        ->where('category',$laud)
                        ->get();
                $data['laud']=$res;
                return View::make('reports.laundryreport1',$data);
            }elseif($guest=='Guest'&& $laud==2){
                $res=DB::table('laundrylists')->select('*')
                    ->join('laundrylist','laundrylist.gid','=','laundrylists.gid')
                    ->where('laundrylists.date',$date)
                    ->where('category',$laud)
                        ->get();
                $data['laud']=$res;
                return View::make('reports.laundryreport1',$data);
            }elseif($guest=='Guest'&& $laud==3){
                $res=DB::table('laundrylists')->select('*')
                    ->join('laundrylist','laundrylist.gid','=','laundrylists.gid')
                    ->where('laundrylists.date',$date)
                    ->where('category',$laud)
                        ->get();
                $data['laud']=$res;
                return View::make('reports.laundryreport1',$data);
            }elseif($guest=='noneguest' && $laud=='all'){
                  $res=DB::table('salesLaundrylits')->select('*')
                      ->join('customerCost','customerCost.customerName','=','salesLaundrylits.name')
                       ->where('customerCost.date',$date)->get();
                   $data['laud']=$res;
                return View::make('reports.salesLaundryreport',$data);
            }elseif($guest=='noneguest' && $laud==1){
                $res=DB::table('salesLaundrylits')->select('*')
                    ->join('customerCost','customerCost.customerName','=','salesLaundrylits.name')
                    ->where('customerCost.date',$date)
                    ->where('category',$laud)->get();
                $data['laud']=$res;
                return View::make('reports.salesLaundryreport',$data);
            }elseif($guest=='noneguest' && $laud==2){
                $res=DB::table('salesLaundrylits')->select('*')
                    ->join('customerCost','customerCost.customerName','=','salesLaundrylits.name')
                    ->where('customerCost.date',$date)
                    ->where('category',$laud)->get();
                $data['laud']=$res;
                return View::make('reports.salesLaundryreport',$data);
            }elseif($guest=='noneguest' && $laud==2){
                $res=DB::table('salesLaundrylits')->select('*')
                    ->join('customerCost','customerCost.customerName','=','salesLaundrylits.name')
                    ->where('customerCost.date',$date)
                    ->where('category',$laud)->get();
                $data['laud']=$res;
                return View::make('reports.salesLaundryreport',$data);
            }elseif($guest=='income'&& $laud=='all'){
                $res=DB::table('laundrylist')
                        ->where('date',$date)
                        ->get(array(
                        '*',
                        DB::raw('SUM(totalprice)AS totalprice')
                    ));
                  if($res){
                     foreach($res as $row){
                         $data=array(
                             'totalprice'=>$row->totalprice
                         );
                     }
               return View::make('reports.laundrycost',$data);
                  }else{
                      $data=array(
                          'totalprice'=>''
                      );
               return View::make('reports.laundrycost',$data);
                  }
             }elseif($guest=='noneguestincome'&& $laud=='all'){
                $res=DB::table('customerCost')
                        ->where('date',$date)
                        ->get(array(
                        '*',
                        DB::raw('SUM(totalprice)AS totalprice')
                    ));
                if($res){
                    foreach($res as $row){
                        $data=array(
                            'totalprice'=>$row->totalprice
                        );
                    }
                    return View::make('reports.laundrycost',$data);
                }else{
                    $data=array(
                        'totalprice'=>''
                    );
                    return View::make('reports.laundrycost',$data);
                }
            }
        }
    function laundry_week($guest,$laud,$start_date,$end_date){
            if($guest=='Guest'&& $laud=='all'){
                $res=DB::table('laundrylist')->select('*')
                    ->join('guests','guests.id','=','laundrylist.gid')
                        ->whereBetween('laundrylist.date',array($start_date,$end_date))
                        ->get();
                $data['laud']=$res;
                return View::make('reports.laundryreport',$data);
            }elseif($guest=='Guest'&& $laud==1){
                $res=DB::table('laundrylists')->select('*')
                    ->join('laundrylist','laundrylist.gid','=','laundrylists.gid')
                        ->whereBetween('laundrylist.date',array($start_date,$end_date))
                        ->where('category',$laud)
                        ->get();
                $data['laud']=$res;
                return View::make('reports.laundryreport1',$data);
            }elseif($guest=='Guest'&& $laud==2){
                $res=DB::table('laundrylists')->select('*')
                    ->join('laundrylist','laundrylist.gid','=','laundrylists.gid')
                    ->whereBetween('laundrylist.date',array($start_date,$end_date))
                        ->where('category',$laud)
                        ->get();
                $data['laud']=$res;
                return View::make('reports.laundryreport1',$data);
            }elseif($guest=='Guest'&& $laud==3){
                $res=DB::table('laundrylists')->select('*')
                    ->join('laundrylist','laundrylist.gid','=','laundrylists.gid')
                    ->whereBetween('laundrylist.date',array($start_date,$end_date))
                        ->where('category',$laud)
                        ->get();
                $data['laud']=$res;
                return View::make('reports.laundryreport1',$data);
            }elseif($guest=='noneguest' && $laud=='all'){
                $res=DB::table('salesLaundrylits')->select('*')
                    ->join('customerCost','customerCost.customerName','=','salesLaundrylits.name')
                    ->whereBetween('customerCost.date',array($start_date,$end_date))->get();
                    $data['laud']=$res;
                return View::make('reports.salesLaundryreport',$data);
            }elseif($guest=='noneguest' && $laud==1){
                $res=DB::table('salesLaundrylits')->select('*')
                ->join('customerCost','customerCost.customerName','=','salesLaundrylits.name')
                    ->whereBetween('customerCost.date',array($start_date,$end_date))
                    ->where('category',$laud)->get();
                $data['laud']=$res;
                return View::make('reports.salesLaundryreport',$data);
            }elseif($guest=='noneguest' && $laud==2){
                $res=DB::table('salesLaundrylits')->select('*')
                    ->join('customerCost','customerCost.customerName','=','salesLaundrylits.name')
                    ->whereBetween('customerCost.date',array($start_date,$end_date))
                    ->where('category',$laud)->get();
                $data['laud']=$res;
                return View::make('reports.salesLaundryreport',$data);
            }elseif($guest=='noneguest' && $laud==3){
                $res=DB::table('salesLaundrylits')->select('*')
                    ->join('customerCost','customerCost.customerName','=','salesLaundrylits.name')
                    ->whereBetween('customerCost.date',array($start_date,$end_date))
                    ->where('category',$laud)->get();
                $data['laud']=$res;
                return View::make('reports.salesLaundryreport',$data);
            }elseif($guest=='income' && $laud=='all'){
                $res=DB::table('laundrylist')
                    ->whereBetween('date',array($start_date,$end_date))
                    ->get(array(
                        '*',
                        DB::raw('SUM(totalprice)AS totalprice')
                    ));
                if($res){
                    foreach($res as $row){
                        $data=array(
                            'totalprice'=>$row->totalprice
                        );
                    }
                    return View::make('reports.laundrycost',$data);
                }else{
                    $data=array(
                        'totalprice'=>''
                    );
                    return View::make('reports.laundrycost',$data);
                }
            }elseif($guest=='noneguestincome'&& $laud=='all'){
                $res=DB::table('customerCost')
                    ->whereBetween('date',array($start_date,$end_date))
                    ->get(array(
                        '*',
                        DB::raw('SUM(totalprice)AS totalprice')
                    ));
                if($res){
                    foreach($res as $row){
                        $data=array(
                            'totalprice'=>$row->totalprice
                        );
                    }
                    return View::make('reports.laundrycost',$data);
                }else{
                    $data=array(
                        'totalprice'=>''
                    );
                    return View::make('reports.laundrycost',$data);
                }
            }
        }
        function laundry_month($guest,$laud,$month,$year){
            if($guest=='Guest'&& $laud=='all'){
                $res=DB::table('laundrylist')->select('*')
                    ->join('guests','guests.id','=','laundrylist.gid')
                        ->where('laundrylist.date','like','%'.$month.'%')
                        ->where('laundrylist.date','LIKE','%'.$year.'%')
                        ->get();
                $data['laud']=$res;
                return View::make('reports.laundryreport',$data);
            }elseif($guest=='Guest'&& $laud==1){
                $res=DB::table('laundrylists')->select('*')
                    ->join('laundrylist','laundrylist.gid','=','laundrylists.gid')
                        ->where('laundrylist.date','like','%'.$month.'%')
                        ->where('laundrylist.date','LIKE','%'.$year.'%')
                        ->where('category',$laud)
                        ->get();
                $data['laud']=$res;
                return View::make('reports.laundryreport1',$data);
            }elseif($guest=='Guest'&& $laud==2){
                $res=DB::table('laundrylists')->select('*')
                    ->join('laundrylist','laundrylist.gid','=','laundrylists.gid')
                        ->where('laundrylist.date','like','%'.$month.'%')
                        ->where('alaundrylist.date','LIKE','%'.$year.'%')
                        ->where('category',$laud)
                        ->get();
                $data['laud']=$res;
                return View::make('reports.laundryreport1',$data);
            }elseif($guest=='Guest'&& $laud==3){
                $res=DB::table('laundrylists')->select('*')
                    ->join('laundrylist','laundrylist.gid','=','laundrylists.gid')
                        ->where('laundrylist.date','like','%'.$month.'%')
                        ->where('laundrylist.date','LIKE','%'.$year.'%')
                        ->where('category',$laud)
                        ->get();
                $data['laud']=$res;
                return View::make('reports.laundryreport1',$data);
            }elseif($guest=='noneguest' && $laud=='all'){
                $res=DB::table('salesLaundrylits')->select('*')
                    ->join('customerCost','customerCost.customerName','=','salesLaundrylits.name')
                    ->where('customerCost.date','like','%'.$month.'%')
                    ->where('customerCost.date','LIKE','%'.$year.'%')
                    ->get();
                $data['laud']=$res;
                return View::make('reports.salesLaundryreport',$data);
            }elseif($guest=='noneguest' && $laud==1){
                $res=DB::table('salesLaundrylits')->select('*')
                    ->join('customerCost','customerCost.customerName','=','salesLaundrylits.name')
                    ->where('customerCost.date','like','%'.$month.'%')
                    ->where('customerCost.date','LIKE','%'.$year.'%')
                    ->where('category',$laud)
                    ->get();
                $data['laud']=$res;
                return View::make('reports.salesLaundryreport',$data);
            }elseif($guest=='noneguest' && $laud==2){
                $res=DB::table('salesLaundrylits')->select('*')
                    ->join('customerCost','customerCost.customerName','=','salesLaundrylits.name')
                    ->where('customerCost.date','like','%'.$month.'%')
                    ->where('customerCost.date','LIKE','%'.$year.'%')
                    ->where('category',$laud)
                    ->get();
                $data['laud']=$res;
                return View::make('reports.salesLaundryreport',$data);
            }elseif($guest=='noneguest' && $laud==3){
                $res=DB::table('salesLaundrylits')->select('*')
                    ->join('customerCost','customerCost.customerName','=','salesLaundrylits.name')
                    ->where('customerCost.date','like','%'.$month.'%')
                    ->where('customerCost.date','LIKE','%'.$year.'%')
                    ->where('category',$laud)
                    ->get();
                $data['laud']=$res;
                return View::make('reports.salesLaundryreport',$data);
            }elseif($guest=='income' && $laud=='all'){
                $res=DB::table('laundrylist')
                        ->where(' date','like','%'.$month.'%')
                        ->where(' date','LIKE','%'.$year.'%')
                    ->get(array(
                        '*',
                        DB::raw('SUM(totalprice)AS totalprice')
                    ));
                if($res){
                    foreach($res as $row){
                        $data=array(
                            'totalprice'=>$row->totalprice
                        );
                    }
                    return View::make('reports.laundrycost',$data);
                }else{
                    $data=array(
                        'totalprice'=>''
                    );
                    return View::make('reports.laundrycost',$data);
                }
            }elseif($guest=='noneguestincome'&& $laud=='all'){
                $res=DB::table('customerCost')
                        ->where(' date','like','%'.$month.'%')
                        ->where(' date','LIKE','%'.$year.'%')
                    ->get(array(
                        '*',
                        DB::raw('SUM(totalprice)AS totalprice')
                    ));
                if($res){
                    foreach($res as $row){
                        $data=array(
                            'totalprice'=>$row->totalprice
                        );
                    }
                    return View::make('reports.laundrycost',$data);
                }else{
                    $data=array(
                        'totalprice'=>''
                    );
                    return View::make('reports.laundrycost',$data);
                }
            }
        }
    function laundry_year($guest,$laud,$year){
            if($guest=='Guest'&& $laud=='all'){
                $res=DB::table('laundrylist')->select('*')
                    ->join('guests','guests.id','=','laundrylist.gid')
                    ->where('laundrylist.date','LIKE','%'.$year.'%')
                    ->get();
                $data['laud']=$res;
                return View::make('reports.laundryreport',$data);
            }elseif($guest=='Guest'&& $laud==1){
                $res=DB::table('laundrylists')->select('*')
                    ->join('laundrylist','laundrylist.gid','=','laundrylists.gid')
                       ->where('laundrylist.date','LIKE','%'.$year.'%')
                        ->where('category',$laud)
                        ->get();
                $data['laud']=$res;
                return View::make('reports.laundryreport1',$data);
            }elseif($guest=='Guest'&& $laud==2){
                $res=DB::table('laundrylists')->select('*')
                    ->join('laundrylist','laundrylist.gid','=','laundrylists.gid')
                    ->where('laundrylist.date','LIKE','%'.$year.'%')
                    ->where('category',$laud)
                    ->get();
                $data['laud']=$res;
                return View::make('reports.laundryreport1',$data);
            }elseif($guest=='Guest'&& $laud==3){
                $res=DB::table('laundrylists')->select('*')
                    ->join('laundrylist','laundrylist.gid','=','laundrylists.gid')
                    ->where('laundrylist.date','LIKE','%'.$year.'%')
                    ->where('category',$laud)
                    ->get();
                $data['laud']=$res;
                return View::make('reports.laundryreport1',$data);
            }elseif($guest=='noneguest' && $laud=='all'){
                $res=DB::table('salesLaundrylits')->select('*')
                    ->join('customerCost','customerCost.customerName','=','salesLaundrylits.name')
                    ->where('customerCost.date','LIKE','%'.$year.'%')
                    ->get();
                $data['laud']=$res;
                return View::make('reports.salesLaundryreport',$data);
            }elseif($guest=='noneguest' && $laud==1){
                $res=DB::table('salesLaundrylits')->select('*')
                    ->join('customerCost','customerCost.customerName','=','salesLaundrylits.name')
                    ->where('customerCost.date','LIKE','%'.$year.'%')
                    ->where('category',$laud)
                    ->get();
                $data['laud']=$res;
                return View::make('reports.salesLaundryreport',$data);
            }elseif($guest=='noneguest' && $laud==2){
                $res=DB::table('salesLaundrylits')->select('*')
                    ->join('customerCost','customerCost.customerName','=','salesLaundrylits.name')
                    ->where('customerCost.date','LIKE','%'.$year.'%')
                    ->where('category',$laud)
                    ->get();
                $data['laud']=$res;
                return View::make('reports.salesLaundryreport',$data);
            }elseif($guest=='noneguest' && $laud==2){
                $res=DB::table('salesLaundrylits')->select('*')
                    ->join('customerCost','customerCost.customerName','=','salesLaundrylits.name')
                    ->where('customerCost.date','LIKE','%'.$year.'%')
                    ->where('category',$laud)
                    ->get();
                $data['laud']=$res;
                return View::make('reports.salesLaundryreport',$data);
            }elseif($guest=='income' && $laud=='all'){
                $res=DB::table('laundrylist')
                    ->where(' date','LIKE','%'.$year.'%')
                    ->get(array(
                        '*',
                        DB::raw('SUM(totalprice)AS totalprice')
                    ));
                if($res){
                    foreach($res as $row){
                        $data=array(
                            'totalprice'=>$row->totalprice
                        );
                    }
                    return View::make('reports.laundrycost',$data);
                }else{
                    $data=array(
                        'totalprice'=>''
                    );
                    return View::make('reports.laundrycost',$data);
                }
            }elseif($guest=='noneguestincome'&& $laud=='all'){
                $res=DB::table('customerCost')
                    ->where(' date','LIKE','%'.$year.'%')
                    ->get(array(
                        '*',
                        DB::raw('SUM(totalprice)AS totalprice')
                    ));
                if($res){
                    foreach($res as $row){
                        $data=array(
                            'totalprice'=>$row->totalprice
                        );
                    }
                    return View::make('reports.laundrycost',$data);
                }else{
                    $data=array(
                        'totalprice'=>''
                    );
                    return View::make('reports.laundrycost',$data);
                }
            }
        }
        function report_display($guest,$rest,$serv,$date){
            if($guest=='Guest'&& $rest=='all'&& $serv=='all'){
                $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
            }elseif ($guest=='Guest'&& $rest=='cash'&& $serv=='all') {
                $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('paymentmode','cash')
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
            
        }elseif($guest=='Guest'&& $rest=='credit'&& $serv=='all'){
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('paymentmode','credit')
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&& $rest=='all'&& $serv==1) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',1)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='all'&&$serv==2) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='all'&&$serv==3) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='all'&&$serv==4) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='all'&&$serv==5) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==1) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==2) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==3) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==4) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==5) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==1) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==2) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==3) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==4) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==5) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='noneguest'&&$rest=='cash'&&$serv=='all') {
            $res=DB::table('foodsales')->select('*')
                        ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->where('date',$date)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsales',$data);
        }elseif ($guest=='noneguest'&&$rest=='cash'&&$serv==1) {
            $res=DB::table('foodsales')->select('*')
                        ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->where('date',$date)
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsales',$data);
        }elseif ($guest=='noneguest'&&$rest=='cash'&&$serv==2) {
            $res=DB::table('foodsales')->select('*')
                    ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->where('date',$date)
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsales',$data);
        }elseif ($guest=='noneguest'&&$rest=='cash'&&$serv==3) {
            $res=DB::table('foodsales')->select('*')
                    ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->where('date',$date)
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsales',$data);
        }elseif ($guest=='noneguest'&&$rest=='cash'&&$serv==4) {
            $res=DB::table('foodsales')->select('*')
                    ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->where('date',$date)
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsales',$data);
        }elseif ($guest=='noneguest'&&$rest=='cash'&&$serv==5) {
            $res=DB::table('foodsales')->select('*')
                    ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->where('date',$date)
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsales',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv=='all') {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==1) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==2) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==3) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==4) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==5) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv=='all') {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('paymentmode',$rest)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==1) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==2) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==3) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==4) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==5) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv=='all') {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('paymentmode',$rest)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==1) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==2) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==3) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==4) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==5) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date',$date)
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='cash'&&$serv=='all') {
            $res=DB::table('foodsales')->select('*')
                        ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->where('date',$date)
                        ->get(array(
                            '*',
                            DB::raw('SUM(restaurants.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='cash'&&$serv==1) {
            $res=DB::table('foodsales')->select('*')
                        ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->where('date',$date)
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(restaurants.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='cash'&&$serv==2) {
            $res=DB::table('foodsales')->select('*')
                        ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->where('date',$date)
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(restaurants.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='cash'&&$serv==3) {
            $res=DB::table('foodsales')->select('*')
                        ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->where('date',$date)
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(restaurants.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='cash'&&$serv==4) {
            $res=DB::table('foodsales')->select('*')
                        ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->where('date',$date)
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(restaurants.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='cash'&&$serv==5) {
            $res=DB::table('foodsales')->select('*')
                        ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->where('date',$date)
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(restaurants.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }
        }
        function report_weekly_display($guest,$rest,$serv,$start_date,$end_date){
           if($guest=='Guest'&& $rest=='all'&& $serv=='all'){
                $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
            }elseif ($guest=='Guest'&& $rest=='cash'&& $serv=='all') {
                $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('paymentmode','cash')
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
            
        }elseif($guest=='Guest'&& $rest=='credit'&& $serv=='all'){
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('paymentmode','credit')
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&& $rest=='all'&& $serv==1) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',1)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='all'&&$serv==2) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='all'&&$serv==3) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='all'&&$serv==4) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='all'&&$serv==5) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==1) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==2) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==3) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==4) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==5) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==1) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==2) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==3) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==4) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==5) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='noneguest'&&$rest=='cash'&&$serv=='all') {
            $res=DB::table('foodsales')->select('*')
                        ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsales',$data);
        }elseif ($guest=='noneguest'&&$rest=='cash'&&$serv==1) {
            $res=DB::table('foodsales')->select('*')
                        ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsales',$data);
        }elseif ($guest=='noneguest'&&$rest=='cash'&&$serv==2) {
            $res=DB::table('foodsales')->select('*')
                    ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsales',$data);
        }elseif ($guest=='noneguest'&&$rest=='cash'&&$serv==3) {
            $res=DB::table('foodsales')->select('*')
                    ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsales',$data);
        }elseif ($guest=='noneguest'&&$rest=='cash'&&$serv==4) {
            $res=DB::table('foodsales')->select('*')
                    ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsales',$data);
        }elseif ($guest=='noneguest'&&$rest=='cash'&&$serv==5) {
            $res=DB::table('foodsales')->select('*')
                    ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsales',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv=='all') {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==1) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==2) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==3) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==4) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==5) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv=='all') {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('paymentmode',$rest)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==1) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==2) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==3) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==4) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==5) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv=='all') {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                       ->whereBetween('date',array($start_date,$end_date))
                        ->where('paymentmode',$rest)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==1) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==2) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==3) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==4) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==5) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='cash'&&$serv=='all') {
            $res=DB::table('foodsales')->select('*')
                        ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->whereBetween('date',array($start_date,$end_date))
                        ->get(array(
                            '*',
                            DB::raw('SUM(restaurants.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='cash'&&$serv==1) {
            $res=DB::table('foodsales')->select('*')
                        ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->whereBetween('date',array($start_date,$end_date))
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(restaurants.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='cash'&&$serv==2) {
            $res=DB::table('foodsales')->select('*')
                        ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->whereBetween('date',array($start_date,$end_date))
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(restaurants.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='cash'&&$serv==3) {
            $res=DB::table('foodsales')->select('*')
                        ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->whereBetween('date',array($start_date,$end_date))
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(restaurants.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='cash'&&$serv==4) {
            $res=DB::table('foodsales')->select('*')
                        ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->whereBetween('date',array($start_date,$end_date))
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(restaurants.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='cash'&&$serv==5) {
            $res=DB::table('foodsales')->select('*')
                        ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->whereBetween('date',array($start_date,$end_date))
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(restaurants.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }
        }
        function report_monthly_display($guest,$rest,$serv,$month,$year){
            if($guest=='Guest'&& $rest=='all'&& $serv=='all'){
                $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
            }elseif ($guest=='Guest'&& $rest=='cash'&& $serv=='all') {
                $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode','cash')
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
            
        }elseif($guest=='Guest'&& $rest=='credit'&& $serv=='all'){
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode','credit')
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&& $rest=='all'&& $serv==1) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',1)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='all'&&$serv==2) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='all'&&$serv==3) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='all'&&$serv==4) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='all'&&$serv==5) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==1) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==2) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==3) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==4) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==5) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==1) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==2) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==3) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                       ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==4) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==5) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='noneguest'&&$rest=='cash'&&$serv=='all') {
            $res=DB::table('foodsales')->select('*')
                        ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsales',$data);
        }elseif ($guest=='noneguest'&&$rest=='cash'&&$serv==1) {
            $res=DB::table('foodsales')->select('*')
                        ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsales',$data);
        }elseif ($guest=='noneguest'&&$rest=='cash'&&$serv==2) {
            $res=DB::table('foodsales')->select('*')
                    ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsales',$data);
        }elseif ($guest=='noneguest'&&$rest=='cash'&&$serv==3) {
            $res=DB::table('foodsales')->select('*')
                    ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                       ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsales',$data);
        }elseif ($guest=='noneguest'&&$rest=='cash'&&$serv==4) {
            $res=DB::table('foodsales')->select('*')
                    ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsales',$data);
        }elseif ($guest=='noneguest'&&$rest=='cash'&&$serv==5) {
            $res=DB::table('foodsales')->select('*')
                    ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsales',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv=='all') {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==1) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==2) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==3) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                       ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==4) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==5) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv=='all') {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==1) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==2) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                       ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==3) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==4) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==5) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv=='all') {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                       ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==1) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                       ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==2) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==3) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==4) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                       ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==5) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='cash'&&$serv=='all') {
            $res=DB::table('foodsales')->select('*')
                        ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                        ->get(array(
                            '*',
                            DB::raw('SUM(restaurants.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='cash'&&$serv==1) {
            $res=DB::table('foodsales')->select('*')
                        ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(restaurants.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='cash'&&$serv==2) {
            $res=DB::table('foodsales')->select('*')
                        ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(restaurants.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='cash'&&$serv==3) {
            $res=DB::table('foodsales')->select('*')
                        ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(restaurants.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='cash'&&$serv==4) {
            $res=DB::table('foodsales')->select('*')
                        ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(restaurants.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='cash'&&$serv==5) {
            $res=DB::table('foodsales')->select('*')
                        ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->where('date','like','%'.$month.'%')
                        ->where('date','LIKE','%'.$year.'%')
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(restaurants.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }
        }
        function report_year_display($guest,$rest,$serv,$year){
            if($guest=='Guest'&& $rest=='all'&& $serv=='all'){
                $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
            }elseif ($guest=='Guest'&& $rest=='cash'&& $serv=='all') {
                $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode','cash')
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
            
        }elseif($guest=='Guest'&& $rest=='credit'&& $serv=='all'){
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode','credit')
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&& $rest=='all'&& $serv==1) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',1)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='all'&&$serv==2) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='all'&&$serv==3) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='all'&&$serv==4) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='all'&&$serv==5) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==1) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==2) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==3) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==4) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='cash'&&$serv==5) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==1) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==2) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==3) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                       ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==4) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='Guest'&&$rest=='credit'&&$serv==5) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                         ->where('paymentmode',$rest)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportz',$data);
        }elseif ($guest=='noneguest'&&$rest=='cash'&&$serv=='all') {
            $res=DB::table('foodsales')->select('*')
                        ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->where('date','LIKE','%'.$year.'%')
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsales',$data);
        }elseif ($guest=='noneguest'&&$rest=='cash'&&$serv==1) {
            $res=DB::table('foodsales')->select('*')
                        ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsales',$data);
        }elseif ($guest=='noneguest'&&$rest=='cash'&&$serv==2) {
            $res=DB::table('foodsales')->select('*')
                    ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsales',$data);
        }elseif ($guest=='noneguest'&&$rest=='credit'&&$serv==3) {
            $res=DB::table('foodsales')->select('*')
                    ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                       ->where('date','LIKE','%'.$year.'%')
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsales',$data);
        }elseif ($guest=='noneguest'&&$rest=='cash'&&$serv==4) {
            $res=DB::table('foodsales')->select('*')
                    ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsales',$data);
        }elseif ($guest=='noneguest'&&$rest=='cash'&&$serv==5) {
            $res=DB::table('foodsales')->select('*')
                    ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('service',$serv)
                        ->get();
                $data['gz']=$res;
                return View::make('reports.restaurantsreportsales',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv=='all') {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==1) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==2) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==3) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                       ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==4) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='all'&&$serv==5) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv=='all') {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==1) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==2) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                       ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==3) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==4) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='cash'&&$serv==5) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv=='all') {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                       ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==1) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                       ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==2) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==3) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                        ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==4) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                       ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='income'&&$rest=='credit'&&$serv==5) {
            $res=DB::table('foodbills')->select('*')
                        ->join('guests','guests.id', '=' ,'foodbills.guestid')
                       ->where('date','LIKE','%'.$year.'%')
                        ->where('paymentmode',$rest)
                        ->where('servicetime',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(foodbills.amount) AS amount')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->amount
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='cash'&&$serv=='all') {
            $res=DB::table('foodsales')->select('*')
                        ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                       ->where('date','LIKE','%'.$year.'%')
                        ->get(array(
                            '*',
                            DB::raw('SUM(restaurants.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='cash'&&$serv==1) {
            $res=DB::table('foodsales')->select('*')
                        ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->where('date','LIKE','%'.$year.'%')
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(restaurants.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='cash'&&$serv==2) {
            $res=DB::table('foodsales')->select('*')
                        ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->where('date','LIKE','%'.$year.'%')
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(restaurants.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='cash'&&$serv==3) {
            $res=DB::table('foodsales')->select('*')
                        ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                       ->where('date','LIKE','%'.$year.'%')
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(restaurants.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='credit'&&$serv==4) {
            $res=DB::table('foodsales')->select('*')
                        ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->where('date','LIKE','%'.$year.'%')
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(restaurants.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }elseif ($guest=='noneguestincome'&&$rest=='cash'&&$serv==5) {
            $res=DB::table('foodsales')->select('*')
                        ->join('restaurants','restaurants.name', '=' ,'foodsales.food')
                        ->where('date','LIKE','%'.$year.'%')
                         ->where('service',$serv)
                        ->get(array(
                            '*',
                            DB::raw('SUM(restaurants.cost) AS cost')
                        ));
                        foreach ($res as $row){
                            $data=array(
                                'amount'=>$row->cost
                            );
                     return View::make('reports.restaurantsreportcost',$data);
                        }
                        $data=array(
                                'amount'=>'No money collected'
                            );
                      return View::make('reports.restaurantsreportcost',$data);
        }
            
        }
}

