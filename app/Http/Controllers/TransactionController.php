<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        // "type" => "expense"
        // "category" => "3"
        // "sale_price" => "20000"
        // "note" => "makan bakso"

        $now = Carbon::now();
        $new_transaction = new Transaction();
        $new_transaction->type = $request->type;
        $new_transaction->category_id = $request->category;
        $new_transaction->amount = $request->amount;
        $new_transaction->note = $request->note;
        $new_transaction->verificator_id = null;
        $new_transaction->created_at = $request->tanggal;
        $new_transaction->save();

        return redirect()->back()->with('sukses', 'Berhasil menambahkan transaksi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function formcatat()
    {
        $category = Category::where('type', 'income')->get();

        return view('cashflow.formcatat', compact('category'));
    }
    public function indexincome()
    {
        $income = Transaction::where('type', 'income')->get();

        return view('cashflow.indexincome', compact('income'));
    }
    public function indexexpense()
    {
        $expense = Transaction::where('type', 'expense')->get();

        return view('cashflow.indexexpense', compact('expense'));
    }

    public function get_type(Request $request)
    {
        $category = Category::where('type', $request->tipe)->get();
        // $data = DB::select("SELECT DISTINCT year(created_at) as year FROM purchase_invoices WHERE deleted_at is null;");
        // dd($request->tipe);

        return response()->json(array(
            'msg' => view('cashflow.transaction-category', compact('category'))->render(),
        ), 200);
    }

    public function dashboard()
    {
        $totalincome = DB::select("SELECT sum(amount) as total FROM `transactions` WHERE `verified_at` is not null and `verificator_id`is not null and `deleted_at`is null and type='income';");
        $totalexpense = DB::select("SELECT sum(amount) as total FROM `transactions` WHERE `verified_at` is not null and `verificator_id`is not null and `deleted_at`is null and type='expense';");
        $balance = $totalincome[0]->total - $totalexpense[0]->total;
        // dd($balance);

        $incomeunverified = DB::select("SELECT * FROM `transactions` WHERE `verified_at` is  null and `verificator_id`is  null and `deleted_at`is null and type='income';");
        $expenseunverified = DB::select("SELECT * FROM `transactions` WHERE `verified_at` is  null and `verificator_id`is  null and `deleted_at`is null and type='expense';");
        $incomecategory = Category::where('type', 'income')->get();
        $expensecategory = Category::where('type', 'expense')->get();

        \DB::statement("SET SQL_MODE=''"); //karena kena error 1055

        $incomepercategory = DB::select("select MONTHNAME(created_at) as bulan, sum(amount) as total from transactions where type='income' and EXTRACT(year FROM created_at) = YEAR(CURDATE()) and deleted_at is null and verificator_id is not null and verified_at is not null and category_id=1 GROUP BY MONTH(created_at);");
        $expensepercategory = DB::select("select MONTHNAME(created_at) as bulan, sum(amount) as total from transactions where type='expense' and EXTRACT(year FROM created_at) = YEAR(CURDATE()) and deleted_at is null and verificator_id is not null and verified_at is not null and category_id=3 GROUP BY MONTH(created_at);");

        // dd($incomeunverified);
        // $data = DB::select("SELECT DISTINCT year(created_at) as year FROM purchase_invoices WHERE deleted_at is null;");
        // dd($request->tipe);

        return view('cashflow.dashboard', compact('balance', 'incomeunverified', 'expenseunverified', 'incomecategory', 'expensecategory', 'incomepercategory', 'expensepercategory'));
    }

    public function incomepercategory(Request $request)
    {
        \DB::statement("SET SQL_MODE=''"); //karena kena error 1055
        $incomepercategory = DB::select("select MONTHNAME(created_at) as bulan, sum(amount) as total from transactions where type='income' and EXTRACT(year FROM created_at) = YEAR(CURDATE()) and deleted_at is null and verificator_id is not null and verified_at is not null and category_id=$request->category GROUP BY MONTH(created_at);");

        return response()->json(array(
            'msg' => view('cashflow.incomepercategory', compact('incomepercategory'))->render(),
        ), 200);
    }

    public function expensepercategory(Request $request)
    {
        \DB::statement("SET SQL_MODE=''"); //karena kena error 1055
        $expensepercategory = DB::select("select MONTHNAME(created_at) as bulan, sum(amount) as total from transactions where type='expense' and EXTRACT(year FROM created_at) = YEAR(CURDATE()) and deleted_at is null and verificator_id is not null and verified_at is not null and category_id=$request->category GROUP BY MONTH(created_at);");
        // DD($expensepercategory);
        return response()->json(array(
            'msg' => view('cashflow.expensepercategory', compact('expensepercategory'))->render(),
        ), 200);
    }

    public function delete_data_ajax_income(Request $request)
    {

        $transaction = Transaction::find($request->id);
        try {
            $transaction->delete();
            return response()->json(array(
                'status' => "sukses",
                'msg' => "Data berhasil dihapus"
            ), 200);
        } catch (\PDOException $e) {
            $message = "Gagal menghapus data. Pastikan data child sudah terhapus atau sudah tidak berhubungan terlebih dahulu.";
            return response()->json(array(
                'status' => "gagal",
                'msg' => $message
            ), 200);
        }
    }
    public function verif_data_ajax_income(Request $request)
    {

        $transaction = Transaction::find($request->id);
        try {
            $transaction->verificator_id = Auth::user()->id;
            $date = date('Y-m-d h:i:s');
            $transaction->verified_at = $date;
            $transaction->save();
            return response()->json(array(
                'status' => "sukses",
                'msg' => "Data berhasil diverif"
            ), 200);
        } catch (\PDOException $e) {
            $message = "Gagal memverifikasi data";
            return response()->json(array(
                'status' => "gagal",
                'msg' => $message
            ), 200);
        }
    }

 
   
}
