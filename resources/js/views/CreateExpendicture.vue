<template>
    <v-app>
        <v-container fluid>
            <v-layout>  
                <v-card width="100%">
                <form @submit.prevent="createExpendicture">
                    <v-toolbar color="cyan" dark>
                        <v-toolbar-side-icon></v-toolbar-side-icon>
                        <v-toolbar-title>Create Expendicture</v-toolbar-title>
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
                    :items="expendicture_entries"
                    :hide-actions=true
                    >
                        <template v-slot:items="props">
                            <td class="text-xs-left">{{ props.index + 1 }}</td>
                            <td class="text-xs-left" width="200px">
                                <v-text-field
                                v-model="props.item.pv_no"></v-text-field>
                            </td>
                            <td class="text-xs-left" width="300px">
                                <v-text-field
                                v-model="props.item.payee_name"></v-text-field>
                            </td>
                            <td class="text-xs-left" width="200px">
                                <v-select
                                v-model="props.item.expendicture_type_id"
                                :items="revenueTypeList"
                                :rules="[v => !!v || 'Item is required']"
                                required
                                ></v-select>
                            </td>
                            <td class="text-xs-left" width="150px">
                                <v-text-field
                                v-model="props.item.code"></v-text-field>
                            </td>
                            <td width="200px">
                                <v-text-field
                                v-model="props.item.amount"
                                min="0"
                                type="number" step="0.01"></v-text-field>
                            </td>
                            <td width="200px">
                                <v-text-field
                                v-model="props.item.tax"
                                min="0"
                                type="number" step="0.01"></v-text-field>
                            </td>
                            <td width="200px">
                                {{ entryNet(props.item) }}
                            </td>
                            <td width="200px">
                                <v-text-field
                                v-model="props.item.cheque_no"
                                type="number" step="0.01"></v-text-field>
                            </td>
                            <td width="200px">
                                <v-text-field
                                v-model="props.item.payment_date"
                                placeholder="dd-mm-yyyy"></v-text-field>
                            </td>
                            <td width="150px">
                                <v-text-field
                                v-model="props.item.tax_staus"></v-text-field>
                            </td>
                            <td>
                                <v-btn 
                                icon 
                                color="red"
                                v-if="expendicture_entries.length > 1"
                                @click="removeEntry(props.index)">
                                    <v-icon
                                    small
                                    color="#ffffff"
                                    >
                                        close
                                    </v-icon>
                                </v-btn>
                                <v-btn
                                v-if="props.index == expendicture_entries.length-1"
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
    import { GetExpendictureTypes, CreateExpendicture } from '../utils/expendicture'
    export default {
        mounted() {
            this.fetchRevenueTypes();
            this.initPage();
        },
        data() {
            return {
                expendicture_entries: [],
                headers: [{text:'#', value:'index', sortable:false},{text:'PV #',value:'pv_no',sortable:false}
                            , {text:'payee', value:'payee_name',sortable:false}, {text:'details', value:'expendicture_type_id',sortable:false}
                            ,{text:'code', value:'code',sortable:false}, {text:'Amount (GHC)', value:'amount',sortable:false}
                            , {text:'tax (GHC)', value:'tax',sortable:false}, {text:'NET (GHC)', value:'net',sortable:false}
                            ,{text:'Cheque #', value:'cheque_no',sortable:false}, {text:'Date of payment', value:'payment_date',sortable:false}
                            ,{text:'Tax Status', value:'tax_status',sortable:false}, {text:'', value:'buttons',sortable:false}],
                expendicture_types: []
            }
        },
        methods: {
            addEntry: function() {
                let entry = {date:'', pv_no:'',payee_name:'', expendicture_type_id:'', code:'', amount:''
                                ,tax:'', net:'', cheque_no:'', payment_date:'', tax_status:''};
                this.expendicture_entries.push(entry);
            },
            fetchRevenueTypes: function() {
                let data = {filter: this.filter}
                GetExpendictureTypes(data)
                    .then(result=> {
                        this.expendicture_types = result.expendicture_types || [];
                    })
                    .catch(err=> {
                        console.log(err);
                    })
            },
            removeEntry: function(index) {
                this.expendicture_entries.splice(index, 1);
            },
            saveToDisk: function(index) {
                localStorage.setItem('expendicture_data', JSON.stringify(this.expendicture_entries));
            },
            initPage: function(){
                let localEntries = localStorage.getItem('expendicture_data');
                if(localEntries) {
                    this.expendicture_entries = JSON.parse(localEntries);
                } else {
                    this.addEntry();
                }
            },
            createExpendicture: function() {
                let entries = this.expendicture_entries || [];
                let res = [];
                entries.forEach((entry)=> {
                    let d = entry;
                    d.net = this.entryNet(entry);
                    res.push(d);
                })
                console.log('data', res);
                CreateExpendicture(res)
                    .then(result=> {
                        if(localStorage.getItem('expendicture_data')) {
                            localStorage.removeItem('expendicture_data');
                        }
                        this.expendicture_entries = [];
                        this.initPage();
                    })
                    .catch(err=> {

                    })
            },
            entryNet: function(row) {
                let amount = Number(row.amount) || 0;
                let tax = Number(row.tax) || 0
                let sum =  amount+tax;
                return sum.toFixed(2);
            },
            resetForm: function() {
                if(localStorage.getItem('expendicture_data')) {
                    localStorage.removeItem('expendicture_data');
                }
                this.expendicture_entries = [];
                this.addEntry();
            }
        },
        computed: {
            revenueTypeList: function(){
                let typeEntries = this.expendicture_types || [];
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