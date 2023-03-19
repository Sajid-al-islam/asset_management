<template>
    <section class="p-5">
        <div class="row">
            <!-- Invoice repeater -->
            <div class="col-12">
                

                <div class="card mb-5">
                    <div class="card-header d-flex flex-wrap g-2">
                        <div class="header d-block">
                            <h5 class="card-title mb-0">Asset Reports Filter</h5>
                        </div>
                        
                    </div>
                    
                    <div class="card-body">
                        <div class="filter-area mb-4">
                            <div class="d-flex justify-content-between">
                                <div class="category_filter">
                                    <label for="defaultSelect" class="form-label">Categories</label>
                                    <select id="select2Basic" @change="categoryFilter($event.target.value)" class="category form-select">
                                        <option v-for="(category, index) in get_asset_category_data" :value="category.id" :key="index">{{ category.name }}</option>
                                    </select>
                                </div>
    
                                <div class="sub_category_filter">
                                    <label for="defaultSelect" class="form-label">Sub Categories</label>
                                    <select id="defaultSelect" class="form-select">
                                        <option v-for="(sub_category, index) in get_asset_sub_category_data" :value="sub_category.id" :key="index">{{ sub_category.name }}</option>
                                    </select>
                                </div>

                                <div class="sub_category_filter">
                                    <label for="defaultSelect" class="form-label">Status</label>
                                    <select id="defaultSelect" class="form-select">
                                        <option value="0">Lost</option>
                                        <option value="1">Available</option>
                                    </select>
                                </div>

                                <div class="sub_category_filter">
                                    <label for="defaultSelect" class="form-label">User</label>
                                    <select id="defaultSelect" class="form-select">
                                        <option v-for="(user, index) in get_asset_data.asset_users" :value="user.id" :key="index">{{ user.first_name }} {{ user.last_name }}</option>
                                    </select>
                                </div>
    
                                <div class="from_date_filter">
                                    <label for="defaultSelect" class="form-label">From date</label>
                                    <input type="date" class="form-control">
                                </div>

                                <div class="to_date_filter">
                                    <label for="defaultSelect" class="form-label">To date</label>
                                    <input type="date" class="form-control">
                                </div>

                                <div class="filter_btn row align-items-center mt-3">
                                    <button class="btn btn-sm btn-primary">apply filter</button>
                                </div>
                            </div>
                        </div>

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>price</th>
                                    <th>current value</th>
                                    <th>V no</th>
                                    <th>SV no</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody v-if="get_asset_data.assets" class="table-border-bottom-0">
                                <tr v-for="(asset, index) in get_asset_data.assets.data" :key="index">
                                    <td><strong style="color: #7367f0;">#{{ index+1 }}</strong></td>
                                    <td>
                                        <span class="fw-semibold">{{ asset.name }}</span>
                                    </td>
                                    <td>{{ asset.price }}</td>
                                    <td>{{ asset.current_value }}</td>
                                    <td>{{ asset.v_no }}</td>
                                    <td>{{ asset.sv_no }}</td>
                                    <td>
                                        <span v-if="asset.is_lost == 0" class="badge bg-label-success me-1">Available</span>
                                        <span v-else class="badge bg-label-danger me-1">Lost</span>
                                    </td>
                                    <td>
                                        <ul class="d-flex gap-1 p-0" style="list-style-type:none">
                                            <li>
                                                <router-link :to="{ name:'assetDetails' , params: { id: asset.id } }">
                                                    <a class="btn btn-sm btn-outline-warning" href="javascript:void(0);"><i class="fa-solid fa-eye me-1"></i> view</a>
                                                </router-link>
                                            </li>
                                            <li>
                                                <router-link :to="{ name:'assetEdit' , params: { id: asset.id } }">
                                                <a class="btn btn-sm btn-outline-info" href="javascript:void(0);"><i class="fa-solid fa-pencil me-1"></i> Edit</a>
                                                </router-link>
                                            </li>
                                            <li>
                                                <a class="btn btn-sm btn-outline-danger" href="javascript:void(0);" @click.prevent="remove(asset)"><i class="fa-solid fa-trash-can me-1"></i> Delete</a>
                                            </li>
                                        </ul>
                                            
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
            <!-- /Invoice repeater -->
        </div>
    </section>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from "vuex";

export default {
    data() {
        return {
            assets: '',
            search_value: ''
        }
    },
    
    methods: {
        ...mapActions([
            'fetch_report_asset',
            'fetch_asset_category_all', 
            'fetch_asset_sub_category_all', 
            'search_asset',
            'filter_asset_product',
            'fetch_category_products'
        ]),
        ...mapMutations([]),
        search: async function() {
            let data = {
                key: this.search_value,
                page: 1
            }
            await this.search_asset(data)
        },
        categoryFilter: async function(category_id) {
            console.log("working", category_id);
            let data =  {
                id: category_id,
                is_product: 'yes'
            }
            await this.fetch_category_products(data);
        },
        remove: async function(asset) {
        
        await window.c_alert() &&
        axios.post('/asset/delete', {
            id: asset.id
            }).then((response) => {
                window.s_alert('success', response.data.message);
                // this.mssg = response.data.message
                this.fetch_report_asset();
            })
            .catch((e) => {
                console.log(e);
            });
        }
    },
    computed: {
        ...mapGetters([
            'get_asset_data',
            'get_asset_category_data', 
            'get_asset_sub_category_data'
        ])
    },
    created: async function()  {
        await this.fetch_report_asset();
        await this.fetch_asset_category_all();
        await this.fetch_asset_sub_category_all(); 
        console.log(this.get_asset_data);
    },
    }
</script>

<style>
</style>
