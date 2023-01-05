<template>
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User Profile /</span> Profile</h4>

    <!-- Header -->
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="user-profile-header-banner">
                    <img :src="banner_img" alt="Banner image" class="rounded-top banner_img" />
                </div>
                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                    <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                        <img :src="profile_img()" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
                    </div>
                    <div class="flex-grow-1 mt-3 mt-sm-5">
                        <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                            <div class="user-profile-info">
                                <h4>{{ get_auth_information.first_name }} {{ get_auth_information.last_name }}</h4>
                                <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                    <li class="list-inline-item"><i class="ti ti-color-swatch"></i> {{ get_auth_information.user_name }}</li>
                                    <!-- <li class="list-inline-item"><i class="ti ti-map-pin"></i> Vatican City</li> -->
                                    <li class="list-inline-item" v-if="get_auth_information.date"><i class="ti ti-calendar"></i> {{ get_auth_information.date[1] }}</li>
                                </ul>
                            </div>
                            <a href="javascript:void(0)" class="btn btn-primary waves-effect waves-light"> <i class="ti ti-user-check me-1"></i>Connected </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Header -->

    <!-- Navbar pills -->
    <!-- <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-sm-row mb-4">
                <li class="nav-item">
                    <a class="nav-link active" href="javascript:void(0);"><i class="ti-xs ti ti-user-check me-1"></i> Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pages-profile-teams.html"><i class="ti-xs ti ti-users me-1"></i> Teams</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pages-profile-projects.html"><i class="ti-xs ti ti-layout-grid me-1"></i> Projects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pages-profile-connections.html"><i class="ti-xs ti ti-link me-1"></i> Connections</a>
                </li>
            </ul>
        </div>
    </div> -->
    <!--/ Navbar pills -->

    <!-- User Profile Content -->
    <div class="row">
        <div class="col-xl-4 col-lg-5 col-md-5">
            <!-- About User -->
            <div class="card mb-4">
                <div class="card-body">
                    <small class="card-text text-uppercase">About</small>
                    <ul class="list-unstyled mb-4 mt-3">
                        <li class="d-flex align-items-center mb-3"><i class="ti ti-user"></i><span class="fw-bold mx-2">Full Name:</span> <span>{{ get_auth_information.first_name }} {{ get_auth_information.last_name }}</span></li>
                        <li class="d-flex align-items-center mb-3"><i class="ti ti-check"></i><span class="fw-bold mx-2">Status:</span> <span v-if="get_auth_information.status == 1">Active</span></li>
                        <!-- <li class="d-flex align-items-center mb-3"><i class="ti ti-crown"></i><span class="fw-bold mx-2">Role:</span> <span>{{ get_auth_information.status }}</span></li> -->
                        <li class="d-flex align-items-center mb-3"><i class="ti ti-flag"></i><span class="fw-bold mx-2">Country:</span> <span>BD</span></li>
                        <!-- <li class="d-flex align-items-center mb-3"><i class="ti ti-file-description"></i><span class="fw-bold mx-2">Languages:</span> <span>English</span></li> -->
                    </ul>
                    <small class="card-text text-uppercase">Contacts</small>
                    <ul class="list-unstyled mb-4 mt-3">
                        <li class="d-flex align-items-center mb-3"><i class="ti ti-phone-call"></i><span class="fw-bold mx-2">Contact:</span> <span>{{ get_auth_information.mobile_number }}</span></li>
                        <li class="d-flex align-items-center mb-3"><i class="ti ti-brand-skype"></i><span class="fw-bold mx-2">Telegram Id:</span> <span>{{ get_auth_information.telegram_id }}</span></li>
                        <li class="d-flex align-items-center mb-3"><i class="ti ti-mail"></i><span class="fw-bold mx-2">Email:</span> <span>{{ get_auth_information.email }}</span></li>
                    </ul>
                </div>
            </div>
            <!--/ About User -->
            <!-- Profile Overview -->
            <div class="card mb-4">
                <div class="card-body">
                    <p class="card-text text-uppercase">Overview</p>
                    <ul class="list-unstyled mb-0">
                        <li class="d-flex align-items-center mb-3"><i class="ti ti-check"></i><span class="fw-bold mx-2">Total Asset:</span> <span>{{ asset_count }}</span></li>
                        <!-- <li class="d-flex align-items-center mb-3"><i class="ti ti-layout-grid"></i><span class="fw-bold mx-2">Projects Compiled:</span> <span>146</span></li>
                        <li class="d-flex align-items-center"><i class="ti ti-users"></i><span class="fw-bold mx-2">Connections:</span> <span>897</span></li> -->
                    </ul>
                </div>
            </div>
            <!--/ Profile Overview -->
        </div>
        <div class="col-xl-8 col-lg-7 col-md-7">
            <!-- Projects table -->
            <div class="card mb-4">
                <div class="card-datatable table-responsive">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                        <div class="card-header pb-0 pt-sm-0">
                            <div class="head-label text-center"><h5 class="card-title mb-0">Assets</h5></div>
                            <div class="d-flex justify-content-center justify-content-md-end">
                                <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                    <label>Search:<input type="search" class="form-control" placeholder="" aria-controls="DataTables_Table_0" /></label>
                                </div>
                            </div>
                        </div>
                        <table v-if="get_auth_information.assets.length" class="table table-hover">
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
                            <tbody class="table-border-bottom-0">
                                <tr v-for="(asset, index) in get_auth_information.assets" :key="index">
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
                        <h4 v-else class="text-center my-3">No assets assigned</h4>
                    </div>  
                </div>
            </div>
            <!--/ Projects table -->
        </div>
    </div>
    <!--/ User Profile Content -->
</div>

</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
    data() {
      return {
        banner_img: '/backend/app-assets/images/banner/profile_banner.jpg',
        asset_count: 0,
        mssg: ''
      }
    },
    methods: {
        ...mapActions(['fetch_auth_information', 'fetch_asset_all']),
        profile_img() {
            return "/backend/app-assets/images/avatars/" + this.get_auth_information.photo;
        }
    },
    computed: {
        ...mapGetters(['get_auth_information'])
    },
    
    created: async function()  {
        await this.fetch_auth_information();
        // this.asset_count = this.get_auth_information.assets.length;
    },
}
</script>

<style scoped>
.banner_img {
    height: 275px;
    width: 100%;
    object-fit: cover;
}
</style>
