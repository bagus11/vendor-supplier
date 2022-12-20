<div class="relative z-auto overflow-y-auto hidden ease-out duration-400" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="addRolePermissionModal">
    <div class="fixed inset-0 transition-opacity">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative w-full max-w-xl h-full md:h-auto overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4  border-b border-gray-300">
                    <div class="sm:flex sm:items-start">
                        <h4>Form Role Permission</h4>
                    </div>
                   
                </div>
                <div class="mt-4 px-8 border-b border-gray-300"id="other_address">
                    <div class="text-white-700 mt-4" style="justify-content: left;max-width:830px" >
                        <div class="mt-3 sm:mt-0 sm:ml-4 sm:text-left">
                            <div class="container px-6">
                                <input type="hidden" id="role_id_permission">
                                <table class="table-auto w-full border-collapse" id="table_pemission_inactive">
                                    <thead>
                                        <tr class="border">
                                            <th style="text-align: left"><input type="checkbox" id="check_all" name="check_all" class="check_all" style="border-radius: 5px !important;"></th>
                                            <th style="text-align: left">Permission Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <br>
                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-2 sm:flex sm:flex-row-reverse sm:px-6">
                    <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-green-400 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-green-500 fg sm:ml-3 sm:w-auto sm:text-sm" id="save_add_role_permission">Save</button>
                    <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-green-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 fg sm:ml-3 sm:w-auto sm:text-sm" id="delete_role_permission">Delete
                    </button>
                    <button Phone="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 fg sm:ml-3 sm:w-auto sm:text-sm" id="close_add_role_permission">  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg></button>
                   
                </div>
            </div>
        </div>
    </div>
</div>