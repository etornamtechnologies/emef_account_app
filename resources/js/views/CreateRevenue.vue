<template>
    <v-app>
        <v-container fluid>
            <v-layout>  
                <v-card width="100%">
                <form @submit.prevent="createRevenue">
                    <v-toolbar color="cyan" dark flat>
                        <v-toolbar-side-icon></v-toolbar-side-icon>
                        <v-toolbar-title>Create Revenue</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-btn 
                        @click="resetForm"
                        icon>
                            <v-icon>refresh</v-icon>
                        </v-btn>
                        <v-btn 
                        icon
                        @click="saveToDisk">
                            <v-icon>save</v-icon>
                        </v-btn>
                        <v-btn icon
                        type="submit">
                            <v-icon>add</v-icon>
                        </v-btn>
                    </v-toolbar>    


                    <v-data-table
                    :headers="headers"
                    :items="revenue_entries"
                    :hide-actions=true
                    >
                        <template v-slot:items="props">
                            <td class="text-xs-left">{{ props.index + 1 }}</td>
                            <td class="text-xs-left" width="200px">
                                <v-text-field
                                placeholder="dd/mm/yyyy"
                                v-model="props.item.date"></v-text-field>
                            </td>
                            <td class="text-xs-left" width="200px">
                                <v-text-field
                                placeholder="payee"
                                v-model="props.item.payee_name"></v-text-field>
                            </td>
                            <td class="text-xs-left" width="200px">
                                <v-text-field
                                placeholder="registration #"
                                v-model="props.item.registration_no"></v-text-field>
                            </td>
                            <td class="text-xs-left" width="200px">
                                <v-select
                                v-model="props.item.revenue_type_id"
                                :items="revenueTypeList"
                                :rules="[v => !!v || 'Item is required']"
                                required
                                ></v-select>
                            </td>
                            <td width="200px">
                                <v-text-field
                                v-model="props.item.amount"
                                type="number" step="0.01"></v-text-field>
                            </td>
                            <td>
                                <v-btn 
                                icon 
                                color="red"
                                v-if="revenue_entries.length > 1"
                                @click="removeEntry(props.index)">
                                    <v-icon
                                    small
                                    color="#ffffff"
                                    >
                                        close
                                    </v-icon>
                                </v-btn>
                                <v-btn
                                v-if="props.index == revenue_entries.length-1"
                                icon
                                color="cyan"
                                @click="addEntry">
                                    <v-icon
                                    color="#ffffff"
                                    small
                                    >
                                        add
                                    </v-icon>
                                </v-btn>
                            </td>
                        </template>
                        <v-alert v-slot:no-results :value="true" color="error" icon="warning">
                            Your search for "{{ search }}" found no results.
                        </v-alert>
                    </v-data-table>
                    </form>
                </v-card>
            </v-layout>
        </v-container>
    </v-app>
</template>
<script>
    import { Message } from 'element-ui'
    import { GetRevenueTypes, CreateRevenue } from '../utils/revenue'
    export default {
        mounted() {
            this.fetchRevenueTypes();
            this.initPage();
        },
        data() {
            return {
                revenue_entries: [],
                headers: [{text:'#', value:'index', sortable:false},{text:'date',value:'',sortable:false}
                            , {text:'payee', value:'payee_name',sortable:false}, {text:'registration number', value:'registration_no',sortable:false}
                            , {text:'details', value:'revenue_type_id',sortable:false},{text:'Amount (GHC)', value:'amount',sortable:false}
                            , {text:'', value:'buttons',sortable:false}],
                revenue_types: []
            }
        },
        methods: {
            addEntry: function() {
                let entry = {date:'', payee_name:'', registration_no:'', revenue_type_id:'', amount:''};
                this.revenue_entries.push(entry);
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
            removeEntry: function(index) {
                this.revenue_entries.splice(index, 1);
            },
            saveToDisk: function(index) {
                localStorage.setItem('revenue_data', JSON.stringify(this.revenue_entries));
            },
            initPage: function(){
                let localEntries = localStorage.getItem('revenue_data');
                if(localEntries) {
                    this.revenue_entries = JSON.parse(localEntries);
                } else {
                    this.addEntry();
                }
            },
            createRevenue: function() {
                let entries = this.revenue_entries || [];
                CreateRevenue(entries)
                    .then(result=> {
                        if(localStorage.getItem('revenue_data')) {
                            localStorage.removeItem('revenue_data');
                        }
                        this.revenue_entries = [];
                        this.initPage();
                    })
                    .catch(err=> {

                    })
            },
            resetForm: function() {
                if(localStorage.getItem('revenue_data')) {
                    localStorage.removeItem('revenue_data');
                }
                this.revenue_entries = [];
                this.addEntry();
            }
        },
        computed: {
            revenueTypeList: function(){
                let typeEntries = this.revenue_types || [];
                let res = typeEntries.map((entry)=> {
                    return {value:entry.id, text:entry.label}
                })
                return res;
            }
        }
    }
</script>
<style scoped>

</style>