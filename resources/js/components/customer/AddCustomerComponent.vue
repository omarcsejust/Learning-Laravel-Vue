<template>
    <div id="add_customer">
        <div class="row">
            <div class="col-8 offset-2">
                <!-- Button trigger modal -->
                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal">
                     Add Category
                 </button>-->

                <!-- Modal -->
                <div class="modal fade" id="addCustomerModal" tabindex="-1" role="dialog" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!--modal header-->
                            <div class="modal-header">
                                <h5 class="modal-title" id="addCustomerModalLabel">Add New Customer</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <!--modal body/content -->
                            <form @submit.prevent="addCustomer" @keydown="form.onKeydown($event)">
                                <div class="modal-body">
                                    <!--show all errors here -->
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input v-model="form.name" type="text" name="name"
                                                   class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                            <has-error :form="form" field="name"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input v-model="form.email" type="text" name="email"
                                                   class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                            <has-error :form="form" field="email"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input v-model="form.phone" type="text" name="phone"
                                                   class="form-control" :class="{ 'is-invalid': form.errors.has('phone') }">
                                            <has-error :form="form" field="phone"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label>Total</label>
                                            <input v-model="form.total" type="text" name="total"
                                                   class="form-control" :class="{ 'is-invalid': form.errors.has('total') }">
                                            <has-error :form="form" total="name"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea rows="3" v-model="form.address" type="text" name="address"
                                                      class="form-control" :class="{ 'is-invalid': form.errors.has('address') }"></textarea>
                                            <has-error :form="form" field="address"></has-error>
                                        </div>

                                        <button :disabled="form.busy" type="submit" class="btn btn-primary">Add Customer</button>


                                    <!--<form action="" method="post">
                                        <div class="form-group">
                                            <label>Customer Name</label>
                                            <input type="text" class="form-control" name="category_name" placeholder="Enter Customer Name">
                                        </div>
                                        <div class="form-group">
                                            <label>Customer Email</label>
                                            <input type="text" class="form-control" name="category_name" placeholder="Enter Customer Email">
                                        </div>
                                        <div class="form-group">
                                            <label>Customer Phone</label>
                                            <input type="text" class="form-control" name="category_name" placeholder="Enter Customer Phone">
                                        </div>
                                        <div class="form-group">
                                            <label>Total</label>
                                            <input type="text" class="form-control" name="category_name" placeholder="Enter Total">
                                        </div>
                                        <div class="form-group">
                                            <label>Customer Address</label>
                                            <textarea type="" class="form-control" name="category_name" rows="3"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>-->
                                </div>

                                <!--modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                // Create a new form instance
                form: new Form({
                    name: '',
                    email: '',
                    phone: '',
                    total: 0,
                    address: '',
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            addCustomer(){
                //console.log("Hello>>>>>>>")
                this.$Progress.start()
                this.form.post('/api/customers')
                    .then(({ data }) => {
                        console.log(data)
                        if (this.form.successful){
                            this.$Progress.finish()
                                //$('#addCustomerModal').modal.hide()
                            this.$snotify.success('Data Inserted Successfully','Success')
                        }else {
                            this.$Progress.fail()
                            this.$snotify.error('Data Insert Fail!','Error')
                        }
                    })
                    .catch(e => {
                        console.log(e)
                        this.$snotify.error('Data Insert Fail!','Error')
                        this.$Progress.fail()
                    })
            }
        }
    }
</script>
