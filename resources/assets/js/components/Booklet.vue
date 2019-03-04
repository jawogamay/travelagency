<template>
    
    <div class="container">
        <div class="row mt-5" v-if="$gate.isAdminOrAuthor()">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Booklet Table</h3>

                <div class="card-tools">
                    <button class="btn btn-success"  @click="newModal">Add New <i class="fas fa-book fa-fw"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                        <th>Book Number</th>
                        <th>Assign Person</th>
                        <th>Created At</th>
                        <th>Modify</th>
                  </tr>
                  <tr v-for="booklet in booklets.data " :key="booklet.id">
                      <td> {{booklet.bookletNumber}}</td>
                     <td>{{booklet.nameAssign}}</td>
                      <td>{{booklet.created_at | myDate}}</td>
                       <td>
                        <a href="#" @click="editModal(booklet)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#" @click="deleteBooklet(booklet.id)">
                            <i class="fa fa-trash red"></i>
                        </a>

                    </td>
                  </tr>


                  
                </tbody></table>
              </div>
                  <div class="card-footer">
                  <pagination :data="booklets" @pagination-change-page="getResults"></pagination>
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
                            
                                <select name="nameAssign" id="consultant" class="form-control" v-model="form.nameAssign">
                                    <option value="">---Select Travel Consultant---</option>
                                    <option  v-for="user in users" :key="user.id" :value="user.id">{{user.name}}</option>
                                 </select>  
                                 <br>
                                 <p><b> Booklet Number: </b></p>
                                 <div class="row">
                                 <div class="col-md-5">
                                    <input type="number" placeholder="Enter first number" class="form-control mr-5 ml-3" name="f1" v-model="form.f1" :class="{ 'is-invalid': form.errors.has('f1') }">
                                     <has-error :form="form" field="f1"></has-error>
                                 </div>
                                  <div class="col-md-5">
                                    <input type="number" placeholder="Enter second number" class="form-control" name="f2" v-model="form.f2" :class="{ 'is-invalid': form.errors.has('f2') }">
                                    <has-error :form="form" field="f2"></has-error>
                                  </div>
                                 </div>
                                 <br> 
                            
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
            <!-- END MODAL -->
              <!-- /.card-body -->
              <div class="card-footer">
                  
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
    </div>
</template>
<script>
export default {
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
    mounted(){
          if(this.$gate.isAdminOrAuthor()){
                axios.get("api/getType").then(({ data }) => (this.users = data));
              this.loadBooklet();
              this.createdBooklets();
          
            }
    },
    
    methods:{
        
        getResults(page = 1) {
            axios.get('api/booklet?page=' + page)
            .then(response => {
                 this.booklets = response.data;
            });
        },
         
        generateSA(){
            this.$Progress.start();
            this.form.post('api/generateSA')
            .then((response)=>{
                
                 Fire.$emit('createdBooklet');
                 $('#addNew').modal('hide')

                    toast({
                        type: 'success',
                        title: 'Book Created in successfully'
                    })
                this.$Progress.finish();
            })

        },
       newModal(){
            this.editmode = false;
            this.form.reset();
            $('#addNew').modal('show');
        },
        editModal(booklet){
            this.editmode = true;
            this.form.reset();
            $('#addNew').modal('show');
            this.form.fill(booklet);
        },
         updateUser(){4/
                this.$Progress.start();
                // console.log('Editing data');
                this.form.put('api/booklet/'+this.form.id)
                .then(() => {
                    // success
                    $('#addNew').modal('hide');
                     swal(
                        'Updated!',
                        'Information has been updated.',
                        'success'
                        )
                        this.$Progress.finish();
                         Fire.$emit('createdBooklet');
                })
                .catch(() => {
                    this.$Progress.fail();
                });

            },
        createBooklet(){
            this.$Progress.start();
            this.form.post('api/booklet')
            .then((response)=>{
                
                 Fire.$emit('createdBooklet');
                 $('#addNew').modal('hide')

                    toast({
                        type: 'success',
                        title: 'Book Created in successfully'
                    })
                this.$Progress.finish();
            })

        },
       loadBooklet(){
            if(this.$gate.isAdminOrAuthor()){
                axios.get("api/booklet").then(({ data }) => (this.booklets= data));
            }
         },
       
        deleteBooklet(id){
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result)=>{
                if(result.value){
                    this.form.delete('api/booklet/'+id).then(()=>{
                        swal(
                            'Deleted!',
                            'Booklet has been deleted',
                            'success'
                        )
                        Fire.$emit('createdBooklet');
                    }).catch(()=>{
                        swal("Failed!", "There was something wrong.", "warning");
                    })
                }
            })
        },
          createdBooklets() {
           this.loadBooklet();
           Fire.$on('createdBooklet',() => {
               this.loadBooklet();
           });
        
        }
        
    }
}
</script>
