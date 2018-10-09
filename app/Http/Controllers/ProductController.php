<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class ProductController extends Controller
{
    public function importcsv()
    {
        return view('product');
    }

    public function importdb(Request $request)
    {
        $file = $request->file('sample_file');
        if ($file) {
            $path = $file->getRealPath();
            $data = Excel::load($path, function ($reader) {
            })->get();
            if (!empty($data) && $data->count()) {
                $nhaMang = [
                    'Viettel' => ['0162', '0163', '0164', '0165', '0166', '0167', '0168', '0169', '096', '097', '098', '0868'],
                    'Vinaphone' => ['0123', '0124', '0125', '0127', '0129', '091', '094', '088'],
                    'Mobifone' => ['0120', '0121', '0122', '0126', '0128', '090', '093', '089'],
                    'Vietnammobile' => ['092', '0188', '0186'],
                    'G-Mobile' => ['099', '0199']
                ];
                $ten = '';
                foreach ($data as $key => $value) {
                    $sdt = $value->callee;
                    foreach ($nhaMang as $tenNhaMnag => $vals) {
                        $first = substr($sdt, 0, 1);
                        if ($first == '0') { //0
                            foreach ($vals as $v) {
                                if (strpos($sdt, $v) !== false) {
                                    $ten = $tenNhaMnag;
                                    break;
                                }
                            };
                        } else { //84
                            $sdt_new = '0' . substr($sdt, 2, strlen($sdt));
                            foreach ($vals as $v2) {
                                if (strpos($sdt_new, $v2) !== false) {
                                    $ten = $tenNhaMnag;
                                    break;
                                }
                            }
                        }
                    }
                    $arr[] = ['caller' => $value->caller, 'callee' => $value->callee, 'duration' => $value->duration, 'time' => $value->time, 'cost' => $value->cost, 'telco' => $ten];
                }
            }
            if (!empty($arr)) {
                DB::table('product')->insert($arr);
                  dd('Insert Record successfully.');
            }
        }
    }
}
