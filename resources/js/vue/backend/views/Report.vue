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
                        
                        <button class="btn btn-sm btn-primary" @click="exportCSV()">Export to csv</button>
                        
                    </div>
                    
                    <div class="card-body table-responsive">
                        <div class="filter-area mb-4">
                            <div class="d-flex justify-content-between">
                                <div class="category_filter">
                                    <label for="defaultSelect" class="form-label">Categories</label>
                                    <select id="select2Basic" v-model="filter.category_id" @change="filterAsset()" class="category form-select">
                                        <option v-for="(category, index) in get_asset_category_data" :value="category.id" :key="index">{{ category.name }}</option>
                                    </select>
                                </div>
    
                                <div class="sub_category_filter">
                                    <label for="defaultSelect" class="form-label">Sub Categories</label>
                                    <select id="defaultSelect" v-model="filter.subcategory_id" @change="filterAsset()" class="form-select">
                                        <option v-for="(sub_category, index) in get_asset_sub_category_data" :value="sub_category.id" :key="index">{{ sub_category.name }}</option>
                                    </select>
                                </div>

                                <div class="sub_category_filter">
                                    <label for="defaultSelect" class="form-label">Status</label>
                                    <select id="defaultSelect" v-model="filter.status" @change="filterAsset()" class="form-select">
                                        <option value="1">Lost</option>
                                        <option value="0">Available</option>
                                    </select>
                                </div>

                                <div class="sub_category_filter">
                                    <label for="defaultSelect" class="form-label">User</label>
                                    <select id="defaultSelect" v-model="filter.user_id" @change="filterAsset()" class="form-select">
                                        <option v-for="(user, index) in get_asset_data.asset_users" :value="user.id" :key="index">{{ user.first_name }} {{ user.last_name }}</option>
                                    </select>
                                </div>
    
                                <div class="from_date_filter">
                                    <label for="defaultSelect" class="form-label">From date</label>
                                    <input type="date" v-model="filter.from_date" @change="filterAsset()" class="form-control">
                                </div>

                                <div class="to_date_filter">
                                    <label for="defaultSelect" class="form-label">To date</label>
                                    <input type="date" v-model="filter.to_date" @change="filterAsset()" class="form-control">
                                </div>

                                <div class="filter_btn row align-items-center mt-3">
                                    <button class="btn btn-sm btn-primary" @click="filterAsset()">apply filter</button>
                                </div>
                            </div>
                        </div>

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Purchase Date</th>
                                    <th>Name</th>
                                    <th>price</th>
                                    <th>current value</th>
                                    <th>V no</th>
                                    <th>SV no</th>
                                    <th>Location of asset</th>
                                    <th>Name of user</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody v-if="get_asset_data.assets" class="table-border-bottom-0">
                                <tr v-for="(asset, index) in get_asset_data.assets.data" :key="index">
                                    <td><strong style="color: #7367f0;">#{{ index+1 }}</strong></td>
                                    <td>{{ asset.buying_date }}</td>
                                    <td>
                                        <span class="fw-semibold">{{ asset.name }}</span>
                                    </td>
                                    <td>{{ asset.price }}</td>
                                    <td>{{ asset.depreciated_price }}</td>
                                    <td>{{ asset.v_no }}</td>
                                    <td>{{ asset.sv_no }}</td>
                                    <td>{{ asset.location }}</td>
                                    <td>{{ asset.user.first_name }} {{ asset.user.last_name }}</td>
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
            search_value: '',
            filter: {
                category_id: '',
                subcategory_id: '',
                status: '',
                user_id: '',
                from_date: '',
                to_date: '',
            }
        }
    },
    watch: {
        filter: {
            handler: async function(newValue, oldValue) {
                this.filter.subcategory_id = ''
                await this.fetch_subcategory_by_category(newValue.category_id);
            },
            deep: true,
        },
    },
    methods: {
        ...mapActions([
            'fetch_report_asset',
            'fetch_asset_category_all', 
            'fetch_asset_sub_category_all', 
            'search_asset',
            'filter_report_asset',
            'fetch_subcategory_by_category',
            'export_asset_all'
        ]),
        ...mapMutations([]),
        search: async function() {
            let data = {
                key: this.search_value,
                page: 1
            }
            await this.search_asset(data)
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
        },
        exportCSV: async function() {
            await this.export_asset_all();
        },
        filterAsset: async function() {
            let isEmpty = Object.values(this.filter).every(x => x === null || x === '')
            if(isEmpty) {
                window.s_alert('warning', "Select at lest one field to apply filter");
            }else {
                let data =  {
                    category_id: this.filter.category_id,
                    subcategory_id: this.filter.subcategory_id,
                    status: this.filter.status,
                    user_id: this.filter.user_id,
                    from_date: this.filter.from_date,
                    to_date: this.filter.to_date,
                    page: 1
                }
                await this.filter_report_asset(data);
                console.log(this.get_asset_data);
            }
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
    },
}
</script>

<style>
</style>
