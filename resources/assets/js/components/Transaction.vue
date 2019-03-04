<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Transaction Table</h3>
                        <div class="card-tools">
                            <button class="btn btn-success"  @click="newModal">Add Transaction <i class="fas fa-money-check fa-fw"></i></button>
                         </div>
                     </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New</h5>
                            <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update User's Info</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>   
                        </div>
                       <form @submit.prevent="editmode ? updateUser() : createBooklet()">
                        <div class="modal-body">
                            <input type="text" class="form-control" placeholder="Enter Account Name"><br>
                            <input type="text" class="form-control" placeholder="Enter TC"><br>
                            <select name="payment" class="form-control">
                                <option value="unpaid">Unpaid</option>
                                <option value="paid">Paid</option>
                            </select>
                            
                        </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                        <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                     </div>
                     </form>
                </div>
            </div>
            
            </div>
    </div>
</template>
<script>
    export default{
        data(){
            return {
            booklets:{},
            users: {},
            editmode: false,
            form: new Form({
                id: '',
                nameAssign : '',
                f1: '',
                f2: ''

            })
        }

        },
        methods:{
            newModal(){
            this.editmode = false;
            this.form.reset();
            $('#addNew').modal('show');
        },
        }
    }
</script>
