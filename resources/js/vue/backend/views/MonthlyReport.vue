<template>
    <section class="p-5">
        <div class="row">
            <!-- Invoice repeater -->
            <div class="col-12">


                <div class="card mb-5">
                    <div class="card-header d-flex justify-content-between" id="print_card_header">
                        <h5 class="card-title mb-0">Category wise asset statistics</h5>
                        <button class="btn btn-sm btn-primary" @click="print()">Print</button>
                    </div>
                    <div class="card-body" id="print_body">
                        <div class="row">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">S.L No.</th>
                                        <th scope="col">Asset Category</th>
                                        <th scope="col">Number of asset</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Current Value</th>
                                        <th scope="col">Comments</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(category, index) in get_category_wise_stats" :key="index">
                                        <th scope="row">{{ index+1 }}</th>
                                        <td>{{ category.name }}</td>
                                        <td>{{ category.assets_count }}</td>
                                        <td>{{ category.assets_sum_price }}</td>
                                        <td>{{ get_asset_current_price(category.assets) }}</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
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
        ...mapActions(['fetch_category_wise_stats']),
        checkToken() {
            let token = localStorage.getItem('token');

            if (!token) {
                // $(this).router.push({ name: 'Login' })
                this.$router.push({ name: 'Login' })
            }
        },
        get_asset_current_price(assets) {
            var total_sum = 0;
            for (var i = 0; i < assets.length; i++) {
                total_sum += assets[i].depreciated_price;
                return total_sum;
            }
        },
        print: function() {
            window.print();
        },
    },
    computed: {
        ...mapGetters(['get_category_wise_stats'])
    },

    created: async function () {
        this.checkToken();
        this.fetch_category_wise_stats();
        console.log('category wise =>',this.get_category_wise_stats);
    },
};
</script>

<style></style>
