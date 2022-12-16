<div class="max-w-xl py-2 rounded-lg shadow-lg bg-white">
    <div class="px-6 border-b border-gray-300">
        <div class="grid grid-cols-2 gap-6">
            <div class="py-3">
                <h3 style="margin-top:5px">List Permission</h3>
            </div>
            <div class="py-3">
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" id="add_permission" style="float:right">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
    </div>
 
    <div class="py-3 px-6 border-t border-gray-300 text-gray-600">
        <div class="container">
            <table class="table-auto w-full bg-blue-500 datatable-collapse" id="permission_table">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Guard Name</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>