<template>
    <section class="p-5">
        <div class="row">
            <!-- Invoice repeater -->
            <div class="col-12">
                

                <div class="card mb-5">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title mb-0">Dashboard statistics</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <router-link :to="{name:'assetIndex'}">
                                    <div class="card border border-primary mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">Total Asset</h5>
                                            <h5 class="card-text">
                                                {{ get_asset_stats.asset_count }}
                                            </h5>
                                        </div>
                                    </div>
                                </router-link>
                            </div>
                            <div class="col-12 col-md-4 col-lg-4">
                                <router-link :to="{name:'assetCategory'}">
                                    <div class="card bg-transparent border border-primary mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">Total category</h5>
                                            <h5 class="card-text">
                                                {{ get_asset_stats.category_count }}
                                            </h5>
                                        </div>
                                    </div>
                                </router-link>
                            </div>
                            <div class="col-12 col-md-4 col-lg-4">
                                <div class="card bg-transparent border border-primary mb-3">
                                    <router-link :to="{name:'assetSubCategory'}">
                                        <div class="card-body">
                                            <h5 class="card-title">Total Sub categories</h5>
                                            <h5 class="card-text">
                                                {{ get_asset_stats.sub_category_count }}
                                            </h5>
                                        </div>
                                    </router-link>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg-4">
                                <router-link :to="{name:'assetIndex'}">
                                    <div class="card bg-transparent border mb-3" style="border-color: #28c76f !important;">
                                        <div class="card-body">
                                            <h5 class="card-title">Available Asset</h5>
                                            <h5 class="card-text">
                                                {{ get_asset_stats.available_asset_count }}
                                            </h5>
                                        </div>
                                    </div>
                                </router-link>
                            </div>
                            <div class="col-12 col-md-4 col-lg-4">
                                <router-link :to="{name:'assetIndex'}">    
                                    <div class="card bg-transparent border border-danger mb-3" style="border-color: #ea5455 !important;">
                                        <div class="card-body">
                                            <h5 class="card-title">Lost Assets</h5>
                                            <h5 class="card-text">
                                                {{ get_asset_stats.lost_asset_count }}
                                            </h5>
                                        </div>
                                    </div>
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- /Invoice repeater -->
        </div>
    </section>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
    methods: {
        ...mapActions(['fetch_dashboard_stats']),
        checkToken() {
            let token = localStorage.getItem('token');
            
            if(!token) {
                // $(this).router.push({ name: 'Login' })
                this.$router.push({ name: 'Login' })
            }
        }
    },
    computed: {
        ...mapGetters(['get_asset_stats'])
    },
    
    created: async function()  {
        this.checkToken();
        this.fetch_dashboard_stats();
    },
};
</script>

<style>
</style>
