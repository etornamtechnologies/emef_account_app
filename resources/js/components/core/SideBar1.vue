<template>
    <div :class="isSideBarClosed ? 'mini-sidebar' : 'sidebar'">
        <div class="sidebar-top">
            <div class="logo-div" v-if="!isSideBarClosed">
                <v-img
                max-height="50px"
                max-width="60px"
                src = "/img/icons/credit-card.png"
                ></v-img>
                <span>HR-PAYROLL</span>
            </div>
        </div>
        <div class="sidebar-middle">
            <div class="nav-menu">

                <div class="nav-item-container" style="margin-bottom:10px">
                    <router-link to="/dashboard" class="nav-router-link">
                        <div class="nav-item">
                            <div class="nav-item-icon">
                                <v-img
                                max-width="40px"
                                max-height="40px"
                                src="/img/icons/home.svg"></v-img>
                            </div>
                            <div class="nav-item-title" v-if="!isSideBarClosed">
                                Home
                            </div>
                        </div>
                    </router-link>
                </div>
                <el-collapse style="width:100%; background-color:inherit">
                    <el-collapse-item style="background-color:red">
                        <template slot="title" v-if="!isSideBarClosed">GHjjd</template>
                    </el-collapse-item>
                </el-collapse>

                <!-- <div class="nav-item-container">
                    <div class="nav-item" @click="togglePayrollMenu">
                        <div class="nav-item-icon">
                            <v-img
                            max-width="40px"
                            max-height="40px"
                            src="/img/icons/card-payment.svg"></v-img>
                        </div>
                        <div class="nav-item-title" v-if="!isSideBarClosed">
                            Payroll
                            <div style="floats:right !importatnt">
                                <v-icon style="float:right" v-if="!is_payroll_menu">chevron_right</v-icon>
                                <v-icon style="float:right" v-if="is_payroll_menu">chevron_left</v-icon>
                            </div>
                        </div>
                    </div>
                    <div class="sub-menu" v-if="is_payroll_menu">
                        <router-link to="" class="nav-router-link">
                            <div class="nav-item">
                                <div class="nav-item-icon">
                                    <v-img
                                    max-width="20px"
                                    max-height="20px"
                                    src="/img/icons/dot-and-circle.svg"></v-img>
                                </div>
                                <div class="nav-item-title" v-if="!isSideBarClosed">
                                    Pay
                                </div>
                            </div>
                        </router-link>
                        <router-link to="" class="nav-router-link">
                            <div class="nav-item">
                                <div class="nav-item-icon">
                                    <v-img
                                    max-width="20px"
                                    max-height="20px"
                                    src="/img/icons/dot-and-circle.svg"></v-img>
                                </div>
                                <div class="nav-item-title" v-if="!isSideBarClosed">
                                    All Payroll
                                </div>
                            </div>
                        </router-link>                            
                    </div>
                </div>

                <div class="nav-item-container">
                    <div class="nav-item" @click="toggleAttendanceMgtMenu">
                        <div class="nav-item-icon">
                            <v-img
                            max-width="40px"
                            max-height="40px"
                            src="/img/icons/checking-attendance.svg"></v-img>
                        </div>
                        <div class="nav-item-title" v-if="!isSideBarClosed">
                            Attendance Managment
                            <div style="floats:right !importatnt">
                                <v-icon style="float:right" v-if="!attendance_mgt_open">chevron_right</v-icon>
                                <v-icon style="float:right" v-if="attendance_mgt_open">chevron_left</v-icon>
                            </div>
                        </div>
                    </div>   
                    <div class="sub-menu" v-if="attendance_mgt_open">
                        <router-link to="" class="nav-router-link">
                            <div class="nav-item">
                                <div class="nav-item-icon">
                                    <v-img
                                    max-width="20px"
                                    max-height="20px"
                                    src="/img/icons/dot-and-circle.svg"></v-img>
                                </div>
                                <div class="nav-item-title" v-if="!isSideBarClosed">
                                    Pay
                                </div>
                            </div>
                        </router-link>
                        <router-link to="" class="nav-router-link">
                            <div class="nav-item">
                                <div class="nav-item-icon">
                                    <v-img
                                    max-width="20px"
                                    max-height="20px"
                                    src="/img/icons/dot-and-circle.svg"></v-img>
                                </div>
                                <div class="nav-item-title" v-if="!isSideBarClosed">
                                    All Payroll
                                </div>
                            </div>
                        </router-link>                            
                    </div>
                </div>

                <div class="nav-item-container">
                    <div class="nav-item" @click="toggleFundMgtMenu">
                        <div class="nav-item-icon">
                            <v-img
                            max-width="40px"
                            max-height="40px"
                            src="/img/icons/piggy-bank.svg"></v-img>
                        </div>
                        <div class="nav-item-title" v-if="!isSideBarClosed">
                            Fund Management
                            <div style="floats:right !importatnt">
                                <v-icon style="float:right" v-if="!fund_mgt_open">chevron_right</v-icon>
                                <v-icon style="float:right" v-if="fund_mgt_open">chevron_left</v-icon>
                            </div>
                        </div>
                    </div>   
                    <div class="sub-menu" v-if="fund_mgt_open">
                        <router-link to="" class="nav-router-link">
                            <div class="nav-item">
                                <div class="nav-item-icon">
                                    <v-img
                                    max-width="20px"
                                    max-height="20px"
                                    src="/img/icons/dot-and-circle.svg"></v-img>
                                </div>
                                <div class="nav-item-title" v-if="!isSideBarClosed">
                                    Pay
                                </div>
                            </div>
                        </router-link>
                        <router-link to="" class="nav-router-link">
                            <div class="nav-item">
                                <div class="nav-item-icon">
                                    <v-img
                                    max-width="20px"
                                    max-height="20px"
                                    src="/img/icons/dot-and-circle.svg"></v-img>
                                </div>
                                <div class="nav-item-title" v-if="!isSideBarClosed">
                                    All Payroll
                                </div>
                            </div>
                        </router-link>                            
                    </div>
                </div>  

                <div class="nav-item-container">
                    <div class="nav-item" @click="toggleReportMenu">
                        <div class="nav-item-icon">
                            <v-img
                            max-width="40px"
                            max-height="40px"
                            src="/img/icons/report.svg"></v-img>
                        </div>
                        <div class="nav-item-title" v-if="!isSideBarClosed">
                            Report
                            <div style="floats:right !importatnt">
                                <v-icon style="float:right" v-if="!report_menu_open">chevron_right</v-icon>
                                <v-icon style="float:right" v-if="report_menu_open">chevron_left</v-icon>
                            </div>
                        </div>
                    </div>   
                    <div class="sub-menu" v-if="report_menu_open">
                        <router-link to="" class="nav-router-link">
                            <div class="nav-item">
                                <div class="nav-item-icon">
                                    <v-img
                                    max-width="20px"
                                    max-height="20px"
                                    src="/img/icons/dot-and-circle.svg"></v-img>
                                </div>
                                <div class="nav-item-title" v-if="!isSideBarClosed">
                                    Pay
                                </div>
                            </div>
                        </router-link>
                        <router-link to="" class="nav-router-link">
                            <div class="nav-item">
                                <div class="nav-item-icon">
                                    <v-img
                                    max-width="20px"
                                    max-height="20px"
                                    src="/img/icons/dot-and-circle.svg"></v-img>
                                </div>
                                <div class="nav-item-title" v-if="!isSideBarClosed">
                                    All Payroll
                                </div>
                            </div>
                        </router-link>                            
                    </div>
                </div>  

                <div class="nav-item-container">
                    <div class="nav-item" @click="toggleConfigMenu">
                        <div class="nav-item-icon">
                            <v-img
                            max-width="40px"
                            max-height="40px"
                            src="/img/icons/report.svg"></v-img>
                        </div>
                        <div class="nav-item-title" v-if="!isSideBarClosed">
                            Configuration
                            <div style="floats:right !importatnt">
                                <v-icon style="float:right" v-if="!config_menu_open">chevron_right</v-icon>
                                <v-icon style="float:right" v-if="config_menu_open">chevron_left</v-icon>
                            </div>
                        </div>
                    </div>   
                    <div class="sub-menu" v-if="config_menu_open">
                        <router-link to="" class="nav-router-link">
                            <div class="nav-item">
                                <div class="nav-item-icon">
                                    <v-img
                                    max-width="20px"
                                    max-height="20px"
                                    src="/img/icons/dot-and-circle.svg"></v-img>
                                </div>
                                <div class="nav-item-title" v-if="!isSideBarClosed">
                                    Pay
                                </div>
                            </div>
                        </router-link>
                        <router-link to="" class="nav-router-link">
                            <div class="nav-item">
                                <div class="nav-item-icon">
                                    <v-img
                                    max-width="20px"
                                    max-height="20px"
                                    src="/img/icons/dot-and-circle.svg"></v-img>
                                </div>
                                <div class="nav-item-title" v-if="!isSideBarClosed">
                                    All Payroll
                                </div>
                            </div>
                        </router-link>                            
                    </div>
                </div>                                             -->
            </div>
        </div>
    </div>
</template>

<script scoped>
    export default {
        mounted() {
            
        },
        data () {
            return {
                drawer: true,
                right: null,
                is_payroll_menu: false,
                attendance_mgt_open: false,
                fund_mgt_open: false,
                report_menu_open: false,
                config_menu_open: false,
            }
        },
        methods: {
            toggleSideBar: function() {
                this.$store.dispatch('toggleSidebar').app;
            },
            togglePayrollMenu: function(){
                this.is_payroll_menu = !this.is_payroll_menu;
            },
            toggleAttendanceMgtMenu: function() {
                this.attendance_mgt_open = !this.attendance_mgt_open;
            },
            toggleFundMgtMenu: function() {
                this.fund_mgt_open = !this.fund_mgt_open;
            },
            toggleReportMenu: function() {
                this.report_menu_open = !this.report_menu_open;
            },
            toggleConfigMenu: function(){
                this.config_menu_open = !this.config_menu_open;
            }
        },
        computed: {
            isSideBarClosed: function() {
                return this.$store.getters.is_sidebar_closed;
            }
        }
    }
</script>

<style scoped>
    .sidebar {
        width:280px;
        height: 100%;
        /* background-color: #29bcbc; */
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        justify-content: flex-start;
        background-image: linear-gradient(to top, #13649d, #0087bc, #00abd4, #00cfe7, #48f3f3);
    }
    .mini-sidebar {
        width:60px;
        height: 100%;
        background-color: #29bcbc;
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        justify-content: flex-start;
    }
    .sidebar-top {
        height: 10%;
        width: 100%;
        border-bottom: solid .5px #63f9f9;
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: center;
        align-items: center;
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
    .sidebar-middle {
        height: 90%;
        overflow-y: auto;
        width: 100%;
    }
    .sidebar-middle::-webkit-scrollbar {
        width: 3px;
        background-color: #f5f5f5;
    }
    .sidebar-middle::-webkit-scrollbar-thumb {
        background-color: #a0a2a5;
    }
    .sidebar-middle::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        background-color: #f5f5f5;
    }

    .nav-menu {
        width: 100%;
        height: 100%;
        list-style: none;
        display: flex;
        flex-wrap: nowrap;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
        padding: 0;
    }
    .nav-item {
        width: 100%;
        height: 60px;
        display: flex;
        flex-direction: row;
        justify-items: flex-start;
        flex-wrap: nowrap;
        align-items: center;
    }
    .nav-item-icon {
        height: 100%;
        width: 60px;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
    }
    .nav-item-title {
        height: 100%;
        width: 100%;
        padding-left: 5px;
        display: flex;
        flex-wrap: nowrap;
        flex-direction: row;
        justify-content: flex-start;
        align-items: center;
        font-size: 16px;
    }
    .nav-item:hover {
        background-color: #aeefef;
    }
    .item-collapse {
        width: 100%;
        height: 100%;
    }
    
     .nav-router-link {
        text-decoration: none;
        width: 100%;
        height: 50px;
        color: inherit;
        padding: 0;
    }

    .nav-item-container {
        width: 100%;
        height: auto;
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        margin-top: 10px !important;
    }

    .sub-menu {
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 0;
        height: auto;
    }
    .el-collapse-item {
        background-color: red !important; 
    }
</style>
