<template>
    <div id="add_customer">
        <!-- Modal -->
        <div class="modal fade" id="addCustomerModal" tabindex="-1" role="dialog" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!--modal header-->
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCustomerModalLabel">{{formUpdateMode ? "Update Customer" : "Add New Customer"}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!--modal body/content -->
                    <form @submit.prevent="addCustomer" @keydown="form.onKeydown($event)">
                        <div class="modal-body">
                            <!--show all errors here -->
                            <alert-error :form="form"></alert-error>
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
</template>

<script>
    export default {
        props:['formUpdateMode','singleCustomer'],
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
        
        watch:{
            singleCustomer: function (newVal, oldVal) {
                if (newVal){
                    this.loadCustomerDataToForm()
                }
            }
        },
        
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            addCustomer(){
                //console.log("Hello>>>>>>>")
                this.$Progress.start()
                this.form.busy = true
                this.form.post('/api/customers')
                    .then(({ data }) => {
                        console.log(data)
                        if (this.form.successful){
                            this.$Progress.finish()
                            this.$snotify.success('Data Inserted Successfully','Success')
                        }else {
                            this.$Progress.fail()
                            this.$snotify.error('Data Insert Fail!','Error')
                            $('#addCustomerModal').modal.hide()
                        }
                    })
                    .catch(e => {
                        //$('#addCustomerModal').modal.hide()
                        console.log(e)
                        this.$snotify.error('Data Insert Fail!','Error')
                        this.$Progress.fail()
                    })
            },
            loadCustomerDataToForm(){
                this.form.reset()
                this.form.clear()
                this.form.fill(this.singleCustomer)
            }
        }
    }
</script>
