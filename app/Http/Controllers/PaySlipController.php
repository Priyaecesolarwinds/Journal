<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DataTables,Auth;
use Illuminate\Database\PDO\Connection;
use Illuminate\Support\Facades\DB;


use function DeepCopy\deep_copy;

class PaySlipController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showForm()
    {
        return view('payslip');
    }



    public function store(Request $request)
    {
        
        try
        {
            $compName =$request->compName;
            $month =$request->month;            
            $year =$request->year;
            $processedCount=0;
            $notProcessedCount=0;
            //$pro =$request->product;      


           // $data  = User::get();
           /* $data=DB::connection('mysql_2ghrm')->table("xhs_hr_emp_tax_declaration")
            ->select('hs_hr_employee.emp_firstname','hs_hr_employee.emp_lastname','hs_hr_employee.emp_middle_name','eec_name as name', 'eec_relationship as email','eec_home_no','eec_mobile_no')
            ->join('hs_hr_employee', 'xhs_hr_emp_tax_declaration.emp_number', '=', 'hs_hr_employee.emp_number')
            ->get();*/
        
           // echo '<br>Max compName==> '.$data;
            
            echo '<br>Max month==> '.$month;
            
            echo '<br>Max year==> '.$year;
        
           // if(file_exists("/home/fv1c7vs7r1uk/public_html/vsurepayroll.in/uploadfile/phpupload/$year/$month/processed.txt"))
           if(file_exists("D:/payslip/$year/$month/processed.txt"))   
             {
                  //echo"file already exists";
                  
     return view('myTestPage')
     ->with('msg', 'Already Processed for ['.$compName.'] For  the Month '.$month.'-'.$year)
     ->with('success', 'None')
     ->with('fail', 'None');   
              }
              else{

            $currentAttachId = DB::connection('mysql_2ghrm')->table("hs_hr_emp_attachment")->max('eattach_id');  
            echo '<br>Max count==> '.$currentAttachId;
            $currentAttachId=$currentAttachId+1;
            


            //$sql = "SELECT emp_number,user_name from ohrm_user";
            $users=DB::connection('mysql_2ghrm')->table("ohrm_user")->select('emp_number', 'user_name as user_name')->get();

            $remarks =$month."-".$year." Payslip";
            $file="";
           
            $filePath="D:/payslip/$year/$month/$file";
            //$filePath="/home/fv1c7vs7r1uk/public_html/vsurepayroll.in/uploadfile/phpupload/$year/$month/$file";


             foreach($users as $ohrm_user) 
               {
                //echo $ohrm_user->emp_number.':'.$ohrm_user->user_name; // for example
                 $empNumber=$ohrm_user->emp_number;                 
                 $file = substr($ohrm_user->user_name, 2) . '.pdf';//eattach_filename
                 
                 $filePath="D:/payslip/$year/$month/$file";

//                 if( file_exists("/home/fv1c7vs7r1uk/public_html/vsurepayroll.in/uploadfile/phpupload/$year/$month/$file"))
                    if( file_exists("D:/payslip/$year/$month/$file"))
                    {
                        echo 'Payslip File Name='.$filePath."<br>";
                       // $filesize = filesize("/home/fv1c7vs7r1uk/public_html/vsurepayroll.in/uploadfile/phpupload/$year/$month/$file");
                       // $pdf_blob = fopen("/home/fv1c7vs7r1uk/public_html/vsurepayroll.in/uploadfile/phpupload/$year/$month/$file", "rb");

                        
                        $filesize = filesize("d:/payslip/$year/$month/$file");
                        $pdf_blob = fopen("d:/payslip/$year/$month/$file", "rb");
            
            
                        $content = fread($pdf_blob, $filesize);//eattach_attachment
                        $content = addslashes($content);
                        fclose($pdf_blob);
            
            //  DB::connection('mysql_2ghrm')->insert('INSERT INTO hs_hr_emp_attachment (emp_number, eattach_id, eattach_desc, eattach_filename, eattach_size,
//eattach_attachment, eattach_type, screen, attached_by, attached_by_name, attached_time) VALUES(?,?,?,?,?,?,?,?,?,?,?)',[$empNumber, $currentAttachId,$remarks, $file, $filesize, $content, 'application/pdf', 'salary', 1, 'vsurevijayadmin', now()]);          
           // DB::disconnect('foo');
           //DB::reconnect('foo');
           $insert_sql = "INSERT INTO `hs_hr_emp_attachment` (`emp_number`, `eattach_id`, `eattach_desc`, `eattach_filename`, `eattach_size`,
           `eattach_attachment`, `eattach_type`, `screen`, `attached_by`, `attached_by_name`, `attached_time`) VALUES
          ($empNumber, $currentAttachId,'$remarks', '$file', '$filesize', '$content', 'application/pdf', 'salary', 1, 'vsurevijayadmin', now());
          ";
           DB::connection('mysql_2ghrm')->insert($insert_sql);
                        echo "<hr>";                       
                        $processedCount++;
                        //echo $insert_sql;            
                    }
                    else
                    {
                        echo 'File Not Found='.$filePath."<br>";
                        $notProcessedCount++;
                    }
               
            
            }// else end , processing the data if file not there
            echo 'Processed Count'.$processedCount;    
            echo 'Processed Count'.$notProcessedCount;   
  $uploadres="$remarks,$processedCount,$notProcessedCount,$compName,$month,$year files uploaded sucessfully";
          
//$myfile=fopen("/home/fv1c7vs7r1uk/public_html/vsurepayroll.in/uploadfile/phpupload/$year/$month/processed.txt","a")or die("unable to open file");
$myfile=fopen("d:/payslip/$year/$month/processed.txt","a")or die("unable to open file");

fwrite($myfile,$uploadres);
fclose($myfile);
            
     return view('myTestPage')
     ->with('msg', 'Processed Payslip uploads Successfully For ['.$compName.'] for the Month '.$month.'-'.$year)     
     ->with('success', $processedCount)
     ->with('fail', $notProcessedCount);           
        }// else end - already processed
            
}
catch(Exception $e) 
    {
      echo 'Message: ' .$e->getMessage();
     }
     
       

}
   
}