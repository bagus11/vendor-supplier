<div class="relative z-auto overflow-y-auto hidden ease-out duration-400" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="addPenilaianModal">
    <div class="fixed inset-0 transition-opacity">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative w-full max-w-4xl h-full md:h-auto overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4  border-b border-gray-300">
                    <div class="sm:flex sm:items-start">
                        <h4>Form Penilaian</h4>
                    </div>
                   
                </div>
                <div class="mt-4 px-8 border-b border-gray-300"id="other_address">
                    <div class="text-white-700 mt-4" style="justify-content: left;max-width:830px" >
                        <div class="mt-3 sm:mt-0 sm:ml-4 sm:text-left">
                            <div class="container px-6">
                                <div class="grid grid-cols-4">
                                    <div class="col-span-1 mt-2">
                                        <label  for="">User</label>
                                    </div>
                                    <div class="col-span-3">
                                        <select name="user_name" id="user_name" class="select2" style="width: 100%"></select>
                                      <input type="hidden" id="user_id" class="w-full" name="user_id">
                                        <span  style="color:red;" class="message_error text-red block user_id_error"></span>
                                    </div>
                                </div>
                                <br>
                                <div class="grid grid-cols-4">
                                    <div class="col-span-1 mt-2">
                                        <label  for="">Supplier</label>
                                    </div>
                                    <div class="col-span-3">
                                        <select name="supplier_name" id="supplier_name" class="select2" style="width: 100%"></select>
                                      <input type="hidden" id="supplier_id" class="w-full" name="supplier_id">
                                        <span  style="color:red;" class="message_error text-red block supplier_id_error"></span>
                                    </div>
                                </div>
                                <br>
                               
                                <div class="grid grid-cols-4">
                                    <div class="col-span-1 mt-2">
                                        <label  for="">Departement</label>
                                    </div>
                                    <div class="col-span-3">
                                        <select name="departement_name" id="departement_name" class="select2" style="width: 100%"></select>
                                      <input type="hidden" id="departement_id" class="w-full" name="departement_id">
                                        <span  style="color:red;" class="message_error text-red block departement_id_error"></span>
                                    </div>
                                </div>
                                <br>
                              
                                <div class="grid grid-cols-1">
                                    <table class="table-auto w-full datatable-collapse" id="table_pertanyaan">
                                        <thead>
                                            <tr class="border">
                                                <th style="text-align: left"><input type="checkbox" id="check_all" name="check_all" class="check_all" style="border-radius: 5px !important;"></th>
                                                <th style="text-align: left">Aspek</th>
                                                <th style="text-align: left">Pertanyaan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-2 sm:flex sm:flex-row-reverse sm:px-6">
                    <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-green-400 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-green-500 fg sm:ml-3 sm:w-auto sm:text-sm" id="save_add_pertanyaan">Save</button>
                    <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 fg sm:ml-3 sm:w-auto sm:text-sm" id="close_add_pertanyaan">  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg></button>
                </div>
            </div>
        </div>
    </div>
</div>