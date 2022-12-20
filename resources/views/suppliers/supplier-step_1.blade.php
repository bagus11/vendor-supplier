<div class="form-step form-step-active">
    <div class="grid xs:grid-cols-1 md:grid-cols-6 gap-3 ">
        <div class="input-group col-span-2">
            <label for="supplierName">Nama Perusahaan</label>
            <input type="text" name="supplierName" id="supplierName">
            <span  style="color:red;" class="message_error text-red block supplierName_error"></span>
        </div>
        <div class="input-group col-span-1">
            <label for="supplierYearOfEstablishment">Tahun Pendirian</label>
            <input type="number" min="1800"  name="supplierYearOfEstablishment" id="supplierYearOfEstablishment">
            <span  style="color:red;" class="message_error text-red block supplierYearOfEstablishment_error"></span>
        </div>
    </div>
   <div class="grid xs:grid-cols-1 md:grid-cols-6 gap-3 ">
        <div class="input-group col-span-2">
            <label for="supplier_siup">Jenis Usaha</label>
            <select name="jenis_usaha_option" style="width:100%" class="select2" id="jenis_usaha_option">
                <option value="">Pilih Jenis Usaha</option>
               @foreach( $master_jenis_usaha as $row)
                <option value="{{$row->jenis_usaha}}"> {{$row->jenis_usaha}}</option>
               @endforeach
            </select>
            <input type="hidden" name="supplierType" id="supplierType">
            <span  style="color:red;" class="message_error text-red block supplierType_error"></span>
        </div>
        <div class="input-group col-span-1">
            <label for="supplierNumberOfEmployee">Jumlah Karyawan</label>
            <input type="number" name="supplierNumberOfEmployee" id="supplierNumberOfEmployee">
            <span  style="color:red;" class="message_error text-red block supplierNumberOfEmployee_error"></span>
           
        </div>
    </div>  
   <div class="grid xs:grid-cols-1 md:grid-cols-6 gap-3 ">
        <div class="input-group col-span-2">
            <label for="supplier_siup">Provinsi</label>
            <select class="select2" name="prov" id="prov"style="width: 100%">
                <option value="">Pilih Provinsi</option>
                @foreach($provinces as $row)
                <option value="{{$row->id}}">{{$row->provinsi}}</option>
                @endforeach
            </select>
           
        </div>
        <div class="input-group col-span-2">
            <label for="supplier_siup">Kabupaten</label>
            <select class="select2" name="kab" id="kab"style="width: 100%">
                <option value="">Pilih provinsi terlebih dahulu</option>
            </select>
           
        </div>
        <div class="input-group col-span-2">
            <label for="supplier_siup">Kecamatan</label>
            <select class="select2" name="kec" id="kec"style="width: 100%">
                <option value="">Pilih provinsi terlebih dahulu</option>
            </select>
           
        </div>
    </div>
   <div class="grid xs:grid-cols-1 md:grid-cols-6 gap-3 ">
      
        <div class="input-group col-span-2">
            <label for="supplier_siup">Kelurahan</label>
            <select class="select2" name="kel" id="kel" style="width: 100%">
                <option value="">Pilih provinsi terlebih dahulu</option>
            </select>
           
        </div>
        <div class="input-group col-span-2">
            <label for="supplier_name">Kode Pos</label>
            <input type="number" style="width: 50%; min-width:90px;text-align:center" name="kode_pos" id="kode_pos">
           
        </div>
    </div>    
   <div class="grid xs:grid-cols-1 md:grid-cols-6 gap-3 ">
        <div class="input-group col-span-4">
            <div class="input-group">
                <label for="supplierAddress">Alamat Kantor</label>
                <textarea class="shadow appearance-none border rounded w-full py-2  text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="supplierAddress"name="supplierAddress"></textarea>
                <span  style="color:red;" class="message_error text-red block supplierAddress_error"></span>
           
            </div>
        </div>
    </div>

   <div class="grid xs:grid-cols-1 md:grid-cols-6 gap-3 ">
        <div class="input-group col-span-3">
            <label for="supplier_siup">No Telpon</label>
            <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==13) return false;"name="supplierPhone" id="supplierPhone">
            <span  style="color:red;" class="message_error text-red block supplierPhone_error"></span>
        </div>
        <div class="input-group col-span-3">
            <label for="supplier_siup">Fax</label>
            <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==13) return false;" name="supplierFax" id="supplierFax">
            <span  style="color:red;" class="message_error text-red block supplierFax_error"></span>
            
        </div>
    </div>
   <div class="grid xs:grid-cols-1 md:grid-cols-6 gap-3 ">
        <div class="input-group col-span-3">
            <label for="supplier_siup">Email</label>
            <input type="text" name="supplierEmail" id="supplierEmail">
            <span  style="color:red;" class="message_error text-red block supplierEmail_error"></span>
        </div>
        <div class="input-group col-span-3">
            <label for="supplier_siup">Website</label>
            <input type="text" name="supplierWebsite" id="supplierWebsite">
            <span  style="color:red;" class="message_error text-red block supplierWebsite_error"></span>
        </div>
    </div>
    <div class="another_address"></div>
    <div class="input-group">
        <button class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" id="add_address">
            <i class="fas fa-plus"></i> Alamat Lain
        </button>
    </div>
    <div class="">
        <a href="#" id="btn_next_1" class="btn btn-next width-50 ml-auto">Next</a>
    </div>
</div>