<div class="form-step">
    <div class="grid xs:grid-cols-1 md:grid-cols-6 gap-3 ">
        <div class="col-span-1">
            <label for="">Metode</label>
            <select name="metode" id="metode">
                <option value="1">Cash</option>
                <option value="2">Transfer</option>
                <option value="3">Giro</option>
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
            <select name="penanggung_jawab" class="select2 penanggung_jawab" id="penanggung_jawab">
                <option value="1">Cash</option>
                <option value="2">Transfer</option>
            </select>
            <span  style="color:red;" class="message_error text-red block penanggung_jawab_error"></span>
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