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
                            <div class="modal-body">
                                <!--show all errors here -->

                                <form action="" method="post">
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
                                </form>
                            </div>

                            <!--modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
