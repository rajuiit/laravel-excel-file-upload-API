<?php
   
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;
use function MongoDB\BSON\toJSON;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use App\User;
use App\Finaluser;
use DB;

class ImportController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $client;
    public function importExportView()
    {
       
      //HTTP Request Receive
      // $results = Http::get('http://ecafela.com/excel-file-api/public/import');
       //dd($results);
       //$results=$results[0];
       //return view('import',compact('results'));

        return view('import');
     
    }
   
    public function import() 
    {
          //HTTP Request Receive
      $results = Http::get('http://ecafela.com/excel-file-api/public/import');
       //dd($results);
      $results=$results[0];
      //dd($results);
       //return view('import',compact('results'));
     //First delete all user from local table and insert data from API
      DB::table('users')->delete();

      Excel::import(new UsersImport,request()->file('file'));
        //return back();
      $datas=User::all();
      
      //$matchingresult=array_diff($results,$data);
      //print_r($matchingresult);
        //dd($data);

     foreach ($datas as $data) {

         foreach ($results as $result) {

            
               

            if ($data->post_code == $result['post_code']   &&  $data->phone_number == $result['phone_number']) {
                        
                        //echo $data->post_code;
                        //echo $data->phone_number;



                DB::table('finalusers')->insertOrIgnore(
                              ['id' =>$data->id,'name' =>$data->name,'post_code' =>$data->post_code, 'phone_number' =>$data->phone_number]
                               );

                return redirect()
                        ->back()
                        ->with('success', 'CSV File Uploaded Successfully');

                    

                }
    }

    }
}
}