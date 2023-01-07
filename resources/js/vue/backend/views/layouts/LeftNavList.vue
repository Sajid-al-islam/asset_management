<template>
    <div>
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item has-sub">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span>
                    <span class="badge badge-light-warning rounded-pill ms-auto me-1">2</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <router-link :to="{name:'Dashboard'}" class="d-flex align-items-center" href="#">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Analytics">Analytics</span>
                        </router-link>
                    </li>
                </ul>
            </li>
            <li class="navigation-header">
                <span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span>
                <i data-feather="more-horizontal"></i>
            </li>
            <!-- <li class="nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="mail"></i>
                    <span class="menu-title text-truncate" data-i18n="Email">Email</span>
                </a>
            </li> -->
            <li class="nav-item has-sub" >
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="user"></i>
                    <span class="menu-title text-truncate" data-i18n="User">User</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <router-link :to="{name:'settingProfile'}" class="d-flex align-items-center" href="#">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Profile">Profile</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link :to="{name:'settingPassword'}" class="d-flex align-items-center" href="#">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Password">Password</span>
                        </router-link>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-sub" >
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="archive"></i>
                    <span class="menu-title text-truncate" data-i18n="User">Assets</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <router-link :to="{name:'assetIndex'}" class="d-flex align-items-center" href="#">
                           <i class="fa-regular fa-circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Asset Management">Asset Management</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link :to="{name:'assetCategory'}" class="d-flex align-items-center" href="#">
                           <i class="fa-regular fa-circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Asset Categories">Asset Categories</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link :to="{name:'assetSubCategory'}" class="d-flex align-items-center" href="#">
                           <i class="fa-regular fa-circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Asset Sub Categories">Asset Sub Categories</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link :to="{name:'assetLocation'}" class="d-flex align-items-center" href="#">
                           <i class="fa-regular fa-circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Asset Sub Categories">Asset locations</span>
                        </router-link>
                    </li>
                </ul>
            </li>

            <li class="nav-item has-sub" >
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="list"></i>
                    <span class="menu-title text-truncate" data-i18n="User">Audit</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <router-link :to="{name:'auditIndex'}" class="d-flex align-items-center" href="#">
                           <i class="fa-regular fa-circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Asset Management">Audits</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link :to="{name:'auditCreate'}" class="d-flex align-items-center" href="#">
                           <i class="fa-regular fa-circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Asset Categories">Create Audit</span>
                        </router-link>
                    </li>
                </ul>
            </li>

            <li class="nav-item has-sub" >
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="file-text"></i>
                    <span class="menu-title text-truncate" data-i18n="User">Cs quotation</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <router-link :to="{name:'quotationIndex'}" class="d-flex align-items-center" href="#">
                           <i class="fa-regular fa-circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Asset Management">Quotation lists</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link :to="{name:'quotationCreate'}" class="d-flex align-items-center" href="#">
                           <i class="fa-regular fa-circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Asset Categories">Create Quotation</span>
                        </router-link>
                    </li>
                </ul>
            </li>
        
                
            <li v-if="is_admin" class="nav-item has-sub" >
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="users"></i>
                    <span class="menu-title text-truncate" data-i18n="User">User Management</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <router-link :to="{name:'userIndex'}" class="d-flex align-items-center" href="#">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Profile">Users</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link :to="{name:'userCreate'}" class="d-flex align-items-center" href="#">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Password">Create User</span>
                        </router-link>
                    </li>
                </ul>
            </li>
            
            

            <li class="nav-item has-sub" >
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="trash"></i>
                    <span class="menu-title text-truncate" data-i18n="User">Recycle bin</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <router-link :to="{name:'recycleAsset'}" class="d-flex align-items-center" href="#">
                           <i class="fa-regular fa-circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Asset Management">Deleted Assets</span>
                        </router-link>
                    </li>
                    <!-- <li>
                        <router-link :to="{name:'assetCategory'}" class="d-flex align-items-center" href="#">
                           <i class="fa-regular fa-circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Asset Categories">Deleted Categories</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link :to="{name:'assetSubCategory'}" class="d-flex align-items-center" href="#">
                           <i class="fa-regular fa-circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Asset Sub Categories">Deleted Sub Categories</span>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="javascript:void(0)">
                            <i class="fa-regular fa-circle"></i>
                            <span class="menu-title text-truncate" data-i18n="Email">Deleted Assets</span>
                        </a>
                    </li> -->
                </ul>
            </li>

            <li class="nav-item">
                <a class="d-flex align-items-center" href="javascript:void(0)" @click="backup()">
                    <i data-feather="download-cloud"></i>
                    <span class="menu-title text-truncate" data-i18n="Email">Site Backup</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="d-flex align-items-center" href="javascript:void(0)" @click="logout()">
                    <i data-feather="user"></i>
                    <span class="menu-title text-truncate" data-i18n="Email">Logout</span>
                </a>
            </li>
        </ul>
        <nav-time-left-watch></nav-time-left-watch>
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import NavTimeLeftWatch from "./NavTimeLeftWatch.vue";

export default{
    data() {
        return {
            user: ''
        }
    },
    components: { NavTimeLeftWatch },
    methods: {
        ...mapActions(['fetch_auth_information']),
        logout() {
            axios.post('/user/api-logout', {
            }).then((response) => {
                localStorage.removeItem('token')
                location.hash ='#/login'
            })
            .catch((e) => {
                console.log(e.response);
            });
        },
        backup: async function() {
            await window.c_alert() &&
            $(".preloader").addClass("active");
            axios.post('/website/backup', {
            }).then((response) => {
                window.s_alert('success',response.data.message); 
                window.location.href = "https://asset.techparkit.org/app/backup/backup_sql.gz"
                $(".preloader").removeClass("active");
            })
            .catch((e) => {
                console.log(e);
            });
        }
    },
    created: function()  {
        this.fetch_auth_information();
    },
    watch: {
        is_admin(val) {
            setTimeout(() => {
                if (feather) {
                    feather.replace({ width: 14, height: 14 });
                }
            }, 1000);
        }
    },
    computed: {
        ...mapGetters(['get_auth_information']),
        
        is_admin: function() {
           return this.get_auth_information.roles?.find(element => element.name == 'super_admin')
        }
        
    }
}
</script>

<style scoped>
li a {
   font-size: 15px; 
}
</style>
