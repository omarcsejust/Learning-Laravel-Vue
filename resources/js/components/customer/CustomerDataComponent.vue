<template>
    <div id="customer">
        <div class="row justify-content-center">
            <div class="col-md-10"> <!-- if [justify-content-center] is used then don't need to use [offset-x], x=1,2,3... -->
                <div class="card">
                    <div class="card-header bg-success">All Customers</div>
                    <div class="card-body">
                        <table class="table table-responsive table-bordered table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Total</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(customer,index) in customers">
                                <th scope="row">{{index+1}}</th>
                                <td>{{customer.name}}</td>
                                <td>{{customer.email}}</td>
                                <td>{{customer.phone}}</td>
                                <td>{{customer.total}}</td>
                                <td class="text-center">

                                    <button type="button" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                                </td>
                            </tr>

                            <tr v-if="is_error_customer" class="text-danger text-center">
                                <td colspan="6">{{customer_data_error_msg}}!</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- set progressbar -->
        <vue-progress-bar></vue-progress-bar>
    </div>
</template>

<script>
    export default {

        data(){
            return{
                customers:[],
                is_error_customer: false,
                customer_data_error_msg: '',

            }
        },
        mounted() {
            console.log('Component mounted.')
            this.getCustomers();
        },
        methods:{
            getCustomers(){
                //  [App.vue specific] When App.vue is first loaded start the progress bar
                this.$Progress.start()

                axios.get('/api/customers')
                    .then(response => {
                        this.customers = response.data.data
                        //console.log(response)
                        //  [App.vue specific] When App.vue is finish loading finish the progress bar
                        this.$Progress.finish()
                    })
                    .catch(e => {
                        console.log(e)
                        this.is_error_customer = true
                        this.customer_data_error_msg = e.toString()
                        this.$Progress.fail()
                    })
            }
        }
    }
</script>
