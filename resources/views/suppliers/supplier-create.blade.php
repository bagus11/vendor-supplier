<style>
    :root{
        --primary-color:rgb(40, 158, 197);

    }
    *,
    *::before,
    *::after{
        box-sizing: border-box
    }
   
    /* Global input */
    label{
        display: block;
        margin-bottom: 0.5rem;
    }
    input{
        display: block;
        width: 100%;
        border: 1px solid #cccccc;
        border-radius: 0.25rem;
    }
    /* Form */
    .form{
        /* width: clamp(300px, 850px, 900px); */
        width: 80%;
        margin: 0 auto;
        border: 1px solid #cccccc;
        border-radius:0.35rem;
        background-color: white;
        padding:1.5rem;
    }
    .input-group{
        margin: 0.5rem 0;
    }
    .btn{
        padding: 0.75rem;
        display: block;
        password-decoration: none;
        background-color: var(--primary-color);
        color: #f3f3f3;
        text-align: center;
        cursor: pointer;
        border-radius: 0.25rem;
        transition:0.3s;
    }
    .width-50{
        width: 50%;
    }
    .ml-auto{
        margin-left: auto;
    }
    .btn:hover{
        box-shadow: 0 0 0 2px #ffff, 0 0 0 3px var(--primary-color);
    }
    .text-center{
        text-align: center;
    }
    .btns-group{
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }
    @keyframes animate{
        from{
            transform: scale(1,0);
            opacity: 0;
        }to{
            transform: scale(1,1);
            opacity: 1;
        }
    }
    .form-step{
        display: none;
        transform-origin: top;
        animation: animate 0.5s;
        /* transition: animate 0.5s; */
    }
    .form-step-active{
        display: block;
    }
    .progressbar{
        position: relative;
        display: flex;
        justify-content: space-between;
        counter-reset: step;
        margin: 2rem 0 4rem;
    }
    .progress-step{
        width   : 2.1875rem;
        height  : 2.1875rem;
        background-color: #dcdcdc;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1;
    }
    .progress-step::before{
        counter-increment: step;
        content:counter(step);

    }
    .progressbar::before, .progress{
        content: "";
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        height: 4px;
        width: 100%;
        background-color: #dcdcdc;
        counter-reset: step;
    }
    .progress{
        background-color: var(--primary-color);
        width: 0%;
        transition: 0.5s;
    }
    .progress-step::after{
        content: attr(data-title);
        position: absolute;
        top: calc(100% + 0.5rem);
        font-size: 0.85rem;
        color: #666666;

    }
    .progress-step-active{
        background-color: var(--primary-color);
        color: #f3f3f3;
    }
    textarea{
        width: 100%
    }
    p{
        font-size: 12px;
    }
    .btn-prev{
        margin-top:20px
    }
    .btn-next{
        margin-top:20px
    }
    .btn-submit{
        margin-top:20px;
        color: var(--primary-color);
        background-color:white; 
        border: 1px solid #cccccc;
    }
  

 
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Add Supplier') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="form" id="form_serialize">
            @csrf
            <h1 class="font-semibold text-xl text-center text-gray-800 leading-tight">
                Register
            </h1>
            {{-- Progress Bar --}}
            <div class="container" style="width: 40%; min-width:250px;margin:0 auto">
                <div class="progressbar mt-6">
                    <div class="progress" id="progress">
    
                    </div>
                    <div class="progress-step progress-step-active" data-title="Profile"></div>
                    <div class="progress-step" data-title="Contact"></div>
                    <div class="progress-step" data-title="Attachment"></div>
                    <div class="progress-step" data-title="Payment"></div>
                </div>
            </div>
            {{-- Step --}}
            <div class="form-step form-step-active">
                <div class="grid grid-cols-6 gap-3">
                    <div class="input-group col-span-4">
                        <label for="nama_supplier">Nama Perusahaan</label>
                        <input type="text" name="nama_supplier" id="nama_supplier">
                        @error('nama_supplier') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="input-group col-span-2">
                        <label for="tahun_pendirian">Tahun Pendirian</label>
                        <input type="number" min="1800"  name="tahun_pendirian" id="tahun_pendirian">
                        @error('tahun_pendirian') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="grid grid-cols-6 gap-3">
                    <div class="input-group col-span-4">
                        <label for="supplier_siup">Jenis Usaha</label>
                        <input type="text" name="jenis_usaha" id="jenis_usaha">
                        @error('jenis_usaha') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="input-group col-span-2">
                        <label for="jml_karyawan">Jumlah Karyawan</label>
                        <input type="number" name="jml_karyawan" id="jml_karyawan">
                        @error('jml_karyawan') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                </div>  
                <div class="grid grid-cols-6 gap-3">
                    <div class="input-group col-span-2">
                        <label for="supplier_siup">Provinsi</label>
                        <select class="select2" name="prov" id="prov"style="width: 100%">
                            <option value="">Pilih Provinsi</option>
                            @foreach($provinces as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                        </select>
                        @error('prov') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="input-group col-span-2">
                        <label for="supplier_siup">Kabupaten</label>
                        <select class="select2" name="kab" id="kab"style="width: 100%">
                            <option value="">Please choose provinces first</option>
                        </select>
                        @error('kab') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="input-group col-span-2">
                        <label for="supplier_siup">Kecamatan</label>
                        <select class="select2" name="kec" id="kec"style="width: 100%">
                            <option value="">Please choose regencies first</option>
                        </select>
                        @error('kec') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="grid grid-cols-6 gap-3">
                  
                    <div class="input-group col-span-2">
                        <label for="supplier_siup">Kelurahan</label>
                        <select class="select2" name="kel" id="kel" style="width: 100%">
                            <option value="">Please choose districts first</option>
                        </select>
                        @error('kel') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="input-group col-span-2">
                        <label for="supplier_name">Kode Pos</label>
                        <input type="number" style="width: 50%" name="kode_pos" id="kode_pos">
                        @error('kode_pos') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                </div>    
                <div class="input-group">
                    <label for="alamat_kantor">Alamat Kantor</label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="alamat_kantor"name="alamat_kantor">
                    </textarea>
                    @error('alamat_kantor') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>

                <div class="grid grid-cols-6 gap-3">
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">No Telpon</label>
                        <input type="number" name="no_telpon" id="no_telpon">
                        @error('no_telpon') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">Fax</label>
                        <input type="number" name="no_fax" id="no_fax">
                        @error('no_fax') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="grid grid-cols-6 gap-3">
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">Email</label>
                        <input type="text" name="email" id="email">
                        @error('email') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">Website</label>
                        <input type="text" name="website" id="website">
                        @error('website') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="another_address"></div>
                <div class="input-group">
                    <button class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" id="add_address">
                <i class="fas fa-plus"></i> Address
              </button>
                </div>
                <div class="">
                    <a href="#" id="btn_next_1" class="btn btn-next width-50 ml-auto">Next</a>
                </div>
            </div>
            <div class="form-step">
              
                <div class="container" id ='contact_pic'>
                    <table class="table" id="table_pic" style="width: 100%"> 
                        <thead>
                            <tr>
                              <th>Dept</th>
                              <th>Name</th>
                              <th>Phone Number</th>
                              <th>Email</th>
                              <th></th>
                           
                            </tr>    
                        </thead> 
                        <tbody  class="dynamic_field" id="dynamic_field" >
                            <tr>
                                <td><input type="text" name ="dept_pic"  class="dept_pic"></td>
                                <td><input type="text" name ="name_pic" class ="name_pic"></td>
                                <td><input type="number" name ="phone_pic" class ="phone_pic"></td>
                                <td><input type="email" name ="email_pic" class ="email_pic"></td>
                                <td>
                                   
                                </td>
                            </tr>
                        </tbody>


                    </table>
                </div>               
                    <div class="input-group">
                        <button type="button" id="add_more" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                              </svg>
                        </button>
                    </div>
             
              
              
                <div class="btns-group">
                    <a href="#" class="btn btn-prev">Previous</a>
                    <a href="#" class="btn btn-next">Next</a>
                </div>
            </div>
            <div class="form-step">
               
                <div class="grid grid-cols-6 gap-3">
                    <div class="input-group col-span-3">
                        <label for="no_pengukuhan">No Pengukuhan PKP</label>
                        <input type="text" name="no_pengukuhan" id="no_pengukuhan">
                    </div>
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">Attachment</label>
                        <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="pengukuhan_attachment" placeholder="Enter Supplier NPWP" name="pengukuhan_attachment">
                    </div>
                   
                </div>
                <div class="grid grid-cols-6 gap-3">
                    <div class="input-group col-span-3">
                        <label for="no_npwp">No NPWP</label>
                        <input type="number" name="no_npwp" id="no_npwp">
                    </div>
                    <div class="input-group col-span-3">
                        <label for="no_npwp_attachment">Attachment</label>
                        <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="npwp_attachment" placeholder="Enter Supplier NPWP" name="npwp_attachment">
                    </div>
                   
                </div>
 
                <div class="input-group">
                        <label for="supplier_siup">Nama NPWP</label>
                        <input type="text" name="nama_npwp" id="nama_npwp">
                </div>
                <div class="grid grid-cols-6 gap-3">
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">Company Profile</label>
                        <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="cp_attachment" placeholder="Enter Supplier NPWP" name="cp_attachment">
                    </div>
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">Surat Keterangan Terdaftar</label>
                        <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="skt_attachment" placeholder="Enter Supplier NPWP" name="skt_attachment">
                    </div>
                   
                </div>
                <div class="input-group">
                    <label for="alamat_npwp">Alamat NPWP</label>
                    <div class="textwrapper">
                        <textarea cols="1" rows="2" id="alamat_npwp">
                        </textarea>
                    </div>
                </div>
                <div class="container">
                    <label for="">Kelengkapan ISO</label>
                    <div class="input-group" style="margin-left: 20px">
                        @foreach($master_iso as $row)
                        <div class="grid grid-cols-6 gap-3">
                        <div class="col-span-1">
                            <label for="">{{$row->ISO}}</label>
                            <input type="hidden" value="{{$row->id}}" class="iso_master_id">
                        </div>
                        <div class="col-span-1">
                            <label for="cc" style="font-size: 12px">
                                <input type="checkbox" class="diterapkan" name="diterapkan">
                                DiTerapkan                  
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
                    <a href="#" class="btn btn-next">Next</a>
                </div>
            </div>
          
            <div class="form-step">
                <div class="input-group">
                    <label for="bank_account">Bank Account</label>
                    <input type="text" name="bank_account" id="bank_account">
                    <span style="font-size:12px">
                       <strong>
                        example : BNI 46 (000.914.2005)
                       </strong>
                    </span>
                </div>
                <div class="grid grid-cols-6 gap-3">
                    <div class="input-group col-span-3" style="width:45%;">
                        <label for="supplier_siup">Term Of Payment</label>
                            <div class="grid grid-cols-6 gap-3" style="display:flex">
                                <div class="col-span-3">
                                    <select name="jangka_waktu" id="jangka_waktu">
                                        <option value="15">15</option>
                                        <option value="30">30</option>
                                        <option value="45">45</option>
                                        <option value="60">60</option>
                                        <option value="90">90</option>
                                    </select>
                                </div>
                                <div class="col-span-3 mt-2">
                                    <label for="">Days</label>
                                </div>
                            </div>
                           
                        </div>
                    
                </div>
               
                <div class="input-group">
                    <label for="cc" style="font-size: 12px">
                        <input type="checkbox" id ="cc">
                        Saya setuju                    
                    </label>
                </div>
                <div class="container px-6 mb-4">
                    <p>
                        Dengan ini saya menyatakan bahwa informasi yang saya berikan di atas adalah benar, apabila dikemudian hari ditemukan dan terjadi penyimpangan dalam penggunaannya, maka saya bersedia menyelesaikan sesuai dengan hukum yang berlaku.
                        <br>
                        Dan saya sebagai Penyedia Eksternal menyatakan kesediaan mengikuti aturan administrasi yang telah ditentukan dan berlaku di PT. Pralon.
                        <br>
                        Demikian surat pernyataan ini saya buat dengan sadar dab tanpa paksaan untuk dapat dipergunakan sebagaimana mestinya.
                    </p>
                </div>
                <div class="btns-group">
                    <a href="#" class="btn btn-prev">Previous</a>
                    {{-- <input type="submit" name="submit" id="submit" style="color:rgb(40, 139, 197); margin-top:20px" value="Submit" class="btn"> --}}
                    <button class="btn btn-submit" type="button" id="save">Submit</button>
                </div>
            </div>
        </div>
      
     
    </div>
</x-app-layout>
<script>
     $('.select2').select2()
    // Alert For closing Tab

    // window.onbeforeunload = function (e) 
    // {
    //     var msg ="Are you sure to closing this tab ?";
    //     return msg;
    // };

    // End for Closing Tab
    
    const prevBtn   = document.querySelectorAll('.btn-prev');
    const nextBtn   = document.querySelectorAll('.btn-next');
    const progress  = document.getElementById('progress');
    const formSteps = document.querySelectorAll('.form-step');
    const progressSteps = document.querySelectorAll('.progress-step');
 

    let formSetpsNum =0;
    nextBtn.forEach(btn=>{
        btn.addEventListener('click',()=>{
            formSetpsNum ++;
            updateFormSteps();
            updateProgressBar();
        })
    })
    prevBtn.forEach(btn=>{
        btn.addEventListener('click',()=>{
            formSetpsNum --;
            updateFormSteps();
            updateProgressBar();
        })
    })

    function updateFormSteps()
    {
        formSteps.forEach((formStep)=>{
            formStep.classList.contains('form-step-active') && 
            formStep.classList.remove('form-step-active')
        });

        formSteps[formSetpsNum].classList.add('form-step-active')
    }
    function updateProgressBar()
    {
        progressSteps.forEach((progressStep, idx)=>{
            if(idx < formSetpsNum +1)
            {
                progressStep.classList.add('progress-step-active')
            }else{
                progressStep.classList.remove('progress-step-active')
            }
        });
        const progressActive = document.querySelectorAll('.progress-step-active');
        progress.style.width =((progressActive.length - 1) / (progressSteps.length -1) *100 +'%')
    }
 

    $('#add_address').on('click', function(){
        $('.another_address').append(
            `   
            <div class="container form_address">
                <div class="input-group" style="float:right">
                    <button class="bg-red-500 btn_pop text-white active:bg-red-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150 " type="button" style="margin:auto" id="btn_pop_address" style="float:right">
                        <i class="fas fa-minus"></i>
                    </button>
            </div>
            <div class="input-group">
            <label for="alamat_lain">Jenis Alamat</label>
            <select name="jenis_alamat_lain" id="jenis_alamat_lain"  class="jenis_alamat_lain">
                <option value="">Pilih Jenis Alamat</option>
                <option value="HO">HO</option>
                <option value="Cabang">Cabang</option>
                <option value="Workshop">Workshop</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>
            <div class="input-group">
                    <label for="alamat_lain">Alamat Lain</label>
                    <div class="textwrapper">
                        <textarea cols="1" class="alamat_lain" rows="2" id="alamat_lain">
                        </textarea>
                    </div>
                    <small style="color: red">
                        Harap cantumin kode pos
                    </small>
                </div>
                <div class="grid grid-cols-6 gap-3">
                    <div class="input-group col-span-3">
                        <label for="no_telp_lain">No Telpon</label>
                        <input type="number" name="no_telp_lain" class="no_telp_lain" id="no_telp_lain">
                    </div>
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">Fax</label>
                        <input type="number" name="no_fax_lain" class="no_fax_lain" id="no_fax_lain">
                    </div>
                </div>
                <div class="grid grid-cols-6 gap-3">
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">Email</label>
                        <input type="text" name="email_lain" class="email_lain" id="email_lain">
                    </div>
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">Website</label>
                        <input type="text" name="website_lain"  class="website_lain" id="website_lain">
                    </div>
                </div> 
            </div>
            `
        )
    })
    $(document).on('click', '#btn_pop_address', function () {
            $(this).closest('.form_address').remove();
    });
    $('#add_more').on('click', function(e){
       $('#dynamic_field').append(`
       <tr>
                                <td><input type="text" name ="dept_pic"  class="dept_pic"></td>
                                <td><input type="text" name ="name_pic" class ="name_pic"></td>
                                <td><input type="number" name ="phone_pic" class ="phone_pic"></td>
                                <td><input type="email" name ="email_pic" class ="email_pic"></td>
                                <td>
                                    <button class="bg-red-500 btn_pop text-white active:bg-red-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" style="margin:auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                          </svg>
                                          
                                    </button>
                                </td>
        </tr>
                    `
       );
    })
    var dept_pic =document.getElementsByClassName("dept_pic");
    var name_pic =document.getElementsByClassName("name_pic");
    var phone_pic =document.getElementsByClassName("phone_pic");
    var email_pic =document.getElementsByClassName("email_pic");

    var id = document.getElementsByClassName('iso_master_id');
    var diterapkan = document.getElementsByClassName('diterapkan');
    var tersertifikasi = document.getElementsByClassName('tersertifikasi');

    var jenis_alamat_lain =document.getElementsByClassName('jenis_alamat_lain');
    var alamat_lain =document.getElementsByClassName('alamat_lain');
    var no_telp_lain =document.getElementsByClassName('no_telp_lain');
    var no_fax_lain =document.getElementsByClassName('no_fax_lain');
    var email_lain =document.getElementsByClassName('email_lain');
    var website_lain =document.getElementsByClassName('website_lain');

   $('#table_pic').on('click', '.btn_pop', function(e){
        $(this).parent().parent().remove();
   })
   
   
    $('#save').prop('disabled',true);
    $('#kab').prop('disabled',true);
    $('#kec').prop('disabled',true);
    $('#kel').prop('disabled',true);
    $('#kode_pos').prop('disabled',true);

    // Provinsi ketika on change, buka kabupaten 
    $('#prov').on('change', function(){
        $('#kab').prop('disabled', false)
        get_regency()
    })
    // End Provinsi on change
    // Kabupaten on change
    $('#kab').on('change', function(){
        $('#kec').prop('disabled', false)
        get_district()
    })
    // End Kabupaten on change
    // Kecamatan on change
    $('#kec').on('change', function(){
        $('#kel').prop('disabled', false)
        get_village()
    })
    // End Kecamatan on change
    // Set CC 
    $('#cc').on('change', function(){
        var cc = document.getElementById('cc');
        if(cc.checked ==true)
        {
            $('#save').prop('disabled',false);
        }else{
            $('#save').prop('disabled',true);
        }
    })
    // End Set CC

    // Button Submit
    $('#save').on('click', function(){
        var cc = document.getElementById('cc');
        if(cc.checked == false)
        {
            toastr.error('Please checklist Term & Condition before click the submit button')
            return false
        }else{
            save()
        }
    })
    // End Button Submit

    // Function here
    function save()
    {
        // Initiating

        // Halaman Pertama 
        var nama_supplier = $('#nama_supplier').val();
        var tahun_pendirian = $('#tahun_pendirian').val();
        var jenis_usaha = $('#jenis_usaha').val();
        var jml_karyawan = $('#jml_karyawan').val();
        var prov = $('#prov').val();
        var kab = $('#kab').val();
        var kec = $('#kec').val();
        var kel = $('#kel').val();
        var kode_pos = $('#kode_pos').val();
        var alamat_kantor = $('#alamat_kantor').val();
        var no_telpon = $('#no_telpon').val();
        var no_fax = $('#no_fax').val();
        var email = $('#email').val();
        var website= $('#website').val();
        var arr_address=[];
           
            for (let i = 0; i < alamat_lain.length; i++) {
            let arralamat_lain = alamat_lain[i].value;
            let arrjenis_alamat_lain = jenis_alamat_lain[i].value;
            let arrno_telp_lain = no_telp_lain[i].value;
            let arrno_fax_lain = no_fax_lain[i].value;
            let arremail_lain = email_lain[i].value;
            let arrwebsite_lain = website_lain[i].value;
            let array_alamat =[
                arralamat_lain,
                arrjenis_alamat_lain,
                arrno_telp_lain,
                arrno_fax_lain,
                arremail_lain,
                arrwebsite_lain
            ]
            arr_address.push(array_alamat);
            }
        // End Halaman Pertama 

        // Halaman Kedua
        var arr_pic=[];
            var arr_iso = []
            for (let i = 0; i < dept_pic.length; i++) {
            let arrdept_pic = dept_pic[i].value;
            let arrname_pic = name_pic[i].value;
            let arrphone_pic = phone_pic[i].value;
            let arremail_pic = email_pic[i].value;
            let array =[
                arrdept_pic,
                arrname_pic,
                arrphone_pic,
                arremail_pic
            ]
            arr_pic.push(array);
        }
        // End Halaman Kedua

        // Halaman Ketiga
        var no_pengukuhan = $('#no_pengukuhan').val()
        var no_npwp = $('#no_npwp').val()
        var nama_npwp = $('#nama_npwp').val()
        var alamat_npwp = $('#alamat_npwp').val()
            // Attachment
                var pengukuhan_attachment = $('#pengukuhan_attachment').val()
                var npwp_attachment = $('#npwp_attachment').val()
                var cp_attachment = $('#cp_attachment').val()
                var skt_attachment = $('#skt_attachment').val()

            //End Attachment 
            // ISO
            for (let i = 0; i < id.length; i++) {
                    var arr_id = id[i].value;
                    var arr_diterapkan = diterapkan[i].checked == true?'1':'0';
                    var arr_tersertifikasi = tersertifikasi[i].checked == true?'1':'0'

                    var selected_data =[
                        arr_id,
                        arr_diterapkan,
                        arr_tersertifikasi
                    ]
                    arr_iso.push(selected_data)
                }
            // End ISO

        // End Halaman Ketiga
        // Halaman Keempat
            var bank_account = $('#bank_account').val()
            var jangka_waktu = $('#jangka_waktu').val()
        // End Halaman Keempat

        // End Initiating
        var data ={
            'nama_supplier':nama_supplier,
            'tahun_pendirian':tahun_pendirian,
            'jenis_usaha':jenis_usaha,
            'jml_karyawan':jml_karyawan,
            'prov':prov,
            'kab':kab,
            'kec':kec,
            'kel':kel,
            'kode_pos':kode_pos,
            'alamat_kantor':alamat_kantor,
            'no_telpon':no_telpon,
            'no_fax':no_fax,
            'email':email,
            'website':website,
            'arr_address':arr_address,
            'arr_pic':arr_pic,
            'no_pengukuhan':no_pengukuhan,
            'no_npwp':no_npwp,
            'nama_npwp':nama_npwp,
            'alamat_npwp':alamat_npwp,
            'arr_iso':arr_iso,
            'bank_account':bank_account,
            'jangka_waktu':jangka_waktu
        };
        // Ajax
        console.log(data)
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('post_supplier')}}",
            type: "post",
            dataType: 'json',
            async: true,
            data: data,
            beforeSend: function() {
                SwalLoading('Inserting progress, please wait .');
            },
            success: function(response) {
                swal.close();
            if(response.get_kode_area_tagih==[]|| response.get_kode_area_tagih=='' || response.get_kode_area_tagih==null)
            {
                toastr['success'](response.message);
                window.location = "{{route('suppliers.create')}}";
            }
            else{
                    toastr['success'](response.message);
                }
                mapping_wilayah_detail(response)

            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('gagal mengambil data, silakan hubungi ITMAN');
            }
        });
        // End Ajax
    }
    function get_regency()
    {
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('get_regency')}}",
            type: "get",
            dataType: 'json',
            async: true,
            data: {
                'prov':$('#prov').val()
            },
            beforeSend: function() {
                SwalLoading('Please wait ...');
            },
            success: function(response) {
                swal.close();
                $('#kab').empty();
                $('#kab').append('<option value="">Pilih Kabupaten</option>');
                $.each(response.regency,function(i,data){
                    $('#kab').append('<option value="'+data.id+'">' + data.name +'</option>');
                });
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('gagal mengambil data, silakan hubungi ITMAN');
            }
        });
    }
    function get_district()
    {
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('get_district')}}",
            type: "get",
            dataType: 'json',
            async: true,
            data: {
                'regency_id':$('#kab').val()
            },
            beforeSend: function() {
                SwalLoading('Please wait ...');
            },
            success: function(response) {
                swal.close();
                $('#kec').empty();
                $('#kec').append('<option value="">Pilih Kecamatan</option>');
                $.each(response.district,function(i,data){
                    $('#kec').append('<option value="'+data.id+'">' + data.name +'</option>');
                });
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('gagal mengambil data, silakan hubungi ITMAN');
            }
        });
    }
    function get_village()
    {
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('get_village')}}",
            type: "get",
            dataType: 'json',
            async: true,
            data: {
                'district_id':$('#kec').val()
            },
            beforeSend: function() {
                SwalLoading('Please wait ...');
            },
            success: function(response) {
                swal.close();
               
                $('#kel').empty();
                $('#kel').append('<option value="">Pilih Kelurahan</option>');
                $.each(response.village,function(i,data){
                    $('#kel').append('<option value="'+data.id+'">' + data.name +'</option>');
                });
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('gagal mengambil data, silakan hubungi ITMAN');
            }
        });
    }
    
    //  End Function

</script>