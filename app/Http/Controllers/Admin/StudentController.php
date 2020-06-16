<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Student;
use App\Imports\StudentImport;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        if($request->filled('order')){
            switch($request->order){
                case 1:
                    $column = 'created_at';
                    $direction = 'desc';
                    break;
                case 2:
                    $column = 'created_at';
                    $direction = 'asc';
                    break;
            }
        }else{
            $column = 'created_at';
            $direction = 'desc';
        }
        $models = new Student;

        if($request->ajax())
        {

            $models = $models->join('users', 'users.id', 'students.user_id')
                                ->select('users.name', 'users.username', 'students.nis', 'students.created_at')
                                ->where(function ($query) use ($request){
                                    if($request->filled('q')){
                                         $query->where('name', 'like', '%'.$request->q.'%');
                                         $query->orWhere('username', 'like', '%'.$request->q.'%');
                                    }
                                })
                                ->paginate(config('stisla.perpage'))
                                ->appends(['q' => $request->q]);
            return $this->trueResponse('List Class Room', $models);
        }
        return view('admin.student.index');
    }

    public function store(Request $request)
    {
        if ($request->file('file_excel')) {

            // menangkap file excel
		$file = $request->file('file_excel');
           try {
                Excel::import(new StudentImport(), $request->file('file_excel'));
            }catch (\Exception $e) {
                 return $this->falseResponse('error'  . $e);
            }
        }

        return $this->trueResponse('successfully upload', setFileUrl($file));
    }

}
