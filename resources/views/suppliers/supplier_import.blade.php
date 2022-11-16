<style>
    .add_supplier:hover{
        box-shadow: 0 0 0 2px #ffff, 0 0 0 3px #59CE8F;
    }
    .editPost:hover{
        box-shadow: 0 0 0 2px #ffff, 0 0 0 3px #5DA7DB;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Import Supplier') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-2 sm:px-8 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg md:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif        
                  
                </div>
                <form class="form" id="form_serialize" enctype="multipart/form-data">
                <div class="py-4 pl-3 px-3">
                      <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-1">
                                    <label for="supplier_siup">Data Supplier</label>
                                    <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="skt_attachment" placeholder="Enter Supplier NPWP" name="skt_attachment">
                                    <span  style="color:red;" class="message_error text-red block skt_attachment_error"></span>
                            </div>
                            <div class="col-span-1">
                                    <label for="supplier_siup">Alamat Supplier</label>
                                    <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="skt_attachment" placeholder="Enter Supplier NPWP" name="skt_attachment">
                                    <span  style="color:red;" class="message_error text-red block skt_attachment_error"></span>
                            </div>
                      </div>
                      <div class="grid grid-cols-2 gap-4 py-4">
                            <div class="col-span-1">
                                    <label for="supplier_siup">PIC Supplier</label>
                                    <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="skt_attachment" placeholder="Enter Supplier NPWP" name="skt_attachment">
                                    <span  style="color:red;" class="message_error text-red block skt_attachment_error"></span>
                            </div>
                            <div class="col-span-1">
                                    <label for="supplier_siup">ISO</label>
                                    <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="skt_attachment" placeholder="Enter Supplier NPWP" name="skt_attachment">
                                    <span  style="color:red;" class="message_error text-red block skt_attachment_error"></span>
                            </div>
                      </div>
                      <button class="h-10 px-5 py-2 m-2 text-green-100 transition-colors duration-150 bg-green-500 rounded-lg focus:shadow-outline hover:bg-green-800 import_file" style="float:right">
                        <i class="fas fa-solid fa-file-import"></i>
                        Import
                    </button>          
                </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    $('.import_file').on('click', function(){
      
    })
</script>

