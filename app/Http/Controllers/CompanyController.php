<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\BranchCreate;
use App\Http\Requests\CompanyCreate;
use App\Http\Requests\UserEditCreate;
use App\Http\Requests\UserAddressEditCreate;
use App\Http\Requests\CompanyEditProfileCreate;
use App\Http\Requests\CompanyEditCompanyCreate;
use App\Http\Requests\CompanyEditAddressCreate;
use App\Branch;
use App\Company;
use App\ContactCompany;
use App\People;
use App\User;
use App\Customer;



class CompanyController extends Controller
{
    
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function companyShow(){
        $role= \Auth::user()->role;
        if($role === 'Super'){
            $companies = Company::orderBy('id','ASC')->get();
            $peoples = People::orderBy('id','ASC')->get();
        
        
            return view('super.company',compact('companies','peoples'));
        } else{
            
            return redirect()->route('Home');
        }
        // $companies = Company::orderBy('id','ASC')->get();
        // $peoples = People::orderBy('id','ASC')->get();
        
        
        // return view('super.company',compact('companies','peoples'));
    }
    public function companyCreate()
    {
        return view('super.addCompany');
    }

    public function companyAdd(CompanyCreate $request)
    {
        
        //Insert users
        $users = new User;
        $users ->role= "user";
        $users ->email= $request->email;
        $users ->password= bcrypt($request->password);
        $users ->usstatus= 1;
        $users->save();
        //dd("Ya agregó al usuario, checar en la db otra vez");

        
        //Insert contact
        $contactcc = new ContactCompany;
        $contactcc->name = $request->name;
        $contactcc->lastname = $request->lastname;
        $contactcc->telephone1 = $request->telephone1;
        $contactcc->telephone2 = $request->telephone2;
        $contactcc->email = $request->email;
        $contactcc->email2 = $request->email2;
        $contactcc->area = $request->area;
        $contactcc->ccstatus = 1;
        $contactcc->save();   
        
        //Get contact id
        $ccs= ContactCompany::latest('id')->first();
        $id=$ccs->id;
        
        //Insert company
        $company = new Company;
        $company->companyrfc = $request->companyrfc;
        $company->companyname = $request->companyname;
        $company->companytelephone1 = $request->companytelephone1;
        $company->companytelephone2 = $request->companytelephone2;
        $company->companyemail1 = $request->companyemail1;
        $company->companyemail2 = $request->companyemail2;
        $company->zipcode = $request->zipcode;
        $company->district = $request->district;
        $company->street = $request->street;
        $company->insidenumber = $request->innumber;
        $company->exteriornumber = $request->extnumber;
        $company->companystatus = 1;
        $company->contact_companies_id = $id;
        $company->save();

        //Branch
        $branch = new Branch;
        $branch ->name= "Own";
        $branch ->branchtelephone1= $request->companytelephone1;
        $branch ->branchtelephone2= $request->companytelephone2;
        $branch ->branchemail1= $request->companyemail1;
        $branch ->branchemail2= $request->companyemail2;
        $branch ->zipcode= $request->zipcode;
        $branch ->district= $request->district;
        $branch ->street= $request->street;
        $branch ->insidenumber= $request->innumber;
        $branch ->exteriornumber= $request->extnumber;
        $branch ->branchstatus= 1;
        $branch->save();

        //Customer
        $com= Company::latest('id')->first();
        $br= Branch::latest('id')->first();
        $us= User::latest('id')->first();
        $customers = new Customer;
        $customers->companies_id=$com->id;
        $customers->branches_id=$br->id;
        $customers->save();
        
        // dd("Se agregaron: usuario login, contacto y empresa");
        return redirect()->route('companyShow');
        
    }

    
    public function companyEdit($id)
    {
        $compan = Company::find($id);
        $contact = ContactCompany::find($id);
        
        
        return view('super.editCompany', compact('compan','contact'));
    }
    public function showBranches($id){
        $company=$id;
        $branches = Branch::join('customers', 'customers.branches_id', '=', 'branches.id')
                ->join('companies', 'companies.id', '=', 'customers.companies_id')
                //->groupBy('branches.id','customers.branches_id','companies.id')
                ->select('branches.id','branches.name',
                'branches.zipcode','branches.district','branches.street',
                'branches.insidenumber','branches.exteriornumber')
                ->groupBy('branches.id')
                ->where('customers.companies_id', '=', $id)
                ->get();
        
        $branch1 = null;
        foreach ($branches as $branch ) {
            $branch1 = $branch->branches_id;
        }
        
        
        //$branches = Branch::join("companies_id","=",$id)->get();     
        return view('super.branches',compact('branches','company','branch1'));
    }


    public function createBranches($id){
        $company=$id;
        return view('super.addBranch',compact('company'));
    }


    public function addBranches(BranchCreate $request,$id){
        
        $branch = new Branch;
        $branch ->name= $request->name;
        $branch ->zipcode= $request->zipcode;
        $branch ->district= $request->district;
        $branch ->street= $request->street;
        $branch ->insidenumber= $request->innumber;
        $branch ->exteriornumber= $request->extnumber;
        $branch->save();

        $ided= Branch::latest('id')->first();
        $customer = new Customer;
        $customer->companies_id = $id;
        $customer->branches_id = $ided->id;
        $customer->save();

        
        $company=$id;
        
        return redirect()->route('showBranches',compact('company'));

        /*$company=$id;
        $branches = Branch::where("companies_id","=",$id)->get();     
        return view('super.branches',compact('branches','company'));*/
    }
    public function companyUpdateProfile(CompanyEditProfileCreate $request, $id)
    {
        $contact = Contact::find($id);
        $contact->name = $request->name;
        $contact->lastname = $request->lastname;
        $contact->telephone = $request->telephone;
        $contact->save();
        return redirect()->route('companyShow');

    }
    public function companyUpdateCompany(CompanyEditCompanyCreate $request, $id)
    {
        $company = Company::find($id);
        $company->companyname = $request->companyname;
        $company->companyrfc = $request->companyrfc;
        $company->companytelephone = $request->companytelephone;
        $company->save();
        return redirect()->route('companyShow');

    }
    public function companyUpdateAddress(CompanyEditAddressCreate $request, $id)
    {
        $company = Company::find($id);
        $company->zipcode = $request->zipcode;
        $company->district = $request->district;
        $company->street = $request->street;
        $company->exteriornumber = $request->extnumber;
        $company->insidenumber = $request->innumber;
        $company->save();
        return redirect()->route('companyShow');

    }

    
    
    
}
