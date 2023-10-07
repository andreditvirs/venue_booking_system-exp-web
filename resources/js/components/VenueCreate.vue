<template>
    <Navbar />
    <div class="container">
        <div class="row my-3">
            <div class="col-10"><h2>Venue - Create</h2></div>
            <router-link class="col-2 ml-auto btn btn-secondary" to="/venue">Kembali</router-link>
        </div>
        <div class="container my-3">
            <form class="row" @submit.prevent="submit">
                <div class="form-group col-lg-8 col-md-8 col-sm-12">
                    <label>Nama</label>
                    <input type="text" class="form-control" placeholder="Enter Nama Venue" v-model="form.nama">
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sm-12">
                    <label>Kategori</label>
                    <select class="form-control" v-model="form.kategori">
                        <option v-for="(category, index) in categories" :value="category.value" :key="index">{{ category.name }}</option>
                    </select>
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sm-12">
                    <label>Thumbnail</label>
                    <input type="file" class="form-control" @change="selectFile"/>
                </div>
                <div class="form-group col">
                    <label>Alamat</label>
                    <textarea class="form-control" v-model="form.alamat"></textarea>
                </div>
                <hr />
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <h5 class="text-center" style="color: #33363A;font-family: Poppins;font-size:20px">Kalender Agenda</h5>
                        <div style="background-color: #FFFFFF;border-radius: 9px;padding: 15px 15px 15px 15px;font-size:15px">
                            <table class="table table-striped table-bordered bg-default table-hover text-center" style="width: 100%;height: 100%">
                                <thead>
                                <tr>
                                    <th colspan="2">
                                        <i>{{'<<'}}Before</i>
                                    </th>
                                    <th colspan="3" style='text-align:center'></th>
                                    <th colspan="2">
                                        <i>Next{{'>>'}}</i>
                                    </th>
                                </tr>
                                <tr>
                                    <th style="text-align: center; color:red">S</th>
                                    <th style="text-align: center">M</th>
                                    <th style="text-align: center">T</th>
                                    <th style="text-align: center">W</th>
                                    <th style="text-align: center">T</th>
                                    <th style="text-align: center">F</th>
                                    <th style="text-align: center">S</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(v, indexTr) in [1, 2, 3, 4, 5]" :key="indexTr">
                                        <template v-for="(d, index) in dates[this.year][this.month]" :key="index">
                                            <td class="hover-date" :title="d.long_value" v-if="d.week==v && d.name=='Minggu'">{{ d.value }}</td> 
                                            <td class="hover-date" :title="d.long_value" v-else-if="d.week==v && d.name=='Senin'">{{ d.value }}</td> 
                                            <td class="hover-date" :title="d.long_value" v-else-if="d.week==v && d.name=='Selasa'">{{ d.value }}</td> 
                                            <td class="hover-date" :title="d.long_value" v-else-if="d.week==v && d.name=='Rabu'">{{ d.value }}</td> 
                                            <td class="hover-date" :title="d.long_value" v-else-if="d.week==v && d.name=='Kamis'">{{ d.value }}</td> 
                                            <td class="hover-date" :title="d.long_value" v-else-if="d.week==v && d.name=='Jumat'">{{ d.value }}</td> 
                                            <td class="hover-date" :title="d.long_value" v-else-if="d.week==v && d.name=='Sabtu'">{{ d.value }}</td> 
                                        </template>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div>
                            <h4>Penyewa</h4>
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="number" class="form-control" v-model="harga"/>
                        </div>
                        <div class="form-group">
                            <label>User</label>
                            <select class="form-control">
                                <option></option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>
    </div>
</template>
<script>
import router from '../routes';
import Navbar from './Navbar.vue';
import Card from './Card.vue';

    export default {
        components: {
            Navbar, Card
        },
        data(){
            return {
                venue: [],
                form: {
                    nama: '',
                    alamat: '',
                    kategori: '',
                    file_image: ''
                },
                categories: [
                    {'name': 'Enter Kategori Venue', 'value' : ''},
                    {'name': 'Hotel', 'value' : 'Hotel'},
                    {'name': 'Convention Hall', 'value' : 'Convention Hall'},
                    {'name': 'Taman', 'value' : 'Taman'},
                ],
                dates: [],
                year: new Date().getFullYear(),
                month: new Date().getMonth()+1
            }
        },
        beforeMount(){
            const today = new Date();
            this.changeDaysInMonth(today.getMonth(), today.getFullYear());
        },
        methods: {
            selectFile(event) {
                this.form.file_image = event.target.files[0];
            },
            async submit(){
                const data = new FormData();
                data.append('file_image', this.form.file_image);
                data.append('nama', this.form.nama);
                data.append('kategori', this.form.kategori);
                data.append('alamat', this.form.alamat);
                await axios.get('/sanctum/csrf-cookie');
                await axios.post("/api/venue/", data);
                router.push({name: 'Venue'});
            },
            getDaysInMonth(month, year) {
                var date = new Date(year, month, 1); // first                
                let date_year = date.getFullYear();
                let date_month = date.getMonth()+1;
                
                let dates = new Array();
                dates[date_year]= [];
                dates[date_year][date_month] = [];
                while (date.getMonth() === month) {
                    let date_day = date.getDate();
                    dates[date_year][date_month].push({ long_value: `${date_year}-${date_month}-${date_day}`, value: date_day, name: date.toLocaleDateString('id-ID', {weekday: 'long'}), week: Math.ceil( (date.getDate())/7 )});
                    date.setDate(date.getDate() + 1);
                }
                return dates;
            },
            changeDaysInMonth(month, year){
                this.dates = this.getDaysInMonth(month, year);
            }
        }
    }
</script>