<template>
    <div id="customer">
        <div class="row justify-content-center">
            <div class="col-md-10"> <!-- if [justify-content-center] is used then don't need to use [offset-x], x=1,2,3... -->

                <!-- Button trigger modal -->
                <div style="position: absolute; right:1rem;">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCustomerModal">
                        Add New Customer
                    </button>
                </div>

                <!-- open pop up form for adding new customer by bootstrap modal -->
                <add-customer-component></add-customer-component>

                <!--card start-->
                <div class="card mt-5">
                    <div class="card-header bg-success">
                        All Customers
                        <div class="float-right">
                            <button type="button" class="btn btn-primary" @click="reload"> <i class="fas fa-sync"></i> </button>
                        </div>
                    </div>

                    <div class="card-body justify-content-center">

                        <!--search customer-->
                        <div class="row mb-3">
                            <div class="col-md-2 form-control">
                                <strong>Search By:</strong>
                            </div>
                            <div class="col-md-3 form-group">
                                <select v-model="queryField" class="form-control">
                                    <option value="name">Name</option>
                                    <option value="email">Email</option>
                                    <option value="phone">Phone</option>
                                    <option value="address">Address</option>
                                    <option value="total">Total</option>
                                </select>
                            </div>
                            <div class="col-md-7 form-group">
                                <form>
                                    <input v-model="query" type="text" class="form-control">
                                </form>
                            </div>
                        </div>
                        <!--end search customer-->

                        <!-- start show customers data grid -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
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
                                <tr v-for="(customer,index) in customers.data">
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
                        <!-- end show customers data grid -->
                    </div>

                    <!-- set laravel vue pagination component here -->
                    <div class="card-footer">
                        <pagination
                                :data="customers" @pagination-change-page="getResults" :limit="5"
                        ></pagination>
                    </div>

                </div>
                <!--card end here-->

            </div>
        </div>

        <vue-progress></vue-progress>
        <vue-snotify></vue-snotify>

    </div>
</template>

<script>
    import VueProgress from "vue-progressbar/src/vue-progressbar";
    export default {
        components: {VueProgress},
        data(){
            return{
                customers:{},
                is_error_customer: false,
                customer_data_error_msg: '',
                pagination:{
                    last_page:1,
                },
                query:'',
                queryField: 'name'

            }
        },
        watch:{
            query:function(newQ,old){
                if(newQ === ''){
                    this.getCustomers()
                }else {
                    //console.log(newQ)
                    this.searchCustomerData()
                }
            }
        },
        mounted() {
            //console.log('Component mounted.')
            this.getCustomers();
        },
        methods:{
            getCustomers(){
                //  [App.vue specific] When App.vue is first loaded start the progress bar
                this.$Progress.start()

                axios.get('/api/customers?page='+this.pagination.last_page)
                    .then(response => {
                        this.customers = response.data
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
            },
            searchCustomerData(){
                //  [App.vue specific] When App.vue is first loaded start the progress bar
                this.$Progress.start()

                axios.get('/api/customers/search/'+this.queryField+'/'+this.query)
                    .then(response => {
                        this.customers = response.data
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
            },

            // Our method to GET results from a Laravel endpoint for pagination
            getResults(page = 1) {
                axios.get('/api/customers?page=' + page)
                    .then(response => {
                        this.customers = response.data;
                    });
            },

            reload(){
                this.getCustomers()
                this.query = ''
                this.queryField = 'name'
                this.$snotify.success('Data Refereshed','Success')
            }
        }
    }
</script>
