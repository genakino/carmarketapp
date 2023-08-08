const Home = () => import('./components/Home.vue')
const VehicleList = () => import('./components/vehicle/VehicleList.vue')
const VehicleCreate = () => import('./components/vehicle/VehicleAdd.vue')
const VehicleUpdate = () => import('./components/vehicle/VehicleUpdate.vue')
const VehicleShow = () => import('./components/vehicle/VehicleShow.vue')

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'vehicleList',
        path: '/vehicles',
        component: VehicleList
    },
    {
        name: 'vehicleUpdate',
        path: '/vehicle/:id/update',
        component: VehicleUpdate
    },
    {
        name: 'vehicleAdd',
        path: '/vehicle/add',
        component: VehicleCreate
    },
    {    
        name: 'vehicleShow',
        path: '/vehicle/:id',
        component: VehicleShow
    }
]