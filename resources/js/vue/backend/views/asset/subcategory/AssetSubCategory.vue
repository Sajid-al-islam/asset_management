<template>
  <div class="assetCategories">
    <td>
      <div class="d-flex align-items-center">
          <a href="javascript:;" data-bs-toggle="tooltip" class="text-body" data-bs-placement="top" aria-label="Send Mail" data-bs-original-title="Send Mail"><i class="ti ti-mail mx-2 ti-sm"></i></a>
          <a href="app-invoice-preview.html" data-bs-toggle="tooltip" class="text-body" data-bs-placement="top" aria-label="Preview Invoice" data-bs-original-title="Preview Invoice"><i class="ti ti-eye mx-2 ti-sm"></i></a>
          <div class="dropdown">
              <a href="javascript:;" class="btn dropdown-toggle hide-arrow text-body p-0" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical ti-sm"></i></a>
              <div class="dropdown-menu dropdown-menu-end">
                  <a href="javascript:;" class="dropdown-item">Download</a><a href="app-invoice-edit.html" class="dropdown-item">Edit</a><a href="javascript:;" class="dropdown-item">Duplicate</a>
                  <div class="dropdown-divider"></div>
                  <a href="javascript:;" class="dropdown-item delete-record text-danger">Delete</a>
              </div>
          </div>
      </div>
  </td>
  <div class="card">
      <div class="card-header d-flex flex-wrap g-2">
        <h5 class="justify-content-start">
          Asset Sub Categories
        </h5>
        <div class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start mt-md-0 mt-3" style="width:280px;">
            <div class="dt-buttons">
              <router-link :to="{name:'assetSubCategoryCreate'}">
                <button class="dt-button btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button">
                    <span><i class="ti ti-plus me-md-1"></i><span class="d-md-inline-block d-none">Create Sub Category</span></span>
                </button>
              </router-link>
            </div>
        </div>
      </div>
      <div v-if="mssg" class="alert alert-danger alert-dismissible" role="alert">
          {{ mssg }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
          </button>
      </div>
      <div class="card-body table-responsive text-nowrap">
          <table class="table table-hover">
              <thead>
                  <tr>
                      <th>SL</th>
                      <th>Name</th>
                      <th>Category</th>
                      <th>Created at</th>
                      <th>Status</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                  <tr v-for="(category, index) in categories.data" :key="index">
                      <td class="sorting_1"><a href=""><strong>#{{ index+1 }}</strong></a></td>
                      <td>{{ category.name }}</td>
                      <td>
                        <a href="#" class="text-body text-truncate"><span class="fw-semibold">{{ category.category.name }}</span></a>
                      </td>
                      <td>
                          {{ category.date[2] }}
                      </td>
                      <td>
                        <span v-if="category.status == 1" class="badge bg-label-success me-1">Active</span>
                        <span v-else class="badge bg-label-danger me-1">Inactive</span>
                      </td>
                      <td>
                          <ul class="d-flex gap-1 p-0" style="list-style-type:none">
                            <li>
                                <router-link :to="{ name:'assetSubCategoryEdit' , params: { id: category.id } }">
                                  <a class="btn btn-sm btn-outline-info" href="javascript:void(0);"><i class="fa-solid fa-pencil me-1"></i> Edit</a>
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{ name:'assetSubCategoryProducts' , params: { id: category.id } }">
                                  <a class="btn btn-sm btn-outline-warning" href="javascript:void(0);"><i class="fa-solid fa-eye me-1"></i> Details</a>
                                </router-link>
                            </li>
                            <li>
                                <a class="btn btn-sm btn-outline-danger" href="javascript:void(0);" @click.prevent="remove(category)"><i class="fa-solid fa-trash-can me-1"></i> Delete</a>
                            </li>
                          </ul>
                              
                      </td>
                  </tr>
              </tbody>
          </table>
      </div>
      <div class="card-footer pt-4">
          <pagination :data="categories" :limit="10" :size="'small'" :show-disabled="true" :align="'center'" @pagination-change-page="fetch_asset_sub_category_paginate">
              <span slot="prev-nav"><i class="fa fa-angle-left"></i> Previous</span>
              <span slot="next-nav">Next <i class="fa fa-angle-right"></i></span>
          </pagination>
      </div>
  </div>

  </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from "vuex";
export default {
   data() {
      return {
        mssg: ''
      }
    },
  methods: {
    ...mapActions(['fetch_asset_sub_category_paginate']),
    ...mapMutations([]),
    remove: async function(category) {
      
      await window.c_alert() &&
      axios.post('/sub_category/delete', {
        id: category.id
        }).then((response) => {
            window.s_alert('success', response.data.message);
            // this.mssg = response.data.message
            this.fetch_asset_sub_category_paginate();
        })
        .catch((e) => {
            console.log(e);
        });
    }
  },
  computed: {
    ...mapGetters(['get_asset_sub_category_data']),
      categories: function () {
          return this.get_asset_sub_category_data
      }
  },
  created: async function()  {
    await this.fetch_asset_sub_category_paginate();
    // this.categories = this.get_asset_sub_category_data
  },
}
</script>

<style>

</style>
