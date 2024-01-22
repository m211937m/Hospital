<?php

namespace App\Http\Livewire;

use App\Models\Doctor;
use App\Models\FondAccount;
use App\Models\Group;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\Patient_account;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class GroupInvoices extends Component
{
    public $InvoiceUpdated, $InvoiceSaved;
    public $show_table = true;
    public $tax_rate = 17;
    public $updateMode = false;
    public $discount_value ;
    public $catchError ;
    public $price , $patient_id , $doctor_id , $section_id , $type , $Group_id  , $Service_id , $group_invoice_id ;

    public function render()
    {
        return view('livewire.group_invoices.group-invoices',[
            'group_invoices' => Invoice::where('invoice_type', 2)->get(),
            'Patients' => Patient::all(),
            'Doctors' => Doctor::where('status',1)->get(),
            'Groups' => Group::all(),
            'subtotal' => $total_after_discount = ((is_numeric($this->price) ? $this->price : 0)) - ((is_numeric($this->discount_value) ? $this->discount_value : 0)),
            'tax_value' => $total_after_discount * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100),
        ]);
    }

    public function show_form_add(){
        $this->show_table = false;
    }

    public function get_section(){
        $doctor_id = Doctor::with('section')->where('id',$this->doctor_id)->first();
        $this->section_id = $doctor_id->section->name;
    }

    public function get_price(){
       $this->price = Group::where('id',$this->Group_id)->first()->Total_before_discount;
       $this->discount_value = Group::where('id',$this->Group_id)->first()->discount_value;
       $this->tax_rate = Group::where('id',$this->Group_id)->first()->tax_rate;
    }

    public function store(){

        //في حال كانت الفاتورة نقدي
        if($this->type == 1){

            DB::beginTransaction();
            try{
                // تعديل الفاتورة نقدي
                if($this->updateMode){
                    //تعديل في جدول الفواتير
                    $Group = Invoice::findorfail($this->Group_id);
                    $Group->invoice_type = 2;
                    $Group->date = date('Y-m-d') ;
                    $Group->patient_id = $this->patient_id ;
                    $Group->doctor_id = $this->doctor_id ;
                    $Group->section_id = DB::table('section_translations')->where('name', $this->section_id)->first()->section_id;
                    $Group->Group_id = $this->Group_id ;
                    $Group->price = $this->price ;
                    $Group->discount_value = $this->discount_value ;
                    $Group->tax_rate = $this->tax_rate ;
                    // قيمة الضريبة = السعر - الخصم * نسبة الضريبة /100
                    $Group->tax_value = ($this->price - $this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
                    // الاجمالي شامل الضريبة  = السعر - الخصم + قيمة الضريبة
                    $Group->total_with_tax = $Group->price -  $Group->discount_value + $Group->tax_value;
                    $Group->type = $this->type ;
                    $Group->save();

                    // تعديل في جدول الصندوق
                    $found_accounts = FondAccount::where('invoice_id',$this->Group_id)->first();
                    $found_accounts->date = date('Y-m-d');
                    $found_accounts->invoice_id = $Group->id ;
                    $found_accounts->Dabit = $Group->total_with_tax ;
                    $found_accounts->credit = 0.00 ;
                    $found_accounts->save();

                    $this->InvoiceUpdated = true;
                    $this->show_table = true;

                }
                // حفظ الفاتورة نقدي
                else{
                    //حفظ في جدول الفواتير
                    $Group = new Invoice();
                    $Group->invoice_type = 2;
                    $Group->date = date('Y-m-d') ;
                    $Group->patient_id = $this->patient_id ;
                    $Group->doctor_id = $this->doctor_id ;
                    $Group->section_id = DB::table('section_translations')->where('name', $this->section_id)->first()->section_id;
                    $Group->Group_id = $this->Group_id ;
                    $Group->price = $this->price ;
                    $Group->discount_value = $this->discount_value ;
                    $Group->tax_rate = $this->tax_rate ;
                    // قيمة الضريبة = السعر - الخصم * نسبة الضريبة /100
                    $Group->tax_value = ($this->price - $this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
                    // الاجمالي شامل الضريبة  = السعر - الخصم + قيمة الضريبة
                    $Group->total_with_tax = $Group->price -  $Group->discount_value + $Group->tax_value;
                    $Group->type = $this->type ;
                    $Group->save();

                    // حفظ في جدول الصندوق
                    $found_accounts = new FondAccount();
                    $found_accounts->date = date('Y-m-d');
                    $found_accounts->invoice_id = $Group->id ;
                    $found_accounts->Dabit = $Group->total_with_tax ;
                    $found_accounts->credit = 0.00 ;
                    $found_accounts->save();

                    $this->InvoiceSaved = true;
                    $this->show_table = true;
                }
                DB::commit();
            }

            catch( \Exception $e ){
                DB::rollback();
                $this->catchError = $e->getMessage();

            }
        }

        // في حال كانت الفاتورة اجل
        else{
            DB::beginTransaction();
            try{
                // تعديل الفاتورة اجل
                if($this->updateMode){

                    $Group =  Invoice::findorfail($this->Group_id);
                    $Group->invoice_type = 2;
                    $Group->date = date('Y-m-d') ;
                    $Group->patient_id = $this->patient_id ;
                    $Group->doctor_id = $this->doctor_id ;
                    $Group->section_id = DB::table('section_translations')->where('name', $this->section_id)->first()->section_id;
                    $Group->Group_id = $this->Group_id ;
                    $Group->price = $this->price ;
                    $Group->discount_value = $this->discount_value ;
                    $Group->tax_rate = $this->tax_rate ;
                    // قيمة الضريبة = السعر - الخصم * نسبة الضريبة /100
                    $Group->tax_value = ($this->price - $this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
                    // الاجمالي شامل الضريبة  = السعر - الخصم + قيمة الضريبة
                    $Group->total_with_tax = $Group->price -  $Group->discount_value + $Group->tax_value;
                    $Group->type = $this->type ;
                    $Group->save();

                    // تعديل في حسابات المريض
                    $patient_account = Patient_account::where('invoice_id', $Group->id )->first();
                    $patient_account->date = date('Y-m-d') ;
                    $patient_account->invoice_id = $Group->id ;
                    $patient_account->patient_id = $Group->patient_id ;
                    $patient_account->Dabit = $Group->total_with_tax ;
                    $patient_account->credit =0.00 ;
                    $patient_account->save() ;

                    $this->InvoiceUpdated = true;
                    $this->show_table = true;
                }
                // حفظ الفاتورة اجل
                else{
                    //حفظ في جدول الفواتير
                    $Group = new Invoice();
                    $Group->invoice_type = 2;
                    $Group->date = date('Y-m-d') ;
                    $Group->patient_id = $this->patient_id ;
                    $Group->doctor_id = $this->doctor_id ;
                    $Group->section_id = DB::table('section_translations')->where('name', $this->section_id)->first()->section_id;
                    $Group->Group_id = $this->Group_id ;
                    $Group->price = $this->price ;
                    $Group->discount_value = $this->discount_value ;
                    $Group->tax_rate = $this->tax_rate ;
                    // قيمة الضريبة = السعر - الخصم * نسبة الضريبة /100
                    $Group->tax_value = ($this->price - $this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
                    // الاجمالي شامل الضريبة  = السعر - الخصم + قيمة الضريبة
                    $Group->total_with_tax = $Group->price -  $Group->discount_value + $Group->tax_value;
                    $Group->type = $this->type ;
                    $Group->save();

                    // حفظ في حسابات المريض
                    $patient_account = new Patient_account();
                    $patient_account->date = date('Y-m-d') ;
                    $patient_account->invoice_id = $Group->id ;
                    $patient_account->patient_id = $Group->patient_id ;
                    $patient_account->Dabit = $Group->total_with_tax ;
                    $patient_account->credit =0.00 ;
                    $patient_account->save() ;

                    $this->InvoiceSaved = true;
                    $this->show_table = true;
                }
                DB::commit();
            }

            catch( \Exception $e ){
                DB::rollback();
                $this->catchError = $e->getMessage();

            }
        }
    }

    public function edit($id){
        try{

            $this->show_table = false;
            $this->updateMode = true;
            $this->InvoiceUpdated = false;
            $this->InvoiceSaved = false;
            $Group = Invoice::findorfail($id);
            $this->Group_id = $Group->id ;
            $this->patient_id = $Group->patient_id;
            $this->doctor_id = $Group->doctor_id  ;
            $this->section_id = DB::table('section_translations')->where('id', $Group->section_id)->first()->name;
            $this->Service_id = $Group->service_id ;
            $this->price = $Group->price ;
            $this->discount_value = $Group->discount_value;
            $this->tax_rate = $Group->tax_rate;
            $this->price = $Group->price;
            $this->discount_value = $Group->discount_value;
            $this->type = $Group->type;
        }
        catch(\Exception $e){
           $this->catchError = $e->getMessage();
        }
    }

    public function delete($id){

        $this->group_invoice_id = $id;
    }

    public function destroy(){
        try{

            Invoice::destroy($this->group_invoice_id);
            return redirect()->to('/group_invoices');
        }
        catch(\Exception $e){
           $this->catchError = $e->getMessage();
        }

    }

    public function print($id){
        $group_invoices = Invoice::findorfail($id)->first();
        return Redirect::route('print_group_invoices',[
         'invoice_date' => $group_invoices->invoice_date,
         'doctor_id' => $group_invoices->Doctor->name,
         'section_id' => $group_invoices->Section->name,
         'Service_id' => $group_invoices->Group->name,
         'type' => $group_invoices->type,
         'price' => $group_invoices->price,
         'discount_value' => $group_invoices->discount_value,
         'tax_rate' => $group_invoices->tax_rate,
         'total_with_tax' => $group_invoices->total_with_tax,
     ]);
     }
}
