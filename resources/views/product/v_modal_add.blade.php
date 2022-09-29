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
    form{
        width: clamp(300px, 700px, 900px);
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
        width: 100%; 
    }
    .textwrapper{
        border:1px solid #999999;
        margin:5px 0;
        padding:3px;
    }
 
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Add Supplier') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <form action="">
            <h1 class="font-semibold text-xl text-center text-gray-800 leading-tight">
                {{ __('Register') }}
            </h1>
            {{-- Progress Bar --}}
            <div class="progressbar mt-6">
                <div class="progress" id="progress">

                </div>
                <div class="progress-step progress-step-active" data-title="Profile"></div>
                <div class="progress-step" data-title="Contact"></div>
                <div class="progress-step" data-title="Attachment"></div>
                <div class="progress-step" data-title="Payment"></div>
            </div>
            {{-- Step --}}
            <div class="form-step form-step-active">
                <div class="grid grid-cols-6 gap-3">
                    <div class="input-group col-span-4">
                        <label for="supplier_name">Nama Perusahaan</label>
                        <input type="text" name="supplier_name" id="supplier_name">
                    </div>
                    <div class="input-group col-span-2">
                        <label for="supplier_name">Tahun Pendirian</label>
                        <input type="number" name="supplier_name" id="supplier_name">
                    </div>
                </div>
                <div class="grid grid-cols-6 gap-3">
                    <div class="input-group col-span-4">
                        <label for="supplier_siup">Jenis Usaha</label>
                        <input type="text" name="supplier_name" id="supplier_name">
                    </div>
                    <div class="input-group col-span-2">
                        <label for="supplier_name">Jumlah Karyawan</label>
                        <input type="number" name="supplier_name" id="supplier_name">
                    </div>
                </div>  
                <div class="grid grid-cols-6 gap-3">
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">Provinsi</label>
                        <select name="categories" id="categories">
                            <option value="">Please choose categories</option>
                        </select>
                    </div>
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">Kabupaten</label>
                        <select name="categories" id="categories">
                            <option value="">Please choose categories</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-6 gap-3">
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">Kecamatan</label>
                        <select name="categories" id="categories">
                            <option value="">Please choose categories</option>
                        </select>
                    </div>
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">Kelurahan</label>
                        <select name="categories" id="categories">
                            <option value="">Please choose categories</option>
                        </select>
                    </div>
                </div>
                <div class="input-group">
                    <label for="supplier_name">Kode Pos</label>
                    <input type="number" style="width: 20%" name="supplier_name" id="supplier_name">
                </div>
                <div class="input-group">
                    <label for="description">Alamat Kantor</label>
                    <div class="textwrapper">
                        <textarea cols="1" rows="10" id="description">
                        </textarea>
                    </div>
                </div>

                <div class="grid grid-cols-6 gap-3">
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">No Telpon</label>
                        <input type="number" name="supplier_name" id="supplier_name">
                    </div>
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">Fax</label>
                        <input type="number" name="supplier_name" id="supplier_name">
                    </div>
                </div>
                <div class="grid grid-cols-6 gap-3">
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">Email</label>
                        <input type="text" name="supplier_name" id="supplier_name">
                    </div>
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">Website</label>
                        <input type="text" name="supplier_name" id="supplier_name">
                    </div>
                </div>

                <div class="input-group">
                    <label for="description">Alamat Lain</label>
                    <div class="textwrapper">
                        <textarea cols="1" rows="10" id="description">
                        </textarea>
                    </div>
                    <small style="color: red">
                        Harap cantumin kode pos
                    </small>
                </div>
                <div class="grid grid-cols-6 gap-3">
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">No Telpon</label>
                        <input type="number" name="supplier_name" id="supplier_name">
                    </div>
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">Fax</label>
                        <input type="number" name="supplier_name" id="supplier_name">
                    </div>
                </div>
                <div class="grid grid-cols-6 gap-3">
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">Email</label>
                        <input type="text" name="supplier_name" id="supplier_name">
                    </div>
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">Website</label>
                        <input type="text" name="supplier_name" id="supplier_name">
                    </div>
                </div>
            

                <div class="">
                    <a href="#" class="btn btn-next width-50 ml-auto">Next</a>
                </div>
            </div>
            <div class="form-step">
                <div class="input-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone">
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email">
                </div>
              
                <div class="btns-group">
                    <a href="#" class="btn btn-prev">Previous</a>
                    <a href="#" class="btn btn-next">Next</a>
                </div>
            </div>
            <div class="form-step">
               
                <div class="grid grid-cols-6 gap-3">
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">No Pengukuhan PKP</label>
                        <input type="text" name="supplier_name" id="supplier_name">
                    </div>
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">Attanchment</label>
                        <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="supplierNPWPFile" placeholder="Enter Supplier NPWP" name="supplierNPWPFile">
                    </div>
                   
                </div>
                <div class="grid grid-cols-6 gap-3">
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">No NPWP</label>
                        <input type="number" name="supplier_name" id="supplier_name">
                    </div>
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">Attanchment</label>
                        <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="supplierNPWPFile" placeholder="Enter Supplier NPWP" name="supplierNPWPFile">
                    </div>
                   
                </div>
 
                <div class="input-group">
                        <label for="supplier_siup">Nama NPWP</label>
                        <input type="text" name="supplier_name" id="supplier_name">
                </div>
                <div class="grid grid-cols-6 gap-3">
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">Company Profile</label>
                        <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="supplierNPWPFile" placeholder="Enter Supplier NPWP" name="supplierNPWPFile">
                    </div>
                    <div class="input-group col-span-3">
                        <label for="supplier_siup">Surat Keterangan Terdaftar</label>
                        <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="supplierNPWPFile" placeholder="Enter Supplier NPWP" name="supplierNPWPFile">
                    </div>
                   
                </div>
                <div class="input-group">
                    <label for="description">Alamat NPWP</label>
                    <div class="textwrapper">
                        <textarea cols="1" rows="10" id="description">
                        </textarea>
                    </div>
                  
                </div>
              
                <div class="btns-group">
                    <a href="#" class="btn btn-prev">Previous</a>
                    <a href="#" class="btn btn-next">Next</a>
                </div>
            </div>
            <div class="form-step">
                <div class="input-group">
                    <label for="password">Bank Account</label>
                    <input type="text" name="password" id="password">
                </div>
                <div class="grid grid-cols-6 gap-3">
                    <div class="input-group col-span-2">
                        <label for="supplier_siup">Term Of Payment</label>
                        <input type="number" style="width: 80%;textAlgin:center" name="termOfPayment" id="termOfPayment">
                    </div>
                    <div class="input-group col-span-1">
                        <br>
                        <br>
                        <label style="margin-top:-10px" for="">Days</label>
                    </div>
                   
                </div>

                <div class="btns-group">
                    <a href="#" class="btn btn-prev">Previous</a>
                    <input type="submit" name="submit" id="submit" style="color:rgb(40, 139, 197)" value="Submit" class="btn">
                </div>
            </div>
       </form>
    </div>
</x-app-layout>
<script>
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
</script>