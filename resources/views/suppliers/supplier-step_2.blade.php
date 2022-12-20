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