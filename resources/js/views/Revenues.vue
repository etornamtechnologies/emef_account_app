<template>
    <v-app>
        <v-container fluid>
            <v-dialog v-model="edit_dialog" width="400px">
                <v-card>
                    <v-card-title>Edit Revenue Type</v-card-title>
                    <v-card-text>
                        <v-container grid-list-xs>
                            <v-layout column>
                                <v-flex>
                                    <v-text-field
                                    label="Date"
                                    v-model="edit_revenue.date"></v-text-field>
                                </v-flex>
                                <v-flex>
                                    <v-text-field
                                    label="Payee"
                                    v-model="edit_revenue.payee_name"></v-text-field>
                                </v-flex>
                                <v-flex>
                                    <v-text-field
                                    label="Registration #"
                                    v-model="edit_revenue.registration_no"></v-text-field>
                                </v-flex>
                                <v-flex>
                                    <v-select
                                    v-model="edit_revenue.revenue_type_id"
                                    :items="revenueTypeList"
                                    ></v-select>
                                </v-flex>
                                <v-flex>
                                    <v-text-field
                                    label="amount (GHC)"
                                    type="number"
                                    min="0"
                                    step="0.01"
                                    v-model="edit_revenue.amount"></v-text-field>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn
                        color="danger"
                        flat="flat"
                        @click="edit_dialog = false"
                        >
                            Close
                        </v-btn>
                        <v-spacer></v-spacer>
                        <v-btn
                        color="cyan"
                        flat="flat"
                        @click="updateRevenue">UPDATE</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-layout>
                <v-flex xs12>
                    <v-card>
                        <v-toolbar color="cyan" dark>
                            <v-toolbar-side-icon></v-toolbar-side-icon>
                            <v-toolbar-title>Revenue Records</v-toolbar-title>
                        </v-toolbar>
                        <v-data-table
                        :headers="headers"
                        :items="revenues"
                        >
                            <template v-slot:items="props">
                                <td class="text-xs-left">{{ props.index + 1 }}</td>
                                <td class="text-xs-left" width="200px">
                                   {{props.item.date}}
                                </td>
                                <td class="text-xs-left" width="200px">
                                    {{props.item.payee_name}}
                                </td>
                                <td class="text-xs-left" width="200px">
                                    {{props.item.registration_no}}
                                </td>
                                <td class="text-xs-left" width="200px">
                                    {{props.item.revenue_type.label}}
                                </td>
                                <td width="200px">
                                    {{props.item.amount}}
                                </td>
                                <td>
                                    <v-btn
                                    icon
                                    color="cyan"
                                    @click="openEditRevenueDialog(props.item, props.index)">
                                        <v-icon
                                        color="#ffffff"
                                        small
                                        >
                                            edit
                                        </v-icon>
                                    </v-btn>
                                    <v-btn 
                                    icon 
                                    color="red"
                                    @click="deleteRevenue(props.item)">
                                        <v-icon
                                        small
                                        color="#ffffff"
                                        >
                                            delete
                                        </v-icon>
                                    </v-btn>
                                </td>
                            </template>
                            <v-alert v-slot:no-results :value="true" color="error" icon="warning">
                                Your search for "{{ search }}" found no results.
                            </v-alert>
                        </v-data-table>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </v-app>
</template>
<script>
    import { Message } from 'element-ui'
    import { GetRevenue, UpdateRevenue, DeleteRevenue, GetRevenueTypes } from '../utils/revenue'
    export default {
        mounted() {
            this.fetchRevenueTypes();
            this.fetchRevenues();
        },
        data() {
            return {
                filter:'',
                edit_dialog: false,
                revenues: [],
                headers: [{text:'#', value:'index', sortable:false},{text:'date',value:'',sortable:false}
                            , {text:'payee', value:'payee_name',sortable:false}, {text:'registration number', value:'registration_no',sortable:false}
                            , {text:'details', value:'revenue_type_id',sortable:false},{text:'Amount (GHC)', value:'amount',sortable:false}
                            , {text:'', value:'buttons',sortable:false}],
                edit_revenue: {},  
                edit_revenue_index: null,   
                revenue_types: [],       
            }
        },
        methods: {
            deleteRevenue: function(row){
                let index = this.revenues.indexOf(row);
                let data = row || {};
                if(confirm('Are you sure you want to delete')) {
                    DeleteRevenue(data)
                        .then(result=> {
                            this.revenues.splice(index, 1);
                        })
                        .catch(err=> {

                        })
                }
            },
            openEditRevenueDialog: function(row, index){
                this.edit_revenue_index = index;
                this.edit_revenue = Vue.util.extend({}, row);
                this.edit_dialog = true;
            },
            fetchRevenues: function() {
                GetRevenue()
                    .then(result=> {
                        console.log(result)
                        this.revenues = result.revenues || [];
                    })
            },
            fetchRevenueTypes: function() {
                let data = {filter: this.filter}
                GetRevenueTypes(data)
                    .then(result=> {
                        this.revenue_types = result.revenue_types || [];
                    })
                    .catch(err=> {
                        console.log(err);
                    })
            },
            updateRevenue: function() {
                let index = this.edit_revenue_index;
                console.log('idx',index);
                UpdateRevenue(this.edit_revenue)
                    .then(result=> {
                        this.edit_dialog = false;
                        this.edit_revenue = {};
                        this.revenues = result.revenues;
                    })
                    .catch(err=> {

                    })
            }
        },
        computed: {
            revenueTypeList: function(){
                let typeEntries = this.revenue_types || [];
                let res = typeEntries.map((entry)=> {
                    return {value:entry.id, text:entry.label}
                })
                console.log('lis', res)
                return res;
            }
        }
    }
</script>
<style scoped>

</style>