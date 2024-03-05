<?php

namespace App\Http\Livewire;


use App\Events\CreateInvoice;
use App\Models\Doctor;
use App\Models\FondAccount;
use App\Models\Invoice;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\Patient_account;
use App\Models\Service;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class SingleInvoices extends Component
{
    public $InvoiceUpdated, $InvoiceSaved;
    public $show_table = true;
    public $tax_rate = 17;
    public $updateMode = false;
    public $discount_value = 0 ;
    public $catchError;
    public $price , $patient_id , $doctor_id , $section_id , $type , $single_invoice_id  , $Service_id ;

    public function render()
    {
        return view('livewire.single_invoices.single-invoices',[
            'single_invoices' => Invoice::where('invoice_type', 1)->get(),
            'Patients' => Patient::all(),
            'Doctors' => Doctor::where('status', 1)->get(),
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
            $single_invoices = Invoice::findorfail($id);
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
            $this->catchError = $e->getMessage();
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
                        $single_invoices = Invoice::findorfail($this->single_invoice_id);
                        $single_invoices->invoice_type = 1;
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
                    $found_accounts = FondAccount::where('invoice_id',$this->single_invoice_id)->first();
                    $found_accounts->date = date('Y-m-d');
                    $found_accounts->invoice_id = $single_invoices->id ;
                    $found_accounts->Dabit = $single_invoices->total_with_tax ;
                    $found_accounts->credit = 0.00 ;
                    $found_accounts->save();

                    $this->InvoiceUpdated = true;
                    $this->show_table = true;

                }
                // حفظ الفاتورة نقدي
                else{
                    //حفظ في جدول الفواتير
                    $single_invoices = new Invoice();
                    $single_invoices->invoice_type = 1;
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
                    $found_accounts->invoice_id = $single_invoices->id ;
                    $found_accounts->Dabit = $single_invoices->total_with_tax ;
                    $found_accounts->credit = 0.00 ;
                    $found_accounts->save();

                    $this->InvoiceSaved = true;
                    $this->show_table = true;

                    $notefection = new Notification();
                    $notefection->user_id = $this->doctor_id ;
                    $notefection->message = "كشف جديد".Patient::find($this->patient_id)->name;
                    $notefection->save();


                    $data = [
                        'patient' => $this->patient_id ,
                        'invoice_id' => $single_invoices->id ,
                        'doctor_id' => $this->doctor_id ,
                    ];

                    event(new CreateInvoice($data));
                }
                DB::commit();
            }

            catch( Exception $e ){
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

                    $single_invoices =  Invoice::findorfail($this->single_invoice_id);
                    $single_invoices->invoice_type = 1;
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
                    $patient_account = Patient_account::where('invoice_id', $single_invoices->id )->first();
                    $patient_account->date = date('Y-m-d') ;
                    $patient_account->invoice_id = $single_invoices->id ;
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
                    $single_invoices = new Invoice();
                    $single_invoices->invoice_type = 1;
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
                    $patient_account->invoice_id = $single_invoices->id ;
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
                $this->catchError = $e->getMessage();

            }
        }
    }


    public function delete($id){

        $this->single_invoice_id = $id;
    }

    public function destroy(){
        try{

            Invoice::destroy($this->single_invoice_id);
            return redirect()->to('/single_invoices');
        }
        catch(Exception $e){
            $this->catchError = $e->getMessage();
        }

    }

    public function print($id){
       $single_invoice = Invoice::findorfail($id);
       return Redirect::route('print_single_invoices',[
        'invoice_date' => $single_invoice->invoice_date,
        'doctor_id' => $single_invoice->Doctor->name,
        'section_id' => $single_invoice->Section->name,
        'Service_id' => $single_invoice->Service->name,
        'type' => $single_invoice->type,
        'price' => $single_invoice->price,
        'discount_value' => $single_invoice->discount_value,
        'tax_rate' => $single_invoice->tax_rate,
        'total_with_tax' => $single_invoice->total_with_tax,
    ]);
    }
}
