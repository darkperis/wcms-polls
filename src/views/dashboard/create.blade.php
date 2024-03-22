@extends('layouts.app')
@section('title')
Polls- Creation
@endsection
@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" rel="stylesheet" />
    <style>
        .custom-label input:checked + svg {
            display: block !important;
        }

        .modal {
            transition: opacity 0.25s ease;
        }
        body.modal-active {
            overflow-x: hidden;
            overflow-y: visible !important;
        }
    </style>
@endsection
@section('content')

<!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <!-- <a href="/admin/content/create" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle mr-2"></i>  Add New</a> -->

                        {{-- <a href="/admin/options/create" title="Create Option" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle mr-2"></i> Add New</a> --}}
                        <a href="{{ route('poll.index') }}" class="btn btn-info mb-2">ALL POLLS</a>

                        
                        <!-- <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>

                            <li class="breadcrumb-item active">News</li>
                        </ol> -->
                    </div>
                    <h4 class="page-title">Create a new poll</h4>

                </div>
            </div>
        </div>
        <!-- end page title -->




        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">



<div id="app">
    
    <div class="w-full">
        <form class=" px-8 pt-6 pb-8 mb-4">

            <div class="mb-6">
                <label class="block text-gray-700 text-lg font-bold mb-2 uppercase tracking-wide font-bold" for="question">
                    Question
                </label>
                <input v-model="question" placeholder="Ποιό είναι το καλύτερο εργαλείο AI;" class="form-control mb-2" id="question" type="text">
            </div>

            <hr>

            <div class="flex flex-wrap mt-4">
                <label class="form-label" for="options">
                    Options
                </label>
                <div v-for="(option, index) in options" class="d-flex py-2">
                    <input v-model="option.value" :placeholder="option.placeholder" class="form-control col-lg-6 mr-4" type="text" />
                    <button @click.prevent="remove(index)" class="btn btn-sm btn-secondary" type="button">
                        Remove
                    </button>
                </div>
                <div class="d-flex py-2">
                    <input @keyup.enter="addNewOption" v-model="newOption" class="form-control col-lg-6 mr-4" type="text" placeholder="Luka Modric" aria-label="Full name">
                    <button @click.prevent="addNewOption" class="btn btn-sm btn-primary" type="button">
                        Add
                    </button>
                </div>
            </div>

            <hr>
            <div class="d-flex flex-wrap -mx-3 mb-6">
                <div class="mb-2 mr-4">
                    <label class="mb-2" for="grid-first-name">
                        Starts at
                    </label>
                    <input id="starts_at" class="form-control localDates" type="text">
                    <p class="text-red-500 text-xs italic d-none">Please fill out this field.</p>
                </div>
                <div class="mb-2">
                    <label class="mb-2" for="grid-last-name">
                        Ends at
                    </label>
                    <input id="ends_at" class="form-control localDates" type="text">
                </div>
            </div>

            <hr>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="px-3 mb-6">
                    <label class="custom-label flex">
                        <div class="flex justify-center items-center mr-2">
                            <input id="canVisitors" type="checkbox" class="form-check-input">
                        </div>
                        <span class="select-none">Allow guests to vote on the question</span>
                    </label>
                </div>
            </div>

            <div class="flex items-center justify-between mt-4">
                <button @click.prevent="save" class="btn btn-primary" type="button">
                    Create
                </button>
            </div>
        </form>
    </div>
</div>




                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
</div>
<!-- container -->

@endsection

@section('packagejs')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script>
        Vue.use(Toasted)
        new Vue({
           el: '#app',
            computed:{
              filledOptions(){
                return this.options.map((option) => {
                    return option.value;
                } ).filter((option) => option);
              }
            },
            mounted(){
                $('.localDates').datetimepicker({
                    format: 'y-m-d H:m',
                });
            },
            data(){
               return {
                    newOption: '',
                    question: '',
                    options: [
                        { value: '', placeholder: 'Chat GPT'},
                        { value: '', placeholder: 'Gemini'},
                    ],
                   error_message: '',
               }
            },
            methods:{
               addNewOption(){
                   if(this.newOption.length === 0){
                       this.error_message = "Please fill the option field";
                       this.flushModal();
                       return;
                   }
                   if(this.filledOptions.filter( option => option === this.newOption).length !== 0){
                       this.error_message = "You can't use the same more than once";
                       this.flushModal();
                       return;
                   }

                   this.options.push({
                       value: this.newOption,
                       placeholder: ''
                   });
                   this.newOption = '';
               },
                remove(index){
                    if(this.filledOptions.length <= 2){
                        this.error_message = "Two options are the minimal";
                        this.flushModal();
                        return;
                    }
                    this.options = this.options.map((option, localIndex) => {
                        if(localIndex === index){
                            return null;
                        }

                        return option
                    }).filter(option => option);
                },
                save(){
                    if(this.question.length === 0){
                        this.error_message = "Please fill the question first";
                        this.flushModal();
                        return;
                    }

                    if(this.filledOptions.length < 2){
                        this.error_message = "Two options are the minimal";
                        this.flushModal();
                        return;
                    }

                   let data = {
                       question: this.question,
                       options: this.filledOptions,
                       starts_at: document.getElementById('starts_at').value,
                       canVisitorsVote: document.getElementById('canVisitors').checked
                   };

                   if(document.getElementById('ends_at').value !== ''){
                       data.ends_at = document.getElementById('ends_at').value;
                   }

                   // POST TO STORE
                   axios.post("{{ route('poll.store') }}", data)
                   .then((response) => {
                       Vue.toasted.success(response.data).goAway(1500);
                       setTimeout(() => {
                           window.location.replace("{{ route('poll.index') }}");
                       }, 1500)
                   })
                   .catch((error) => {

                       Object.values(error.response.data.errors)
                       .forEach((error) => {
                           this.flushModal(error[0], 2000);
                       })
                   })
                },
                flushModal(message = this.error_message, after = 1500){
                    Vue.toasted.error(message).goAway(after);
                }
            }
        });
    </script>
@endsection
