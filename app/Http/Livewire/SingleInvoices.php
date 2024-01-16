<?php

namespace App\Http\Livewire;

use App\Models\Doctor;
use App\Models\FondAccount;
use App\Models\Patient;
use App\Models\Patient_account;
use App\Models\Service;
use App\Models\single_invoices;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SingleInvoices extends Component
{
    public $InvoiceUpdated, $InvoiceSaved;
    public $show_table = true;
    public $tax_rate = 17;
    public $updateMode = false;
    public $discount_value = 0 ;
    public $price , $patient_id , $doctor_id , $section_id , $type , $single_invoice_id  , $Service_id ;

    public function render()
    {
        return view('livewire.single_invoices.single-invoices',[
            'single_invoices' => single_invoices::all(),
            'Patients' => Patient::all(),
            'Doctors' => Doctor::where('status',1)->get(),
            'Services' => Service::all(),
            'subtotal' => $total_after_discount = ((is_numeric($this->price) ? $this->price : 0)) - ((is_numeric($this->discount_value) ? $this->discount_value : 0)),
            'tax_value' => $total_after_discount * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100),
        ]);
    }
    public function show_form_add(){
        $this->show_table = false;
        $this->InvoiceUpdated = false;
        $this->InvoiceSaved = false;
    }

    public function get_section(){
        $doctors_id = Doctor::with('section')->where('id', $this->doctor_id)->first();
        $this->section_id = $doctors_id->section->name;
    }
    public function get_price(){
        $service = Service::findorfail($this->Service_id);
        $this->price = $service->price;
    }

    public function edit($id){
        try{

            $this->show_table = false;
            $this->updateMode = true;
            $this->InvoiceUpdated = false;
            $this->InvoiceSaved = false;
            $single_invoices = single_invoices::findorfail($id);
            $this->single_invoice_id = $single_invoices->id ;
            $this->patient_id = $single_invoices->patient_id;
            $this->doctor_id = $single_invoices->doctor_id  ;
            $this->section_id = DB::table('section_translations')->where('id', $single_invoices->section_id)->first()->name;
            $this->Service_id = $single_invoices->service_id ;
            $this->price = $single_invoices->price ;
            $this->discount_value = $single_invoices->discount_value;
            $this->tax_rate = $single_invoices->tax_rate;
            $this->price = $single_invoices->price;
            $this->discount_value = $single_invoices->discount_value;
            $this->type = $single_invoices->type;
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function store(){

        //في حال كانت الفاتورة نقدي
        if($this->type == 1){

            DB::beginTransaction();
            try{
                // تعديل الفاتورة نقدي
                if($this->updateMode){
                        //تعديل في جدول الفواتير
                        $single_invoices = single_invoices::findorfail($this->single_invoice_id);
                        $single_invoices->date = date('Y-m-d') ;
                        $single_invoices->patient_id = $this->patient_id ;
                        $single_invoices->doctor_id = $this->doctor_id ;
                        $single_invoices->section_id = DB::table('section_translations')->where('name', $this->section_id)->first()->section_id;
                        $single_invoices->service_id = $this->Service_id ;
                        $single_invoices->price = $this->price ;
                        $single_invoices->discount_value = $this->discount_value ;
                        $single_invoices->tax_rate = $this->tax_rate ;
                        // قيمة الضريبة = السعر - الخصم * نسبة الضريبة /100
                        $single_invoices->tax_value = ($this->price - $this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
                        // الاجمالي شامل الضريبة  = السعر - الخصم + قيمة الضريبة
                        $single_invoices->total_with_tax = $single_invoices->price -  $single_invoices->discount_value + $single_invoices->tax_value;
                        $single_invoices->type = $this->type ;
                        $single_invoices->save();

                    // تعديل في جدول الصندوق
                    $found_accounts = FondAccount::where('single_invoice_id',$this->single_invoice_id)->first();
                    $found_accounts->date = date('Y-m-d');
                    $found_accounts->single_invoice_id = $single_invoices->id ;
                    $found_accounts->Dabit = $single_invoices->total_with_tax ;
                    $found_accounts->credit = 0.00 ;
                    $found_accounts->save();

                    $this->InvoiceUpdated = true;
                    $this->show_table = true;

                }
                // حفظ الفاتورة نقدي
                else{
                    //حفظ في جدول الفواتير
                    $single_invoices = new single_invoices();
                    $single_invoices->date = date('Y-m-d') ;
                    $single_invoices->patient_id = $this->patient_id ;
                    $single_invoices->doctor_id = $this->doctor_id ;
                    $single_invoices->section_id = DB::table('section_translations')->where('name', $this->section_id)->first()->section_id;
                    $single_invoices->service_id = $this->Service_id ;
                    $single_invoices->price = $this->price ;
                    $single_invoices->discount_value = $this->discount_value ;
                    $single_invoices->tax_rate = $this->tax_rate ;
                    // قيمة الضريبة = السعر - الخصم * نسبة الضريبة /100
                    $single_invoices->tax_value = ($this->price - $this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
                    // الاجمالي شامل الضريبة  = السعر - الخصم + قيمة الضريبة
                    $single_invoices->total_with_tax = $single_invoices->price -  $single_invoices->discount_value + $single_invoices->tax_value;
                    $single_invoices->type = $this->type ;
                    $single_invoices->save();

                    // حفظ في جدول الصندوق
                    $found_accounts = new FondAccount();
                    $found_accounts->date = date('Y-m-d');
                    $found_accounts->single_invoice_id = $single_invoices->id ;
                    $found_accounts->Dabit = $single_invoices->total_with_tax ;
                    $found_accounts->credit = 0.00 ;
                    $found_accounts->save();

                    $this->InvoiceSaved = true;
                    $this->show_table = true;
                }
                DB::commit();
            }

            catch( \Exception $e ){
                DB::rollback();
                return redirect()->back()->withErrors([ 'error' => $e->getMessage() ]);

            }
        }

        // في حال كانت الفاتورة اجل
        else{
            DB::beginTransaction();
            try{
                // تعديل الفاتورة اجل
                if($this->updateMode){

                    $single_invoices =  single_invoices::findorfail($this->single_invoice_id);
                    $single_invoices->date = date('Y-m-d') ;
                    $single_invoices->patient_id = $this->patient_id ;
                    $single_invoices->doctor_id = $this->doctor_id ;
                    $single_invoices->section_id = DB::table('section_translations')->where('name', $this->section_id)->first()->section_id;
                    $single_invoices->service_id = $this->Service_id ;
                    $single_invoices->price = $this->price ;
                    $single_invoices->discount_value = $this->discount_value ;
                    $single_invoices->tax_rate = $this->tax_rate ;
                    // قيمة الضريبة = السعر - الخصم * نسبة الضريبة /100
                    $single_invoices->tax_value = ($this->price - $this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
                    // الاجمالي شامل الضريبة  = السعر - الخصم + قيمة الضريبة
                    $single_invoices->total_with_tax = $single_invoices->price -  $single_invoices->discount_value + $single_invoices->tax_value;
                    $single_invoices->type = $this->type ;
                    $single_invoices->save();

                    // تعديل في حسابات المريض
                    $patient_account = Patient_account::where('single_invoice_id', $single_invoices->id )->first();
                    $patient_account->date = date('Y-m-d') ;
                    $patient_account->single_invoice_id = $single_invoices->id ;
                    $patient_account->patient_id = $single_invoices->patient_id ;
                    $patient_account->Dabit = $single_invoices->total_with_tax ;
                    $patient_account->credit =0.00 ;
                    $patient_account->save() ;

                    $this->InvoiceUpdated = true;
                    $this->show_table = true;
                }
                // حفظ الفاتورة اجل
                else{
                    //حفظ في جدول الفواتير
                    $single_invoices = new single_invoices();
                    $single_invoices->date = date('Y-m-d') ;
                    $single_invoices->patient_id = $this->patient_id ;
                    $single_invoices->doctor_id = $this->doctor_id ;
                    $single_invoices->section_id = DB::table('section_translations')->where('name', $this->section_id)->first()->section_id;
                    $single_invoices->service_id = $this->Service_id ;
                    $single_invoices->price = $this->price ;
                    $single_invoices->discount_value = $this->discount_value ;
                    $single_invoices->tax_rate = $this->tax_rate ;
                    // قيمة الضريبة = السعر - الخصم * نسبة الضريبة /100
                    $single_invoices->tax_value = ($this->price - $this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
                    // الاجمالي شامل الضريبة  = السعر - الخصم + قيمة الضريبة
                    $single_invoices->total_with_tax = $single_invoices->price -  $single_invoices->discount_value + $single_invoices->tax_value;
                    $single_invoices->type = $this->type ;
                    $single_invoices->save();

                    // حفظ في حسابات المريض
                    $patient_account = new Patient_account();
                    $patient_account->date = date('Y-m-d') ;
                    $patient_account->single_invoice_id = $single_invoices->id ;
                    $patient_account->patient_id = $single_invoices->patient_id ;
                    $patient_account->Dabit = $single_invoices->total_with_tax ;
                    $patient_account->credit =0.00 ;
                    $patient_account->save() ;

                    $this->InvoiceSaved = true;
                    $this->show_table = true;
                }
                DB::commit();
            }

            catch( \Exception $e ){
                DB::rollback();
                return redirect()->back()->withErrors([ 'error' => $e->getMessage() ]);

            }
        }
    }


    public function delete($id){

        $this->single_invoice_id = $id;
    }

    public function destroy(){
        try{

            single_invoices::destroy($this->single_invoice_id);
            return redirect()->to('/single_invoices');
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
