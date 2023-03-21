import Vue from 'vue'
import VueRouter from 'vue-router'

// Login, Dashboard routes
import Layout from '../views/Layout'
import Dashboard from '../views/Dashboard'
import Report from '../views/Report'
import MonthlyReport from '../views/MonthlyReport'
import Login from '../views/auth/Login'

// Profile routes
import settingLayout from '../views/settings/Layout'
import settingProfile from '../views/settings/Profile'
import settingPassword from '../views/settings/Password'

// Asset Category, sub category routes
import assetLayout from '../views/asset/Layout'
import assetIndex from '../views/asset/Asset'
import assetCategory from '../views/asset/category/AssetCategory'
import assetCategoryCreate from '../views/asset/category/AssetCategoryCreate'
import assetCategoryEdit from '../views/asset/category/AssetCategoryEdit'
import assetCategoryDetails from '../views/asset/category/AssetCategoryDetails'

import assetSubCategory from '../views/asset/subcategory/AssetSubCategory'
import assetSubCategoryCreate from '../views/asset/subcategory/AssetSubCategoryCreate'
import assetSubCategoryEdit from '../views/asset/subcategory/AssetSubCategoryEdit'
import assetSubCategoryProducts from '../views/asset/subcategory/AssetSubCategoryProducts'

// Asset Routes
import assetCreate from '../views/asset/AssetCreate'
import assetEdit from '../views/asset/AssetEdit'
import assetDetails from '../views/asset/AssetDetails'

// Audit Routes
import auditLayout from '../views/audit/Layout'
import audit from '../views/audit/Audit'
import auditCreate from '../views/audit/AuditCreate'
import auditEdit from '../views/audit/AuditEdit'
import auditDetails from '../views/audit/AuditDetails'


// Quotation Routes
import quotationLayout from '../views/quotation/Layout'
import quotation from '../views/quotation/Quotation'
import quotationCreate from '../views/quotation/CsQuotationCreate'
import quotationEdit from '../views/quotation/QuotationEdit'
import quotationDetails from '../views/quotation/quotationDetails'

// User Routes
import userLayout from '../views/user/Layout'
import user from '../views/user/User'
import userCreate from '../views/user/UserCreate'
import userEdit from '../views/user/UserEdit'
import userDetails from '../views/user/UserDetails'


// AssetLocation Routes
import locationLayout from '../views/location/Layout'
import assetLocation from '../views/location/AssetLocation'
import assetLocationCreate from '../views/location/AssetLocationCreate'
import assetLocationEdit from '../views/location/AssetLocationEdit'
import assetLocationDetails from '../views/location/AssetLocationDetails'

// Audit recycle bin routes
import recycleLayout from '../views/recycle/Layout'
import recycleCategory from '../views/recycle/RecycleCategory'
import recycleSubCategory from '../views/recycle/RecycleSubCategory'
import recycleAsset from '../views/recycle/RecycleAsset'
import recycleList from '../views/recycle/RecycleList'

Vue.use(VueRouter);
window.Fire = new Vue();

const routes = [{
        path: '/',
        component: Layout,
        children: [
            {
                path: '',
                name: 'Dashboard',
                component: Dashboard,
            },
            {
                path: '/report',
                name: 'Report',
                component: Report,
            },
            {
                path: '/monthly-report',
                name: 'MonthlyReport',
                component: MonthlyReport,
            },
            {
                path: 'setting',
                component: settingLayout,
                children: [{
                        path: '',
                        name: 'settingProfile',
                        component: settingProfile,
                    },
                    {
                        path: 'password',
                        name: 'settingPassword',
                        component: settingPassword,
                    },
                    // {
                    //     path: 'details/:id',
                    //     name: 'chapterDetails',
                    //     component: chapterDetails,
                    // },
                ],
            },
            {
                path: 'recycle_bin',
                component: recycleLayout,
                children: [{
                        path: 'category',
                        name: 'recycleCategory',
                        component: recycleCategory,
                    },
                    {
                        path: 'sub_category',
                        name: 'recycleSubCategory',
                        component: recycleSubCategory,
                    },
                    {
                        path: 'asset',
                        name: 'recycleAsset',
                        component: recycleAsset,
                    },
                    {
                        path: 'list',
                        name: 'recycleList',
                        component: recycleList,
                    },
                    // {
                    //     path: 'details/:id',
                    //     name: 'chapterDetails',
                    //     component: chapterDetails,
                    // },
                ],
            },

            {
                path: 'location',
                component: locationLayout,
                children: [{
                        path: '',
                        name: 'assetLocation',
                        component: assetLocation,
                    },
                    {
                        path: 'create',
                        name: 'assetLocationCreate',
                        component: assetLocationCreate,
                    },
                    {
                        path: 'edit/:id',
                        name: 'assetLocationEdit',
                        component: assetLocationEdit,
                    },
                    {
                        path: 'details/:id',
                        name: 'assetLocationDetails',
                        component: assetLocationDetails,
                    },
                    
                ],
            },
            {
                path: 'asset',
                component: assetLayout,
                children: [
                    {
                        path: '',
                        name: 'assetIndex',
                        component: assetIndex,
                    },
                    {
                        path: 'create',
                        name: 'assetCreate',
                        component: assetCreate,
                    },
                    {
                        path: 'edit/:id',
                        name: 'assetEdit',
                        component: assetEdit,
                    },
                    {
                        path: 'details/:id',
                        name: 'assetDetails',
                        component: assetDetails,
                    },
                    {
                        path: 'category',
                        name: 'assetCategory',
                        component: assetCategory,
                    },
                    {
                        path: 'category/create',
                        name: 'assetCategoryCreate',
                        component: assetCategoryCreate,
                    },
                    {
                        path: 'category/edit/:id',
                        name: 'assetCategoryEdit',
                        component: assetCategoryEdit,
                    },
                    {
                        path: 'category/details/:id',
                        name: 'assetCategoryDetails',
                        component: assetCategoryDetails,
                    },

                    {
                        path: 'subcategory',
                        name: 'assetSubCategory',
                        component: assetSubCategory,
                    },
                    {
                        path: 'subcategory/create',
                        name: 'assetSubCategoryCreate',
                        component: assetSubCategoryCreate,
                    },
                    {
                        path: 'subcategory/edit/:id',
                        name: 'assetSubCategoryEdit',
                        component: assetSubCategoryEdit,
                    },
                    {
                        path: 'subCategory/products/:id',
                        name: 'assetSubCategoryProducts',
                        component: assetSubCategoryProducts,
                    },
                ],
            },

            {
                path: 'audit',
                component: auditLayout,
                children: [
                    {
                        path: '',
                        name: 'auditIndex',
                        component: audit,
                    },
                    {
                        path: 'create',
                        name: 'auditCreate',
                        component: auditCreate,
                    },
                    {
                        path: 'edit/:id',
                        name: 'auditEdit',
                        component: auditEdit,
                    },
                    {
                        path: 'details/:id',
                        name: 'auditDetails',
                        component: auditDetails,
                    },
                ],
            },

            {
                path: 'quotation',
                component: quotationLayout,
                children: [
                    {
                        path: '',
                        name: 'quotationIndex',
                        component: quotation,
                    },
                    {
                        path: 'create',
                        name: 'quotationCreate',
                        component: quotationCreate,
                    },
                    {
                        path: 'edit/:id',
                        name: 'quotationEdit',
                        component: quotationEdit,
                    },
                    {
                        path: 'details/:id',
                        name: 'quotationDetails',
                        component: quotationDetails,
                    },
                ],
            },

            {
                path: 'user',
                component: userLayout,
                children: [
                    {
                        path: '',
                        name: 'userIndex',
                        component: user,
                    },
                    {
                        path: 'create',
                        name: 'userCreate',
                        component: userCreate,
                    },
                    {
                        path: 'edit/:id',
                        name: 'userEdit',
                        component: userEdit,
                    },
                    {
                        path: 'details/:id',
                        name: 'userDetails',
                        component: userDetails,
                    },
                ],
            },

        ]
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    },
];

const management_router = new VueRouter({
    routes,
    mode: 'hash',
    linkExactActiveClass: 'active',
    // scrollBehavior: function(to, from, savedPosition) {
    //     return { x: 0, y: 0 }
    // }
});

management_router.beforeEach((to, from, next) => {
    let isAuthenticated = window.localStorage?.token?.length ? true : false;
    if (isAuthenticated == true) {
        window.axios.defaults.headers.common["Authorization"] = `Bearer ${window.localStorage?.token}`;
    } else {
        window.axios.defaults.headers.common["Authorization"] = null;
    }
    if (!isAuthenticated) {
        console.log('no auth');
        window.location.hash = "#/login"
        next({
            to: '/login'
        })
    } else {
        next()
    }
})

export default management_router
