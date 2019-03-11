<template>
    <v-app>
        <v-container fluid text-md-center>
            <v-dialog v-model="edit_dialog" width="400px">
                <v-card>
                    <v-card-title>Edit Expendicture Type</v-card-title>
                    <v-card-text>
                        <v-container grid-list-xs>
                            <v-layout column>
                                <v-flex>
                                    <v-text-field
                                    label="label"
                                    v-model="edit_expendicture_type.label"></v-text-field>
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
                        @click="updateExpendictureType">UPDATE</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-layout row grid>
                <v-flex md7 xs12 style="margin-right:10px">
                    <v-card style="min-height:600px">
                        <v-card-title>
                            All Expendicture Types
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
                        :items="expendicture_types"
                        :search="search"
                        >
                            <template v-slot:items="props">
                                <td class="text-xs-left">{{ props.item.label }}</td>
                                <td class="text-xs-left">{{ props.item.created_at }}</td>
                                <td class="justify-center layout px-0">
                                    <v-icon
                                        small
                                        class="mr-2 mt-2"
                                        @click="editExpendictureTypeDialog(props.item, props.index)"
                                    >
                                        edit
                                    </v-icon>
                                    <v-icon
                                        small
                                        class="mt-2"
                                        @click="deleteExpendictureType(props.item)"
                                    >
                                        delete
                                    </v-icon>
                                </td>
                            </template>
                            <v-alert v-slot:no-results :value="true" color="error" icon="warning">
                                Your search for "{{ search }}" found no results.
                            </v-alert>
                        </v-data-table>
                    </v-card>
                </v-flex>
                <v-flex md5 xs12>
                    <v-card style="min-height:600px">
                        <v-toolbar color="cyan" dark>
                            <v-toolbar-side-icon></v-toolbar-side-icon>
                            <v-toolbar-title>Create Expendicture Types</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-btn icon
                            @click="createNewExpendictureType">
                                <v-icon>add</v-icon>
                            </v-btn>
                        </v-toolbar>
                        <v-list style="margin-top:10px;">
                            <v-list-tile
                            style="margin-top:5px"
                            v-for="(entry, index) in new_expendicture_types"
                            :key="index">
                                <v-list-tile-action>
                                    <v-btn 
                                    icon
                                    v-if="new_expendicture_types.length > 1"
                                    @click="removeexpendictureTypeEntry(index)">
                                        <v-icon color="red">delete</v-icon>
                                    </v-btn>
                                </v-list-tile-action>
                                <v-list-tile-content style="padding:0">
                                    <v-text-field
                                    style="width:100% !important"
                                    box
                                    placeholder="label"
                                    v-model="entry.label"
                                    required></v-text-field>
                                </v-list-tile-content>
                                <v-list-tile-avatar>
                                    <v-btn 
                                    color="cyan" 
                                    icon 
                                    v-if="index == new_expendicture_types.length-1"
                                    @click="addNewExpendictureTypeEntry">
                                        <v-icon color="#ffffff">add</v-icon>
                                    </v-btn>
                                </v-list-tile-avatar>
                            </v-list-tile>
                        </v-list>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </v-app>
</template>
<script>
    import { Message } from 'element-ui'
    import { CreateNewExpendictureType, GetExpendictureTypes, UpdateExpendictureType, DeleteExpendictureType } from '../utils/expendicture'
    export default {
        mounted() {
            this.fetchExpendictureTypes();
        },
        data() {
            return {
                edit_dialog: false,
                filter: '',
                search: '',
                new_expendicture_types: [{label:''}],
                edit_expendicture_type: {},
                expendicture_types: [],
                headers: [ 
                    {text: 'Label',align: 'left',sortable: true, value: 'label'},
                    {text: 'Created on', align: 'left', value: 'created_at'},
                    {text:'', align: 'left', value:'name'}
                ]
            }    
        },
        methods: {
            addNewExpendictureTypeEntry: function(){
                let entry = {label:''};
                this.new_expendicture_types.push(entry);
            },
            removeExpendictureTypeEntry: function(index) {
                if(this.new_expendicture_types.length > 1) {
                    this.new_expendicture_types.splice(index, 1);
                }
            },
            createNewExpendictureType: function(index) {
                let data = this.new_expendicture_types;
                console.log(data);
                let errors = [];
                data.forEach((entry, index)=> {
                    if(entry.label == index) {
                        errors.push('')
                        
                    }
                })
                if(errors.length > 0) {
                    return Message({message: "Cannot create with empty label field",type: 'error',duration: 3 * 1000})
                }
                CreateNewExpendictureType(data)
                    .then((res)=> {
                        console.log(res)
                        this.new_expendicture_types = [{label:''}];
                        this.expendicture_types = res.expendicture_types || [];
                    })
                    .catch((err)=> {
                        console.log(err)
                    })
            },
            fetchExpendictureTypes: function() {
                let data = {filter: this.filter}
                GetExpendictureTypes(data)
                    .then(result=> {
                        this.expendicture_types = result.expendicture_types || [];
                        console.log(this.expendicture_types)
                    })
                    .catch(err=> {
                        console.log(err);
                    })
            },
            editExpendictureTypeDialog: function(row, index) {
                this.edit_expendicture_type = row || {};
                this.edit_expendicture_type.idx = index;
                this.edit_dialog = true;
            },
            updateExpendictureType: function() {
                UpdateExpendictureType(this.edit_expendicture_type)
                    .then((res)=> {
                        this.edit_dialog = false;
                        this.expendicture_types[index] = res.expendicture_type || {};
                        this.edit_expendicture_type = {};
                    })
                    .catch(err=> {

                    })
            },
            deleteExpendictureType: function(row) {
                let data = row;
                let isConfirm = confirm('Are you sure you want to delete this entry?')
                const index = this.expendicture_types.indexOf(row);
                if(isConfirm) {
                    DeleteExpendictureType(data)
                        .then((res)=> {
                            this.expendicture_types.splice(index, 1);
                        })
                        .catch(err=> {

                        })
                }
            }
        }
    }
</script>
<style scoped>

</style>
