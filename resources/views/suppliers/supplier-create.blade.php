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
            @include('suppliers.supplier-step_1')
            @include('suppliers.supplier-step_2')
            @include('suppliers.supplier-step_3')
            @include('suppliers.supplier-step_4')
        {{-- End Step --}}
        
        </form>
      
     
    </div>
</x-app-layout>
@include('suppliers.supplier-create_js')