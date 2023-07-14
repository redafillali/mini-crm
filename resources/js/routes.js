import VueRouter from 'vue-router';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        // Company routes...
        {
            path: '/companies',
            name: 'companies.index',
            component: () => import('./Pages/Companies/Index.vue'),
        },
        {
            path: '/companies/create',
            name: 'companies.create',
            component: () => import('./Pages/Companies/Create.vue'),
        },
        {
            path: '/companies/:id/edit',
            name: 'companies.edit',
            component: () => import('./Pages/Companies/Edit.vue'),
        },
        // Employee routes...
        {
            path: '/employees',
            name: 'employees.index',
            component: () => import('./Pages/Employees/Index.vue'),
        },
        {
            path: '/employees/create',
            name: 'employees.create',
            component: () => import('./Pages/Employees/Create.vue'),
        },
        {
            path: '/employees/:id/edit',
            name: 'employees.edit',
            component: () => import('./Pages/Employees/Edit.vue'),
        },

        // Catch-all route...
        {
            path: '*',
            component: () => import('./Pages/404.vue'),
        },
    ],
});

export default router;
