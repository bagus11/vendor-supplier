<div class="form-step">
               
    <div class="grid xs:grid-cols-1 md:grid-cols-6 gap-3 ">
         <div class="input-group col-span-3" style="padding-top:10px">
             <label for="numberPKP">No Pengukuhan PKP</label>
             <input type="text" name="numberPKP" id="numberPKP">
             <span  style="color:red;" class="message_error text-red block numberPKP_error"></span>
         </div>
         <div class="input-group col-span-3">
             <label for="supplier_siup">File Pengukuhan</label>
             <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="pengukuhan_attachment" placeholder="Enter Supplier NPWP" name="pengukuhan_attachment">
             <span  style="color:red;" class="message_error text-red block pengukuhan_attachment_error"></span>
         </div>
        
     </div>
    <div class="grid xs:grid-cols-1 md:grid-cols-6 gap-3 ">
         <div class="input-group col-span-3" style="padding-top:10px">
             <label for="numberNPWP">No NPWP</label>
             <input type="number"  pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==16) return false;" name="numberNPWP" id="numberNPWP">
             <span  style="color:red;" class="message_error text-red block numberNPWP_error"></span>
         </div>
         <div class="input-group col-span-3">
             <label for="numberNPWP_attachment">File NPWP</label>
             <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="npwp_attachment" placeholder="Enter Supplier NPWP" name="npwp_attachment">
             <span  style="color:red;" class="message_error text-red block npwp_attachment_error"></span>
         </div>
        
     </div>
    <div class="grid xs:grid-cols-1 md:grid-cols-6 gap-3 ">
         <div class="input-group col-span-3">
             <div class="input-group">
                     <label for="supplier_siup">Nama NPWP</label>
                     <input type="text" name="nameNPWP" id="nameNPWP">
                     <span  style="color:red;" class="message_error text-red block nameNPWP_error"></span>
             </div>
         </div>
         <div class="input-group col-span-3">
             <div class="input-group">
                 <label for="addressNPWP">Alamat NPWP</label>
                 <div class="textwrapper">
                     <textarea cols="1" rows="2" id="addressNPWP" style="border-radius: 5px !important;"></textarea>
                 </div>
                 <span  style="color:red;" class="message_error text-red block addressNPWP_error"></span>
             </div>
         </div>
     </div>
    <div class="grid xs:grid-cols-1 md:grid-cols-6 gap-3 ">
         <div class="input-group col-span-3">
             <label for="supplier_siup">Company Profile</label>
             <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="cp_attachment" placeholder="Enter Supplier NPWP" name="cp_attachment">
             <span  style="color:red;" class="message_error text-red block cp_attachment_error"></span>
         </div>
         <div class="input-group col-span-3">
             <label for="supplier_siup">Surat Keterangan Terdaftar</label>
             <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="skt_attachment" placeholder="Enter Supplier NPWP" name="skt_attachment">
             <span  style="color:red;" class="message_error text-red block skt_attachment_error"></span>
         </div>
        
     </div>
     
     <div class="container mt-2">
         <label for="">Kelengkapan ISO</label>
         <div class="input-group" style="margin-left: 20px">
             @foreach($master_iso as $row)
             <div class="grid grid-cols-3 lg:grid-cols-6 md:grid-cols-6 lg:grid-cols-6 xl:grid-cols-6 gap-3 ">
             <div class="col-span-1">
                 <label for="">{{$row->ISO}}</label>
                 <input type="hidden" value="{{$row->id}}" class="iso_master_id">
             </div>
             <div class="col-span-1">
                 <label for="cc" style="font-size: 12px">
                     <input type="checkbox" class="diterapkan" name="diterapkan">
                     Diterapkan                  
                 </label>
             </div>
             <div class="col-span-1">
                 <label for="cc" style="font-size: 12px">
                     <input type="checkbox" class="tersertifikasi" name="tersertifikasi">
                   Tersertifikasi                  
                 </label>
             </div>
             </div>
             @endforeach
         </div>
     </div>


     <div class="btns-group">
         <a href="#" class="btn btn-prev">Previous</a>
         <a href="#" class="btn btn-next" id="next_3">Next</a>
     </div>
 </div>