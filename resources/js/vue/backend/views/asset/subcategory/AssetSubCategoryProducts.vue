<template>
    <section class="p-5">
        <div class="row">
            <!-- Invoice repeater -->
            <h4 class="justify-content-start">
                Sub Category Details
            </h4>
            <div class="row invoice-preview">
                <!-- Invoice -->
                <div class="col-xl-12 col-md-12 col-12 mb-md-0 mb-4">
                    <div class="card invoice-preview-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">
                                <div class="mb-xl-0 mb-4">
                                    <div class="d-flex svg-illustration mb-4 gap-2 align-items-center">
                                        <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                                                fill="#7367F0"
                                            ></path>
                                            <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616"></path>
                                            <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z" fill="#7367F0"></path>
                                        </svg>

                                        <span class="app-brand-text fw-bold fs-4">
                                            {{ category.name }}
                                        </span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="divider">
                            <div class="divider-text"><h3>Products:</h3></div>
                        </div>
                        <div class="table-responsive border-top">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Name</th>
                                        <th>price</th>
                                        <th>current value</th>
                                        <th>V no</th>
                                        <th>SV no</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(sub, index) in category.assets" :key="index">
                                        <td class="sorting_1"><a href="#">#{{ index+1 }}</a></td>
                                        <td class="sorting_1">
                                            <a href="javascript:void(0)"><p class="fw-bold">{{ sub.name }}</p></a>
                                            <!-- <span class="badge bg-label-primary px-3 py-2"><p class="m-0 p-0 fw-semibold text-primary"><strong>{{ sub.name }}</strong></p></span> -->
                                        </td>
                                        <td class="text-nowrap">{{ sub.price }}</td>
                                        <td class="text-nowrap">{{ sub.current_value }}</td>
                                        <td class="text-nowrap">{{ sub.v_no }}</td>
                                        <td class="text-nowrap">{{ sub.sv_no }}</td>
                                        <td class="text-nowrap">{{ sub.date[2] }}</td>
                                        <td>
                                            <span v-if="sub.status == 1" class="badge bg-label-success me-1">Active</span>
                                            <span v-else class="badge bg-label-danger me-1">Inactive</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="card-body mx-3">
                            <div class="row">
                                <div class="col-12">
                                    <span class="fw-semibold">Note:</span>
                                    <span>Change the categories from category pages</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Invoice -->
            </div>

            <!-- /Invoice repeater -->
        </div>
        
    </section>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
    data() {
        return {
            id: '',
        }
    },
    methods: {
        ...mapActions(['fetch_asset_sub_category_single']),

    },
    
    created: async function() {
        this.id = this.$route.params.id
        
        await this.fetch_asset_sub_category_single(this.id);
    },

    computed: {
        ...mapGetters(['get_asset_sub_category_single_data']),
        
        category: function () {
    
          return this.get_asset_sub_category_single_data
        }
        
    }
};
</script>

<style>
</style>
