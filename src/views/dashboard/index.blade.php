@extends('layouts.app')
{{-- @section('style') --}}
    <!--Regular Datatables CSS wcmspolls:: -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    {{-- <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
    <!--Responsive Extension Datatables CSS-->

    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">

    <style type="text/css">
        .dataTables_wrapper .dataTables_filter {
float: right;
text-align: right;
}

.dataTables_wrapper .dataTables_length {
float: left;
}

.dataTables_wrapper .dataTables_paginate {
float: right;
text-align: right;
padding-top: 0.25em;
}
    </style>
{{-- @endsection --}}
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
                        <a href="{{ route('poll.create') }}" class="btn btn-primary mb-2 mt-2">Create a new poll</a>

                        
                        <!-- <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>

                            <li class="breadcrumb-item active">News</li>
                        </ol> -->
                    </div>
                    <h4 class="page-title">Manage Polls</h4>

                </div>
            </div>
        </div>
        <!-- end page title -->




        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">





<div id="app">

    <div id='recipients' class="p-8 mt-6 lg:mt-0">
            <table v-if="polls.length > 0"  id="example" class="table table-striped dt-responsive nowrap w-100" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead>
                    <tr>
                        <th data-priority="1">#</th>
                        <th data-priority="2">Question</th>
                        <th data-priority="3">Options</th>
                        <th data-priority="4">Visitors allowed</th>
                        <th data-priority="5">Votes</th>
                        <th data-priority="6">State</th>
                        <th data-priority="7">Edit</th>
                        <th data-priority="8">Delete</th>
                        <th data-priority="9">Lock/Unlock</th>
                    </tr>
                </thead>
            <tbody>
                <tr class="text-center" v-for="(poll, index) in polls">
                    <th scope="row">@{{ poll.id }}</th>
                    <td>@{{ poll.question }}</td>
                    <td>@{{ poll.options_count }}</td>
                    <td>@{{ poll.canVisitorsVote ? 'Yes' : 'No' }}</td>
                    <td>@{{ poll.votes_count }}</td>
                    <td>
                        <span v-if="poll.isLocked" class="label label-danger">Closed</span>
                        <span v-else-if="poll.isComingSoon" class="label label-info">Soon</span>
                        <span v-else-if="poll.isRunning" class="label label-success">Started</span>
                        <span v-else-if="poll.hasEnded" class="label label-success">Ended</span>
                    </td>
                    <td>
                        <a class="btn btn-primary btn-sm" :href="poll.edit_link">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-danger btn-sm" href="#" @click.prevent="deletePoll(index)">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-info btn-sm" href="#" @click.prevent="toggleLock(index)">
                            <i v-if="poll.isLocked" class="fa fa-unlock" aria-hidden="true"></i>
                            <i v-else class="fa fa-lock" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
        <small v-else>No poll has been found. Try to add one <a href="{{ route('poll.create') }}">Now</a></small>
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
    <!--Datatables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script>
       new Vue({
           el: "#app",
           data(){
               return {
                   polls: {!! json_encode($polls) !!},
               }
           },
           mounted(){
               $('#example').DataTable( {
                   responsive: true
               } ) .columns.adjust().responsive.recalc();
           },
           methods:{
               deletePoll(index){
                    if(confirm('Do You really want to delete this poll?')){
                        axios.delete(this.polls[index].delete_link)
                            .then((response) => {
                                this.polls.splice(index, 1);
                            });
                    }
               },
               toggleLock(index){
                   if(this.polls[index].isLocked){
                       this.unlock(index);
                       return;
                   }

                   this.lock(index)
               },
               lock(index){
                   if(confirm('Do You really want to lock this poll?')){
                       axios.patch(this.polls[index].lock_link)
                           .then((response) => {
                               this.assignNewData(response)
                           });
                   }
               },
               unlock(index){
                   if(confirm('Do You really want to unlock this poll?')){
                       axios.patch(this.polls[index].unlock_link)
                           .then((response) => {
                               this.assignNewData(response)
                           });
                   }
               },
               assignNewData(response){
                   this.polls[index].isLocked = response.data.poll.isLocked;
                   this.polls[index].isRunning = response.data.poll.isRunning;
                   this.polls[index].isComingSoon = response.data.poll.isComingSoon;
               }
           }
       })
    </script>
@endsection
