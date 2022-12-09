<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
use App\Models\Admin;
use App\Models\Customer;
use Session;

class AdminController extends Controller
{
    public function index()
    {
       if(Session::has('adminLogin'))
       {
            $data = Admin::get()->first();
            return view('admins/index', compact('data'));
       }
       else
       {
            return view('admins/login');
       }
    }

    public function login(Request $request)
    {
        $user = Admin::where('adminID', '=', $request->adminID)->first();
        if($user)
        {
            $password = Admin::where('adminPass', '=', $request->adminPass)->first();
            if($password)
            {
                $request->session()->put('adminLogin', $user->adminID);
                $request->session()->put('adminName', $user->adminFullName);
                $request->session()->put('adminImage', $user->adminPhoto);
                return redirect('admins/index');
            }
            else
            {
                return back()->with('fail', 'Invalid password!');
            }
        }
        else
        {
            return back()->with('fail', 'Invalid ID!');
        }
    }

    public function logout()
    {
        if(Session::has('adminLogin'));
        Session::pull('adminLogin');
        return view('admins/login');
    }

    public function editAdmin($id)
    {
        $data = Admin::where('adminID', '=', $id)->first();
        return view('admins/admin-profile', compact('data'));
    }

    public function updateAdmin(Request $request)
    {
        $id = $request->adminID;
        Admin::where('adminID', '=', $id)->update([
            'adminID' => $request->adminID,
            'adminPass' => $request->adminPass,
            'adminFullName' => $request->adminFullName,
            'adminPhoto' => $request->adminPhoto,
        ]);
        return redirect()->back()->with('success', 'Your profile have been updated!');
    }

    public function deleteAdmin($id)
    {
        Admin::where('adminID', '=', $id)->delete();
        return view('admins.login')->with('success', 'Congratulation! You have just destroyed yourself!');
    }

    public function getProducts()
    {
        $data = Product::select('products.*','categories.categoryName')
        ->join('categories','products.categoryID', '=', 'categories.categoryID')
        ->get();

        return view('admins/products', compact('data'));
    }

    public function getCategories()
    {
        $data = Category::select('categories.*')
        ->get();

        return view('admins/categories', compact('data'));
    }

    public function getCustomers()
    {
        $data = Customer::get();
        return view('admins/customers', compact('data'));
    }

    public function editCustomer($email)
    {
        $data = Customer::where('customerEmail', '=', $email)->first();
        return view('admins/customers-edit', compact('data'));
    }
    public function updateCustomer(Request $request)
    {
        $email = $request->customerEmail;
        Customer::where('customerEmail', '=', $email)->update([
            'customerPass' => $request->customerPass,
            'customerName' => $request->customerName,
            'customerAddress' => $request->customerAddress,
            'customerPhone' => $request->customerPhone,
        ]);
        return redirect()->back()->with('success', 'Customer information update succesfully!');
    }

    public function deleteCustomer($email)
    {
        Customer::where('customerEmail', '=', $email)->delete();
        return redirect()->back()->with('success', 'Customer deleted');
    }

    public function addCustomer()
    {
        $data = Customer::get();
        return view('admins/customer-add',compact('data'));
    }

    public function saveCustomer(Request $request)
    {
        $customer = new Customer();
        $customer->customerEmail = $request->customerEmail;
        $customer->customerPass = $request->customerPass;
        $customer->customerName = $request->customerName;

        $customer->save();
        return redirect()->back()->with('success', "Customer added successfully!");
        //return redirect()->back()->with('Failed', "Product has not been added!");
    }
}
