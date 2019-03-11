<template>
<div class="bg-menu">
    <el-menu default-active="1" 
    style="height:100vh !important"
    text-color="#000000"
    active-text-color="#9f9fa0"
    class="el-menu-vertical-demo" 
    unique-opened
    @open="handleOpen" 
    @close="handleClose" 
    :collapse="isSideBarClosed">
        <div class="logo-menu" style="height:90px; border-bottom: solid 1px #000000; margin-bottom:30px">
            <div class="logo-div" v-if="!isSideBarClosed">
                <v-img
                max-height="50px"
                max-width="60px"
                src = "/img/icons/credit-card.png"
                ></v-img>
                <span>EMEFA-ACCOUNT</span>
            </div>
        </div>
        <router-link to="/">
        <el-menu-item index="1" class="menu-object">
            <img src="/img/icons/home.svg" class="el-icon" alt="">
            <span slot="title" class="menu-title">Home</span>
        </el-menu-item>
        </router-link>
        <el-submenu index="2" class="menu-object">
            <template slot="title">
                <img src="/img/icons/card-payment.svg" class="el-icon" alt="">
                <span slot="title" class="menu-title">Revenue</span>
            </template>
            <el-menu-item-group>
                <router-link to="/revenue-types">
                    <el-menu-item index="2-1">Revenue Types</el-menu-item>
                </router-link>
                <router-link to="/revenue-records">
                    <el-menu-item index="2-2">Revenues</el-menu-item>
                </router-link>
                <router-link to="/create-revenue">
                    <el-menu-item index="2-3">Create Revenue</el-menu-item>
                </router-link>
            </el-menu-item-group>
        </el-submenu>
        <el-submenu index="3" class="menu-object">
            <template slot="title">
                <img src="/img/icons/card-payment.svg" class="el-icon" alt="">
                <span slot="title" class="menu-title">Expendicture</span>
            </template>
            <el-menu-item-group>
                <router-link to="/expendicture-types">
                    <el-menu-item index="3-1">Expendicture Types</el-menu-item>
                </router-link>
                <router-link to="/expendicture-records">
                    <el-menu-item index="3-2">Expendictures</el-menu-item>
                </router-link>
                <router-link to="/create-expendicture">
                    <el-menu-item index="3-3">Create Expendicture</el-menu-item>
                </router-link>
            </el-menu-item-group>
        </el-submenu>
        <el-submenu index="4" class="menu-object">
            <template slot="title">
                <img src="/img/icons/settings2.svg" class="el-icon" alt="">
                <span slot="title" class="menu-title">Reports</span>
            </template>
            <el-menu-item-group>
                <el-menu-item index="7-1">Expendicture</el-menu-item>
                <el-menu-item index="7-2">Revenue</el-menu-item>
            </el-menu-item-group>
        </el-submenu>                       
    </el-menu>
</div>
</template>

<script>
    export default {
        data() {
            return {
                isCollapse: true
            };
        },
        methods: {
            handleOpen(key, keyPath) {
                console.log(key, keyPath);
            },
            handleClose(key, keyPath) {
                console.log(key, keyPath);
            }
        },
        computed: {
            isSideBarClosed: function() {
                return this.$store.getters.is_sidebar_closed;
            },
        }
    }
</script>

<style>
    .el-menu-vertical-demo:not(.el-menu--collapse) {
        width: 270px;
        height: 100%;
    }
    .el-menu--collapse{
        height: 100% !important;
        overflow-x: hidden;
    }
    .el-menu-vertical-demo {
        width: 80px;
        min-height: 100%;
    }
    .logo-div {
        height: 100%;
        width: 100%;
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: center;
        align-items: center;
    }
    .el-icon {
        width: 40px;
        width: 40px;
    }
    .menu-title {
        margin-left: 10px !important;
        font-size: 13px !important;
    }

    .el-menu {
        /* background-image: linear-gradient(to top, #13649d, #0087bc, #00abd4, #00cfe7, #48f3f3);
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: scroll;
        overflow-y: auto; */
        overflow-y: auto;
        background-color: transparent;
    }
    .bg-menu {
         background-image: linear-gradient(to top, #13649d, #0087bc, #00abd4, #00cfe7, #48f3f3);
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: scroll;
        overflow-y: auto;
    }
    .el-menu-item:hover {
        background-color: #ffffff !important;
    }
    .menu-object {
        margin-bottom: 10px;
    }

    .el-menu::-webkit-scrollbar {
        width: 3px;
        background-color: #f5f5f5;
    }
    .el-menu::-webkit-scrollbar-thumb {
        background-color: #a0a2a5;
    }
    .el-menu::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        background-color: #f5f5f5;
    }

    .el-menu a {
        text-decoration: none;
        color: inherit;
    }

    .el-submenu {
        background-color: transparent !important;
    }
    .el-submenu .el-icon-arrow, .el-submenu__icon-arrow {
        color: #000 !important;
        font-weight: bold;
    }
    .el-submenu .el-submenu .el-icon-arrow-down {
        color: #000 !important;
        font-weight: bold;
    }

    .el-menu--vertical {
        /* background-color: green; */
    }
     .el-menu--vertical .el-menu--popup {
         font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: transparent !important;
    }

    .el-menu--vertical{
        background-color: #09c2e2 !important;
    }
    .el-menu-item:hover {
        
    }
    .el-menu-item:active {
        color: red;
    }
    is-active {
        background-color: red !important;
    }
</style>