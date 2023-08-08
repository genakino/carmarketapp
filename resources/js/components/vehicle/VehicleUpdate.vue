<template>
    <div class="container mt-5 mb-5">
        <h2>Update Vehicle</h2>
        <hr>
        <form @submit.prevent="update" enctype="multipart/form-data">
            <div class="form-group row mb-3">
                <label for="image" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-8">
                    <img :src="'/images/' + vehicle.image" height="450px" alt="...">
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="image" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-8">
                    <input type="file" name ="image" class="form-control" @change="onChange">
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" v-model="vehicle.name" required>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="make" class="col-sm-2 col-form-label">Make</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" v-model="vehicle.make" required>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="model" class="col-sm-2 col-form-label">Model</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" v-model="vehicle.model" required>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="year" class="col-sm-2 col-form-label">Year</label>
                <div class="col-sm-8">
                    <select name="year" class="form-control" v-model="vehicle.year" required>
                        <option value="" disabled>Choose Year</option>
                        <option v-for="year in yearList" v-bind:key="year" :value="year">
                            {{ year }}
                        </option>
                    </select>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="gearbox" class="col-sm-2 col-form-label">Gearbox</label>
                <div class="col-sm-8">
                    <select name="gearbox" class="form-control" v-model="vehicle.gearbox" required>
                        <option v-for="gearbox in gearbox_options" v-bind:key="gearbox.value" :value="gearbox.value">
                            {{ gearbox.text }}
                        </option>
                    </select>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="fuel_type" class="col-sm-2 col-form-label">Fuel Type</label>
                <div class="col-sm-8">
                    <select name="fuel_type" class="form-control" v-model="vehicle.fuel_type" required>
                        <option v-for="fuel_type in fuel_type_options" v-bind:key="fuel_type.value" :value="fuel_type.value">
                            {{ fuel_type.text }}
                        </option>
                    </select>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="price" class="col-sm-2 col-form-label">Price</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" v-model="vehicle.price" required>
                </div>
            </div>

            <div class="form-group row  mb-3">     
                <div class="col-sm-8">
                    <button type="button" class="btn btn-secondary" @click="goBack">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Vehicle</button>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
export default{
    name:"update-vehicle",
    data(){
        return{
            vehicle:{
                name:"",
                make:"",
                model:"",
                year:"",
                gearbox:"",
                fuel_type:"",
                image:"",
                price:"",
                newImage:""
            },
            startYear: 2000,
            endYear: new Date().getFullYear(),
            gearbox_options: [
                {text: 'Automatic', value:'Automatic'},
                {text: 'Manual', value:'Manual'}
            ],
            fuel_type_options: [
                {text: 'Petrol', value:'Petrol'},
                {text: 'Diesel', value:'Diesel'}
            ]
        }
    },
    computed: {
        yearList() {
        const years = [];
        for (let i = this.endYear; i >= this.startYear; i--) {
            years.push(i);
        }
        return years;
        },
    },
    mounted(){
        this.showVehicle()
    },
    methods:{
        goBack() {
            this.$router.go(-1)
        },
        onChange(e) {
            let image = e.target.files[0];
            this.vehicle.newImage = image;
        },
        async showVehicle(){
            await this.axios.get('/api/vehicle/'+this.$route.params.id).then(response=>{
                const { 
                    name,
                    make,
                    model,
                    year,
                    gearbox,
                    fuel_type,
                    image,
                    price 
                } = response.data
                this.vehicle.name = name
                this.vehicle.make = make
                this.vehicle.model = model
                this.vehicle.year = year
                this.vehicle.gearbox = gearbox
                this.vehicle.fuel_type = fuel_type
                this.vehicle.image = image
                this.vehicle.price = price
            }).catch(error=>{
                console.log(error)
            })
        },
        async update(){
            let updateData = new FormData();
            updateData.append('id', this.$route.params.id);
            updateData.append('name', this.vehicle.name);
            updateData.append('make', this.vehicle.make);
            updateData.append('model', this.vehicle.model);
            updateData.append('year', this.vehicle.year);
            updateData.append('gearbox', this.vehicle.gearbox);
            updateData.append('fuel_type', this.vehicle.fuel_type);
            updateData.append('image', this.vehicle.newImage ? this.vehicle.newImage : this.vehicle.image);
            updateData.append('price', this.vehicle.price);
            updateData.append('_method', 'PATCH');

            await this.axios.post('/api/vehicle/' + this.$route.params.id, updateData).then(response=>{
                alert(response.data.message);
                this.$router.push({name:"vehicleList"});                
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>