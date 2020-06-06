import Dashboard from './components/Crm/Dashboard.vue';
import Services from './components/Crm/Services';
import Employees from './components/Crm/Employees';
import Goods from './components/Crm/Goods';
import Clients from './components/Crm/Clients';
import Bids from './components/Crm/Bids';

const router = [
  {
    path: '/crm/dashboard',
    component: Dashboard,
    meta: { title: 'Статистика', mdi: 'mdi-home' },
  },
  {
    path: '/crm/bids',
    component: Bids,
    meta: { title: 'Заявки', mdi: 'mdi-bell-ring' },
  },
  {
    path: '/crm/services',
    component: Services,
    meta: { title: 'Услуги', mdi: 'mdi-toolbox' },
  },
  {
    path: '/crm/clients',
    component: Clients,
    meta: { title: 'Клиенты', mdi: 'mdi-account-group' },
  },
  {
    path: '/crm/employees',
    component: Employees,
    meta: { title: 'Сотрудники', mdi: 'mdi-account-group' },
  },
  {
    path: '/crm/goods',
    component: Goods,
    meta: { title: 'Товары', mdi: 'mdi-wrench' },
  },
];

export default router;
