<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>SINDRY</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <v-app :dark="darkmode">
                <v-content>
                    <v-container fill-height text-xs-center>
                        <v-layout row wrap align-center justify-center>
                            <v-flex>
                                <h1 class="display-3 font-weight-thin mb-3">SINDRY</h1>
                                <v-text-field v-model="keyword" label="Search for loundry transaction histories" append-icon="search" color="teal" solo clearable></v-text-field>
                                <v-slide-y-transition>
                                    <v-data-table hide-headers hide-actions :items="transactions" class="elevation-1" v-if="transactions" :loading="true">
                                        <template v-slot:items="props">
                                            <td nowrap class="text-xs-left py-2">
                                                @{{ props.item.code }} <br>
                                                A/N : @{{ props.item.customer.name }}
                                            </td>
                                            <td nowrap class="text-xs-left">
                                                <small>Masuk</small> <br> @{{ props.item.start_date }}
                                            </td>
                                            <td nowrap class="text-xs-left">
                                                <small>Selesai</small> <br> @{{ props.item.end_date }}
                                            </td>
                                            <td nowrap class="text-xs-left">@{{ props.item.days }} hari</td>
                                            <td nowrap class="text-xs-left">Rp. @{{ props.item.amount | number }},-</td>
                                            <td nowrap class="text-xs-center">
                                                <v-chip small color="teal" text-color="white" v-if="props.item.status">
                                                    <v-avatar><v-icon>check_circle</v-icon></v-avatar> Done
                                                </v-chip>
                                                <v-chip small color="orange" text-color="white" v-else>
                                                    Progress
                                                </v-chip>
                                            </td>
                                            <td nowrap class="text-xs-right">
                                                <v-btn flat icon small class="mr-0" v-on:click="show(props.item)">
                                                    <v-icon>list</v-icon>
                                                </v-btn>
                                            </td>
                                        </template>
                                    </v-data-table>
                                </v-slide-y-transition>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-content>

                <v-dialog v-model="detail.dialog" width="800">
                    <v-card v-if="Object.keys(detail.data).length">
                        <v-card-title class="headline">Detail Transaction</v-card-title>
                        <v-card-text class="pb-0">
                            <table>
                                <tr>
                                    <th class="text-xs-left pa-1 pr-3" width="1%" nowrap>ID </th>
                                    <td class="text-xs-left pa-1" nowrap>: @{{ detail.data.code }}</td>
                                    <td class="text-xs-right" width="1%" nowrap>
                                        <b>Date</b> : @{{ detail.data.start_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-xs-left pa-1 pr-3" nowrap>Customer </th>
                                    <td class="text-xs-left pa-1" nowrap>: @{{ detail.data.customer.name }}</td>
                                </tr>
                                <tr>
                                    <th class="text-xs-left pa-1 pr-3" nowrap>Phone </th>
                                    <td class="text-xs-left pa-1" nowrap>: @{{ detail.data.customer.phone }}</td>
                                </tr>
                                <tr>
                                    <th class="text-xs-left pa-1 pr-3" nowrap>Address </th>
                                    <td class="text-xs-left pa-1" nowrap>: @{{ detail.data.customer.address }}</td>
                                </tr>
                                <tr>
                                    <th class="text-xs-left pa-1 pr-3" nowrap>Status</th>
                                    <td class="text-xs-left pa-1" nowrap>:
                                        <v-chip small color="teal" text-color="white" v-if="detail.data.status">
                                            <v-avatar><v-icon>check_circle</v-icon></v-avatar> Done
                                        </v-chip>
                                        <v-chip small color="orange" text-color="white" v-else>
                                            Progress
                                        </v-chip>
                                    </td>
                                </tr>
                            </table>
                        </v-card-text>
                        <v-data-table :headers="detail.headers" hide-actions :items="detail.data.details">
                            <template v-slot:items="props">
                                <td nowrap class="text-xs-left">
                                    @{{ props.item.type.name }}
                                    <span style="float: right"> Rp. @{{ props.item.type.price }} / kg</span>
                                </td>
                                <td nowrap class="text-xs-center">@{{ props.item.qty }} kg</td>
                                <td nowrap class="text-xs-right">Rp. @{{ props.item.subtotal | number }},-</td>
                            </template>
                            <template v-slot:footer>
                                <td colspan="3" class="text-xs-right font-weight-bold">Total — Rp. @{{ detail.data.amount | number }},-</td>
                            </template>
                        </v-data-table>

                        <div class="text-xs-center pa-2">
                            <v-btn color="red darken-1" flat @click="detail.dialog = false">
                                <v-icon dark left>close</v-icon> Close
                            </v-btn>
                        </div>
                    </v-card>
                </v-dialog>
            </v-app>
        </div>

        <script src="{{ asset('/js/app.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.js"></script>
        <script>
            new Vue({
                el: '#app',
                data: () => ({
                    keyword: '',
                    darkmode: false,
                    transactions: null,
                    detail: {
                        dialog: false,
                        headers: [
                            { text: 'Item', value: 'item', sortable: false },
                            { text: 'QTY', value: 'qty', align: 'center', sortable: false  },
                            { text: 'Subtotal', value: 'subtotal', align: 'right', sortable: false },
                        ],
                        data: []
                    }
                }),
                watch: {
                    keyword(value) {
                        this.searchIt(value)
                    }
                },
                methods: {
                    searchIt: _.debounce(function(value) {
                        if (value) {
                            this.search(value)
                        } else {
                            this.transactions = null
                        }
                    }, 300),

                    search(keyword) {
                        axios.get('/api/transactions', {
                            params: { q: keyword }
                        })
                        .then(({ data }) => {
                            this.transactions = data
                        })
                    },

                    show(data) {
                        this.detail.data = data
                        this.detail.dialog = true
                    }
                }
            })
        </script>
    </body>
</html>
