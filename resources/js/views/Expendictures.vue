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
                                    label="pv no"
                                    v-model="edit_expendicture.pv_no"></v-text-field>
                                </v-flex>
                                <v-flex>
                                    <v-text-field
                                    label="Payee"
                                    v-model="edit_expendicture.payee_name"></v-text-field>
                                </v-flex>
                                <v-flex>
                                    <v-select
                                    v-model="edit_expendicture.expendicture_type_id"
                                    :items="expendictureTypeList"
                                    ></v-select>
                                </v-flex>
                                <v-flex>
                                    <v-text-field
                                    label="code"
                                    v-model="edit_expendicture.code"></v-text-field>
                                </v-flex>
                                <v-flex>
                                    <v-text-field
                                    label="amount (GHC)"
                                    type="number"
                                    min="0"
                                    step="0.01"
                                    v-model="edit_expendicture.amount"></v-text-field>
                                </v-flex>
                                <v-flex>
                                    <v-text-field
                                    label="tax (GHC)"
                                    type="number"
                                    min="0"
                                    step="0.01"
                                    v-model="edit_expendicture.tax"></v-text-field>
                                </v-flex>
                                <v-flex>
                                    <v-text-field
                                    label="net (GHC)"
                                    type="number"
                                    min="0"
                                    step="0.01"
                                    v-model="edit_expendicture.net"></v-text-field>
                                </v-flex>
                                <v-flex>
                                    <v-text-field
                                    label="Payee"
                                    v-model="edit_expendicture.cheque_no"></v-text-field>
                                </v-flex>
                                <v-flex>
                                    <v-text-field
                                    label="Payee"
                                    v-model="edit_expendicture.payment_date"></v-text-field>
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
                        @click="updateExpendicture">UPDATE</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-layout>
                <v-flex xs12>
                    <v-card>
                        <v-toolbar color="cyan" dark>
                            <v-toolbar-side-icon></v-toolbar-side-icon>
                            <v-toolbar-title>Expendicture Records</v-toolbar-title>
                        </v-toolbar>
                        <v-card-title>
                            All Expendictures
                            <v-spacer></v-spacer>
                            <v-text-field
                            v-model="search"
                            append-icon="search"
                            label="Search"
                            single-line
                            hide-details
                            ></v-text-field>
                        </v-card-title>
                        <v-data-table
                        :headers="headers"
                        :items="expendictures"
                        :search="search"
                        >
                            <template v-slot:items="props">
                                <td class="text-xs-left">{{ props.index + 1 }}</td>
                                <td class="text-xs-left" width="200px">
                                   {{props.item.pv_no}}
                                </td>
                                <td class="text-xs-left" width="200px">
                                    {{props.item.payee_name}}
                                </td>
                                <td class="text-xs-left" width="200px">
                                    {{props.item.expendicture_type.label}}
                                </td>
                                <td class="text-xs-left" width="200px">
                                    {{props.item.code}}
                                </td>
                                <td width="200px">
                                    {{props.item.amount}}
                                </td>
                                <td width="200px">
                                    {{props.item.tax}}
                                </td>
                                <td width="200px">
                                    {{props.item.net}}
                                </td>
                                <td width="200px">
                                    {{props.item.cheque_no}}
                                </td>
                                <td width="200px">
                                    {{props.item.payment_date}}
                                </td>
                                <td>
                                    <v-btn
                                    icon
                                    color="cyan"
                                    @click="openEditExpendictureDialog(props.item, props.index)">
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
                                    @click="DeleteExpendicture(props.item)">
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
    import { GetExpendicture, UpdateExpendicture, DeleteExpendicture, GetExpendictureTypes } from '../utils/expendicture'
    export default {
        mounted() {
            this.fetchExpendictureTypes();
            this.fetchExpendictures();
        },
        data() {
            return {
                search:'',
                filter:'',
                edit_dialog: false,
                expendictures: [],
                headers: [{text:'#', value:'index', sortable:false},{text:'pv number',value:'pv_no',sortable:false}
                            , {text:'payee', value:'payee_name',sortable:false}, {text:'details', value:'expendicture_type',sortable:false}
                            , {text:'code', value:'code'}, {text:'Amount (GHC)', value:'amount',sortable:false}
                            ,{text:'tax', value:'tax'}, {text:'net', value:'net'}
                            , {text:'cheque_no', value:'cheque_no'}, {text:'date of payment', value:'payment_date'}
                            , {text:'', value:'buttons',sortable:false}],
                edit_expendicture: {},  
                edit_revenue_index: null,   
                expendicture_types: [],       
            }
        },
        methods: {
            deleteExpendicture: function(row){
                let index = this.revenues.indexOf(row);
                let data = row || {};
                if(confirm('Are you sure you want to delete')) {
                    DeleteExpendicture(data)
                        .then(result=> {
                            this.revenues.splice(index, 1);
                        })
                        .catch(err=> {

                        })
                }
            },
            openEditExpendictureDialog: function(row, index){
                this.edit_revenue_index = index;
                this.edit_expendicture = Vue.util.extend({}, row);
                this.edit_dialog = true;
            },
            fetchExpendictures: function() {
                GetExpendicture()
                    .then(result=> {
                        console.log(result)
                        this.expendictures = result.expendictures || [];
                        console.log('data', this.expendictures)
                    })
            },
            fetchExpendictureTypes: function() {
                let data = {filter: this.filter}
                GetExpendictureTypes(data)
                    .then(result=> {
                        this.expendicture_types = result.expendicture_types || [];
                    })
                    .catch(err=> {
                        console.log(err);
                    })

            },
            updateExpendicture: function() {
                let index = this.edit_revenue_index;
                UpdateExpendicture(this.edit_expendicture)
                    .then(result=> {
                        console.log(result)
                        this.edit_dialog = false;
                        this.edit_revenue = {};
                        this.revenues = result.revenues;
                    })
                    .catch(err=> {

                    })
            }
        },
        computed: {
            expendictureTypeList: function(){
                let typeEntries = this.expendicture_types || [];
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