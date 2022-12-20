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
   $('#jenis_usaha_option').on('change', function(){
       var jenis_usaha_option= $('#jenis_usaha_option').val();
       $('#supplierType').val(jenis_usaha_option);
   })
   // ketuka diklik, maka akan nampilin PIC sebagai penanggung jawab
   $('#next_3').on('click', function(){
       $('#penanggung_jawab').empty();
       $('#penanggung_jawab').append('<option value ="">Pilih Penanggung Jawab</option>');
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
       var metode = $('#metode').val();
       var bankName = $('#bankName').val();
       var numberBank = $('#numberBank').val();
       if(metode == 2)
       {
           if(bankName == null ||bankName == '' || numberBank == null || numberBank=='')
           {
               toastr.error('Nama Bank / No Rekening tidak boleh kosong .')
               return false
           }
       }
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
       var metode= $('#metode').val();
       var arr_address=[];
       // let array_alamat =[];
       //     for (let i = 0; i < alamat_lain.length; i++) {
       //     var arralamat_lain = push(alamat_lain[i].value);
       //     var arrjenis_alamat_lain = push(jenis_alamat_lain[i].value);
       //     var arrno_telp_lain = push(no_telp_lain[i].value);
       //     var arrsupplierFax_lain = push(supplierFax_lain[i].value);
       //     var arremail_lain = push(email_lain[i].value);
       //     var arrwebsite_lain = push(website_lain[i].value);
       //     }
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
           var penanggung_jawab = $('#penanggung_jawab').val()
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
           formData.append('metode',metode)
           formData.append('penanggung_jawab',penanggung_jawab)
           // Array request
           // formData.append('jenis_alamat_lain',arralamat_lain)
           // formData.append('alamat_lain',arrjenis_alamat_lain)
           // formData.append('no_telp_lain',arrno_telp_lain)
           // formData.append('supplierFax_lain',arrsupplierFax_lain)
           // formData.append('email_lain',arremail_lain)
           // formData.append('website_lain',arrwebsite_lain)

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