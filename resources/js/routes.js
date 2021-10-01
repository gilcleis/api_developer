import ListDeveloper from './components/developers/List.vue';
import CreateDeveloper from './components/developers/Create.vue';
import EditDeveloper from './components/developers/Edit.vue';
 
export const routes = [
   
    // ********************  developers
    {
        name: 'developer.list',
        path: '/',
        component: ListDeveloper
    },
    {
        name: 'developer.list',
        path: '/developers',
        component: ListDeveloper
    },
    {
        name: 'developer.create',
        path: '/developers/create',
        component: CreateDeveloper
    },
    {
        name: 'developer.edit',
        path: '/developers/edit/:id',
        component: EditDeveloper
    },

    
];