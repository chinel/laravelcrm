<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use function redirect;
use Illuminate\Support\Facades\Auth;
use App\Contact;
use App\Staff;
use App\Task;
use App\Deal;
use App\Activity;
use Khill\Lavacharts\Lavacharts;
use Charts;



class AdminController extends Controller
{


//    public $mailchimp;
//    public $listId = '1f89208b57';
//
//
//
//    public function __construct(\Mailchimp $mailchimp)
//    {
//
//        $this->mailchimp = $mailchimp;
//
//
//
//    }

    public function register(Request $request){



      $staff_id =  Staff::select('id')->where('email','=', $request->email)->get();

      if (count($staff_id) == 0){
          Session::flash('message','Please you have not been registered to use this application');
          return redirect('/register');

      }
      else{


         $user =  new User;
         $user->email = $request->email;
         $user->password = bcrypt($request->password);
         $user->staff_id = $staff_id[0]->id;
         $user->pin = $request->pin;
         $user->save();

            /* User::create([
            'email' => $request->email,
              'password ' => $password,
              'staff_id' => $staff_id[0]->id,
              'pin' => $request->pin
          ]);*/

          Activity::create([
              'user_id' => $user->id,
              'description' => $request->email . ' just registered to use staff hub',

          ]);

          Session::flash('success','Registration successful, Login in now to use staff hub');
          return redirect('/');

      }


        


    }

    public function AdminGetStaff(){

        $staff = Staff::latest()->paginate(9);

        return view('Admin.Staff', compact('staff'));



    }


    public function AdminStaff(Request $request){

        $staff_id =  Staff::select('id')->where('email','=', $request->email)->get();

        if (count($staff_id) != 0){
            Session::flash('message','Please this Staff already exists');
            return redirect('/AdminStaff');

        }
        else {

            Staff::create($request->all());

            Session::flash('success','Successfully added Staff to use Staff hub');
            return redirect('/AdminStaff');
        }

    }


    public function AdminRemoveStaff($id){

        \DB::table('staff')->delete($id);

        Session::flash('success','Successfully deleted staff details');
        return redirect('/AdminStaff');

    }


    public function AdminBlockStaff($id){

     $staff = Staff::findOrFail($id);

     $staff->status = "blocked";

     $staff->save();

     Session::flash('success','Successfully blocked staff');
        return redirect('/AdminStaff');

    }


    public function AdminUnblockStaff($id){

        $staff = Staff::findOrFail($id);


        $staff->status = "active";
        $staff->save();

        Session::flash('success','Successfully unblocked staff');
        return redirect('/AdminStaff');

    }


    public function AdminActivities(){

        $activities = Activity::Select('users.email','description','activities.created_at as created_at')
                                ->join('users','activities.user_id','=','users.id')
                                ->latest()
                                ->paginate(10);



        return view('Admin.activities',compact('activities'));

    }


    public function AdminSearchStaff(Request $request){

        $staff = Staff::where('firstname','like','%'.$request->queryString.'%')
                        ->orWhere('lastname','like','%'.$request->queryString.'%')
                        ->paginate(9);

        return view('Admin.searchStaff',compact('staff'));

    }

    public function AdminContactDetails(){

        $contacts = Contact::latest()->paginate(9);



        return view('Admin.contact',compact('contacts'));
    }

    public function AdminContact(Request $request){

        $contact = new Contact;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->position = $request->position;
        $contact->description = $request->description;
        $contact->company_name = $request->company_name;
        $contact->company_address = $request->company_address;
        $contact->company_website = $request->company_website;
        $contact->user_id = \Auth::user()->id;
        $contact->save();

        Activity::create([
            'user_id' => \Auth::user()->id,
            'description' => \Auth::user()->email . ' just added a new contact',

        ]);

        Session::flash('message','Contact details successfully added!!');
        return redirect('/Admin/Contact');


    }

    public function AdminSearchContact(Request $request){

        $contacts = Contact::where('name','like','%'.$request->queryString.'%')->paginate(9);

        return view('Admin.searchContact',compact('contacts'));

    }

    public function AdminToDoTaskDetails(){

        $pendingTasks = Task::select('title','description','duedate','email')
                          ->join('users','tasks.user_id','=','users.id')
                          ->where('status','=','pending')->latest('tasks.updated_at')->paginate(1,['*'],'pending');


        $completedTasks =  Task::select('title','description','duedate','email')
                             ->join('users','tasks.user_id','=','users.id')

                            ->where('status','=','completed')->latest('tasks.updated_at')->paginate(2,['*'],'completed');

        return view('Admin.task',compact('pendingTasks','completedTasks'));
    }


    public function AdminDealsDetails(){

        $deals = Deal::select('title','company','stage','amount','closing_date','deals.created_at','email')
            ->join('users','deals.user_id','=','users.id')
            ->latest()->paginate(10);

        return view('Admin.deals', compact('deals'));
    }

    public function AdminContactChart(){


        $contacts = Contact::
            where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))

            ->get();

        $chart = Charts::database($contacts, 'bar', 'highcharts')

            ->title("Monthly contacts of clients for ". date('Y'))

            ->elementLabel("Total Contacts")

            ->dimensions(1000, 500)

            ->responsive(true)

            ->groupByMonth(date('Y'), true);


        return view('Admin.contactchart',compact('chart'));

    }


    public function AdminSearchContactChart(Request $request){

        $contacts = Contact::
            where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),$request->queryString)

            ->get();

        $chart = Charts::database($contacts, 'bar', 'highcharts')

            ->title("Monthly contacts of clients for ". $request->queryString)

            ->elementLabel("Total Contacts")

            ->dimensions(1000, 500)

            ->responsive(true)

            ->groupByMonth(date('Y'), true);


        return view('Admin.contactchart',compact('chart'));

    }

    public function AdminDealChart(){


        $deals = Deal::
            where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))

            ->get();

        $chart = Charts::database($deals, 'bar', 'highcharts')

            ->title("Monthly deals made")

            ->elementLabel("Total Deals")

            ->dimensions(1000, 500)

            ->responsive(true)

            ->groupByMonth(date('Y'), true);


        return view('Admin.dealschart',compact('chart'));



    }


    public function AdminSearchDealChart(Request $request){


        $deals = Deal::
            where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),$request->queryString)
            ->where('stage','=', $request->stage)
            ->get();


        $chart = Charts::database($deals, 'bar', 'highcharts')

            ->title("Monthly ".$request->stage. " deals made for ". $request->queryString)

            ->elementLabel("Total deals made")

            ->dimensions(1000, 500)

            ->responsive(true)

            ->groupByMonth(date('Y'), true);


        return view('Admin.dealschart',compact('chart'));



    }

    public function AdminTaskChart(){


        $tasks = Task::
            where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))

            ->get();

        $chart = Charts::database($tasks, 'bar', 'highcharts')

            ->title("Monthly Total number of tasks")

            ->elementLabel("Total Tasks")

            ->dimensions(1000, 500)

            ->responsive(true)

            ->groupByMonth(date('Y'), true);


        return view('Admin.taskchart',compact('chart'));
    }


    public function AdminSearchTaskChart(Request $request){


        $tasks = Task::
            where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),$request->queryString)
            ->where('status','=', $request->status)
            ->get();


        $chart = Charts::database($tasks, 'bar', 'highcharts')

            ->title("Monthly ". $request->status  ." task for ". $request->queryString)

            ->elementLabel("Total tasks")

            ->dimensions(1000, 500)

            ->responsive(true)

            ->groupByMonth(date('Y'), true);


        return view('Admin.taskchart',compact('chart'));


    }



    public function adminHome(){

        $contacts =  Contact::get();
        $tasks = Task::get();
        $deals = Deal::get();
        $staff = Staff::get();




        return view('Admin.index',compact('contacts','tasks','deals','staff'));
    }



    public function staffHome(){

        $contacts =  Contact::where('user_id','=', \Auth::user()->id)->get();
        $pendingTasks = Task::where('user_id','=', \Auth::user()->id)->where('status','=','pending')->get();
        $completedTasks =  Task::where('user_id','=', \Auth::user()->id)->where('status','=','completed')->get();
        $deals = Deal::where('user_id','=', \Auth::user()->id)->get();

        return view('Staff.index',compact('contacts','pendingTasks','completedTasks','deals'));

    }


    public function StaffContactDetails(){

        $contacts = Contact::where('user_id','=', \Auth::user()->id)->latest()->paginate(9);

        return view('Staff.contact', compact('contacts'));
    }


    public function editStaffContact($id){

        $contact = Contact::findOrFail($id);

        return view('Staff.editContact',compact('contact'));
    }


    public function updateStaffContact($id, Request $request){

        $contact = Contact::findOrFail($id);

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->position = $request->position;
        $contact->description = $request->description;
        $contact->company_name = $request->company_name;
        $contact->company_address = $request->company_address;
        $contact->company_website = $request->company_website;
        $contact->user_id = \Auth::user()->id;
        $contact->save();

        Session::flash('message','Successfully edited '. $request->name.'s record');
        return redirect('/StaffContact');

    }

    public function deleteStaffContact($id){
        \DB::table('contacts')->delete($id);

        Session::flash('message','Successfully deleted contact details');
        return redirect('/StaffContact');
    }


    public function mailStaffContact($id){

        $contact = Contact::findOrFail($id);

        return view('Staff.mailContact',compact('contact'));

    }



    // -----------    SEND EMAIL TO CONTACT PERSON ---------//
    // ---------------- HERE -------------------------------//


    public function sendMailToContact(Request $request){

      $contact = Contact::findOrFail($request->contactId);

      $personName = $contact->name;
      $subject = $request->subject;
      $message = $request->message;


                  //WRITE MAIL HERE ///



      Session::flash('message','STILL UNDER CONSTRUCTION');
      return redirect('/StaffContact');

    }

    public function StaffContact(Request $request){

        $contact = new Contact;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->position = $request->position;
        $contact->description = $request->description;
        $contact->company_name = $request->company_name;
        $contact->company_address = $request->company_address;
        $contact->company_website = $request->company_website;
        $contact->user_id = \Auth::user()->id;
        $contact->save();

        Activity::create([
            'user_id' => \Auth::user()->id,
            'description' => \Auth::user()->email . ' just added a new contact',

        ]);

      /*  $listId = getenv('MAILCHIMP_LIST_ID');

        $mailchimp = new \Mailchimp(getenv('MAILCHIMP_API_KEY'));


        try{
          $mailchimp->lists->subscribe(
              $listId,
              ['email' => $request->email]
          );

            Session::flash('message','Contact details successfully added!!');
            return redirect('/StaffContact');
        }
        catch (\Mailchimp_List_AlreadySubscribed $e){
            Session::flash('Error','Email already exists');
            return redirect('/StaffContact');
        }
        catch (\Mailchimp_Error $e){
            Session::flash('Error','Error from MailChimp');
            return redirect('/StaffContact');

        }*/


        Session::flash('message','Contact details successfully added!!');
        return redirect('/StaffContact');




    }

    public function StaffSearchContact(Request $request){

        $contacts = Contact::where('user_id','=', \Auth::user()->id)->where('name','like','%'.$request->queryString.'%')->paginate(9);

        return view('Staff.searchContact',compact('contacts'));

    }


    public function StaffToDoTaskDetails(){

        $pendingTasks = Task::where('user_id','=', \Auth::user()->id)->where('status','=','pending')->latest('updated_at')->paginate(1,['*'],'pending');

        $completedTasks =  Task::where('user_id','=', \Auth::user()->id)->where('status','=','completed')->latest('updated_at')->paginate(2,['*'],'completed');

        return view('Staff.task',compact('pendingTasks','completedTasks'));
    }

    public function StaffToDoTask(Request $request){

        $task = new Task;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->duedate = $request->duedate;
        $task->user_id = \Auth::user()->id;
        $task->save();

        Activity::create([
            'user_id' => \Auth::user()->id,
            'description' => \Auth::user()->email . ' just added a new task',

        ]);

        Session::flash('message','Successfully added task');
        return redirect('/StaffToDoTask');



    }

    public function StaffMarkTask(Request $request){
        $task = Task::findOrFail($request->id);
        $task->status = "completed";
        $task->save();

        Session::flash('message','Task successfully marked as completed');
        return redirect('/StaffToDoTask');
    }


    public function StaffDealsDetails(){

        $deals = Deal::where('user_id','=', \Auth::user()->id)->latest()->paginate(10);

        return view('Staff.deals', compact('deals'));
    }

    public function StaffAddDeal(Request $request){

        $deal = new Deal;
        $deal->title = $request->title;
        $deal->company = $request->company;
        $deal->stage = $request->stage;
        $deal->amount = $request->amount;
        $deal->closing_date = $request->closing_date;
        $deal->user_id = \Auth::user()->id;
        $deal->save();


        Activity::create([
            'user_id' => \Auth::user()->id,
            'description' => \Auth::user()->email . ' just added a new deal',

        ]);

        Session::flash('message','New deal added successfully');


        return redirect('/StaffDeals');
    }

    public function StaffContactChart(){


        $contacts = Contact::where('user_id','=', \Auth::user()->id)
                   ->where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))

            ->get();

        $chart = Charts::database($contacts, 'bar', 'highcharts')

            ->title("Monthly contacts of clients for ". date('Y'))

            ->elementLabel("Total Contacts")

            ->dimensions(1000, 500)

            ->responsive(true)

            ->groupByMonth(date('Y'), true);


        return view('Staff.contactchart',compact('chart'));

    }


    public function StaffSearchContactChart(Request $request){

        $contacts = Contact::where('user_id','=', \Auth::user()->id)
            ->where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),$request->queryString)

            ->get();

        $chart = Charts::database($contacts, 'bar', 'highcharts')

            ->title("Monthly contacts of clients for ". $request->queryString)

            ->elementLabel("Total Contacts")

            ->dimensions(1000, 500)

            ->responsive(true)

            ->groupByMonth(date('Y'), true);


        return view('Staff.contactchart',compact('chart'));

    }


    public function StaffDealChart(){


        $deals = Deal::where('user_id','=', \Auth::user()->id)
            ->where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))

            ->get();

        $chart = Charts::database($deals, 'bar', 'highcharts')

            ->title("Monthly deals made")

            ->elementLabel("Total Deals")

            ->dimensions(1000, 500)

            ->responsive(true)

            ->groupByMonth(date('Y'), true);


        return view('Staff.dealschart',compact('chart'));



    }


    public function StaffSearchDealChart(Request $request){


        $deals = Deal::where('user_id','=', \Auth::user()->id)
            ->where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),$request->queryString)
            ->where('stage','=', $request->stage)
            ->get();


        $chart = Charts::database($deals, 'bar', 'highcharts')

            ->title("Monthly ".$request->stage. " deals made for ". $request->queryString)

            ->elementLabel("Total deals made")

            ->dimensions(1000, 500)

            ->responsive(true)

            ->groupByMonth(date('Y'), true);


        return view('Staff.dealschart',compact('chart'));



    }


    public function StaffTaskChart(){


        $tasks = Task::where('user_id','=', \Auth::user()->id)
            ->where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))

            ->get();

        $chart = Charts::database($tasks, 'bar', 'highcharts')

            ->title("Monthly Total number of tasks")

            ->elementLabel("Total Tasks")

            ->dimensions(1000, 500)

            ->responsive(true)

            ->groupByMonth(date('Y'), true);


        return view('Staff.taskchart',compact('chart'));
    }


    public function StaffSearchTaskChart(Request $request){


        $tasks = Task::where('user_id','=', \Auth::user()->id)
            ->where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),$request->queryString)
            ->where('status','=', $request->status)
            ->get();


        $chart = Charts::database($tasks, 'bar', 'highcharts')

            ->title("Monthly ". $request->status  ." task for ". $request->queryString)

            ->elementLabel("Total tasks")

            ->dimensions(1000, 500)

            ->responsive(true)

            ->groupByMonth(date('Y'), true);


        return view('Staff.taskchart',compact('chart'));


    }

    public function StaffProfile(){

        $profile = Staff::where('id','=', \Auth::user()->staff_id)
                          ->get();

        return view('Staff.profile',compact('profile'));

    }




    public function resetForm(){

        return view('reset');
    }

    public function resetPassword(Request $request){

        $user = User::select('id')
                         ->where('email','=', $request->email)
                         ->where('pin','=', $request->pin)
                         ->get();


        if (count($user) == 0){
            Session::flash('message','Invalid pin and email combination');
            return redirect('/resetForm');
        }else{

            Session::flash('message1','Enter your new password');

            return view('passwordReset',compact('user'));


        }


    }

    public function updatePassword(Request $request){

        $user = User::findOrFail($request->id);



        $user->password = bcrypt($request->password);
        $user->save();

        Session::flash('success','Password reset successful, you can log in now');
        return redirect('/');

    }


    public function login(Request $request){

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){

            $status = Staff::select('status')
                                 ->where('email','=',$request->email)
                                 ->get();

            if(\Auth::user()->role == "admin"){
                return redirect('/Admin');

            }

            elseif(\Auth::user()->role == "staff" and $status[0]->status == "active" ){
                return redirect('/Staff');
            }



        }
        else{
            Session::flash('message','Invalid Login details');
            return   redirect('/');
        }
    }




    public function logout(){

        Auth::logout();
        return redirect('/');
    }


}
