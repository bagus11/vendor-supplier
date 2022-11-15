<style>
    :root{
        /* --primary-color:rgb(40, 158, 197); */
        --primary-color:#E0144C;

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
    #add_more:hover{
        box-shadow: 0 0 0 2px #ffff, 0 0 0 3px #59CE8F;
    }
    
    #btn_pop_address:hover{
        box-shadow: 0 0 0 2px #ffff, 0 0 0 3px #FF1E00;
    }
    #btn_pop_pic:hover{
        box-shadow: 0 0 0 2px #ffff, 0 0 0 3px #FF1E00;
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
    .error_message{
        font-size: 12px;
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
                <div class="grid xs:grid-cols-1 md:grid-cols-6 gap-3 ">
                    <div class="input-group col-span-4">
                        <label for="supplierName">Nama Perusahaan</label>
                        <input type="text" name="supplierName" id="supplierName">
                        <span  style="color:red;" class="message_error text-red block supplierName_error"></span>
                    </div>
                    <div class="input-group col-span-2">
                        <label for="supplierYearOfEstablishment">Tahun Pendirian</label>
                        <input type="number" min="1800"  name="supplierYearOfEstablishment" id="supplierYearOfEstablishment">
                        <span  style="color:red;" class="message_error text-red block supplierYearOfEstablishment_error"></span>
                    </div>
                </div>
               <div class="grid xs:grid-cols-1 md:grid-cols-6 gap-3 ">
                    <div class="input-group col-span-4">
                        <label for="supplier_siup">Jenis Usaha</label>
                        <input type="text" name="supplierType" id="supplierType">
                        <span  style="color:red;" class="message_error text-red block supplierType_error"></span>
                    </div>
                    <div class="input-group col-span-2">
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
            <div class="form-step" >
               
                <div class="container">      
                    <div id="dynamic_field" class ="grid grid justify-items-center lg:grid-cols-2 gap-4 auto-cols-auto sm:grid-cols-1"> 
                            <div class="relative w-full p-3 rounded-lg shadow-lg bg-white max-w-xl" style="box-shadow: 0 0 0 2px #ffff, 0 0 0 3px #EEEEEE;" >
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
          
            <div class="form-step">
                <div class="grid xs:grid-cols-1 md:grid-cols-6 gap-3 ">
                    <div class="col-span-1">
                        <label for="">Metode</label>
                        <select name="metode" id="metode">
                            <option value="1">Cash</option>
                            <option value="2">Transfer</option>
                        </select>
                    </div>   
                </div>   
             
                <div id="tf_methode">
                    <div class="grid sm:grid-cols-2 gap-3 lg:grid-cols-6 md:grid-cols-6 xl:grid-cols-6 xxl:grid-cols-6" >
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
                                <label for="numberBank">No Rekening</label>
                                <input type="number" name="numberBank" id="numberBank">
                               
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 lg:grid-cols-6 md:grid-cols-6 lg:grid-cols-6 xl:grid-cols-6 gap-3 ">
                        <div class="input-group col-span-3" style="width:45%;" >
                            <label for="supplier_siup">Jangka Waktu Pembayaran</label>
                                <div class="grid grid-cols-1 gap-3 " style="display:flex">
                                    <div class="col-span-3">
                                        <select name="termOfPayment" id="termOfPayment">
                                            <option value="15">15</option>
                                            <option value="30">30</option>
                                            <option value="45">45</option>
                                            <option value="60">60</option>
                                            <option value="90">90</option>
                                            <option value="120">120</option>
                                        </select>
                                    </div>
                                    <div class="col-span-3 mt-2">
                                        <label for="">Hari</label>
                                    </div>
                                </div>
                        </div>
                    </div>

                    
                </div>
                <div class="grid xs:grid-cols-1 md:grid-cols-6 gap-3 ">
                    <div class="col-span-1">
                        <label for="">Penanggung Jawab</label>
                        <select name="penanggung_jawab" class="select2" id="penanggung_jawab">
                            <option value="1">Cash</option>
                            <option value="2">Transfer</option>
                        </select>
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
                        Demikian surat pernyataan ini saya buat dengan sadar dan tanpa paksaan untuk dapat dipergunakan sebagaimana mestinya.
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
    $('#tf_methode').hide()
    $('#metode').on('change', function(){
        $('#metode').val() == 2 ? $('#tf_methode').show() : $('#tf_methode').hide()
    })
    // ketuka diklik, maka akan nampilin PIC sebagai penanggung jawab
    $('#next_3').on('click', function(){
        $('#penanggung_jawab').empty();
        $('#penanggung_jawab').append('<option value ="">Pilih Penanggun Jawab</option>');
        var arr_pic=[];
            var arr_iso = []
            var array =[];
            for (var i = 0; i < dept_pic.length; i++) {
            var arrname_pic = name_pic[i].value;
                if(arrname_pic !=''){
                        $('#penanggung_jawab').append('<option value ="'+arrname_pic+'">'+arrname_pic+'</option>')
                }
        }
    })
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
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
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
       <div class="grid xs:grid-cols-1 md:grid-cols-6 gap-3 ">
            <div class="input-group col-span-4">
                <div class="input-group">
                        <label for="alamat_lain">Alamat</label>
                        <div class="textwrapper">
                            <textarea cols="1" class="alamat_lain" rows="2" id="alamat_lain" style="border-radius: 5px !important;"></textarea>
                        </div>
                   
                    </div>
                </div>
            </div>
               <div class="grid xs:grid-cols-1 md:grid-cols-6 gap-3 ">
                    <div class="input-group col-span-3">
                        <label for="no_telp_lain">No Telpon</label>
                        <input type="number"  pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==13) return false;" name="no_telp_lain" class="no_telp_lain" id="no_telp_lain">
                    </div>
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">Fax</label>
                        <input type="number"  pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==13) return false;" name="supplierFax_lain" class="supplierFax_lain" id="supplierFax_lain">
                    </div>
                </div>
               <div class="grid xs:grid-cols-1 md:grid-cols-6 gap-3 ">
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
                               
                    <div class="array_pic_contact relative w-full p-3 rounded-lg shadow-lg bg-white max-w-xl "style="box-shadow: 0 0 0 2px #ffff, 0 0 0 3px #EEEEEE" >
                                <div class="grid grid-cols-6 gap-3 pt-4">
                                    <div class="input-group col-span-2" style="justify-content:center">
                                    <img style="margin-top:25%;" src="{{URL::asset('profile.png')}}" alt="">                     
                                    </div>
    
                                    <div class="input-group col-span-4">
                                        <button class="bg-red-500 btn_pop text-white active:bg-red-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150 " type="button" id="btn_pop_pic"  style="float:right;margin-top:-10%;margin-right:-2%;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
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
    var supplierFax_lain =document.getElementsByClassName('supplierFax_lain');
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
    $('#save').on('click', function(e){
        e.preventDefault();
        var cc = document.getElementById('cc');
        if(cc.checked == false)
        {
            toastr.error('Please checklist Term & Condition before click the submit button')
            return false
        }else{
            $('#save').prop('disabled', true);
            $('#cc').prop('disabled', true);
            save(e)
        }
    })
    // End Button Submit
    function onlyUnique(value, index, self) {
    return self.indexOf(value) === index;
    }
    // Function here
    function save()
    {
        // Initiating
        
        // Halaman Pertama 
        var supplierName = $('#supplierName').val();
        var supplierYearOfEstablishment = $('#supplierYearOfEstablishment').val();
        var supplierType = $('#supplierType').val();
        var supplierNumberOfEmployee = $('#supplierNumberOfEmployee').val();
        var prov = $('#prov').val();
        var kab = $('#kab').val();
        var kec = $('#kec').val();
        var kel = $('#kel').val();
        var kode_pos = $('#kode_pos').val();
        var supplierAddress = $('#supplierAddress').val();
        var supplierPhone = $('#supplierPhone').val();
        var supplierFax = $('#supplierFax').val();
        var email = $('#supplierEmail').val();
        var supplierWebsite= $('#supplierWebsite').val();
        var bankName= $('#bankName').val();
        var arr_address=[];
        let array_alamat =[]
            for (let i = 0; i < alamat_lain.length; i++) {
            let arralamat_lain = alamat_lain[i].value;
            let arrjenis_alamat_lain = jenis_alamat_lain[i].value;
            let arrno_telp_lain = no_telp_lain[i].value;
            let arrsupplierFax_lain = supplierFax_lain[i].value;
            let arremail_lain = email_lain[i].value;
            let arrwebsite_lain = website_lain[i].value;

            array_alamat =[
                arralamat_lain,
                arrjenis_alamat_lain,
                arrno_telp_lain,
                arrsupplierFax_lain,
                arremail_lain,
                arrwebsite_lain
            ]
            arr_address.push(array_alamat);
            }
        // End Halaman Pertama 

        // Halaman Kedua
        var arr_pic=[];
            var arr_iso = []
            let array =[];
            for (let i = 0; i < dept_pic.length; i++) {
            let arrdept_pic = dept_pic[i].value;
            let arrname_pic = name_pic[i].value;
            let arrphone_pic = phone_pic[i].value;
            let arremail_pic = email_pic[i].value;
                if(arrdept_pic !='' && arrname_pic !='' && arrphone_pic != '' && arremail_pic !=''){
                    array =[
                            arrdept_pic,
                            arrname_pic,
                            arrphone_pic,
                            arremail_pic
                        ]
                }
            arr_pic.push(array);
        }
            if(array.length ===0 ){
                toastr['error']('PIC tidak boleh kosong');
                $('#save').prop('disabled', false)
                return false;
            }
          
        // End Halaman Kedua

        // Halaman Ketiga
        var numberPKP = $('#numberPKP').val()
        var numberNPWP = $('#numberNPWP').val()
        var nameNPWP = $('#nameNPWP').val()
        var addressNPWP = $('#addressNPWP').val()
            //End Attachment 
            // ISO
            var select_data_2 =[]
            for (let i = 0; i < id.length; i++) {
                    var arr_id = id[i].value;
                    var arr_diterapkan = diterapkan[i].checked == true?1:0;
                    var arr_tersertifikasi = tersertifikasi[i].checked == true?1:0

             
                    if(arr_diterapkan === 0 && arr_tersertifikasi ===0 )
                    {
                       
                    }else{
                        select_data_2 =[
                            arr_id,
                            arr_diterapkan,
                            arr_tersertifikasi
                        ]
                    }
                    arr_iso.push(select_data_2)
                    var select_data = arr_iso.filter(onlyUnique)
                }
              
                if(select_data_2.length === 0){
                        toastr['error']('ISO tidak boleh kosong');
                        $('#save').prop('disabled', false)
                        return false
                    }
            // End ISO

        // End Halaman Ketiga
        // Halaman Keempat
            var numberBank = $('#numberBank').val()
            var termOfPayment = $('#termOfPayment').val()
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
            formData.append('supplierName',supplierName)
            formData.append('supplierYearOfEstablishment',supplierYearOfEstablishment)
            formData.append('supplierType',supplierType)
            formData.append('supplierNumberOfEmployee',supplierNumberOfEmployee)
            formData.append('supplierProvince',prov)
            formData.append('supplierCity',kab)
            formData.append('supplierDistricts',kec)
            formData.append('supplierVillage',kel)
            formData.append('supplierPostalCode',kode_pos)
            formData.append('supplierAddress',supplierAddress)
            formData.append('supplierPhone',supplierPhone)
            formData.append('supplierFax',supplierFax)
            formData.append('supplierEmail',email)
            formData.append('supplierWebsite',supplierWebsite)
            formData.append('arr_address',JSON.stringify(arr_address))
            formData.append('arr_pic',JSON.stringify(arr_pic))
            formData.append('numberPKP',numberPKP)
            formData.append('numberNPWP',numberNPWP)
            formData.append('nameNPWP',nameNPWP)
            formData.append('addressNPWP',addressNPWP)
            formData.append('arr_iso',JSON.stringify(select_data))
            formData.append('numberBank',numberBank)
            formData.append('bankName',bankName)
            formData.append('termOfPayment',termOfPayment)
 
        // EndForm Upload
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
                $('#save').prop('disabled', true);
                $('.message_error').html('')
                if(response.status==422)
                {
                    Swal.fire({
                    icon: 'error',
                    title: 'Error Message',
                    text: 'Mohon, koreksi kembali inputan sebelum data dikirim',
                    })
                  
                    $.each(response.message, (key, val) => 
                    {
                       $('span.'+key+'_error').text(val[0])
                    });
                    $('#save').prop('disabled', false);
                    return false;
                }
                else{
                    toastr['success']('Success,Data saved successfully');
                    // window.location = "{{route('suppliers.index')}}";
                }
               

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