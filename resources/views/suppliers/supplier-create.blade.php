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
        border-radius: 5px !important;
    }
    /* Form */
    .form{
        /* width: clamp(300px, 850px, 900px); */
        width: 80%;
        margin: 0 auto;
        border: 1px solid none;
        border-radius:0.75rem;
        background-color: white;
        padding:1.5rem;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
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
        <form class="form" id="form_serialize" enctype="multipart/form-data">
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
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 print-error-msg" role="alert" style="display:none;margin-bottom:20px;margin-top:20px">
                <ul></ul>
            </div>
            {{-- Step --}}
            <div class="form-step form-step-active">
                <div class="grid grid-cols-6 gap-3 ">
                    <div class="input-group col-span-4">
                        <label for="nama_supplier">Nama Perusahaan</label>
                        <input type="text" name="nama_supplier" id="nama_supplier">
                      
                    </div>
                    <div class="input-group col-span-2">
                        <label for="tahun_pendirian">Tahun Pendirian</label>
                        <input type="number" min="1800"  name="tahun_pendirian" id="tahun_pendirian">
                       
                    </div>
                </div>
                <div class="grid grid-cols-6 gap-3 md:cols-4">
                    <div class="input-group col-span-4">
                        <label for="supplier_siup">Jenis Usaha</label>
                        <input type="text" name="jenis_usaha" id="jenis_usaha">
                      
                    </div>
                    <div class="input-group col-span-2">
                        <label for="jml_karyawan">Jumlah Karyawan</label>
                        <input type="number" name="jml_karyawan" id="jml_karyawan">
                       
                    </div>
                </div>  
                <div class="grid grid-cols-6 gap-3">
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
                <div class="grid grid-cols-6 gap-3">
                  
                    <div class="input-group col-span-2">
                        <label for="supplier_siup">Kelurahan</label>
                        <select class="select2" name="kel" id="kel" style="width: 100%">
                            <option value="">Pilih provinsi terlebih dahulu</option>
                        </select>
                       
                    </div>
                    <div class="input-group col-span-2">
                        <label for="supplier_name">Kode Pos</label>
                        <input type="number" style="width: 50%" name="kode_pos" id="kode_pos">
                       
                    </div>
                </div>    
                
                <div class="input-group">
                    <label for="alamat_kantor">Alamat Kantor</label>
                    <textarea class="shadow appearance-none border rounded w-full py-2  text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="alamat_kantor"name="alamat_kantor"></textarea>
                   
                </div>

                <div class="grid grid-cols-6 gap-3">
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">No Telpon</label>
                        <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==13) return false;"name="no_telpon" id="no_telpon">
                       
                    </div>
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">Fax</label>
                        <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==13) return false;" name="no_fax" id="no_fax">
                        
                    </div>
                </div>
                <div class="grid grid-cols-6 gap-3">
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">Email</label>
                        <input type="text" name="email" id="email">
                       
                    </div>
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">Website</label>
                        <input type="text" name="website" id="website">
                        
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
            <div class="form-step" >
              
                <div class="container">      
                    <div id="dynamic_field" class ="grid md:grid-cols-2 grid-flow-col gap-2 auto-cols-auto sm:grid-cols-1"> 
                            <div class="relative w-full p-3 rounded-lg shadow-lg bg-white max-w-md" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                <div class="grid grid-cols-6 gap-2 pt-4">
                                    <div class="input-group col-span-2" style="justify-content:center">
                                    <img style="margin-top:20%;width:100%" src="{{URL::asset('profile.png')}}" alt="">                     
                                    </div>
    
                                    <div class="input-group col-span-4">
                                            <div class="input-group" style="max-width: 120px">
                                                <input type="text" name ="dept_pic" placeholder="Departement" class="dept_pic">
                                            </div>
                                            <div class="input-group">
                                                <input type="text" placeholder="Nama" name ="name_pic" class ="name_pic">
                                            </div>
                                        
                                            <div class="input-group">
                                                <input type="number" placeholder="No HP" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==13) return false;" name ="phone_pic" class ="phone_pic">
                                            </div>
                                            <div class="input-group">
                                                <input type="email" placeholder="Email" name ="email_pic" class ="email_pic">
                                            </div>
                                    </div>
                                
                                </div>
                            </div>
                    </div>
                </div>               
                    <div class="input-group mt-4">
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
                    <div class="input-group col-span-3" style="padding-top:10px">
                        <label for="no_pengukuhan">No Pengukuhan PKP</label>
                        <input type="text" name="no_pengukuhan" id="no_pengukuhan">
                    </div>
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">Attachment</label>
                        <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="pengukuhan_attachment" placeholder="Enter Supplier NPWP" name="pengukuhan_attachment">
                    </div>
                   
                </div>
                <div class="grid grid-cols-6 gap-3">
                    <div class="input-group col-span-3" style="padding-top:10px">
                        <label for="no_npwp">No NPWP</label>
                        <input type="number"  pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==16) return false;" name="no_npwp" id="no_npwp">
                    </div>
                    <div class="input-group col-span-3">
                        <label for="no_npwp_attachment">Attachment</label>
                        <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="npwp_attachment" placeholder="Enter Supplier NPWP" name="npwp_attachment">
                    </div>
                   
                </div>
                <div class="grid grid-cols-6 gap-3">
                    <div class="input-group col-span-3">
                        <div class="input-group">
                                <label for="supplier_siup">Nama NPWP</label>
                                <input type="text" name="nama_npwp" id="nama_npwp">
                        </div>
                    </div>
                    <div class="input-group col-span-3">
                        <div class="input-group">
                            <label for="alamat_npwp">Alamat NPWP</label>
                            <div class="textwrapper">
                                <textarea cols="1" rows="2" id="alamat_npwp"></textarea>
                            </div>
                        </div>
                    </div>
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
                
                <div class="container mt-2">
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
                    <a href="#" class="btn btn-next">Next</a>
                </div>
            </div>
          
            <div class="form-step">
                <div class="grid grid-cols-1 gap-3 md:grid-cols-6 gap-3 xl:grid-cols-6 gap-3">
                    <div class="col-span-1">
                      <div class="input-group">
                        <label for="">Bank</label>
                        <select name="bankName" id="bankName" class="select2" style="width: 100%;">
                            <option value="">Pilih Bank</option>
                            @foreach($master_bank as $row)
                                <option value="{{$row->id}}">{{$row->nameBank}}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-span-2">
                        <div class="input-group">
                            <label for="bank_account">No Rekening</label>
                            <input type="number" name="bank_account" id="bank_account">
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-6 gap-3">
                    <div class="input-group col-span-3" style="width:45%;">
                        <label for="supplier_siup">Jangka Waktu Pembayaran</label>
                            <div class="grid grid-cols-1 gap-3 " style="display:flex">
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
                                    <label for="">Hari</label>
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
                    <button class="btn btn-submit" type="submit" id="save">Submit</button>
                </div>
            </div>
        </form>
      
     
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
                    <button class="bg-red-500 btn_pop text-white active:bg-red-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150 " type="button" style="margin:auto" id="btn_pop_address" style="float:right;postion:fixed">
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
                        <textarea cols="1" class="alamat_lain" rows="2" id="alamat_lain"></textarea>
                    </div>
                    <small style="color: red">
                        Harap cantumin kode pos
                    </small>
                </div>
                <div class="grid grid-cols-6 gap-3">
                    <div class="input-group col-span-3">
                        <label for="no_telp_lain">No Telpon</label>
                        <input type="number"  pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==13) return false;" name="no_telp_lain" class="no_telp_lain" id="no_telp_lain">
                    </div>
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">Fax</label>
                        <input type="number"  pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==13) return false;" name="no_fax_lain" class="no_fax_lain" id="no_fax_lain">
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
    $(document).on('click', '#btn_pop_pic', function () {
            $(this).closest('.array_pic_contact').remove();
    });
    $('#add_more').on('click', function(e){
       $('#dynamic_field').append(`
                    <div class="array_pic_contact relative w-full p-3 rounded-lg shadow-lg bg-white max-w-md" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                <button class="bg-red-500 btn_pop text-white active:bg-red-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150 " type="button" style="float:right" id="btn_pop_pic">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>

                                </button>
                                <div class="grid grid-cols-6 gap-3 pt-4">
                                    <div class="input-group col-span-2" style="justify-content:center">
                                    <img style="margin-top:25%;" src="{{URL::asset('profile.png')}}" alt="">                     
                                    </div>
    
                                    <div class="input-group col-span-4">
                                            <div class="input-group" style="max-width: 120px">
                                                <input type="text" name ="dept_pic" placeholder="Departement" class="dept_pic">
                                            </div>
                                            <div class="input-group">
                                                <input type="text" placeholder="Nama" name ="name_pic" class ="name_pic">
                                            </div>
                                        
                                            <div class="input-group">
                                                <input type="number" placeholder="No HP" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==13) return false;" name ="phone_pic" class ="phone_pic">
                                            </div>
                                            <div class="input-group">
                                                <input type="email" placeholder="Email" name ="email_pic" class ="email_pic">
                                            </div>
                                    </div>
                                
                                </div>
                  </div>
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

    $('#save').prop('disabled',true);
    $('#kab').prop('disabled',true);
    $('#kec').prop('disabled',true);
    $('#kel').prop('disabled',true);
    $('#kode_pos').prop('disabled',true);

    // Provinsi ketika on change, buka kabupaten 
    $('#prov').on('change', function(){
        $('#kab').prop('disabled', false)
        $('#kec').prop('disabled', true)
        $('#kec').empty()
        $('#kec').append('<option value="">Silahkan pilih kabupaten terlebih dahulu</option>')
        $('#kel').prop('disabled', true)
        $('#kel').empty()
        $('#kel').append('<option value="">Silahkan pilih kecamatan terlebih dahulu</option>')
        $('#kode_pos').val('')
        get_regency()
    })
    // End Provinsi on change
    // Kabupaten on change
    $('#kab').on('change', function(){
        $('#kec').prop('disabled', false)
        $('#kel').prop('disabled', true)
        $('#kel').empty()
        $('#kel').append('<option value="">Silahkan pilih kecamatan terlebih dahulu</option>')
        $('#kode_pos').val('')
        get_district()
    })
    // End Kabupaten on change
    // Kecamatan on change
    $('#kec').on('change', function(){
        $('#kel').prop('disabled', false)
        $('#kode_pos').val('')
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
    $('#kel').on('change', function(){
        get_postalcode()
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
            $('#save').prop('disabled', true);
            $('#cc').prop('disabled', true);
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
        var bankName= $('#bankName').val();
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
     

        // Form Upload
        var formData = new FormData();    
        var pengukuhan_attachment = $('#pengukuhan_attachment')[0].files[0];
        var npwp_attachment = $('#npwp_attachment')[0].files[0];
        var cp_attachment = $('#cp_attachment')[0].files[0];
        var skt_attachment = $('#skt_attachment')[0].files[0];
        
            formData.append('pengukuhan_attachment',pengukuhan_attachment)
            formData.append('npwp_attachment',npwp_attachment)
            formData.append('cp_attachment',cp_attachment)
            formData.append('skt_attachment',skt_attachment)
            formData.append('supplierName',nama_supplier)
            formData.append('supplierYearOfEstablishment',tahun_pendirian)
            formData.append('supplierType',jenis_usaha)
            formData.append('supplierNumberOfEmployee',jml_karyawan)
            formData.append('supplierProvince',prov)
            formData.append('supplierCity',kab)
            formData.append('supplierDistricts',kec)
            formData.append('supplierVillage',kel)
            formData.append('supplierPostalCode',kode_pos)
            formData.append('supplierAddress',alamat_kantor)
            formData.append('supplierPhone',no_telpon)
            formData.append('supplierFax',no_fax)
            formData.append('supplierEmail',email)
            formData.append('supplierWebsite',website)
            formData.append('arr_address',JSON.stringify(arr_address))
            formData.append('arr_pic',JSON.stringify(arr_pic))
            formData.append('numberPKP',no_pengukuhan)
            formData.append('numberNPWP',no_npwp)
            formData.append('nameNPWP',nama_npwp)
            formData.append('addressNPWP',alamat_npwp)
            formData.append('arr_iso',JSON.stringify(arr_iso))
            formData.append('numberBank',bank_account)
            formData.append('bankName',bankName)
            formData.append('termOfPayment',jangka_waktu)
 
        // EndForm Upload
        // jika form PIC Kosong maka akan di validasi disini
        console.log(arr_pic)
        if(arr_pic == ['', '', '', ''])
        {
            toastr['error']('Form PIC kosong, harap isi terlebih dahulu');
            $('#save').prop('disabled', false)
            return false;
        }
        // End jika form PIC Kosong maka akan di validasi disini


        // Ajax
    
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('post_supplier')}}",
            type: "post",
            dataType: 'json',
            async: true,
            processData: false,
            contentType: false,
            data: formData,
            beforeSend: function() {
                SwalLoading('Inserting progress, please wait .');
            },
            success: function(response) {
                swal.close();
                if(response.status==422)
                {
                    printErrorMsg(response.message)
                }else{
                    toastr['success']('Success,Data saved successfully');
                    window.location = "{{route('suppliers.index')}}";
                }
                $('#save').prop('disabled', false);
               

            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Error system, please contact ICT Developer');
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
                    $('#kab').append('<option value="'+data.id+'">' + data.kabupaten_kota +'</option>');
                });
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
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
                    $('#kec').append('<option value="'+data.id+'">' + data.kecamatan +'</option>');
                });
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
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
                    $('#kel').append('<option value="'+data.id+'">' + data.kelurahan +'</option>');
                });
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });
    }
    function get_postalcode()
    {
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('get_kdpos')}}",
            type: "get",
            dataType: 'json',
            async: true,
            data: {
                'kel_id':$('#kel').val()
            },
            beforeSend: function() {
                SwalLoading('Please wait ...');
            },
            success: function(response) {
                swal.close();
                $('#kode_pos').val(response.kel.kd_pos);
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });
    }

    function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append(`<li>${value}</li>`);
            });
        }
    
    //  End Function

</script>