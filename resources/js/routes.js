const Welcome = () => import('./components/Welcome.vue')
const VehicleList = () => import('./components/vehicle/list.vue')
const VehicleCreate = () => import('./components/vehicle/add.vue')
const VehicleUpdate = () => import('./components/vehicle/update.vue')
const VehicleShow = () => import('./components/vehicle/show.vue')

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Welcome
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